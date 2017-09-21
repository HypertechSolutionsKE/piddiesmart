<?php
class Access_levels_model extends CI_Model {
	
	function get_access_levels_list(){
		$this->db->from('access_levels');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->get()->result();
	}
	function save($data){
		$insert = $this->db->insert('access_levels', $data);
		if ($insert){
			$arr_return = array('res' => true,'dt' => 'Access Level added successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not add Access Level successfully. Please try again.');
		}
		return $arr_return;
	}
	function access_level_exists($access_level_name){
		$this->db->where('access_level_name',$access_level_name);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('access_levels');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}
	function get_access_level($access_level_id){
		$this->db->from('access_levels');
		$this->db->where( array('access_level_id'=>$access_level_id));
		return $this->db->get()->result_array();
	}
	function access_level_update_exists($access_level_id,$access_level_name){
		$q = $this->db->query("SELECT * FROM access_levels WHERE access_level_id != ".$access_level_id." AND access_level_name = '$access_level_name' AND is_deleted = 0");
		if ($q->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}	
	function update($data,$access_level_id){
		$this->db->where(array('access_level_id'=>$access_level_id));
		$update = $this->db->update('access_levels', $data);
		if ($update){
			$arr_return = array('res' => true,'dt' => 'Access Level updated successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update Access Level successfully. Please try again.');
		}
		return $arr_return;
	}
	function delete($access_level_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('access_level_id'=>$access_level_id));
		$delupdate = $this->db->update('access_levels', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'Access Level deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting Access Level');
		}
		return $arr_return;
	}


}