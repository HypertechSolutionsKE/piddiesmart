<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brands extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');	
		//$this->load->model('be/main_model');
		$this->load->model('be/brands_model');
		//$this->load->model('be/cities_model');		
		//$this->load->model('be/regions_model');

	}
	function index(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['brands'] = $this->brands_model->get_brands_list();
			//$data['cities'] = $this->cities_model->get_cities_list();			
			//$data['regions'] = $this->regions_model->get_regions_list();
			$data['page_title'] = 'Brands | ';
			$data['main_content'] = 'be/brands';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function save(){
		$brand_ref_id = url_title($this->input->post('brand_name'),'-',TRUE);
		$data = array(
			'brand_name' => $this->input->post('brand_name'),
			'brand_ref_id' => $brand_ref_id,			
			'brand_type' => $this->input->post('brand_type'),
			'brand_description' => $this->input->post('brand_description')
		);	
		$brand_name = $this->input->post('brand_name');
		if($this->brands_model->brand_exists($brand_name) == false){
			$q = $this->brands_model->save($data);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Brand added successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Brand already exists in the database');
		}
			
		echo json_encode($resp);
	}
	function loadjs(){
		$data['brands'] = $this->brands_model->get_brands_list();
		$this->load->view('be/jsloads/brands',$data);

	}
	function get_brand($brand_id){
		$brand = $this->brands_model->get_brand($brand_id);
		echo json_encode($brand);
	}
/*	function get_brands_by_city($city_id){
		$brands = $this->brands_model->get_brands_by_city($city_id);
		echo json_encode($brands);
	}
*/	function update(){
		$brand_id = $this->input->post('brand_id');
		$brand_name = $this->input->post('brand_name');
		$brand_ref_id = url_title($this->input->post('brand_name'),'-',TRUE);

		$data = array(
			'brand_name' => $this->input->post('brand_name'),
			'brand_ref_id' => $brand_ref_id,	
			'brand_type' => $this->input->post('brand_type'),					
			'brand_description' => $this->input->post('brand_description')
		);	
		if($this->brands_model->brand_update_exists($brand_id,$brand_name) == false){
			$q = $this->brands_model->update($data,$brand_id);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Brand updated successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Brand already exists in the database');
		}
		echo json_encode($resp);
	}
	function delete($brand_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->brands_model->delete($brand_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => 'Brand deleted successfully');			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}


}