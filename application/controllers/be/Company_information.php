<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_information extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');	
		//$this->load->model('be/main_model');
		$this->load->model('be/company_information_model');
	}
	function index(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['company_information'] = $this->company_information_model->get_company_information();
			$data['company_information_exists'] = $this->company_information_model->company_information_exists();
			$data['page_title'] = 'Company Information | ';
			$data['main_content'] = 'be/company_information';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function save(){
		$data = array(
			'company_name' => $this->input->post('company_name'),
			'phone_number' => $this->input->post('phone_number'),
			'mobile_number' => $this->input->post('mobile_number'),
			'company_tagline' => $this->input->post('company_tagline'),
			'email_address' => $this->input->post('email_address'),
			'website' => $this->input->post('website'),
			'fax_number' => $this->input->post('fax_number'),
			'postal_address' => $this->input->post('postal_address'),
			'zip_code' => $this->input->post('zip_code'),
			'city' => $this->input->post('city'),
			'country' => $this->input->post('country'),
			'pin_number' => $this->input->post('pin_number')
		);	
		$q = $this->company_information_model->save($data);
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => $q['dt']);
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
			
		echo json_encode($resp);
	}
	function change_company_logo(){
		$q = $this->company_information_model->upload_company_logo();
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => 'Company logo updated successfully.');
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}
}