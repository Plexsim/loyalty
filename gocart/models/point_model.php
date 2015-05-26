<?php
Class Point_model extends CI_Model
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
		$res = $this->db->get('point');
		return $res->result_array();
	}
	
		
	function get_point_amt($customer_id = '')
	{
		$this->db->select(' (sum(point) - sum(depoint)) as point_amt ');
		$res = $this->db->where('customer_id', $customer_id)->get('point');
		return $res->row_array();
	}
	

	function get_point($id)
	{
		$this->db->select('point.*, customers.id as customer_id, customers.name as customer_name ');
		$this->db->join('customers', 'customers.id = point.customer_id');
		$res = $this->db->where('point.id', $id)->get('point');
		return $res->row_array();
	}
	
	function save_point($data)
	{
		if($data['id'])
		{
			$this->db->where('id', $data['id'])->update('point', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('point', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_message($id)
	{
		$this->db->where('id', $id)->delete('point');
		return $id;
	}
	
	
}