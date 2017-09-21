<?php
class Property_features_model extends CI_Model {
	
	function get_property_features_list(){
		$this->db->from('property_features');
		//$this->db->join('property_feature_types', 'property_feature_types.property_feature_type_id=property_features.property_feature_type_id','left outer');
		$this->db->where( array('property_features.is_deleted'=>0));
		return $this->db->get()->result();
	}
	function save($data){
		$insert = $this->db->insert('property_features', $data);
		if ($insert){
			$arr_return = array('res' => true,'dt' => 'Property Feature added successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not add Property Feature successfully. Please try again.');
		}
		return $arr_return;
	}
	function property_feature_exists($property_feature_name){
		$this->db->where('property_feature_name',$property_feature_name);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('property_features');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}
	function get_property_feature($property_feature_id){
		$this->db->from('property_features');
		$this->db->where( array('property_feature_id'=>$property_feature_id));
		return $this->db->get()->result_array();
	}
	function property_feature_update_exists($property_feature_id,$property_feature_name){
		$q = $this->db->query("SELECT * FROM property_features WHERE property_feature_id != ".$property_feature_id." AND property_feature_name = '$property_feature_name' AND is_deleted = 0");
		if ($q->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}	
	function update($data,$property_feature_id){
		$this->db->where(array('property_feature_id'=>$property_feature_id));
		$update = $this->db->update('property_features', $data);
		if ($update){
			$arr_return = array('res' => true,'dt' => 'Property Feature updated successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update Property Feature successfully. Please try again.');
		}
		return $arr_return;
	}
	function delete($property_feature_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('property_feature_id'=>$property_feature_id));
		$delupdate = $this->db->update('property_features', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'Property Feature deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting Property Feature');
		}
		return $arr_return;
	}


}