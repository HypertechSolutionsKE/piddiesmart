<?php
class Property_subcategories_model extends CI_Model {
	
	function get_property_subcategories_list(){
		$this->db->from('property_subcategories');
		$this->db->join('property_types', 'property_types.property_type_id=property_subcategories.property_type_id');
		$this->db->where( array('property_subcategories.is_deleted'=>0));
		return $this->db->get()->result();
	}
	function get_property_subcategories_by_property_type($property_type_id){
		$query = $this->db->query("select property_subcategory_id, property_subcategory_name from property_subcategories where property_type_id = $property_type_id and is_deleted = 0"); ;
		return $query->result();

	}
	function get_fe_property_subcategories($purpose){
		$this->db->select('psc.*, psc.property_subcategory_id, psc.property_subcategory_name');
		$this->db->from('property_subcategories as psc');
		$this->db->join('property_types as pt', 'psc.property_type_id = pt.property_type_id');
		$this->db->like('pt.property_type_name',$purpose);
		$this->db->where( array('psc.is_deleted'=>0));
		return $this->db->get()->result();

	}

	function save($data){
		$insert = $this->db->insert('property_subcategories', $data);
		if ($insert){
			$arr_return = array('res' => true,'dt' => 'Property Subcategory added successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not add Property Subcategory successfully. Please try again.');
		}
		return $arr_return;
	}
	function property_subcategory_exists($property_subcategory_name){
		$this->db->where('property_subcategory_name',$property_subcategory_name);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('property_subcategories');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}
	function get_property_subcategory($property_subcategory_id){
		$this->db->from('property_subcategories');
		$this->db->where( array('property_subcategory_id'=>$property_subcategory_id));
		return $this->db->get()->result_array();
	}
	function get_property_subcategory2($property_subcategory_id){
		$this->db->from('property_subcategories');
		$this->db->where( array('property_subcategory_id'=>$property_subcategory_id));
		return $this->db->get()->result();
	}

	function property_subcategory_update_exists($property_subcategory_id,$property_subcategory_name){
		$q = $this->db->query("SELECT * FROM property_subcategories WHERE property_subcategory_id != ".$property_subcategory_id." AND property_subcategory_name = '$property_subcategory_name' AND is_deleted = 0");
		if ($q->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}	
	function update($data,$property_subcategory_id){
		$this->db->where(array('property_subcategory_id'=>$property_subcategory_id));
		$update = $this->db->update('property_subcategories', $data);
		if ($update){
			$arr_return = array('res' => true,'dt' => 'Property Subcategory updated successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update Property Subcategory successfully. Please try again.');
		}
		return $arr_return;
	}
	function delete($property_subcategory_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('property_subcategory_id'=>$property_subcategory_id));
		$delupdate = $this->db->update('property_subcategories', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'Property Subcategory deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting Property Subcategory');
		}
		return $arr_return;
	}


}