<?php
class Property_feature_types_model extends CI_Model {
	
	function get_property_feature_types_list(){
		$this->db->from('property_feature_types');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->get()->result();
	}
	function get_property_feature_types_list2(){
		$this->db->select('pft.property_feature_type_id,pft.property_feature_type_name');
		$this->db->join('property_features as pf','pft.property_feature_type_id = pf.property_feature_type_id','left');
		$this->db->where('pft.is_deleted',0);
		$this->db->where('pf.is_deleted',0);
		$this->db->group_by('pft.property_feature_type_id');// add group_by
		
		return $this->db->get('property_feature_types as pft')->result();
	}
	function save($data){
		$insert = $this->db->insert('property_feature_types', $data);
		if ($insert){
			$arr_return = array('res' => true,'dt' => 'Property Feature Type added successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not add Property Feature Type successfully. Please try again.');
		}
		return $arr_return;
	}
	function property_feature_type_exists($property_feature_type_name){
		$this->db->where('property_feature_type_name',$property_feature_type_name);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('property_feature_types');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}
	function get_property_feature_type($property_feature_type_id){
		$this->db->from('property_feature_types');
		$this->db->where( array('property_feature_type_id'=>$property_feature_type_id));
		return $this->db->get()->result_array();
	}
	function property_feature_type_update_exists($property_feature_type_id,$property_feature_type_name){
		$q = $this->db->query("SELECT * FROM property_feature_types WHERE property_feature_type_id != ".$property_feature_type_id." AND property_feature_type_name = '$property_feature_type_name' AND is_deleted = 0");
		if ($q->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}	
	function update($data,$property_feature_type_id){
		$this->db->where(array('property_feature_type_id'=>$property_feature_type_id));
		$update = $this->db->update('property_feature_types', $data);
		if ($update){
			$arr_return = array('res' => true,'dt' => 'Property Feature Type updated successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update Property Feature Type successfully. Please try again.');
		}
		return $arr_return;
	}
	function delete($property_feature_type_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('property_feature_type_id'=>$property_feature_type_id));
		$delupdate = $this->db->update('property_feature_types', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'Property Feature Type deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting Property Feature Type');
		}
		return $arr_return;
	}


}