<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currencies extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');	
		//$this->load->model('be/main_model');
		$this->load->model('be/currencies_model');
	}
	function index(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['currencies'] = $this->currencies_model->get_currencies_list();
			$data['page_title'] = 'Currencies | ';
			$data['main_content'] = 'be/currencies';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function save(){
		$country_name = $this->input->post('country_name');
		$country_code = $this->input->post('country_code');
		$currency_name = $this->input->post('currency_name');
		$currency_symbol = $this->input->post('currency_symbol');
		
		$e = $this->currencies_model->currency_exists($country_name,$country_code,$currency_name,$currency_symbol);

		if($e['res'] == true){
			$data = array(
				'country_name' => $country_name,
				'country_code' => $country_code,
				'currency_name' => $currency_name,
				'currency_symbol' => $currency_symbol			
			);
			$q = $this->currencies_model->save($data);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Currency added successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => $e['dt']);
		}
			
		echo json_encode($resp);
	}
	function loadjs(){
		$data['currencies'] = $this->currencies_model->get_currencies_list();
		$this->load->view('be/jsloads/currencies',$data);

	}
	function get_currency($currency_id){
		$currency = $this->currencies_model->get_currency($currency_id);
		echo json_encode($currency);
	}
	function update(){
		$currency_id = $this->input->post('currency_id');
		$country_name = $this->input->post('country_name');
		$country_code = $this->input->post('country_code');
		$currency_name = $this->input->post('currency_name');
		$currency_symbol = $this->input->post('currency_symbol');

		$e = $this->currencies_model->currency_update_exists($currency_id,$country_name,$country_code,$currency_name,$currency_symbol);

		if($e['res'] == true){
			$data = array(
				'country_name' => $country_name,
				'country_code' => $country_code,
				'currency_name' => $currency_name,
				'currency_symbol' => $currency_symbol			
			);

			$q = $this->currencies_model->update($data,$currency_id);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Currency updated successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => $e['dt']);
		}
		echo json_encode($resp);
	}
	function delete($currency_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->currencies_model->delete($currency_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => 'Currency deleted successfully');			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}


}