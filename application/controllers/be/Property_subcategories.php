<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property_subcategories extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');	
		//$this->load->model('be/main_model');
		$this->load->model('be/property_subcategories_model');
		$this->load->model('be/property_types_model');

	}
	function index(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['property_subcategories'] = $this->property_subcategories_model->get_property_subcategories_list();
			$data['property_types'] = $this->property_types_model->get_property_types_list();
			$data['page_title'] = 'Property Subcategories | ';
			$data['main_content'] = 'be/property_subcategories';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function save(){
		$data = array(
			'property_type_id' => $this->input->post('property_type_id'),
			'property_subcategory_name' => $this->input->post('property_subcategory_name'),
			'property_subcategory_description' => $this->input->post('property_subcategory_description')
		);	
		$property_subcategory_name = $this->input->post('property_subcategory_name');
		if($this->property_subcategories_model->property_subcategory_exists($property_subcategory_name) == false){
			$q = $this->property_subcategories_model->save($data);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Property Subcategory added successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Property Subcategory already exists in the database');
		}
			
		echo json_encode($resp);
	}
	function loadjs(){
		$data['property_subcategories'] = $this->property_subcategories_model->get_property_subcategories_list();
		$this->load->view('be/jsloads/property_subcategories',$data);

	}
	function get_property_subcategory($property_subcategory_id){
		$property_subcategory = $this->property_subcategories_model->get_property_subcategory($property_subcategory_id);
		echo json_encode($property_subcategory);
	}
	function get_property_subcategories_by_property_type($property_type_id){
		$property_subcategories = $this->property_subcategories_model->get_property_subcategories_by_property_type($property_type_id);
		echo json_encode($property_subcategories);
	}
	function get_fe_property_subcategories($purpose){
		$property_subcategories = $this->property_subcategories_model->get_fe_property_subcategories($purpose);
		echo json_encode($property_subcategories);		
	}

	function update(){
		$property_subcategory_id = $this->input->post('property_subcategory_id');
		$property_subcategory_name = $this->input->post('property_subcategory_name');
		$data = array(
			'property_type_id' => $this->input->post('property_type_id'),
			'property_subcategory_name' => $this->input->post('property_subcategory_name'),
			'property_subcategory_description' => $this->input->post('property_subcategory_description')
		);	
		if($this->property_subcategories_model->property_subcategory_update_exists($property_subcategory_id,$property_subcategory_name) == false){
			$q = $this->property_subcategories_model->update($data,$property_subcategory_id);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Property Subcategory updated successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Property Subcategory already exists in the database');
		}
		echo json_encode($resp);
	}
	function delete($property_subcategory_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->property_subcategories_model->delete($property_subcategory_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => 'Property Subcategory deleted successfully');			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}


}