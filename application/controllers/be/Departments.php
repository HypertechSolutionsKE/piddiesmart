<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departments extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');	
		//$this->load->model('be/main_model');
		$this->load->model('be/departments_model');
	}
	function index(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['departments'] = $this->departments_model->get_departments_list();
			$data['page_title'] = 'Departments | ';
			$data['main_content'] = 'be/departments';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function save(){
		$data = array(
			'department_name' => $this->input->post('department_name'),
			'department_description' => $this->input->post('department_description')
		);	
		$department_name = $this->input->post('department_name');
		if($this->departments_model->department_exists($department_name) == false){
			$q = $this->departments_model->save($data);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Department added successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Department already exists in the database');
		}
			
		echo json_encode($resp);
	}
	function loadjs(){
		$data['departments'] = $this->departments_model->get_departments_list();
		$this->load->view('be/jsloads/departments',$data);

	}
	function get_department($department_id){
		$department = $this->departments_model->get_department($department_id);
		echo json_encode($department);
	}
	function update(){
		$department_id = $this->input->post('department_id');
		$department_name = $this->input->post('department_name');
		$data = array(
			'department_name' => $this->input->post('department_name'),
			'department_description' => $this->input->post('department_description')
		);	
		if($this->departments_model->department_update_exists($department_id,$department_name) == false){
			$q = $this->departments_model->update($data,$department_id);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Department updated successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Department already exists in the database');
		}
		echo json_encode($resp);
	}
	function delete($department_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->departments_model->delete($department_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => 'Department deleted successfully');			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}


}