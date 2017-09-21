<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Countries extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');	
		//$this->load->model('be/main_model');
		$this->load->model('be/countries_model');
	}

	function index(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['countries'] = $this->countries_model->get_countries_list();
			$data['page_title'] = 'Countries | ';
			$data['main_content'] = 'be/countries';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}

	function save(){
		$data = array(
			'country_name' => $this->input->post('country_name'),
			'country_description' => $this->input->post('country_description')
		);	
		$country_name = $this->input->post('country_name');
		if($this->countries_model->country_exists($country_name) == false){
			$q = $this->countries_model->save($data);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => $q['dt']);
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Country already exists in the database');
		}
			
		echo json_encode($resp);
	}
	function loadjs(){
		$data['countries'] = $this->countries_model->get_countries_list();
		$this->load->view('be/jsloads/countries',$data);

	}
	function get_country($country_id){
		$country = $this->countries_model->get_country($country_id);
		echo json_encode($country);
	}
	function update(){
		$country_id = $this->input->post('country_id');
		$country_name = $this->input->post('country_name');
		$data = array(
			'country_name' => $this->input->post('country_name'),
			'country_description' => $this->input->post('country_description')
		);	
		if($this->countries_model->country_update_exists($country_id,$country_name) == false){
			$q = $this->countries_model->update($data,$country_id);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Country updated successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Country already exists in the database');
		}
		echo json_encode($resp);
	}
	function delete($country_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->countries_model->delete($country_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => 'Country deleted successfully');			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}

}