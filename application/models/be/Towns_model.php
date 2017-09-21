<?php
class Towns_model extends CI_Model {
	
	function get_towns_list(){
		$this->db->from('towns');
		$this->db->join('countries', 'countries.country_id = towns.country_id', 'left outer');
		$this->db->where( array('towns.is_deleted'=>0));
		return $this->db->get()->result();
	}
	function get_towns_by_country($country_id){
		$query = $this->db->query("select town_id, town_name from towns where country_id = $country_id and is_deleted = 0"); ;
		//$this->db->from('towns');
		//$this->db->join('countries', 'countries.country_id=towns.country_id');
		//$this->db->where(array('towns.country_id'=>$country_id,'towns.is_deleted'=>0));
		return $query->result();

	}
	function save($data){
		$insert = $this->db->insert('towns', $data);
		if ($insert){
			$arr_return = array('res' => true,'dt' => 'Town added successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not add town successfully. Please try again.');
		}
		return $arr_return;
	}
	function town_exists($town_name){
		$this->db->where('town_name',$town_name);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('towns');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}
	function get_town($town_id){
		$this->db->from('towns');
		$this->db->where( array('town_id'=>$town_id));
		return $this->db->get()->result_array();
	}
	function get_town2($town_id){
		$this->db->from('towns');
		$this->db->where( array('town_id'=>$town_id));
		return $this->db->get()->result();
	}

	function town_update_exists($town_id,$town_name){
		$q = $this->db->query("SELECT * FROM towns WHERE town_id != ".$town_id." AND town_name = '$town_name' AND is_deleted = 0");
		if ($q->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}	
	function update($data,$town_id){
		$this->db->where(array('town_id'=>$town_id));
		$update = $this->db->update('towns', $data);
		if ($update){
			$arr_return = array('res' => true,'dt' => 'Town updated successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update town successfully. Please try again.');
		}
		return $arr_return;
	}
	function delete($town_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('town_id'=>$town_id));
		$delupdate = $this->db->update('towns', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'Town deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting town');
		}
		return $arr_return;
	}


}