<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Listing_types extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');	
		//$this->load->model('be/main_model');
		$this->load->model('be/listing_types_model');
	}
	function index(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['listing_types'] = $this->listing_types_model->get_listing_types_list();
			$data['page_title'] = 'Listing Types | ';
			$data['main_content'] = 'be/listing_types';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function save(){
		$data = array(
			'listing_type_name' => $this->input->post('listing_type_name'),
			'listing_type_description' => $this->input->post('listing_type_description')
		);	
		$listing_type_name = $this->input->post('listing_type_name');
		if($this->listing_types_model->listing_type_exists($listing_type_name) == false){
			
			$q = $this->listing_types_model->save($data);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => $q['dt']);
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Listing Type already exists in the database');
		}
			
		echo json_encode($resp);
	}
	function loadjs(){
		$data['listing_types'] = $this->listing_types_model->get_listing_types_list();
		$this->load->view('be/jsloads/listing_types',$data);

	}
	function get_listing_type($listing_type_id){
		$listing_type = $this->listing_types_model->get_listing_type($listing_type_id);
		echo json_encode($listing_type);
	}
	function update(){
		$listing_type_id = $this->input->post('listing_type_id');
		$listing_type_name = $this->input->post('listing_type_name');
		$data = array(
			'listing_type_name' => $this->input->post('listing_type_name'),
			'listing_type_description' => $this->input->post('listing_type_description')
		);	
		if($this->listing_types_model->listing_type_update_exists($listing_type_id,$listing_type_name) == false){
			$q = $this->listing_types_model->update($data,$listing_type_id);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Listing Type updated successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Listing Type already exists in the database');
		}
		echo json_encode($resp);
	}
	function delete($listing_type_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->listing_types_model->delete($listing_type_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => 'Listing Type deleted successfully');			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}


}