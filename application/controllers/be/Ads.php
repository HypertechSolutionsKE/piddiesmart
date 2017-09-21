<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');	
		$this->load->model('be/ads_model');
		//$this->load->model('be/currencies_model');
	}
	function index(){
	}

	//HOME IMAGE
	function home_image(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['home_image'] = $this->ads_model->get_home_image();
			$data['page_title'] = 'Ads - Home Image | ';
			$data['main_content'] = 'be/home_image';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}		
	}
	function upload_home_image(){
		$q = $this->ads_model->upload_home_image();
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => 'Homepage background image uploaded successfully.');
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}

	//HEADER ADVERTS
	function header_adverts(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['header_adverts'] = $this->ads_model->get_header_adverts();
			$data['page_title'] = 'Ads - Header Adverts | ';
			$data['main_content'] = 'be/header_adverts';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}		
	}
	function upload_header_advert($header_advert_id){
		$q = $this->ads_model->upload_header_advert($header_advert_id);
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => 'Ad uploaded successfully.');
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}
	function upload_header_advert2(){
		$q = $this->ads_model->upload_header_advert2();
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => 'Ad uploaded successfully.');
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}
	function header_advert_inactive($header_advert_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->ads_model->header_advert_inactive($header_advert_id);
			if($q['res'] == TRUE){
				$this->session->set_flashdata('success',$q['dt']);
			}else{					
				$this->session->set_flashdata('error',$q['dt']);
			}
			redirect('be/ads/header_adverts');
		}else{
			redirect('be/auth');		
    	}
	}
	function header_advert_active($header_advert_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->ads_model->header_advert_active($header_advert_id);
			if($q['res'] == TRUE){
				$this->session->set_flashdata('success',$q['dt']);
			}else{					
				$this->session->set_flashdata('error',$q['dt']);
			}
			redirect('be/ads/header_adverts');
		}else{
			redirect('be/auth');		
    	}		
	}
	function header_advert_delete($header_advert_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->ads_model->header_advert_delete($header_advert_id);
			if($q['res'] == TRUE){
				$this->session->set_flashdata('success',$q['dt']);
			}else{					
				$this->session->set_flashdata('error',$q['dt']);
			}
			redirect('be/ads/header_adverts');
		}else{
			redirect('be/auth');		
    	}		
	}


	//SIDEBAR ADVERTS
	function sidebar_adverts(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['sidebar_adverts'] = $this->ads_model->get_sidebar_adverts();
			$data['page_title'] = 'Ads - Sidebar Adverts | ';
			$data['main_content'] = 'be/sidebar_adverts';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}		
	}
	function upload_sidebar_advert($sidebar_advert_id){
		$q = $this->ads_model->upload_sidebar_advert($sidebar_advert_id);
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => 'Ad uploaded successfully.');
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}
	function upload_sidebar_advert2(){
		$q = $this->ads_model->upload_sidebar_advert2();
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => 'Ad uploaded successfully.');
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}
	function sidebar_advert_inactive($sidebar_advert_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->ads_model->sidebar_advert_inactive($sidebar_advert_id);
			if($q['res'] == TRUE){
				$this->session->set_flashdata('success',$q['dt']);
			}else{					
				$this->session->set_flashdata('error',$q['dt']);
			}
			redirect('be/ads/sidebar_adverts');
		}else{
			redirect('be/auth');		
    	}
	}
	function sidebar_advert_active($sidebar_advert_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->ads_model->sidebar_advert_active($sidebar_advert_id);
			if($q['res'] == TRUE){
				$this->session->set_flashdata('success',$q['dt']);
			}else{					
				$this->session->set_flashdata('error',$q['dt']);
			}
			redirect('be/ads/sidebar_adverts');
		}else{
			redirect('be/auth');		
    	}		
	}
	function sidebar_advert_delete($sidebar_advert_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->ads_model->sidebar_advert_delete($sidebar_advert_id);
			if($q['res'] == TRUE){
				$this->session->set_flashdata('success',$q['dt']);
			}else{					
				$this->session->set_flashdata('error',$q['dt']);
			}
			redirect('be/ads/sidebar_adverts');
		}else{
			redirect('be/auth');		
    	}		
	}



	//DETAIL ADVERTS
	function detail_adverts(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['detail_adverts'] = $this->ads_model->get_detail_adverts();
			$data['page_title'] = 'Ads - Detail View Adverts | ';
			$data['main_content'] = 'be/detail_adverts';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}		
	}
	function upload_detail_advert($detail_advert_id){
		$q = $this->ads_model->upload_detail_advert($detail_advert_id);
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => 'Ad uploaded successfully.');
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}
	function upload_detail_advert2(){
		$q = $this->ads_model->upload_detail_advert2();
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => 'Ad uploaded successfully.');
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}
	function detail_advert_inactive($detail_advert_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->ads_model->detail_advert_inactive($detail_advert_id);
			if($q['res'] == TRUE){
				$this->session->set_flashdata('success',$q['dt']);
			}else{					
				$this->session->set_flashdata('error',$q['dt']);
			}
			redirect('be/ads/detail_adverts');
		}else{
			redirect('be/auth');		
    	}
	}
	function detail_advert_active($detail_advert_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->ads_model->detail_advert_active($detail_advert_id);
			if($q['res'] == TRUE){
				$this->session->set_flashdata('success',$q['dt']);
			}else{					
				$this->session->set_flashdata('error',$q['dt']);
			}
			redirect('be/ads/detail_adverts');
		}else{
			redirect('be/auth');		
    	}		
	}
	function detail_advert_delete($detail_advert_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->ads_model->detail_advert_delete($detail_advert_id);
			if($q['res'] == TRUE){
				$this->session->set_flashdata('success',$q['dt']);
			}else{					
				$this->session->set_flashdata('error',$q['dt']);
			}
			redirect('be/ads/detail_adverts');
		}else{
			redirect('be/auth');		
    	}		
	}

}