<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property_features extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');	
		//$this->load->model('be/main_model');
		$this->load->model('be/property_features_model');
		$this->load->model('be/property_feature_types_model');

	}
	function index(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['property_features'] = $this->property_features_model->get_property_features_list();
			$data['property_feature_types'] = $this->property_feature_types_model->get_property_feature_types_list();
			$data['page_title'] = 'Property Features | ';
			$data['main_content'] = 'be/property_features';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function save(){
		$data = array(
			'property_feature_name' => $this->input->post('property_feature_name'),
			'property_feature_description' => $this->input->post('property_feature_description')
		);	
		$property_feature_name = $this->input->post('property_feature_name');
		if($this->property_features_model->property_feature_exists($property_feature_name) == false){
			$q = $this->property_features_model->save($data);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Property Feature added successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Property Feature already exists in the database');
		}
			
		echo json_encode($resp);
	}
	function loadjs(){
		$data['property_features'] = $this->property_features_model->get_property_features_list();
		$this->load->view('be/jsloads/property_features',$data);

	}
	function get_property_feature($property_feature_id){
		$property_feature = $this->property_features_model->get_property_feature($property_feature_id);
		echo json_encode($property_feature);
	}
	function update(){
		$property_feature_id = $this->input->post('property_feature_id');
		$property_feature_name = $this->input->post('property_feature_name');
		$data = array(
			'property_feature_name' => $this->input->post('property_feature_name'),
			'property_feature_description' => $this->input->post('property_feature_description')
		);	
		if($this->property_features_model->property_feature_update_exists($property_feature_id,$property_feature_name) == false){
			$q = $this->property_features_model->update($data,$property_feature_id);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Property Feature updated successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Property Feature already exists in the database');
		}
		echo json_encode($resp);
	}
	function delete($property_feature_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->property_features_model->delete($property_feature_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => 'Property Feature deleted successfully');			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}


}