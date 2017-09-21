<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');	
		//$this->load->model('be/main_model');
		$this->load->model('be/categories_model');
		//$this->load->model('be/cities_model');		
		//$this->load->model('be/regions_model');

	}
	function index(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['categories'] = $this->categories_model->get_categories_list();
			//$data['cities'] = $this->cities_model->get_cities_list();			
			//$data['regions'] = $this->regions_model->get_regions_list();
			$data['page_title'] = 'Categories | ';
			$data['main_content'] = 'be/categories';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function save(){
		$category_ref_id = url_title($this->input->post('category_name'),'-',TRUE);
		$data = array(
			'category_name' => $this->input->post('category_name'),
			'category_ref_id' => $category_ref_id,			
			'category_type' => $this->input->post('category_type'),
			'category_description' => $this->input->post('category_description')
		);	
		$category_name = $this->input->post('category_name');
		if($this->categories_model->category_exists($category_name) == false){
			$q = $this->categories_model->save($data);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Category added successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Category already exists in the database');
		}
			
		echo json_encode($resp);
	}
	function loadjs(){
		$data['categories'] = $this->categories_model->get_categories_list();
		$this->load->view('be/jsloads/categories',$data);

	}
	function get_category($category_id){
		$category = $this->categories_model->get_category($category_id);
		echo json_encode($category);
	}
/*	function get_categories_by_city($city_id){
		$categories = $this->categories_model->get_categories_by_city($city_id);
		echo json_encode($categories);
	}
*/	function update(){
		$category_id = $this->input->post('category_id');
		$category_name = $this->input->post('category_name');
		$category_ref_id = url_title($this->input->post('category_name'),'-',TRUE);

		$data = array(
			'category_name' => $this->input->post('category_name'),
			'category_ref_id' => $category_ref_id,	
			'category_type' => $this->input->post('category_type'),					
			'category_description' => $this->input->post('category_description')
		);	
		if($this->categories_model->category_update_exists($category_id,$category_name) == false){
			$q = $this->categories_model->update($data,$category_id);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Category updated successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Category already exists in the database');
		}
		echo json_encode($resp);
	}
	function delete($category_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->categories_model->delete($category_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => 'Category deleted successfully');			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}


}