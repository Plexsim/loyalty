<?php

class Reports extends Admin_Controller {

	//this is used when editing or adding a customer
	var $customer_id	= false;	
	protected $activemenu 	= 'reports';

	function __construct()
	{		
		parent::__construct();

		$this->auth->check_access('Admin', true);
		
		$this->load->model('Order_model');
		$this->load->model('Search_model');
		$this->load->model('Credit_model');
		$this->load->model('Point_model');
		$this->load->helper(array('formatting'));
		
		$this->lang->load('report');
	}
	
	function index()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('reports');
		$data['years']		= $this->Order_model->get_sales_years();
		$this->view($this->config->item('admin_folder').'/reports', $data);
	}
	
	function daily_reports()
	{		
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('daily_reports');
		
		$this->view($this->config->item('admin_folder').'/daily_reports', $data);
	}
	
	function monthly_reports()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('monthly_reports');
	
		$this->view($this->config->item('admin_folder').'/monthly_reports', $data);
	}
	
	function print_reports()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('print_statement');
	
		$this->view($this->config->item('admin_folder').'/print_reports', $data);
	}
	
	function daily_trx()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('daily_reports');
		$this->load->helper('date');
		$start	= $this->input->post('start');
		$end	= $this->input->post('end');
		$data['credits_in']		= $this->Credit_model->get_add_credits_trx($start, $end);
		$data['credits_out']	= $this->Credit_model->get_minus_credits_trx($start, $end);
		$data['points_in']		= $this->Point_model->get_add_points_trx($start, $end);
		$data['points_out']	= $this->Point_model->get_minus_points_trx($start, $end);
						
		$this->load->view($this->config->item('admin_folder').'/reports/daily_transaction', $data);
	}
	
	function monthly_trx()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('monthly_reports');
		
		
		$this->load->helper('date');
		$year	= $this->input->post('year');
		$month	= $this->input->post('month');
		$card	= $this->input->post('card');
		
		
	 	/* $year	= '2015';
		$month	= '6';
		$card	= $this->input->post('card');  */
		//$customer_id = NULL;
	
		$customer = $this->Customer_model->get_customer_by_card($card);
		$customer_id = NULL;
		if(isset($customer) && !empty($customer))
		{
			$customer_id = $customer['id'];
		}		
		
		$data['credits_in']		= $this->Credit_model->get_add_credits_trx_monthly($year, $month, $customer_id);					
		$data['credits_out']	= $this->Credit_model->get_minus_credits_trx_monthly($year, $month, $customer_id);
		$data['points_in']		= $this->Point_model->get_add_points_trx_monthly($year, $month, $customer_id);
		$data['points_out']		= $this->Point_model->get_minus_points_trx_monthly($year, $month, $customer_id);
	
		$this->load->view($this->config->item('admin_folder').'/reports/monthly_transaction', $data);
	}
	
	function print_statement()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('print_statement');
		
		$this->load->helper('date');		
		$from_year	= $this->input->post('from_year');
		$from_month	= $this->input->post('from_month');
		$start = $from_year.'-'.$from_month.'-01';
		
		$to_year	= $this->input->post('to_year');
		$to_month	= $this->input->post('to_month');
		$end = $to_year.'-'.$to_month.'-31';
		
		$card	= $this->input->post('card');
	
		$customer = $this->Customer_model->get_customer_by_card($card);
		$customer_id = NULL;
		if(isset($customer) && !empty($customer))
		{
			$customer_id = $customer['id'];
		}
	
		$data['customer'] = $customer;
		$data['credit_balance'] = $this->Credit_model->get_credit_amt($customer_id);
		$data['point_balance'] = $this->Point_model->get_point_amt($customer_id);
		$data['credits']		= $this->Credit_model->get_credits_trx($start, $end, $customer_id);
		
		$this->load->view($this->config->item('admin_folder').'/reports/print_statement', $data);
	}
	
	function best_sellers()
	{
		$data['page_title']	= lang('daily_reports');
		$start	= $this->input->post('start');
		$end	= $this->input->post('end');
		$data['best_sellers']	= $this->Order_model->get_best_sellers($start, $end);
		
		$this->load->view($this->config->item('admin_folder').'/reports/best_sellers', $data);	
	}
	
	function sales()
	{
		$data['page_title']	= lang('daily_reports');
		$year			= $this->input->post('year');
		$data['orders']	= $this->Order_model->get_gross_monthly_sales($year);
		$this->load->view($this->config->item('admin_folder').'/reports/sales', $data);	
	}

}