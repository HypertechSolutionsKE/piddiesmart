<?php
class Company_information_model extends CI_Model {
	
	function get_company_information(){
		$this->db->from('company_information');
		return $this->db->get()->result();
	}
	function company_information_exists(){
		$query = $this->db->get('company_information');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}		
	}
	
	function save($data){
		$found = false;
		$query = $this->db->get('company_information');
		if ($query->num_rows() > 0){
			$found = true;
		}else{
			$found = false;
		}

		if ($found == false){
			$insert = $this->db->insert('company_information', $data);
			if ($insert){

				$this->upload_company_logo();

				$arr_return = array('res' => true,'dt' => 'Company information saved successfully.');
			}else{
				$arr_return = array('res' => false,'dt' => 'Could not successfully save company information. Please try again.');
			}
		}else{
			$update = $this->db->update('company_information', $data);
			if ($update){
				
				//$this->upload_company_logo();

				$arr_return = array('res' => true,'dt' => 'Company information updated successfully.');
			}else{
				$arr_return = array('res' => false,'dt' => 'Could not successfully update company information. Please try again.');
			}
		}
		return $arr_return;
	}

	function change_company_logo(){


	}

	//UPLOAD NATIONAL ID
	function upload_company_logo(){
		if(basename($_FILES['company_logo']['name'])!=''){
			//$imagefilename = url_title(basename($_FILES['national_id']['name']),'-',TRUE);
			
			$upload_config['upload_path'] = './uploads/company_logos/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
			
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
			
			$q = $this->upload->do_upload('company_logo');
		
			if($q){				
				$det = $this->upload->data();					
				$this->db->update('company_information', array('company_logo' => $det['file_name']));
				$arr_return = array('res' => true,'dt' => 'Company Logo uploaded successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Company Logo uploaded successfully');
		}
		return $arr_return;
	}


}