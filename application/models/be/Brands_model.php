<?php
class Brands_model extends CI_Model {
	
	function get_brands_list(){
		$this->db->from('brands');
		$this->db->where( array('brands.is_deleted'=>0));
		return $this->db->get()->result();
	}

	function get_clothing_brands_list(){
		$this->db->from('brands');
		$this->db->where( array('is_deleted'=>0, 'brand_type'=>'Clothing'));
		return $this->db->get()->result();		
	}
	function get_cosmetics_brands_list(){
		$this->db->from('brands');
		$this->db->where( array('is_deleted'=>0, 'brand_type'=>'Cosmetics'));
		return $this->db->get()->result();		
	}
	function get_sound_brands_list(){
		$this->db->from('brands');
		$this->db->where( array('is_deleted'=>0, 'brand_type'=>'Sound'));
		return $this->db->get()->result();		
	}


/*	function get_brands_by_city($city_id){
		$query = $this->db->query("select brand_id, brand_name from brands where city_id = $city_id and is_deleted = 0 order by brand_name asc"); ;
		return $query->result();
	}
*/	function save($data){
		$err = '';	
		$insert = $this->db->insert('brands', $data);
		$insert_id = $this->db->insert_id();

		if ($insert){
			$q = $this->upload_brand_logo($insert_id);
			if ($q['res'] == false){ $err = $err . $q['dt'] . '<br />'; }

			//$arr_return = array('res' => true,'dt' => 'Brand added successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not add Brand successfully. Please try again.');
		}
		if ($err == ''){
			$arr_return = array('res' => true,'dt' => 'Brand saved successfully');
		}else{
			$arr_return = array('res' => false,'dt' => $err);
		}

		return $arr_return;
	}
	function upload_brand_logo($brand_id){
		if(basename($_FILES['brand_logo']['name'])!=''){
			//$imagefilename = url_title(basename($_FILES['national_id']['name']),'-',TRUE);
			
			$upload_config['upload_path'] = './uploads/brand_logos/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
			
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
			
			$q = $this->upload->do_upload('brand_logo');
		
			if($q){				
				$det = $this->upload->data();
				$this->db->where(array('brand_id' => $brand_id));
				$this->db->update('brands', array('brand_logo' => $det['file_name']));
				$arr_return = array('res' => true,'dt' => 'Brand logo saved successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Brand logo saved successfully');
		}
		return $arr_return;
	}

	function brand_exists($brand_name){
		$this->db->where('brand_name',$brand_name);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('brands');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}
	function get_brand($brand_id){
		$this->db->from('brands');
		$this->db->where( array('brand_id'=>$brand_id));
		return $this->db->get()->result_array();
	}
	function brand_update_exists($brand_id,$brand_name){
		$q = $this->db->query("SELECT * FROM brands WHERE brand_id != ".$brand_id." AND brand_name = '$brand_name' AND is_deleted = 0");
		if ($q->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}	
	function update($data,$brand_id){
		$err = '';

		$this->db->where(array('brand_id'=>$brand_id));
		$update = $this->db->update('brands', $data);

		if ($update){

			$q = $this->upload_brand_logo($brand_id);
			if ($q['res'] == false){ $err = $err . $q['dt'] . '<br />'; }

		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update Brand successfully. Please try again.');
		}
		if ($err == ''){
			$arr_return = array('res' => true,'dt' => 'Brand updated successfully');
		}else{
			$arr_return = array('res' => false,'dt' => $err);
		}

		return $arr_return;
	}
	function delete($brand_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('brand_id'=>$brand_id));
		$delupdate = $this->db->update('brands', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'Brand deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting Brand');
		}
		return $arr_return;
	}


}