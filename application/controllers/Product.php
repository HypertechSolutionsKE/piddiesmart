<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('product_model');		
	}

	function index(){	
		//$data['main_content'] = 'fe/clothingline/clothingline';
		//$this->load->view('fe/clothingline/includes/template',$data);
	}

	function orderpopup($product_id){
		$data['product'] = $this->product_model->get_product($product_id);
		$data['product_categories'] = $this->product_model->get_product_categories($product_id);
		$data['product_attributes'] = $this->product_model->get_product_attributes($product_id);
		$data['product_images'] = $this->product_model->get_product_images($product_id);

		//$data['main_content'] = 'fe/orderpopup';
		$this->load->view('fe/orderpopup',$data);

	}
}