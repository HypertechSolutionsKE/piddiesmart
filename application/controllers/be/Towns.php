<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Towns extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');	
		//$this->load->model('be/main_model');
		$this->load->model('be/towns_model');
		$this->load->model('be/countries_model');

	}
	function index(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['towns'] = $this->towns_model->get_towns_list();
			$data['countries'] = $this->countries_model->get_countries_list();
			
			$data['page_title'] = 'Towns | ';
			$data['main_content'] = 'be/towns';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function save(){
		$data = array(
			'country_id' => $this->input->post('country_id'),
			'town_name' => $this->input->post('town_name'),
			'town_description' => $this->input->post('town_description')
		);	
		$town_name = $this->input->post('town_name');
		if($this->towns_model->town_exists($town_name) == false){
			$q = $this->towns_model->save($data);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Town added successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This town already exists in the database');
		}
			
		echo json_encode($resp);
	}
	function loadjs(){
		$data['towns'] = $this->towns_model->get_towns_list();
		$this->load->view('be/jsloads/towns',$data);

	}
	function get_town($town_id){
		$town = $this->towns_model->get_town($town_id);
		echo json_encode($town);
	}
	function get_towns_by_region($region_id){
		$towns = $this->towns_model->get_towns_by_region($region_id);
		echo json_encode($towns);
	}
	function update(){
		$town_id = $this->input->post('town_id');
		$town_name = $this->input->post('town_name');
		$data = array(
			'country_id' => $this->input->post('country_id'),
			'town_name' => $this->input->post('town_name'),
			'town_description' => $this->input->post('town_description')
		);	
		if($this->towns_model->town_update_exists($town_id,$town_name) == false){
			$q = $this->towns_model->update($data,$town_id);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Town updated successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Town already exists in the database');
		}
		echo json_encode($resp);
	}
	function delete($town_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->towns_model->delete($town_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => 'Town deleted successfully');			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}


}