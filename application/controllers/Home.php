<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('piddiesmart');
	}

	function index(){
	
		$data['main_content'] = 'fe/home';
		$this->load->view('fe/includes/template',$data);
	}
	
	function about(){
	
		$data['main_content'] = 'fe/about';
		$this->load->view('fe/includes/template',$data);
	}
	function contact(){
	
		$data['main_content'] = 'fe/contact';
		$this->load->view('fe/includes/template',$data);
	}
	public function insert_buyer_detail()
	{ 
		$buyer_id = url_title($this->input->post('buyer_product'),'-',TRUE);		   	
		$add_buyer_details = array(
        'buyer_product'=>$this->input->post('buyer_product'),
        'buyer_first_name'=>$this->input->post('buyer_first_name'),
        'buyer_last_name'=>$this->input->post('buyer_last_name'),
        'buyer_phone_number'=>$this->input->post('buyer_phone_number'),
        'buyer_email'=>$this->input->post('buyer_email'),
        'buyer_id' =>$buyer_id         
         );
         $q = $this->piddiesmart->add_buyer_details($buyers);         	
          
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => $q['dt']);
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}

	
}