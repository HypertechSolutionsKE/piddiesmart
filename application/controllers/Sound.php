<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sound extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('piddiesmart');
	}

	function index(){
	
		$data['main_content'] = 'fe/sound/sound';
		$this->load->view('fe/sound/includes/template',$data);
	}
}