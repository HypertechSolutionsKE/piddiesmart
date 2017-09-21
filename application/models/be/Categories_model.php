<?php
class Categories_model extends CI_Model {
	
	function get_categories_list(){
		$this->db->from('categories');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->get()->result();
	}
	function get_clothing_categories_list(){
		$this->db->from('categories');
		$this->db->where( array('is_deleted'=>0, 'category_type'=>'Clothing'));
		return $this->db->get()->result();
	}
	function get_cosmetics_categories_list(){
		$this->db->from('categories');
		$this->db->where( array('is_deleted'=>0, 'category_type'=>'Cosmetics'));
		return $this->db->get()->result();
	}
	function get_sound_categories_list(){
		$this->db->from('categories');
		$this->db->where( array('is_deleted'=>0, 'category_type'=>'Sound'));
		return $this->db->get()->result();
	}

/*	function get_categories_by_city($city_id){
		$query = $this->db->query("select category_id, category_name from categories where city_id = $city_id and is_deleted = 0 order by category_name asc"); ;
		return $query->result();
	}
*/	function save($data){
		$insert = $this->db->insert('categories', $data);

		if ($insert){
			$arr_return = array('res' => true,'dt' => 'Category added successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not add Category successfully. Please try again.');
		}

		return $arr_return;
	}

	function category_exists($category_name){
		$this->db->where('category_name',$category_name);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('categories');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}
	function get_category($category_id){
		$this->db->from('categories');
		$this->db->where( array('category_id'=>$category_id));
		return $this->db->get()->result_array();
	}
	function category_update_exists($category_id,$category_name){
		$q = $this->db->query("SELECT * FROM categories WHERE category_id != ".$category_id." AND category_name = '$category_name' AND is_deleted = 0");
		if ($q->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}	
	function update($data,$category_id){

		$this->db->where(array('category_id'=>$category_id));
		$update = $this->db->update('categories', $data);

		if ($update){
			$arr_return = array('res' => true,'dt' => 'Category updated successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update Category successfully. Please try again.');
		}

		return $arr_return;
	}
	function delete($category_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('category_id'=>$category_id));
		$delupdate = $this->db->update('categories', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'Category deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting Category');
		}
		return $arr_return;
	}


}