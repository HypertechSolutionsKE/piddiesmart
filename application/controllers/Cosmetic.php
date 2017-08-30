<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cosmetic  extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('piddiesmart');
	}

	function index(){
	
		$data['main_content'] = 'fe/cosmetic/cosmetic';
		$this->load->view('fe/cosmetic/includes/template',$data);
	}
}