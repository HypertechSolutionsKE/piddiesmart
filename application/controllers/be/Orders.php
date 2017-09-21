<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->model('be/orders_model');
		//$this->load->model('be/property_features_model');		
		//$this->load->model('be/property_types_model');
	}
	function index(){
		redirect('be/orders/clothing');
	}

	function clothing(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['orders'] = $this->orders_model->get_orders_filtered_list('Clothing');

			$data['page_title'] = 'Clothing Orders | ';
			$data['main_content'] = 'be/clothing_orders';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}

	}
	function cosmetics(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['orders'] = $this->orders_model->get_orders_filtered_list('Cosmetics');

			$data['page_title'] = 'Cosmetics Orders | ';
			$data['main_content'] = 'be/cosmetics_orders';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}

	}
	function sound(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['orders'] = $this->orders_model->get_orders_filtered_list('Sound');

			$data['page_title'] = 'Sound Orders | ';
			$data['main_content'] = 'be/sound_orders';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}

	}


	function loadjs_clothing_filtered(){
		$data['orders'] = $this->orders_model->get_orders_filtered_list('Clothing');
		$this->load->view('be/jsloads/clothing_orders_list',$data);		
	}
	function loadjs_cosmetics_filtered(){
		$data['orders'] = $this->orders_model->get_orders_filtered_list('Cosmetics');
		$this->load->view('be/jsloads/cosmetics_orders_list',$data);		
	}
	function loadjs_sound_filtered(){
		$data['orders'] = $this->orders_model->get_orders_filtered_list('Sound');
		$this->load->view('be/jsloads/sound_orders_list',$data);		
	}


	function loadjs(){
		$data['property_types'] = $this->property_types_model->get_property_types_list();
		$this->load->view('be/jsloads/property_types',$data);
	}
	function get_fe_special_features($purpose){
		$data['special_features'] = $this->property_types_model->get_fe_special_features($purpose);
		$this->load->view('fe/jsloads/fe_special_features',$data);
	}

	function delete($property_type_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->property_types_model->delete($property_type_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => 'Property Type deleted successfully');			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}


}