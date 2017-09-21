<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_levels extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');	
		//$this->load->model('be/main_model');
		$this->load->model('be/access_levels_model');
	}
	function index(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['access_levels'] = $this->access_levels_model->get_access_levels_list();
			$data['page_title'] = 'Access Levels | ';
			$data['main_content'] = 'be/access_levels';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function save(){
		$data = array(
			'access_level_name' => $this->input->post('access_level_name'),
			'access_level_description' => $this->input->post('access_level_description')
		);	
		$access_level_name = $this->input->post('access_level_name');
		if($this->access_levels_model->access_level_exists($access_level_name) == false){
			$q = $this->access_levels_model->save($data);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Access Level added successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Access Level already exists in the database');
		}
			
		echo json_encode($resp);
	}
	function loadjs(){
		$data['access_levels'] = $this->access_levels_model->get_access_levels_list();
		$this->load->view('be/jsloads/access_levels',$data);

	}
	function get_access_level($access_level_id){
		$access_level = $this->access_levels_model->get_access_level($access_level_id);
		echo json_encode($access_level);
	}
	function update(){
		$access_level_id = $this->input->post('access_level_id');
		$access_level_name = $this->input->post('access_level_name');
		$data = array(
			'access_level_name' => $this->input->post('access_level_name'),
			'access_level_description' => $this->input->post('access_level_description')
		);	
		if($this->access_levels_model->access_level_update_exists($access_level_id,$access_level_name) == false){
			$q = $this->access_levels_model->update($data,$access_level_id);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Access Level updated successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Access Level already exists in the database');
		}
		echo json_encode($resp);
	}
	function delete($access_level_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->access_levels_model->delete($access_level_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => 'Access Level deleted successfully');			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}


}