<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clothingline  extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('piddiesmart');
	}

	function index(){
	
		$data['main_content'] = 'fe/clothingline/clothingline';
		$this->load->view('fe/clothingline/includes/template',$data);
	}
}