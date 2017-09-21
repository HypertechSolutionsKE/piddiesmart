<?php
class Listing_types_model extends CI_Model {
	
	function get_listing_types_list(){
		$this->db->from('listing_types');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->get()->result();
	}
	function save($data){
		$insert = $this->db->insert('listing_types', $data);
		if ($insert){
			$arr_return = array(
				'res' => true,
				'dt' => 'Listing Type added successfully.'
			);
		}else{
			$arr_return = array(
				'res' => false,
				'dt' => 'Could not add listing type successfully. Please try again.'
			);
		}
		return $arr_return;
	}
	function listing_type_exists($listing_type_name){
		$this->db->where('listing_type_name',$listing_type_name);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('listing_types');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}
	function get_listing_type($listing_type_id){
		$this->db->from('listing_types');
		$this->db->where( array('listing_type_id'=>$listing_type_id));
		return $this->db->get()->result_array();
	}
	function get_listing_type_by_name($listing_type){
		$this->db->select('*');
		$this->db->from('listing_types');
		$this->db->like('listing_type_name',$listing_type);
		$this->db->where( array('is_deleted'=>0));
		return $this->db->get()->result();

	}
	function listing_type_update_exists($listing_type_id,$listing_type_name){
		$q = $this->db->query("SELECT * FROM listing_types WHERE listing_type_id != ".$listing_type_id." AND listing_type_name = '$listing_type_name' AND is_deleted = 0");
		if ($q->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}	
	function update($data,$listing_type_id){
		$this->db->where(array('listing_type_id'=>$listing_type_id));
		$update = $this->db->update('listing_types', $data);
		if ($update){
			$arr_return = array('res' => true,'dt' => 'Listing Type updated successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update listing type successfully. Please try again.');
		}
		return $arr_return;
	}
	function delete($listing_type_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('listing_type_id'=>$listing_type_id));
		$delupdate = $this->db->update('listing_types', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'Listing Type deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting Listing Type');
		}
		return $arr_return;
	}


}