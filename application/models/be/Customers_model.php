<?php
class Customers_model extends CI_Model {
	
	function get_customers_list(){
		$this->db->from('customers');
		$this->db->join('countries', 'customers.country_id = countries.country_id', 'left outer');
		$this->db->join('towns', 'towns.town_id = customers.town_id', 'left outer');
		$this->db->where( array('customers.is_deleted'=>0));
		return $this->db->get()->result();
	}
	function save($data){
		$insert = $this->db->insert('customers', $data);

		if ($insert){
			$arr_return = array('res' => true,'dt' => 'Customer saved successfully');
		}else{
			$err = 'Could not save Customer successfully. Please try again.';
		}		
		return $arr_return;
	}
	function customer_exists($email_address){
		$this->db->where('email_address',$email_address);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('customers');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}
	function get_customer($customer_id){
		$this->db->from('customers');
		$this->db->where( array('customer_id'=>$customer_id));
		return $this->db->get()->result_array();
	}
	function get_customer2($customer_id){
		$this->db->from('customers');
		$this->db->where( array('customer_id'=>$customer_id));
		return $this->db->get()->result();
	}

	function customer_update_exists($customer_id,$email_address){
		$q = $this->db->query("SELECT * FROM customers WHERE customer_id != ".$customer_id." AND email_address = '$email_address' AND is_deleted = 0");
		if ($q->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	function check_old_password($customer_id,$old_password){
		$this->db->from('customers');
		$this->db->where(array('customer_id' => $customer_id,'user_password' => $old_password));
		$numrows = $this->db->get()->num_rows();
		if ($numrows > 0){
			return true;
		}else{
			return false;
		}

	}
	function update($data,$customer_id){
		$this->db->where(array('customer_id'=>$customer_id));
		$update = $this->db->update('customers', $data);

		if ($update){
			$arr_return = array('res' => true,'dt' => 'Customer updated successfully');			
		}else{
			$err = 'Could not update customer successfully. Please try again.';
		}		

		return $arr_return;
	}
/*	function update_profile($data,$customer_id){
		$err = '';
		$this->db->where(array('customer_id'=>$customer_id));
		$update = $this->db->update('customers', $data);

		if ($update){
		}else{
			$err = 'Could not update profile information successfully. Please try again.';
		}		
		if ($err == ''){
			$arr_return = array('res' => true,'dt' => 'Profile Information updated successfully');
		}else{
			$arr_return = array('res' => false,'dt' => $err);
		}
		return $arr_return;
	}
*/	function change_password($data,$customer_id){
		$this->db->where(array('customer_id'=>$customer_id));
		$update = $this->db->update('customers', $data);

		if ($update){
			$arr_return = array('res' => true,'dt' => 'Password changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not change password successfully. Please try again.');
		}		
		return $arr_return;

	}
	function delete($customer_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('customer_id'=>$customer_id));
		$delupdate = $this->db->update('customers', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'Customer deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting Customer');
		}
		return $arr_return;
	}


}