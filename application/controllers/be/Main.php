<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->model('be/main_model');
	}

	function index(){
		if($this->session->userdata('piddie_be_loginstate')) {
/*			$data['total_listing_types'] = $this->main_model->get_total_listing_types();
			$data['total_property_types'] = $this->main_model->get_total_property_types();
			$data['total_property_subcategories'] = $this->main_model->get_total_property_subcategories();
			$data['total_regions'] = $this->main_model->get_total_regions();
			$data['total_cities'] = $this->main_model->get_total_cities();
			$data['total_areas'] = $this->main_model->get_total_areas();
			$data['total_property_feature_types'] = $this->main_model->get_total_property_feature_types();
			$data['total_property_features'] = $this->main_model->get_total_property_features();
			$data['total_currencies'] = $this->main_model->get_total_currencies();
			$data['total_system_users'] = $this->main_model->get_total_system_users();

			$data['total_agent_active_properties'] = $this->main_model->get_total_agent_active_properties();
*/
			
			$data['page_title'] = 'Dashboard | ';
			$data['main_content'] = 'be/dashboard';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
}

