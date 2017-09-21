<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');	
		$this->load->model('be/products_model');
		$this->load->model('be/currencies_model');
		$this->load->model('be/categories_model');
		$this->load->model('be/brands_model');
	}
	function index(){
		redirect('be/products/clothing');
	}

	//CLOTHING
	function clothing(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['products'] = $this->products_model->get_products_list('Clothing');
			$data['categories'] = $this->categories_model->get_clothing_categories_list();
			$data['brands'] = $this->brands_model->get_clothing_brands_list();

			$data['page_title'] = 'Clothing Products Listing | ';
			$data['main_content'] = 'be/clothing_products_list';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function cosmetics(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['products'] = $this->products_model->get_products_list('Cosmetics');
			$data['categories'] = $this->categories_model->get_cosmetics_categories_list();
			$data['brands'] = $this->brands_model->get_cosmetics_brands_list();
			
			$data['page_title'] = 'Cosmetics Products Listing | ';
			$data['main_content'] = 'be/cosmetics_products_list';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function sound(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['products'] = $this->products_model->get_products_list('Sound');
			$data['categories'] = $this->categories_model->get_sound_categories_list();
			$data['brands'] = $this->brands_model->get_sound_brands_list();
			
			$data['page_title'] = 'Sound Products Listing | ';
			$data['main_content'] = 'be/sound_products_list';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function clothing_add_start(){
		if($this->session->userdata('piddie_be_loginstate')) {
			if($this->session->userdata('product_type') && $this->session->userdata('product_name')) {
				if ($this->session->userdata('product_type') != 'Clothing'){
					$this->unset_variables();
				}
			}
			$data['currencies'] = $this->currencies_model->get_currencies_list();			
			$data['categories'] = $this->categories_model->get_clothing_categories_list();
			$data['brands'] = $this->brands_model->get_clothing_brands_list();

			$data['product_type'] = 'Clothing';
			$data['mode'] = 'Add';

			$data['page_title'] = 'Start - New Clothing Product | ';
			$data['main_content'] = 'be/product_add_start';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function clothing_add_features(){
		if($this->session->userdata('piddie_be_loginstate')) {
			if($this->session->userdata('product_type') && $this->session->userdata('product_name')) {	
				$data['product_type'] = 'Clothing';
				$data['mode'] = 'Add';

				$data['page_title'] = 'Features - New Clothing Product | ';
				$data['main_content'] = 'be/product_add_features';
				$this->load->view('be/includes/template',$data);
			}else{
				redirect('be/products/clothing_add_start');
			}						
		}else {
            redirect('be/auth');
		}			
	}
	function clothing_add_images(){
		if($this->session->userdata('piddie_be_loginstate')) {
			if($this->session->userdata('product_type') && $this->session->userdata('product_name')) {
				if($this->session->userdata('product_status') && $this->session->userdata('featured')) {
					$data['product_type'] = 'Clothing';
					$data['mode'] = 'Add';

					$data['page_title'] = 'Images - New Clothing Product | ';
					$data['main_content'] = 'be/product_add_images';
					$this->load->view('be/includes/template',$data);
				}else{
					redirect('be/products/clothing_add_features');
				}						
			}else{
				redirect('be/products/clothing_add_start');
			}
		}else {
            redirect('be/auth');
		}			
	}

	function save_start(){
		$this->session->set_userdata(array(
			'product_type'				=> $this->input->post('product_type'),
            'product_name'				=> $this->input->post('product_name'),
            'product_description'		=> $this->input->post('product_description'),
            'category_id'				=> $this->input->post('category_id'),
            'brand_id'					=> $this->input->post('brand_id'),
            'price'						=> $this->input->post('price'),
            'deal_price'				=> $this->input->post('deal_price'),
            'currency_id'				=> $this->input->post('currency_id')
       	));
		
		$resp = array('status' => 'SUCCESS','message' => '');
		echo json_encode($resp);
	}

	function save_features(){		
		$this->session->set_userdata(array(
			'attribute_name_1'			=> $this->input->post('attribute_name_1'),
            'attribute_value_1'			=> $this->input->post('attribute_value_1'),
			'attribute_name_2'			=> $this->input->post('attribute_name_2'),
            'attribute_value_2'			=> $this->input->post('attribute_value_2'),
			'attribute_name_3'			=> $this->input->post('attribute_name_3'),
            'attribute_value_3'			=> $this->input->post('attribute_value_3'),
			'attribute_name_4'			=> $this->input->post('attribute_name_4'),
            'attribute_value_4'			=> $this->input->post('attribute_value_4'),
			'attribute_name_5'			=> $this->input->post('attribute_name_5'),
            'attribute_value_5'			=> $this->input->post('attribute_value_5'),
            'product_status'			=> $this->input->post('product_status'),
            'featured'					=> $this->input->post('featured'),
            'new_arrival'				=> $this->input->post('new_arrival'),
            'special_offer'				=> $this->input->post('special_offer'),
            'featured'			=> $this->input->post('featured')
       	));
		
		$resp = array('status' => 'SUCCESS','message' => '');
		echo json_encode($resp);
	}
	function save_images_and_publish($product_type){
		if($this->session->userdata('piddie_be_loginstate')) {
			if($this->session->userdata('product_type') && $this->session->userdata('product_name')) {
				if($this->session->userdata('product_status') && $this->session->userdata('featured')) {
					$product_sku = $this->products_model->get_product_sku();
					$product_reference_id = url_title($this->session->userdata('product_name'),'-',TRUE) . '-' . strtolower($product_sku);
	
					$save_data = array(
						'product_type' => $this->session->userdata('product_type'),
						'product_reference_id' => $product_reference_id,
						'product_sku_code' => $product_sku,
						'product_name' => $this->session->userdata('product_name'),
						'product_description' => $this->session->userdata('product_description'),
						'product_price' => $this->session->userdata('price'),
						'product_deal_price' => $this->session->userdata('deal_price'),
						'product_status' => $this->session->userdata('product_status'),
						'new_arrival' => $this->session->userdata('new_arrival'),
						'featured' => $this->session->userdata('featured'),
						'special_offer' => $this->session->userdata('special_offer'),
						'featured' => $this->session->userdata('featured'),
						'brand_id' => $this->session->userdata('brand_id'),
						'currency_id' => $this->session->userdata('currency_id')
					);

					$q = $this->products_model->save_product($save_data);
					if ($q['res'] == true){
						$this->unset_variables();
						$this->session->set_flashdata('success',$q['dt']);

						$resp = array('status' => 'SUCCESS','message' => $q['dt']);
					}else{
						$resp = array('status' => 'ERR','message' => '<strong>'. $q['dt'] .'</strong>');
					}
					echo json_encode($resp);
				}else{
					if ($product_type == 'Clothing'){
						redirect('be/products/clothing_add_features');
					}else if ($product_type == 'Cosmetics'){
						redirect('be/products/cosmetics_add_features');
					}else if ($product_type == 'Sound'){
						redirect('be/products/sound_add_features');
					}
				}
			}else{
				if ($product_type == 'Clothing'){
					redirect('be/products/clothing_add_start');
				}else if ($product_type == 'Cosmetics'){
					redirect('be/products/cosmetics_add_start');
				}else if ($product_type == 'Sound'){
					redirect('be/products/sound_add_start');
				}
			}
		}else {
            redirect('be/auth');
		}

	}

	//COSMETICS
	function cosmetics_add_start(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['currencies'] = $this->currencies_model->get_currencies_list();			
			$data['categories'] = $this->categories_model->get_cosmetics_categories_list();
			$data['brands'] = $this->brands_model->get_cosmetics_brands_list();

			$data['product_type'] = 'Cosmetics';
			$data['mode'] = 'Add';			

			$data['page_title'] = 'Start - New Cosmetics Product | ';
			$data['main_content'] = 'be/product_add_start';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}

	}
	function cosmetics_add_features(){
		if($this->session->userdata('piddie_be_loginstate')) {
			if($this->session->userdata('product_type') && $this->session->userdata('product_name')) {	
				$data['product_type'] = 'Cosmetics';
				$data['mode'] = 'Add';

				$data['page_title'] = 'Features - New Cosmetics Product | ';
				$data['main_content'] = 'be/product_add_features';
				$this->load->view('be/includes/template',$data);
			}else{
				redirect('be/products/cosmetics_add_start');
			}						
		}else {
            redirect('be/auth');
		}			
	}
	function cosmetics_add_images(){
		if($this->session->userdata('piddie_be_loginstate')) {
			if($this->session->userdata('product_type') && $this->session->userdata('product_name')) {
				if($this->session->userdata('product_status') && $this->session->userdata('featured')) {
					$data['product_type'] = 'Cosmetics';
					$data['mode'] = 'Add';

					$data['page_title'] = 'Images - New Cosmetics Product | ';
					$data['main_content'] = 'be/product_add_images';
					$this->load->view('be/includes/template',$data);
				}else{
					redirect('be/products/cosmetics_add_features');
				}						
			}else{
				redirect('be/products/cosmetics_add_start');
			}
		}else {
            redirect('be/auth');
		}			
	}

	//SOUND
	function sound_add_start(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['currencies'] = $this->currencies_model->get_currencies_list();			
			$data['categories'] = $this->categories_model->get_sound_categories_list();
			$data['brands'] = $this->brands_model->get_sound_brands_list();

			$data['product_type'] = 'Sound';
			$data['mode'] = 'Add';			

			$data['page_title'] = 'Start - New Sound Product | ';
			$data['main_content'] = 'be/product_add_start';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}

	}
	function sound_add_features(){
		if($this->session->userdata('piddie_be_loginstate')) {
			if($this->session->userdata('product_type') && $this->session->userdata('product_name')) {	
				$data['product_type'] = 'Sound';
				$data['mode'] = 'Add';

				$data['page_title'] = 'Features - New Sound Product | ';
				$data['main_content'] = 'be/product_add_features';
				$this->load->view('be/includes/template',$data);
			}else{
				redirect('be/products/sound_add_start');
			}						
		}else {
            redirect('be/auth');
		}			
	}
	function sound_add_images(){
		if($this->session->userdata('piddie_be_loginstate')) {
			if($this->session->userdata('product_type') && $this->session->userdata('product_name')) {
				if($this->session->userdata('product_status') && $this->session->userdata('featured')) {
					$data['product_type'] = 'Sound';
					$data['mode'] = 'Add';

					$data['page_title'] = 'Images - New Sound Product | ';
					$data['main_content'] = 'be/product_add_images';
					$this->load->view('be/includes/template',$data);
				}else{
					redirect('be/products/sound_add_features');
				}						
			}else{
				redirect('be/products/sound_add_start');
			}
		}else {
            redirect('be/auth');
		}			
	}

	function unset_variables(){
		$this->session->unset_userdata('product_type');
		$this->session->unset_userdata('product_name');
		$this->session->unset_userdata('product_description');
		$this->session->unset_userdata('category_id');
		$this->session->unset_userdata('brand_id');
		$this->session->unset_userdata('price');
		$this->session->unset_userdata('deal_price');
		$this->session->unset_userdata('currency_id');
		$this->session->unset_userdata('attribute_name_1');
		$this->session->unset_userdata('attribute_value_1');
		$this->session->unset_userdata('attribute_name_2');
		$this->session->unset_userdata('attribute_value_2');
		$this->session->unset_userdata('attribute_name_3');
		$this->session->unset_userdata('attribute_value_3');
		$this->session->unset_userdata('attribute_name_4');
		$this->session->unset_userdata('attribute_value_4');
		$this->session->unset_userdata('attribute_name_5');
		$this->session->unset_userdata('attribute_value_5');
		$this->session->unset_userdata('product_status');
		$this->session->unset_userdata('featured');
		$this->session->unset_userdata('new_arrival');
		$this->session->unset_userdata('special_offer');
		$this->session->unset_userdata('featured');
	}

	function loadjs_clothing_filtered(){
		$data['products'] = $this->products_model->get_products_filtered_list('Clothing');
		$this->load->view('be/jsloads/clothing_products_list',$data);		
	}
	function loadjs_cosmetics_filtered(){
		$data['products'] = $this->products_model->get_products_filtered_list('Cosmetics');
		$this->load->view('be/jsloads/cosmetics_products_list',$data);		
	}
	function loadjs_sound_filtered(){
		$data['products'] = $this->products_model->get_products_filtered_list('Sound');
		$this->load->view('be/jsloads/sound_products_list',$data);		
	}

	// function loadjs(){
	// 	$data['products'] = $this->products_model->get_products_list();
	// 	$this->load->view('be/jsloads/products_list',$data);
	// }
	// function loadjs_filtered(){
	// 	$data['products'] = $this->products_model->get_products_filtered_list();
	// 	$this->load->view('be/jsloads/products_list',$data);		
	// }
	// function loadjs_agentfiltered(){
	// 	$data['products'] = $this->products_model->get_agent_products_filtered_list();
	// 	$this->load->view('be/jsloads/agent_products_list',$data);		
	// }


	//EDIT PRODUCT
	//Start
	function clothing_edit_start($product_id){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['product'] = $this->products_model->get_product2($product_id);
			$data['currencies'] = $this->currencies_model->get_currencies_list();			
			$data['categories'] = $this->categories_model->get_clothing_categories_list();
			$data['brands'] = $this->brands_model->get_clothing_brands_list();

			$data['product_categories'] = $this->products_model->get_product_categories($product_id);

			$data['product_type'] = 'Clothing';
			$data['mode'] = 'Edit';

			$data['page_title'] = 'Start - Edit Clothing Product | ';
			$data['main_content'] = 'be/product_add_start';
			$this->load->view('be/includes/template',$data);
        }else{
            redirect('be/auth');
		}
	}
	function cosmetics_edit_start($product_id){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['product'] = $this->products_model->get_product2($product_id);
			$data['currencies'] = $this->currencies_model->get_currencies_list();			
			$data['categories'] = $this->categories_model->get_cosmetics_categories_list();
			$data['brands'] = $this->brands_model->get_cosmetics_brands_list();

			$data['product_categories'] = $this->products_model->get_product_categories($product_id);

			$data['product_type'] = 'Cosmetics';
			$data['mode'] = 'Edit';

			$data['page_title'] = 'Start - Edit Cosmetics Product | ';
			$data['main_content'] = 'be/product_add_start';
			$this->load->view('be/includes/template',$data);
        }else{
            redirect('be/auth');
		}
	}
	function sound_edit_start($product_id){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['product'] = $this->products_model->get_product2($product_id);
			$data['currencies'] = $this->currencies_model->get_currencies_list();			
			$data['categories'] = $this->categories_model->get_sound_categories_list();
			$data['brands'] = $this->brands_model->get_sound_brands_list();

			$data['product_categories'] = $this->products_model->get_product_categories($product_id);

			$data['product_type'] = 'Sound';
			$data['mode'] = 'Edit';

			$data['page_title'] = 'Start - Edit Sound Product | ';
			$data['main_content'] = 'be/product_add_start';
			$this->load->view('be/includes/template',$data);
        }else{
            redirect('be/auth');
		}
	}
	//Features
	function clothing_edit_features($product_id){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['product'] = $this->products_model->get_product2($product_id);

			$data['product_attributes'] = $this->products_model->get_product_attributes($product_id);
			$data['product_num_attributes'] = $this->products_model->get_product_num_attributes($product_id);

			$data['product_type'] = 'Clothing';
			$data['mode'] = 'Edit';

			$data['page_title'] = 'Features - Edit Clothing Product | ';
			$data['main_content'] = 'be/product_add_features';
			$this->load->view('be/includes/template',$data);
        }else{
            redirect('be/auth');
		}
	}
	function cosmetics_edit_features($product_id){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['product'] = $this->products_model->get_product2($product_id);

			$data['product_attributes'] = $this->products_model->get_product_attributes($product_id);
			$data['product_num_attributes'] = $this->products_model->get_product_num_attributes($product_id);

			$data['product_type'] = 'Cosmetics';
			$data['mode'] = 'Edit';

			$data['page_title'] = 'Features - Edit Cosmetics Product | ';
			$data['main_content'] = 'be/product_add_features';
			$this->load->view('be/includes/template',$data);
        }else{
            redirect('be/auth');
		}
	}
	function sound_edit_features($product_id){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['product'] = $this->products_model->get_product2($product_id);

			$data['product_attributes'] = $this->products_model->get_product_attributes($product_id);
			$data['product_num_attributes'] = $this->products_model->get_product_num_attributes($product_id);

			$data['product_type'] = 'Sound';
			$data['mode'] = 'Edit';

			$data['page_title'] = 'Features - Edit Sound Product | ';
			$data['main_content'] = 'be/product_add_features';
			$this->load->view('be/includes/template',$data);
        }else{
            redirect('be/auth');
		}
	}
	//Images
	function clothing_edit_images($product_id){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['product'] = $this->products_model->get_product2($product_id);

			$data['product_other_images'] = $this->products_model->get_product_other_images($product_id);
			$data['product_num_other_images'] = $this->products_model->get_product_num_other_images($product_id);

			$data['product_type'] = 'Clothing';
			$data['mode'] = 'Edit';

			$data['page_title'] = 'Images - Edit Clothing Product | ';
			$data['main_content'] = 'be/product_add_images';
			$this->load->view('be/includes/template',$data);
        }else{
            redirect('be/auth');
		}
	}
	function cosmetics_edit_images($product_id){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['product'] = $this->products_model->get_product2($product_id);

			$data['product_other_images'] = $this->products_model->get_product_other_images($product_id);
			$data['product_num_other_images'] = $this->products_model->get_product_num_other_images($product_id);

			$data['product_type'] = 'Cosmetics';
			$data['mode'] = 'Edit';

			$data['page_title'] = 'Images - Edit Cosmetics Product | ';
			$data['main_content'] = 'be/product_add_images';
			$this->load->view('be/includes/template',$data);
        }else{
            redirect('be/auth');
		}
	}
	function sound_edit_images($product_id){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['product'] = $this->products_model->get_product2($product_id);

			$data['product_other_images'] = $this->products_model->get_product_other_images($product_id);
			$data['product_num_other_images'] = $this->products_model->get_product_num_other_images($product_id);

			$data['product_type'] = 'Sound';
			$data['mode'] = 'Edit';

			$data['page_title'] = 'Images - Edit Sound Product | ';
			$data['main_content'] = 'be/product_add_images';
			$this->load->view('be/includes/template',$data);
        }else{
            redirect('be/auth');
		}
	}

	//UPDATE PRODUCT
	function update_start(){
		$product_id = $this->input->post('product_id');
		$product_sku = $this->products_model->get_product_sku_code($product_id);		
		$product_reference_id = url_title($this->input->post('product_name'),'-',TRUE) . '-' . strtolower($product_sku);

		$data = array(
			'product_type'				=> $this->input->post('product_type'),
			'product_reference_id'		=> $product_reference_id,
            'product_name'				=> $this->input->post('product_name'),
            'product_description'		=> $this->input->post('product_description'),
            'brand_id'					=> $this->input->post('brand_id'),
            'product_price'				=> $this->input->post('price'),
            'product_deal_price'		=> $this->input->post('deal_price'),
            'currency_id'				=> $this->input->post('currency_id')
       	);		

		$q = $this->products_model->update_start($data,$product_id);		
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => $q['dt']);
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}
	function edit_features($product_id){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['product'] = $this->products_model->get_product2($product_id);
			$data['product_listing_features'] = $this->products_model->get_product_listing_features($product_id);
			$product_type_id = $this->products_model->get_product_type_id($product_id);
			$data['product_type'] = $this->product_types_model->get_product_type2($product_type_id);
			$data['product_feature_types'] = $this->product_feature_types_model->get_product_feature_types_list2();
			$data['product_features'] = $this->product_features_model->get_product_features_list();

			$data['page_title'] = 'Edit product - Features | ';
			$data['main_content'] = 'be/add_features';
			$this->load->view('be/includes/template',$data);			
		}else {
            redirect('be/auth');
		}			
	}

	function update_features(){
		$product_id = $this->input->post('product_id');

		$data = array(
            'product_status'			=> $this->input->post('product_status'),
            'featured'					=> $this->input->post('featured'),
            'new_arrival'				=> $this->input->post('new_arrival'),
            'special_offer'				=> $this->input->post('special_offer'),
            'featured'			=> $this->input->post('featured')
       	);
		
		$q = $this->products_model->update_features($data,$product_id);		
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => $q['dt']);
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}

	function edit_images($product_id){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['product'] = $this->products_model->get_product2($product_id);
			$data['page_title'] = 'Edit product - images | ';
			$data['main_content'] = 'be/add_images';
			$this->load->view('be/includes/template',$data);
		}else {
            redirect('be/auth');
		}			
	}
	function edit_agent_images($product_id){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['product'] = $this->products_model->get_product2($product_id);
			$data['page_title'] = 'Edit product - images | ';
			$data['main_content'] = 'be/edit_agent_product_images';
			$this->load->view('be/includes/template',$data);
		}else {
            redirect('be/auth');
		}			
	}

	function update_images(){
		$product_id = $this->input->post('product_id');

		$data = array(
			'virtual_video' => $this->input->post('virtual_video'),
			'publish_status'=> $this->input->post('publish_status'),
            'featured'		=> $this->input->post('featured')
       	);
		$q = $this->products_model->update_images($data,$product_id);		
		if ($q['res'] == true){
			$this->session->set_flashdata('success',$q['dt']);
			$resp = array('status' => 'SUCCESS','message' => $q['dt']);
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}

	function upload_main_image(){
		$product_id = $this->input->post('product_main_image_id');		
		$q = $this->products_model->upload_main_image2($product_id);
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => 'Main Image uploaded successfully.');
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}
	function upload_edit_other_image(){
		$product_image_id = $this->input->post('product_edit_other_image_id');		
		$q = $this->products_model->upload_edit_other_image2($product_image_id);
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => 'Image changed successfully.');
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);

	}
	function upload_other_image(){
		$product_id = $this->input->post('product_other_image_product_id');		
		$q = $this->products_model->upload_other_image2($product_id);
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => 'Image added successfully.');
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}

	function get_product($product_id){
		$product = $this->products_model->get_product($product_id);
		echo json_encode($product);
	}
	function update(){
		$product_id = $this->input->post('product_id');
		$country_name = $this->input->post('country_name');
		$country_code = $this->input->post('country_code');
		$product_name = $this->input->post('product_name');
		$product_symbol = $this->input->post('product_symbol');

		$e = $this->products_model->product_update_exists($product_id,$country_name,$country_code,$product_name,$product_symbol);

		if($e['res'] == true){
			$data = array(
				'country_name' => $country_name,
				'country_code' => $country_code,
				'product_name' => $product_name,
				'product_symbol' => $product_symbol			
			);

			$q = $this->products_model->update($data,$product_id);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'product updated successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => $e['dt']);
		}
		echo json_encode($resp);
	}
	function delete($product_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->products_model->delete($product_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => 'Product deleted successfully');			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}
	function restore($product_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->products_model->restore($product_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => 'Product restored successfully');			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}

	function delete_product_image($image_id){
		//$product_id = $this->input->post('product_id');
		
		$q = $this->products_model->delete_product_image($image_id);
		if($q['res'] == TRUE){
			$resp = array('status' => 'SUCCESS','message' => $q['dt']);			
		}else{					
			$resp = array('status' => 'ERR','message' => $q['dt']);			
		}
		echo json_encode($resp);			
	}
	function set_online($product_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->products_model->set_online($product_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => $q['dt']);			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}
	function set_offline($product_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->products_model->set_offline($product_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => $q['dt']);			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}
	//FEATURED
	function set_featured($product_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->products_model->set_featured($product_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => $q['dt']);			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}
	function unset_featured($product_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->products_model->unset_featured($product_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => $q['dt']);			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}
	//NEW ARRIVAL
	function set_new_arrival($product_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->products_model->set_new_arrival($product_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => $q['dt']);			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}
	function unset_new_arrival($product_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->products_model->unset_new_arrival($product_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => $q['dt']);			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}
	//SPECIAL OFFER
	function set_special_offer($product_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->products_model->set_special_offer($product_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => $q['dt']);			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}
	function unset_special_offer($product_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->products_model->unset_special_offer($product_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => $q['dt']);			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}
	//DEAL OF THE WEEK
	function set_deal_of_the_week($product_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->products_model->set_deal_of_the_week($product_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => $q['dt']);			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}
	function unset_deal_of_the_week($product_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->products_model->unset_deal_of_the_week($product_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => $q['dt']);			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}


}