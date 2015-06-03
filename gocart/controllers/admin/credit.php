<?php

class Credit extends Admin_Controller {	

	protected $activemenu 	= 'credit';
	var $current_admin	= false;
	
	function __construct()
	{		
		parent::__construct();		
		
		$this->load->model(array('Credit_model', 'Search_model', 'Point_model'));
		//$this->load->model('location_model');
		$this->load->helper(array('formatting'));
		$this->lang->load('credit');
		
		$this->current_admin	= $this->session->userdata('admin');
	}
	
	//this is a callback to make sure that customers are not sharing an email address
	function check_card($str)
	{
		$customer	= $this->Customer_model->get_customer_by_card($str);
		if ($customer)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_card', lang('error_card_in_use'));
			return FALSE;			
		}
	}
	
	function index($sort_by='created',$sort_order='desc', $code=0, $page=0, $rows=15)
	{		
		$data['activemenu'] 		= $this->activemenu;
		//if they submitted an export form do the export
		if($this->input->post('submit') == 'export')
		{
			$this->load->model('Credit_model');
			$this->load->helper('download_helper');
			$post	= $this->input->post(null, false);
			$term	= (object)$post;

			$data['credits']	= $this->Credit_model->get_credits($term);		
			
			force_download_content('credits.xml', $this->load->view($this->config->item('admin_folder').'/credits_xml', $data, true));
			
			//kill the script from here
			die;
		}
		
		$this->load->helper('form');
		$this->load->helper('date');
		$data['message']	= $this->session->flashdata('message');
		$data['page_title']	= lang('credits');
		$data['code']		= $code;
		$term				= false;
		
		$post	= $this->input->post(null, false);
		if($post)
		{
			//if the term is in post, save it to the db and give me a reference
			$term			= json_encode($post);			
			$code			= $this->Search_model->record_term($term);
			$data['code']	= $code;
			//reset the term to an object for use
			$term	= (object)$post;
		}
		elseif ($code)
		{
			$term	= $this->Search_model->get_term($code);
			$term	= json_decode($term);
		} 
 		
		
		
 		$data['term']	= $term;
 		$data['credits']	= $this->Credit_model->get_credits($term, $sort_by, $sort_order, $rows, $page);
		$data['total']	= $this->Credit_model->get_credits_count($term);
		
		$this->load->library('pagination');
		
		$config['base_url']			= site_url($this->config->item('admin_folder').'/credit/index/'.$sort_by.'/'.$sort_order.'/'.$code.'/');
		$config['total_rows']		= $data['total'];
		$config['per_page']			= $rows;
		$config['uri_segment']		= 7;
		$config['first_link']		= 'First';
		$config['first_tag_open']	= '<li>';
		$config['first_tag_close']	= '</li>';
		$config['last_link']		= 'Last';
		$config['last_tag_open']	= '<li>';
		$config['last_tag_close']	= '</li>';

		$config['full_tag_open']	= '<div class="pagination"><ul>';
		$config['full_tag_close']	= '</ul></div>';
		$config['cur_tag_open']		= '<li class="active"><a href="#">';
		$config['cur_tag_close']	= '</a></li>';
		
		$config['num_tag_open']		= '<li>';
		$config['num_tag_close']	= '</li>';
		
		$config['prev_link']		= '&laquo;';
		$config['prev_tag_open']	= '<li>';
		$config['prev_tag_close']	= '</li>';

		$config['next_link']		= '&raquo;';
		$config['next_tag_open']	= '<li>';
		$config['next_tag_close']	= '</li>';
		
		$this->pagination->initialize($config);
	
		$data['sort_by']	= $sort_by;
		$data['sort_order']	= $sort_order;
				
		$this->view($this->config->item('admin_folder').'/credits', $data);
	}
	
	function export()
	{
		$this->load->model('customer_model');
		$this->load->helper('download_helper');
		$post	= $this->input->post(null, false);
		$term	= (object)$post;
		
		$data['credits']	= $this->Credit_model->get_credits($term);		

		foreach($data['credits'] as &$o)
		{
			$o->items	= $this->Credit_model->get_items($o->id);
		}

		force_download_content('credits.xml', $this->load->view($this->config->item('admin_folder').'/credits_xml', $data, true));
		
	}
	
	function edit_status()
    {
    	$this->auth->is_logged_in();
    	$order['id']		= $this->input->post('id');
    	$order['status']	= $this->input->post('status');
    	
    	$this->Credit_model->save_order($order);
    	
    	echo url_title($order['status']);
    }    
	
	function bulk_delete()
    {
    	$credits	= $this->input->post('order');
    	
		if($credits)
		{
			foreach($credits as $order)
	   		{
	   			$this->Credit_model->delete($order);
	   		}
			$this->session->set_flashdata('message', lang('message_credits_deleted'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_no_credits_selected'));
		}
   		//redirect as to change the url
		redirect($this->config->item('admin_folder').'/credits');	
    }
    
    function topup_credit_form($id = false)
    {
    	$data['activemenu'] 		= $this->activemenu;
    	//$this->load->helper('form');
    	$this->load->helper(array('form', 'date'));
    	$this->load->library('form_validation');
    
    	$data['page_title']		= lang('topup_credit_form');
    
    	//default values are empty if the customer is new
    	$data['id']					= '';
    	$data['card']				= '';
    	$data['created']			= '';
    	$data['cost']				= '';
    	$data['in']					= '';
    	$data['out']				= '';   
    	$data['remark']				= '';    	
    	$data['active']				= false;
    	
    	$customer = '';
    	if ($id)
    	{
    		//$this->customer_id	= $id;
    		$customer		= $this->Customer_model->get_customer_by_id($id);
    		//if the customer does not exist, redirect them to the customer list with an error
    		if (!$customer)
    		{
    			$this->session->set_flashdata('error', lang('error_not_found'));
    			redirect($this->config->item('admin_folder').'/credit');
    		}
    			
    		//set values to db values
    		$data['id']					= $customer->id;
    		$data['name']				= $customer->name;
    		$data['firstname']			= $customer->firstname;
    		$data['lastname']			= $customer->lastname;
    		$data['email']				= $customer->email;
    		$data['phone']				= $customer->phone;
    		$data['company']			= $customer->company;
    		$data['active']				= $customer->active;
    		$data['email_subscribe']	= $customer->email_subscribe;
    			
    	}
    	
    	$this->form_validation->set_rules('card', 'lang:card', 'trim|required|max_length[255]|callback_check_card');
    	$this->form_validation->set_rules('topup_date', 'lang:topup_date', 'trim|required');
    	$this->form_validation->set_rules('customer_cost', 'lang:customer_cost', 'trim|required|numeric');
    	$this->form_validation->set_rules('customer_topup_value', 'lang:customer_topup_value', 'trim|required|numeric');
    	$this->form_validation->set_rules('remark', 'lang:remark', 'trim|required');    	
    	$this->form_validation->set_rules('active', 'lang:active');
    	    	
    	if ($this->form_validation->run() == FALSE)
    	{
    		$this->view($this->config->item('admin_folder').'/topup_credit_form', $data);
    	}
    	else
    	{
    		$card = $this->input->post('card');
    		$customer		= $this->Customer_model->get_customer_by_card($card);
    		
    		$save['id']					= $id;
    		$save['customer_id']		= $customer['id'];
    		$save['cost']				= $this->input->post('customer_cost');
    		$save['in']					= $this->input->post('customer_topup_value');
    		$save['remark']				= $this->input->post('remark');
    		$save['created']			= format_ymd_malaysia($this->input->post('topup_date'));
    		$save['staff_id']			= $this->current_admin['id'];
    		
    		//$save['status']				= 1;
    		//$save['active']				= $this->input->post('active');
    			
    		$this->Credit_model->save_credit($save);
    			
    		$this->session->set_flashdata('message', lang('message_saved_customer'));
    			
    		//go back to the credit
    		redirect($this->config->item('admin_folder').'/credit');
    	}
    }
    
    function consume_form($id = false)
    {
    	$data['activemenu'] 		= $this->activemenu;
    	//$this->load->helper('form');
    	$this->load->helper(array('form', 'date'));
    	$this->load->library('form_validation');
    
    	$data['page_title']		= lang('consume_form');
    
    	//default values are empty if the customer is new
    	$data['id']					= '';
    	$data['card']				= '';
    	$data['created']			= '';
    	$data['cost']				= '';
    	$data['in']					= '';
    	$data['out']				= '';
    	$data['remark']				= '';
    	$data['options']			= '';
    	$data['active']				= false;
    	 
    	$customer = '';
    	if ($id)
    	{
    		//$this->customer_id	= $id;
    		$customer		= $this->Customer_model->get_customer_by_id($id);
    		//if the customer does not exist, redirect them to the customer list with an error
    		if (!$customer)
    		{
    			$this->session->set_flashdata('error', lang('error_not_found'));
    			redirect($this->config->item('admin_folder').'/credit');
    		}
    		 
    		//set values to db values
    		$data['id']					= $customer->id;
    		$data['name']				= $customer->name;
    		$data['firstname']			= $customer->firstname;
    		$data['lastname']			= $customer->lastname;
    		$data['email']				= $customer->email;
    		$data['phone']				= $customer->phone;
    		$data['company']			= $customer->company;
    		$data['active']				= $customer->active;
    		$data['options']			= '';
    		$data['email_subscribe']	= $customer->email_subscribe;
    		 
    	}
    	 
    	$this->form_validation->set_rules('card', 'lang:card', 'trim|required|max_length[255]|callback_check_card');
    	$this->form_validation->set_rules('consume_date', 'lang:consume_date', 'trim|required');
    	$this->form_validation->set_rules('consume_amount', 'lang:consume_amount', 'trim|required|numeric');
    	
    	$this->form_validation->set_rules('remark', 'lang:remark', 'trim|required');
    	$this->form_validation->set_rules('payment', 'lang:payment', 'required');
    
    	if ($this->form_validation->run() == FALSE)
    	{
    		$this->view($this->config->item('admin_folder').'/consume_form', $data);
    	}
    	else
    	{
    		$card = $this->input->post('card');
    		$customer		= $this->Customer_model->get_customer_by_card($card);
    		$payment				= $this->input->post('payment');
    		
    		
    		if($payment == 'Credit')
    		{    			    			
    			$save['id']					= $id;
    			$save['customer_id']		= $customer['id'];
    			$save['out']				= $this->input->post('consume_amount');
    			$save['remark']				= $this->input->post('remark');
    			$save['created']			= format_ymd_malaysia($this->input->post('consume_date'));
    			$save['staff_id']			= $this->current_admin['id'];
    			//$save['branch'] = $staff_branch;    			
    			$id = $this->Credit_model->save_credit($save);
    		}
    		else{
    			$save['id'] = '';
    			$save['customer_id'] =  $customer['id'];
    			$save['depoint'] 	= $this->input->post('consume_amount');
    			$save['created'] = format_ymd_malaysia($this->input->post('consume_date'));
    			$save['staff_id'] = $this->current_admin['id'];
    			//$save['branch'] = $staff_branch;
    			//$save['status'] = 1; //enable
    			$save['remark'] =  $this->input->post('remark');
    		
    			$id = $this->Point_model->save_point($save);
    		}
    		
    		//$save['status']				= 1;
    		//$save['active']				= $this->input->post('active');    		 
    		 
    		$this->session->set_flashdata('message', lang('message_saved_customer'));
    		 
    		//go back to the credit
    		redirect($this->config->item('admin_folder').'/credit');
    	}
    }
    
    
    
}