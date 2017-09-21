<?php
class Departments_model extends CI_Model {
	
	function get_departments_list(){
		$this->db->from('departments');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->get()->result();
	}
	function save($data){
		$insert = $this->db->insert('departments', $data);
		if ($insert){
			$arr_return = array('res' => true,'dt' => 'Department added successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not add Department successfully. Please try again.');
		}
		return $arr_return;
	}
	function department_exists($department_name){
		$this->db->where('department_name',$department_name);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('departments');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}
	function get_department($department_id){
		$this->db->from('departments');
		$this->db->where( array('department_id'=>$department_id));
		return $this->db->get()->result_array();
	}
	function department_update_exists($department_id,$department_name){
		$q = $this->db->query("SELECT * FROM departments WHERE department_id != ".$department_id." AND department_name = '$department_name' AND is_deleted = 0");
		if ($q->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}	
	function update($data,$department_id){
		$this->db->where(array('department_id'=>$department_id));
		$update = $this->db->update('departments', $data);
		if ($update){
			$arr_return = array('res' => true,'dt' => 'Department updated successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update Department successfully. Please try again.');
		}
		return $arr_return;
	}
	function delete($department_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('department_id'=>$department_id));
		$delupdate = $this->db->update('departments', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'Department deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting Department');
		}
		return $arr_return;
	}


}