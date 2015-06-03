<?php
class Latest_News extends Admin_Controller
{

	protected $activemenu 	= 'latest_news';
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('latest_news_model');
		
		$lang = $this->session->userdata('lang');
		$this->lang->load('latest_news', $lang);
		
	}
		
	function index()
	{
		$data['latest_news_title']	= lang('latest_news');
		$data['latest_news']		= $this->latest_news_model->get_list();		
		$data['activemenu'] 		= $this->activemenu;
		
		$this->view($this->config->item('admin_folder').'/latest_news', $data);
	}
	
	/********************************************************************
	edit latest_news
	********************************************************************/
	function form($id = false)
	{
		$data['activemenu'] 		= $this->activemenu;
		$this->load->helper('url');
		$this->load->helper('form');
						
		$config['upload_path']		= 'uploads';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
		$this->load->library('form_validation');
		//set the default values
		$data['id']			= '';
		$data['title']		= '';
		$data['caption']	= '';
		$data['content']	= '';
		$data['sequence']	= 0;
		$data['seo_title']	= '';
		$data['meta']		= '';		
		$data['enable_date']		= '';
		$data['disable_date']		= '';
		$data['image']		= '';
		$data['status']		= '';
		
		$data['latest_news_title']	= lang('latest_new_form');
		$data['latest_news']		= $this->latest_news_model->get_list();
		
		if($id)
		{
			
			$latest_news			= $this->latest_news_model->get_latest_news($id);
			
			if(!$latest_news)
			{
				//latest_news does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/latest_news');
			}
						
			//set values to db values
			$data['id']				= $latest_news['id'];			
			$data['title']			= $latest_news['title'];
			$data['caption']		= $latest_news['caption'];
			$data['content']		= $latest_news['content'];
			$data['sequence']		= $latest_news['sequence'];
			$data['seo_title']		= $latest_news['seo_title'];
			$data['meta']			= $latest_news['meta'];
			$data['enable_date']	= $latest_news['enable_date'];
			$data['disable_date']	= $latest_news['disable_date'];
			$data['image']			= $latest_news['image'];
			$data['status']			= $latest_news['status'];
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('caption', 'lang:caption', 'trim');
		$this->form_validation->set_rules('content', 'lang:content', 'trim');
		$this->form_validation->set_rules('enable_date', 'lang:enable_date', 'trim');
		$this->form_validation->set_rules('disable_date', 'lang:disable_date', 'trim');
		$this->form_validation->set_rules('image', 'lang:image', 'trim');
		$this->form_validation->set_rules('seo_title', 'lang:seo_title', 'trim');
		$this->form_validation->set_rules('meta', 'lang:meta', 'trim');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('status', 'lang:status', 'trim');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/latest_new_form', $data);
		}
		else
		{
			$this->load->helper('text');
			
			$uploaded	= $this->upload->do_upload('image');
			
			$save = array();
			
			$save['title']		= $this->input->post('title');
			$save['sequence']	= $this->input->post('sequence');
			$save['content']	= $this->input->post('content');						
			
			$save['seo_title']	= $this->input->post('seo_title');
			$save['meta']		= $this->input->post('meta');
			$save['status']		= $this->input->post('status');
				
								
			if ($id)
			{
				$save['id']			= $id;
			
				//delete the original file if another is uploaded
				if($uploaded)
				{
					if($data['image'] != '')
					{
						$file = 'uploads/'.$data['image'];
			
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
					$this->view(config_item('admin_folder').'/latest_new_form', $data);
					return; //end script here if there is an error
				}
			}
				
			if($uploaded)
			{
				$image			= $this->upload->data();
				$save['image']	= $image['file_name'];
			}
			
			
			
			//save the latest_news
			$latest_news_id	= $this->latest_news_model->save_latest_news($save);
									
			$this->session->set_flashdata('message', lang('message_saved_latest_news'));
			
			//go back to the latest_news list
			redirect($this->config->item('admin_folder').'/latest_news');
		}
	}
	
	function link_form($id = false)
	{
	
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data['id']			= '';
		$data['title']		= '';
		$data['url']		= '';
		$data['new_window']	= false;
		$data['sequence']	= 0;
		$data['parent_id']	= 0;

		
		$data['latest_news_title']	= lang('link_form');
		$data['latest_news']		= $this->latest_news_model->get_list();
		if($id)
		{
			$latest_news			= $this->latest_news_model->get_latest_news($id);

			if(!$latest_news)
			{
				//latest_news does not exist
				$this->session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->config->item('admin_folder').'/latest_news');
			}
			
			
			//set values to db values
			$data['id']			= $latest_news->id;
			$data['parent_id']	= $latest_news->parent_id;
			$data['title']		= $latest_news->title;
			$data['url']		= $latest_news->url;
			$data['new_window']	= (bool)$latest_news->new_window;
			$data['sequence']	= $latest_news->sequence;
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('url', 'lang:url', 'trim|required');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('new_window', 'lang:new_window', 'trim|integer');
		$this->form_validation->set_rules('parent_id', 'lang:parent_id', 'trim|integer');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/link_form', $data);
		}
		else
		{	
			$save = array();
			$save['id']			= $id;
			$save['parent_id']	= $this->input->post('parent_id');
			$save['title']		= $this->input->post('title');
			$save['menu_title']	= $this->input->post('title'); 
			$save['url']		= $this->input->post('url');
			$save['sequence']	= $this->input->post('sequence');
			$save['new_window']	= $this->input->post('new_window');
			
			//save the latest_news
			$this->latest_news_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the latest_news list
			redirect($this->config->item('admin_folder').'/latest_news');
		}
	}
	
	/********************************************************************
	delete latest_news
	********************************************************************/
	function delete($id)
	{
		
		$latest_news	= $this->latest_news_model->get_latest_news($id);
		
		if($latest_news)
		{
			$this->latest_news_model->delete_latest_news($id);
			$this->session->set_flashdata('message', lang('message_deleted_latest_news'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/latest_news');
	}
}	