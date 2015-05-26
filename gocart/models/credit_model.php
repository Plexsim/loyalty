<?php
Class Credit_model extends CI_Model
{
	function __construct()
	{
			parent::__construct();
	}
	
	
	function get_list($customer_id = '')
	{		
		if($customer_id != '')
		{
			$this->db->where('customer_id', $customer_id);
		}
		$res = $this->db->get('credit');
		return $res->result_array();
	}
	
	function get_credit_amt($customer_id = '')
	{		
		$this->db->select(' (sum(`in`) - sum(`out`)) as credit_amt ');
		$res = $this->db->where('customer_id', $customer_id)->get('credit');
		
		return $res->row_array();
	}
	
	function get_total_credit_consume($customer_id = '')
	{
		$this->db->select(' (sum(`out`)) as total_consumption ');
		$res = $this->db->where('customer_id', $customer_id)->get('credit');
	
		return $res->row_array();
	}
	
	function get_credit($id)
	{
		$this->db->select(' credit.*, customers.id as customer_id, customers.name as customer_name ');
		$this->db->join('customers', 'customers.id = credit.customer_id');
		$res = $this->db->where('credit.id', $id)->get('credit');
		return $res->row_array();
	}
	
	function save_credit($data)
	{
		if($data['id'])
		{
			$this->db->where('id', $data['id'])->update('credit', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('credit', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_message($id)
	{
		$this->db->where('id', $id)->delete('credit');
		return $id;
	}
	
	
}