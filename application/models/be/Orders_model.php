<?php
class Orders_model extends CI_Model {
	
	function get_orders_list(){
		$this->db->from('orders');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->get()->result();
	}

	function get_orders_filtered_list($product_type){
		$this->db->select('orders.*, products.product_id, products.product_name, products.product_sku_code');	
		$date_from = $this->input->post('order_date_from');
		$date_to = $this->input->post('order_date_to');
		$order_status = $this->input->post('order_status');

		$this->db->from('orders');
		$this->db->join('products', 'orders.product_id = products.product_id', 'left outer');

		if ($date_from != '' && $date_to != ''){
			$this->db->where('orders.created_on >= ',date('Y-m-d', strtotime($date_from)));
			$this->db->where('orders.created_on <= ',date('Y-m-d', strtotime($date_to)));
		}
		if ($order_status != 'All' && $order_status != ''){
			switch ($order_status) {
				case 'Unread':
					$this->db->where( array('orders.order_status'=>0,'orders.is_deleted'=>0));
					break;
				case 'Pending':
					$this->db->where( array('orders.order_status'=>1,'orders.is_deleted'=>0));
					break;
				case 'Processing':
					$this->db->where( array('orders.order_status'=>2,'orders.is_deleted'=>0));
					break;
				case 'Completed':
					$this->db->where( array('orders.order_status'=>3,'orders.is_deleted'=>0));
					break;
				case 'Cancelled':
					$this->db->where( array('orders.is_deleted'=>1));
					break;				
				default:
					# code...
					break;
			}
			
		}
		$this->db->where( array('products.product_type'=>$product_type));
		return $this->db->get()->result();
	}


	function order_exists($order_name){
		$this->db->where('order_name',$order_name);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('orders');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	function get_order($order_id){
		$this->db->from('orders');
		$this->db->where( array('order_id'=>$order_id));
		return $this->db->get()->result_array();
	}
	function get_order2($order_id){
		$this->db->from('orders');
		$this->db->where( array('order_id'=>$order_id));
		return $this->db->get()->result();
	}
	function get_order_by_name($order){
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->like('order_name',$order);
		return $this->db->get()->result();

	}

	function delete($order_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('order_id'=>$order_id));
		$delupdate = $this->db->update('orders', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'Property Type deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting Property Type');
		}
		return $arr_return;
	}


}