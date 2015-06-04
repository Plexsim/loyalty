<?php

class Vouchers extends Admin_Controller {	
	
	var $voucher_id;
	
	function __construct()
	{		
		parent::__construct();
        
		$this->auth->check_access('Admin', true);
		$this->load->model('Voucher_model');
		$this->load->model('Product_model');
		$this->lang->load('voucher');
	}
	
	function index()
	{
		$data['page_title']	= lang('vouchers');
		$data['vouchers']	= $this->Voucher_model->get_vouchers();
		
		$this->view($this->config->item('admin_folder').'/vouchers', $data);
	}
	
	function upload_card() {
    	 
    	$today_date 	= date("Ymd");
    	$upload_path_url = base_url() . 'uploads/voucher/'.$today_date.'/';
    	    	
    	//$config['upload_path'] = FCPATH . 'uploads/';
    	$config['upload_path']		= FCPATH . 'uploads/voucher/'.$today_date.'/';
    	
    	
    	if (!is_dir($config['upload_path'])) {
    		mkdir('./uploads/voucher/' . $today_date, 0777, TRUE);
    		mkdir('./uploads/voucher/' . $today_date.'/thumbs', 0777, TRUE);
    	}    	
    	
    	$config['allowed_types'] = 'jpg|jpeg|png|gif';
    	$config['max_size'] = '30000';
    
    	$this->load->library('upload', $config);
    
    	if (!$this->upload->do_upload()) {
    		//$error = array('error' => $this->upload->display_errors());
    		//$this->load->view('upload', $error);
    
    		//Load the list of existing files in the upload directory
    		$existingFiles = get_dir_file_info($config['upload_path']);
    		$foundFiles = array();
    		$f=0;
    		foreach ($existingFiles as $fileName => $info) {
    			if($fileName!='thumbs'){//Skip over thumbs directory
    				//set the data for the json array
    				$foundFiles[$f]['name'] = $fileName;
    				$foundFiles[$f]['size'] = $info['size'];
    				$foundFiles[$f]['url'] = $upload_path_url . $fileName;
    				$foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
    				$foundFiles[$f]['deleteUrl'] = base_url() . 'upload/deleteImage/' . $fileName;
    				$foundFiles[$f]['deleteType'] = 'DELETE';
    				$foundFiles[$f]['error'] = null;
    
    				$f++;
    			}
    		}
    		$this->output
    		->set_content_type('application/json')
    		->set_output(json_encode(array('files' => $foundFiles)));
    	} else {
    		$data = $this->upload->data();
    		
    		
    		//echo '<div class="step-by-inner-img2"><img src='.base_url($full_path).' alt="voucher" class="image-voucher" style="width:100px; height:150px;"/></div>';
    		
    		/*
    		 * Array
    		(
    				[file_name] => png1.jpg
    				[file_type] => image/jpeg
    				[file_path] => /home/ipresupu/public_html/uploads/
    				[full_path] => /home/ipresupu/public_html/uploads/png1.jpg
    				[raw_name] => png1
    				[orig_name] => png.jpg
    				[client_name] => png.jpg
    				[file_ext] => .jpg
    				[file_size] => 456.93
    				[is_image] => 1
    				[image_width] => 1198
    				[image_height] => 1166
    				[image_type] => jpeg
    				[image_size_str] => width="1198" height="1166"
    		)
    		*/
    		// to re-size for thumbnail images un-comment and set path here and in json array
    		$config = array();
    		$config['image_library'] = 'gd2';
    		$config['source_image'] = $data['full_path'];
    		$config['create_thumb'] = TRUE;
    		$config['new_image'] = $data['file_path'] . 'thumbs/';
    		$config['maintain_ratio'] = TRUE;
    		$config['thumb_marker'] = '';
    		$config['width'] = 75;
    		$config['height'] = 50;
    		$this->load->library('image_lib', $config);
    		$this->image_lib->resize();
    
    
    		//set the data for the json array
    		$info = new StdClass;
    		$info->name = $data['file_name'];
    		$info->size = $data['file_size'] * 1024;
    		$info->type = $data['file_type'];
    		$info->url = $upload_path_url . $data['file_name'];
    		// I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
    		$info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
    		$info->deleteUrl = base_url() . 'upload/deleteImage/' . $data['file_name'];
    		$info->deleteType = 'DELETE';
    		$info->error = null;
    		
    		
    		$full_path = 'uploads/voucher/'.$today_date.'/'.$data['file_name'];
    		$save = array();
    		$save['image_voucher'] 	= $full_path;
    		//$this->load->model('Settings_model');
    		//update member table for record background or logo path to retrieve next day
    		$this->Settings_model->save_settings('gocart', $save);
    		
    		    		
    		$files[] = $info;
    		//this is why we put this in the constants to pass only json data
    		if (IS_AJAX) {
    			echo json_encode(array("files" => $files));
    			//this has to be the only data returned or you will get an error.
    			//if you don't give this a json array it will give you a Empty file upload result error
    			//it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
    			// so that this will still work if javascript is not enabled
    		} else {
    			$file_data['upload_data'] = $this->upload->data();
    			$this->load->view('upload/upload_success', $file_data);
    		}
    	}
    }
	
	
	function form($id = false)
	{
		$today_date 	= date("Ymd");
		//die(print_r($_POST));

		$this->load->helper(array('form', 'date'));
		$config['upload_path']		= 'uploads/voucher/'.$today_date.'/';
		
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->helper('form');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$this->voucher_id	= $id;
		
		$data['page_title']		= lang('voucher_form');
		
		//default values are empty if the product is new
		$data['id']						= '';
		$data['code']					= '';
		$data['name']					= '';
		$data['start_date']				= '';
		$data['whole_order_voucher']	= 1;
		$data['max_product_instances'] 	= '';
		$data['end_date']				= '';
		$data['max_uses']				= '';
		$data['reduction_target'] 		= 'price';
		$data['reduction_type']			= '';
		$data['reduction_amount']		= '';
		$data['point_consume']			= '';	
		$data['image']					= '';
		$data['desc']					= '';
		
		$added = array();
		
		if ($id)
		{	
			$voucher		= $this->Voucher_model->get_voucher($id);

			//if the product does not exist, redirect them to the product list with an error
			if (!$voucher)
			{
				$this->session->set_flashdata('message', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/product');
			}
			
			//set values to db values
			$data['id']						= $voucher->id;
			$data['code']					= $voucher->code;
			$data['name']					= $voucher->name;
			$data['start_date']				= $voucher->start_date;
			$data['end_date']				= $voucher->end_date;
			//$data['whole_order_voucher']	= $voucher->whole_order_voucher;
			$data['whole_order_voucher']	= 1;
			$data['whole_order_voucher']	= $voucher->whole_order_voucher;
			$data['max_product_instances'] 	= $voucher->max_product_instances;
			$data['num_uses']     			= $voucher->num_uses;
			$data['max_uses']				= $voucher->max_uses;
			//$data['reduction_target']		= $voucher->reduction_target;
			$data['reduction_target']		= 'price';
			$data['reduction_type']			= $voucher->reduction_type;
			$data['reduction_amount']		= $voucher->reduction_amount;
			$data['point_consume']			= $voucher->point_consume;
			$data['image']					= $voucher->image;
			$data['desc']					= $voucher->desc;
			
			$added = $this->Voucher_model->get_product_ids($id);
		}
		
		$this->form_validation->set_rules('code', 'lang:code', 'trim|required|callback_check_code');
		$this->form_validation->set_rules('max_uses', 'lang:max_uses', 'trim|numeric');
		$this->form_validation->set_rules('max_product_instances', 'lang:limit_per_order', 'trim|numeric');
		$this->form_validation->set_rules('whole_order_voucher', 'lang:whole_order_discount');
		//$this->form_validation->set_rules('reduction_target', 'lang:reduction_target', 'trim|required');
		$this->form_validation->set_rules('reduction_target', 'lang:reduction_target', 'trim');
		$this->form_validation->set_rules('reduction_type', 'lang:reduction_type', 'trim');
		$this->form_validation->set_rules('reduction_amount', 'lang:reduction_amount', 'trim|numeric');
		$this->form_validation->set_rules('point_consume', 'lang:point_consume', 'trim|numeric');
		$this->form_validation->set_rules('image', 'lang:image', 'trim');
		$this->form_validation->set_rules('desc', 'lang:desc', 'trim');
		
		$this->form_validation->set_rules('start_date', 'lang:start_date');
		$this->form_validation->set_rules('end_date', 'lang:end_date');
		
		// create product list
		$products = $this->Product_model->get_products();
		
		// set up a 2x2 row list for now
		$data['product_rows'] = "";
		$x=0;
		while(TRUE) { // Yes, forever, until we find the end of our list
			if ( !isset($products[$x] )) break; // stop if we get to the end of our list
			$checked = "";
			if(in_array($products[$x]->id, $added))
			{
				$checked = "checked='checked'";
			}
			$data['product_rows']  .=  "<tr><td><input type='checkbox' name='product[]' value='". $products[$x]->id ."' $checked></td><td> ". $products[$x]->name ."</td>";
			
			$x++;
			
			//reset the checked value to nothing
			$checked = "";
			if ( isset($products[$x] )) { // if we've gotten to the end on this row
				if(in_array($products[$x]->id, $added))
				{
					$checked = "checked='checked'";
				}
				$data['product_rows']  .= 	"<td><input type='checkbox' name='product[]' value='". $products[$x]->id ."' $checked><td><td> ". $products[$x]->name ."</td></tr>";
			} else {
				$data['product_rows']  .= 	"<td> </td></tr>";
			}
			
			$x++;
		} 
		
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/voucher_form', $data);
		}
		else
		{
			
			$this->load->helper('text');
			$uploaded	= $this->upload->do_upload('image');
			
			$save['id']						= $id;
			$save['code']					= $this->input->post('code');
			$save['name']					= $this->input->post('name');
			$save['start_date']				= format_ymd_malaysia($this->input->post('start_date'));
			$save['end_date']				= format_ymd_malaysia($this->input->post('end_date'));
			$save['max_uses']				= $this->input->post('max_uses');
			$save['whole_order_voucher'] 	= 1;
			//$save['whole_order_voucher'] 	= $this->input->post('whole_order_voucher');
			$save['max_product_instances'] 	= $this->input->post('max_product_instances');
			//$save['reduction_target']		= $this->input->post('reduction_target');
			$save['reduction_target']		= 'price';
			$save['reduction_type']			= $this->input->post('reduction_type');
			$save['reduction_amount']		= $this->input->post('reduction_amount');
			$save['point_consume']			= $this->input->post('point_consume');
			$save['desc']					= $this->input->post('desc');
			

			if($save['start_date']=='')
			{
				$save['start_date'] = null;
			}
			if($save['end_date']=='')
			{
				$save['end_date'] = null;
			}
			
			$product = $this->input->post('product');
			
			if ($id)
			{	
				//delete the original file if another is uploaded
				if($uploaded)
				{
					if($data['image'] != '')
					{
						//$file = 'uploads/'.$data['image'];
						//$config['upload_path'] = FCPATH . 'uploads/';						 						
						
						$file = 'uploads/voucher/'.$today_date.'/'.$data['image'];												
							
						//delete the existing file if needed
						if(file_exists($file))
						{
							unlink($file);
						}
					}
				}
					
			}
			else
			{
				if(!$uploaded)
				{
					$data['error']	= $this->upload->display_errors();
					$this->view(config_item('admin_folder').'/voucher_form', $data);
					return; //end script here if there is an error
				}
			}
			
			if($uploaded)
			{
				if (!is_dir('uploads/voucher/'.$today_date.'/')) {
					mkdir('./uploads/voucher/' . $today_date, 0777, TRUE);
					//mkdir('./uploads/voucher/' . $today_date.'/thumbs', 0777, TRUE);
				}
								
				$image			= $this->upload->data();
															
				$save['image']  = 'uploads/voucher/'.$today_date.'/'.$image['file_name'];
				//$save['image']	= $image['file_name'];
			}
			
			
			
			// save voucher
			$promo_id = $this->Voucher_model->save($save);
			
			// save products if not a whole order voucher
			//   clear products first, then save again (the lazy way, but sequence is not utilized at the moment)
			$this->Voucher_model->remove_product($id);
			
			if(!$save['whole_order_voucher'] && $product) 
			{
				while(list(, $product_id) = each($product))
				{
					$this->Voucher_model->add_product($promo_id, $product_id);
				}
			}
			
			// We're done
			$this->session->set_flashdata('message', lang('message_saved_voucher'));
			
			//go back to the product list
			redirect($this->config->item('admin_folder').'/vouchers');
		}
	}

	//this is a callback to make sure that 2 vouchers don't have the same code
	function check_code($str)
	{
		$code = $this->Voucher_model->check_code($str, $this->voucher_id);
        if ($code)
       	{
			$this->form_validation->set_message('check_code', lang('error_already_used'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function delete($id = false)
	{
		if ($id)
		{	
			$voucher	= $this->Voucher_model->get_voucher($id);
			//if the promo does not exist, redirect them to the customer list with an error
			if (!$voucher)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/vouchers');
			}
			else
			{
				$this->Voucher_model->delete_voucher($id);
				
				$this->session->set_flashdata('message', lang('message_voucher_deleted'));
				redirect($this->config->item('admin_folder').'/vouchers');
			}
		}
		else
		{
			//if they do not provide an id send them to the promo list page with an error
			$this->session->set_flashdata('message', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/vouchers');
		}
	}
}