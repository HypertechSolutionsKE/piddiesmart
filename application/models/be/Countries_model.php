<?php
class Countries_model extends CI_Model {
	
	function get_countries_list(){
		$this->db->from('countries');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->get()->result();
	}
	function save($data){
		$insert = $this->db->insert('countries', $data);
		if ($insert){
			$arr_return = array('res' => true,'dt' => 'Country added successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not add country successfully. Please try again.');
		}
		return $arr_return;
	}
	function country_exists($country_name){
		$this->db->where('country_name',$country_name);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('countries');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}
	function get_country($country_id){
		$this->db->from('countries');
		$this->db->where( array('country_id'=>$country_id));
		return $this->db->get()->result_array();
	}
	function country_update_exists($country_id,$country_name){
		$q = $this->db->query("SELECT * FROM countries WHERE country_id != ".$country_id." AND country_name = '$country_name' AND is_deleted = 0");
		if ($q->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}	
	function update($data,$country_id){
		$this->db->where(array('country_id'=>$country_id));
		$update = $this->db->update('countries', $data);
		if ($update){
			$arr_return = array('res' => true,'dt' => 'Country updated successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update Country successfully. Please try again.');
		}
		return $arr_return;
	}
	function delete($country_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('country_id'=>$country_id));
		$delupdate = $this->db->update('countries', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'Country deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting Country');
		}
		return $arr_return;
	}


}