<?php
class Currencies_model extends CI_Model {
	
	function get_currencies_list(){
		$this->db->from('currencies');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->get()->result();
	}
	function save($data){
		$insert = $this->db->insert('currencies', $data);
		if ($insert){
			$arr_return = array('res' => true,'dt' => 'Currency added successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not add Currency successfully. Please try again.');
		}
		return $arr_return;
	}
	//ADD EXISTS
	function currency_exists($country_name,$country_code,$currency_name,$currency_symbol){
		$err = "";
		$query = $this->db->where(array('country_name'=>$country_name,'is_deleted'=>0))->get('currencies');
		if ($query->num_rows() > 0){$err = $err . "The country name you entered already exists for another currency.<br />";}
		
		$query = $this->db->where(array('country_code'=>$country_code,'is_deleted'=>0))->get('currencies');
		if ($query->num_rows() > 0){$err = $err . "The country code you entered already exists for another currency.<br />";}
		
		$query = $this->db->where(array('currency_name'=>$currency_name,'is_deleted'=>0))->get('currencies');
		if ($query->num_rows() > 0){$err = $err . "The currency name you entered already exists for another currency.<br />";}
		
		$query = $this->db->where(array('currency_symbol'=>$currency_symbol,'is_deleted'=>0))->get('currencies');
		if ($query->num_rows() > 0){$err = $err . "The currency symbol you entered already exists for another currency.<br />";}
		
		if ($err == ""){
			$arr_return = array('res' => true,'dt' => '');
		}else{
			$arr_return = array('res' => false,'dt' => $err);
		}
		return $arr_return;
	}

	function get_currency($currency_id){
		$this->db->from('currencies');
		$this->db->where( array('currency_id'=>$currency_id));
		return $this->db->get()->result_array();
	}
	/*function currency_update_exists($currency_id,$currency_name){
		$q = $this->db->query("SELECT * FROM currencies WHERE currency_id != ".$currency_id." AND currency_name = '$currency_name' AND is_deleted = 0");
		if ($q->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}	*/
	function currency_update_exists($currency_id,$country_name,$country_code,$currency_name,$currency_symbol){
		$err = "";
		$query = $this->db->where(array('currency_id !='=>$currency_id,'country_name'=>$country_name,'is_deleted'=>0))->get('currencies');
		if ($query->num_rows() > 0){$err = $err . "The country name you entered already exists for another currency.<br />";}
		
		$query = $this->db->where(array('currency_id !='=>$currency_id,'country_code'=>$country_code,'is_deleted'=>0))->get('currencies');
		if ($query->num_rows() > 0){$err = $err . "The country code you entered already exists for another currency.<br />";}
		
		$query = $this->db->where(array('currency_id !='=>$currency_id,'currency_name'=>$currency_name,'is_deleted'=>0))->get('currencies');
		if ($query->num_rows() > 0){$err = $err . "The currency name you entered already exists for another currency.<br />";}
		
		$query = $this->db->where(array('currency_id !='=>$currency_id,'currency_symbol'=>$currency_symbol,'is_deleted'=>0))->get('currencies');
		if ($query->num_rows() > 0){$err = $err . "The currency symbol you entered already exists for another currency.<br />";}
		
		if ($err == ""){
			$arr_return = array('res' => true,'dt' => '');
		}else{
			$arr_return = array('res' => false,'dt' => $err);
		}
		return $arr_return;
	}

	function update($data,$currency_id){
		$this->db->where(array('currency_id'=>$currency_id));
		$update = $this->db->update('currencies', $data);
		if ($update){
			$arr_return = array('res' => true,'dt' => 'Currency updated successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update Currency successfully. Please try again.');
		}
		return $arr_return;
	}
	function delete($currency_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('currency_id'=>$currency_id));
		$delupdate = $this->db->update('currencies', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'Currency deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting Currency');
		}
		return $arr_return;
	}


}