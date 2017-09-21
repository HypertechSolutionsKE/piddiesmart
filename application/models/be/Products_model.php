	<?php
class Products_model extends CI_Model {

	//Clothing products	
	function get_products_list($product_type){
		$this->db->select('products.*, brands.brand_id, brands.brand_name, currencies.currency_id, currencies.currency_symbol');
		$this->db->from('products');
		$this->db->join('brands', 'brands.brand_id = products.brand_id', 'left outer');
		$this->db->join('currencies', 'currencies.currency_id = products.currency_id', 'left outer');
		$this->db->where( array('products.is_deleted'=>0,'products.product_type'=>$product_type));
		return $this->db->get()->result();
	}

	function get_products_filtered_list($product_type){
		$this->db->select('products.*, brands.brand_id, brands.brand_name, currencies.currency_id, currencies.currency_symbol');

		$category_id = $this->input->post('category_id');
		$brand_id = $this->input->post('brand_id');
		$product_status = $this->input->post('product_status');
		$featured = $this->input->post('featured');
		$new_arrival = $this->input->post('new_arrival');
		$special_offer = $this->input->post('special_offer');
		$deal_of_the_week = $this->input->post('deal_of_the_week');

		$this->db->from('products');
		//$this->db->join('categories', 'categories.category_id = products.category_id', 'left outer');
		$this->db->join('brands', 'brands.brand_id = products.brand_id', 'left outer');
		$this->db->join('currencies', 'currencies.currency_id = products.currency_id', 'left outer');

		//if ($category_id != ''){$this->db->where(array('products.category_id'=>$category_id));}
		if ($brand_id != ''){$this->db->where(array('products.brand_id'=>$brand_id));}

		if ($featured != 'All' && $featured != ''){$this->db->where( array('products.featured'=>$featured));}
		if ($product_status != 'All' && $product_status != ''){$this->db->where( array('products.product_status'=>$product_status));}
		if ($new_arrival != 'All' && $new_arrival != ''){$this->db->where( array('products.new_arrival'=>$new_arrival));}
		if ($special_offer != 'All' && $special_offer != ''){$this->db->where( array('products.special_offer'=>$special_offer));}
		if ($deal_of_the_week != 'All' && $deal_of_the_week != ''){$this->db->where( array('products.deal_of_the_week'=>$deal_of_the_week));}


		$this->db->where( array('products.product_type'=>$product_type));
		return $this->db->get()->result();
	}

	function generate_product_sku($length = 12) {
    	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$randomString = '';
    	for ($i = 0; $i < $length; $i++) {
       	$randomString .= $characters[rand(0, strlen($characters) - 1)];
    	}
    	return $randomString;
	}
	
	function get_product_sku(){
		$product_sku = $this->generate_product_sku();
		$checktrue = $this->check_sku_exists($product_sku);
		while ($checktrue == true){
			$product_sku = $this->generate_product_sku();
			$checktrue = $this->check_sku_exists($product_sku);
		}
		return $product_sku;
	}
	function check_sku_exists($sku){
		$this->db->from('products');
		$this->db->where( array('product_sku_code'=>$sku));
		$numrows = $this->db->get()->num_rows();
		if ($numrows > 0){
			return true;
		}else{
			return false;
		}
	}
	function get_product_sku_code($product_id){
		$sku_code = '';
		$this->db->from('products');
		$this->db->where( array('product_id'=>$product_id));
		$result = $this->db->get()->result();
		foreach ($result as $r){
			$sku_code = $r->product_sku_code;
		}

		return $sku_code;
	}

	function save_product($save_data){
		$err = '';
		$err2 = '';
		$insert = $this->db->insert('products', $save_data);
		$insert_id = $this->db->insert_id();
		if ($insert){
			//Categories
			if ($this->session->userdata('category_id')){
				if ($this->session->userdata('category_id') != ''){
					$this->save_product_categories($insert_id);
				}
			}

			//Attributes
			$this->save_product_attributes($insert_id);

			//Main Image
			$q = $this->upload_main_image($insert_id);
			if ($q['res'] == false){ $err2 = $err2 . '<br />' . $q['dt']; }

			//Other Image 1
			$q = $this->upload_other_images($insert_id);
			if ($q['res'] == false){ $err2 = $err2 . '<br />' . $q['dt']; }
						
		}else{
			$err = 'Could not save the product successfully. Please try again.';
		}

		if ($err == ''){
			if ($err2 == ''){
				$arr_return = array('res' => true,'dt' => 'Product saved successfully');
			}else{
				$arr_return = array('res' => true,'dt' => 'product saved successfully' . $err2);
			}
		}else{
			$arr_return = array('res' => false,'dt' => $err);
		}
		return $arr_return;

	}
	function save_product_categories($product_id){
		$category_id = $this->session->userdata('category_id');		
		foreach ($category_id as $temp_id){
			//$parent_cat_id = $this->get_parent_cat_id($temp_cat_id);
			$new_data = array(
				'product_id' => $product_id,
				'category_id' => $temp_id
			);
			$insert = $this->db->insert('product_categories', $new_data);
		}				
	}

	function save_product_attributes2($product_id){
		if (($this->input->post('attribute_name_1') != '') && ($this->input->post('attribute_value_1') != '')){
			$attribute_data = array(
				'product_id' => $product_id,
				'product_attribute_name' => $this->input->post('attribute_name_1'),
				'product_attribute_values' => $this->input->post('attribute_value_1')
			);
			$this->db->insert('product_attributes', $attribute_data);
		}
		if (($this->input->post('attribute_name_2') != '') && ($this->input->post('attribute_value_2') != '')){
			$attribute_data = array(
				'product_id' => $product_id,
				'product_attribute_name' => $this->input->post('attribute_name_2'),
				'product_attribute_values' => $this->input->post('attribute_value_2')
			);
			$this->db->insert('product_attributes', $attribute_data);
		}
		if (($this->input->post('attribute_name_3') != '') && ($this->input->post('attribute_value_3') != '')){
			$attribute_data = array(
				'product_id' => $product_id,
				'product_attribute_name' => $this->input->post('attribute_name_3'),
				'product_attribute_values' => $this->input->post('attribute_value_3')
			);
			$this->db->insert('product_attributes', $attribute_data);
		}
		if (($this->input->post('attribute_name_4') != '') && ($this->input->post('attribute_value_4') != '')){
			$attribute_data = array(
				'product_id' => $product_id,
				'product_attribute_name' => $this->input->post('attribute_name_4'),
				'product_attribute_values' => $this->input->post('attribute_value_4')
			);
			$this->db->insert('product_attributes', $attribute_data);
		}
		if (($this->input->post('attribute_name_5') != '') && ($this->input->post('attribute_value_5') != '')){
			$attribute_data = array(
				'product_id' => $product_id,
				'product_attribute_name' => $this->input->post('attribute_name_5'),
				'product_attribute_values' => $this->input->post('attribute_value_5')
			);
			$this->db->insert('product_attributes', $attribute_data);
		}
	}

	function save_product_attributes($product_id){
		if (($this->session->userdata('attribute_name_1') != '') && ($this->session->userdata('attribute_value_1') != '')){
			$attribute_data = array(
				'product_id' => $product_id,
				'product_attribute_name' => $this->session->userdata('attribute_name_1'),
				'product_attribute_values' => $this->session->userdata('attribute_value_1')
			);
			$this->db->insert('product_attributes', $attribute_data);
		}
		if (($this->session->userdata('attribute_name_2') != '') && ($this->session->userdata('attribute_value_2') != '')){
			$attribute_data = array(
				'product_id' => $product_id,
				'product_attribute_name' => $this->session->userdata('attribute_name_2'),
				'product_attribute_values' => $this->session->userdata('attribute_value_2')
			);
			$this->db->insert('product_attributes', $attribute_data);
		}
		if (($this->session->userdata('attribute_name_3') != '') && ($this->session->userdata('attribute_value_3') != '')){
			$attribute_data = array(
				'product_id' => $product_id,
				'product_attribute_name' => $this->session->userdata('attribute_name_3'),
				'product_attribute_values' => $this->session->userdata('attribute_value_3')
			);
			$this->db->insert('product_attributes', $attribute_data);
		}
		if (($this->session->userdata('attribute_name_4') != '') && ($this->session->userdata('attribute_value_4') != '')){
			$attribute_data = array(
				'product_id' => $product_id,
				'product_attribute_name' => $this->session->userdata('attribute_name_4'),
				'product_attribute_values' => $this->session->userdata('attribute_value_4')
			);
			$this->db->insert('product_attributes', $attribute_data);
		}
		if (($this->session->userdata('attribute_name_5') != '') && ($this->session->userdata('attribute_value_5') != '')){
			$attribute_data = array(
				'product_id' => $product_id,
				'product_attribute_name' => $this->session->userdata('attribute_name_5'),
				'product_attribute_values' => $this->session->userdata('attribute_value_5')
			);
			$this->db->insert('product_attributes', $attribute_data);
		}
	}

	//UPLOAD MAIN IMAGE
	function upload_main_image($product_id){
		if(basename($_FILES['main_image']['name'])!=''){
			
			$upload_config['upload_path'] = './uploads/product_images/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
			
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
			
			$q = $this->upload->do_upload('main_image');
		
			if($q){				
				$det = $this->upload->data();					
				$this->db->where(array('product_id'=>$product_id));
				$this->db->update('products', array('main_image' => $det['file_name']));
				$arr_return = array('res' => true,'dt' => 'Main image uploaded successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Main image uploaded successfully');
		}
		return $arr_return;
	}

	//UPLOAD OTHER IMAGES
	function upload_other_images($product_id){
		for ($i = 1; $i <= 5; $i++) {
			if(basename($_FILES['other_image_'.$i]['name'])!=''){
				
				$upload_config['upload_path'] = './uploads/product_images/';
				$upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
				//$upload_config['file_name'] = $imagefilename;
				$upload_config['max_size']	= '0';
				$upload_config['max_width']  = '0';
				$upload_config['max_height']  = '0';
				
				$this->load->library('upload');
				$this->upload->initialize($upload_config);
				
				$q = $this->upload->do_upload('other_image_'.$i);
			
				if($q){				
					$det = $this->upload->data();

					$image_data = array(
						'product_id' => $product_id,
						'image_filename' => $det['file_name']
					);
					$this->db->insert('product_images', $image_data);

					//$this->db->where(array('product_id'=>$product_id));
					//$this->db->update('products', array('other_image_'.$i => $det['file_name']));
					$arr_return = array('res' => true,'dt' => 'Image $i uploaded successfully');
				}else{
					$arr_return = array('res' => false,'dt' => 'Image $i :' . $this->upload->display_errors());
				}
			}else{
				$arr_return = array('res' => true,'dt' => 'Image $i uploaded successfully');
			}    		
		}
		return $arr_return;
	}

	//UPLOAD MAIN IMAGE
	function upload_main_image2($product_id){
		if(basename($_FILES['product_main_image']['name'])!=''){
			
			$upload_config['upload_path'] = './uploads/product_images/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
			
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
			
			$q = $this->upload->do_upload('product_main_image');
		
			if($q){				
				$det = $this->upload->data();					
				$this->db->where(array('product_id'=>$product_id));
				$this->db->update('products', array('main_image' => $det['file_name']));
				$arr_return = array('res' => true,'dt' => 'Main image uploaded successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Main image uploaded successfully');
		}
		return $arr_return;
	}
	function upload_edit_other_image2($product_image_id){
		if(basename($_FILES['product_edit_other_image']['name'])!=''){
			
			$upload_config['upload_path'] = './uploads/product_images/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
			
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
			
			$q = $this->upload->do_upload('product_edit_other_image');
		
			if($q){				
				$det = $this->upload->data();					
				$this->db->where(array('product_image_id'=>$product_image_id));
				$this->db->update('product_images', array('image_filename' => $det['file_name']));
				$arr_return = array('res' => true,'dt' => 'Image changed successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Image changed successfully');
		}
		return $arr_return;

	}
	function upload_other_image2($product_id){
		//for ($i = 1; $i <= 5; $i++) {
		if(basename($_FILES['product_other_image']['name'])!=''){
				
			$upload_config['upload_path'] = './uploads/product_images/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
				
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
				
			$q = $this->upload->do_upload('product_other_image');
			
			if($q){				
				$det = $this->upload->data();

				$image_data = array(
					'product_id' => $product_id,
					'image_filename' => $det['file_name']
				);
				$this->db->insert('product_images', $image_data);

				//$this->db->where(array('product_id'=>$product_id));
				//$this->db->update('products', array('other_image_'.$imageid => $det['file_name']));
				$arr_return = array('res' => true,'dt' => 'Image added successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Image added successfully');
		}    		
		//}
		return $arr_return;
	}



	function get_product($product_id){
		$this->db->from('products');
		$this->db->where(array('product_id'=>$product_id));
		return $this->db->get()->result_array();
	}
	function get_product2($product_id){
		$this->db->from('products');
		$this->db->join('brands', 'brands.brand_id = products.brand_id', 'left outer');
		$this->db->join('currencies', 'currencies.currency_id = currencies.currency_id', 'left outer');
		$this->db->where(array('products.product_id'=>$product_id));
		return $this->db->get()->result();
	}
	function get_brand_id($product_id){
		$this->db->from('products');
		$this->db->where(array('product_id'=>$product_id));
		$result = $this->db->get()->result();
		foreach ($result as $row) {
			$brand_id = $row->brand_id;
		}
		return $brand_id;
	}
	function get_product_categories($product_id){
		$this->db->from('product_categories');
		$this->db->where(array('product_id'=>$product_id,'is_deleted'=>0));
		return $this->db->get()->result();
	}
	function get_product_other_images($product_id){
		$this->db->from('product_images');
		$this->db->where(array('product_id'=>$product_id,'is_deleted'=>0));
		return $this->db->get()->result();
	}
	function get_product_num_other_images($product_id){
		$this->db->from('product_images');
		$this->db->where(array('product_id'=>$product_id,'is_deleted'=>0));
		return $this->db->count_all_results();
	}

	function get_product_attributes($product_id){
		$this->db->from('product_attributes');
		$this->db->where(array('product_id'=>$product_id,'is_deleted'=>0));
		return $this->db->get()->result();
	}
	function get_product_num_attributes($product_id){
		$this->db->from('product_attributes');
		$this->db->where( array('product_id'=>$product_id,'is_deleted'=>0));
		return $this->db->count_all_results();
	}

	function update_start($data,$product_id){
		$this->db->where(array('product_id' => $product_id));
		$update = $this->db->update('products', $data);
		if ($update){
			$category_id = $this->input->post('category_id');
			if ($category_id != ''){
				$this->update_product_categories($product_id,$category_id);
			}
			$arr_return = array('res' => true,'dt' => 'Product updated successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update product successfully. Please try again.');
		}
		return $arr_return;		
	}
	function update_product_categories($product_id,$category_id){
		$product_categories = $this->get_product_categories($product_id);

		foreach ($product_categories as $row){
			$found = false;
			foreach ($category_id as $temp_id){
				if ($row->category_id == $temp_id){
					$found = true;
					break;
				}
			}
			if ($found == false){
			   $this->db->where('product_id', $product_id);
			   $this->db->where('category_id', $row->category_id);			   
			   $this->db->delete('product_categories'); 				
			}
		}

		$product_categories = $this->get_product_categories($product_id);
	
		foreach ($category_id as $temp_id){
			$found = false;
			foreach ($product_categories as $row){
				if ($row->category_id == $temp_id){
					$found = true;
					break;
				}
			}
			if ($found == false){
				$new_data = array(
					'product_id' => $product_id,
					'category_id' => $temp_id
				);
				$this->db->insert('product_categories', $new_data);
			}
		}				
	}

	function update_features($data,$product_id){
		$this->db->where(array('product_id' => $product_id));
		$update = $this->db->update('products', $data);
		if ($update){
			$this->update_product_attributes($product_id);
			$arr_return = array('res' => true,'dt' => 'Product updated successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update product successfully. Please try again.');
		}
		return $arr_return;		

	}
	function update_product_attributes($product_id){
		$this->db->where( array('product_id'=>$product_id));
		$this->db->delete('product_attributes');
		$this->save_product_attributes2($product_id);
	}


	function update_attachments($data,$product_id){
		$this->db->where(array('product_id' => $product_id));
		$update = $this->db->update('products', $data);
		if ($update){
			$arr_return = array('res' => true,'dt' => 'product updated successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update product successfully. Please try again.');
		}
		return $arr_return;		
	}


	function update($data,$product_id){
		$this->db->where(array('product_id'=>$product_id));
		$update = $this->db->update('products', $data);
		if ($update){
			$arr_return = array('res' => true,'dt' => 'product updated successfully.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not update product successfully. Please try again.');
		}
		return $arr_return;
	}
	function delete($product_id){
		$data = array('is_deleted'=> 1);			
		$this->db->where( array('product_id'=>$product_id));
		$delupdate = $this->db->update('products', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'Product deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting product');
		}
		return $arr_return;
	}
	function restore($product_id){
		$data = array('is_deleted'=> 0);			
		$this->db->where( array('product_id'=>$product_id));
		$delupdate = $this->db->update('products', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'product restored successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error restoring product');
		}
		return $arr_return;
	}

	function delete_product_image($image_id){
		//$other_image = 'other_image_'.$image_index;
		$data = array('is_deleted' => 1);			
		$this->db->where(array('product_image_id'=>$image_id));		
		
		if ($this->db->update('product_images', $data)){
			$arr_return = array('res' => true,'dt'=>'Image deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting product image');
		}

		//echo $product_id;
		return $arr_return;

	}

	function area_exists($area_name){
		$this->db->where('area_name',$area_name);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('areas');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}

	function set_online($product_id){
		$data = array('product_status'=> 'Online');			
		$this->db->where(array('product_id'=>$product_id));
		$res = $this->db->update('products', $data);
		
		if ($res){
			$arr_return = array('res' => true,'dt'=>'Product status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error changing Product status');
		}
		return $arr_return;
	}
	function set_offline($product_id){
		$data = array('product_status'=> 'Offline');			
		$this->db->where(array('product_id'=>$product_id));
		$res = $this->db->update('products', $data);
		
		if ($res){
			$arr_return = array('res' => true,'dt'=>'Product status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error changing Product status');
		}
		return $arr_return;
	}
	//FEATURED
	function set_featured($product_id){
		$data = array('featured'=> 'Yes');			
		$this->db->where(array('product_id'=>$product_id));
		$res = $this->db->update('products', $data);
		
		if ($res){
			$arr_return = array('res' => true,'dt'=>'Product Featured status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error changing Product Featured status');
		}
		return $arr_return;
	}
	function unset_featured($product_id){
		$data = array('featured'=> 'No');			
		$this->db->where( array('product_id'=>$product_id));
		$res = $this->db->update('products', $data);
		
		if ($res){
			$arr_return = array('res' => true,'dt'=>'Product Featured status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error changing Product Featured status');
		}
		return $arr_return;
	}
	//NEW ARRIVAL
	function set_new_arrival($product_id){
		$data = array('new_arrival'=> 'Yes');			
		$this->db->where(array('product_id'=>$product_id));
		$res = $this->db->update('products', $data);
		
		if ($res){
			$arr_return = array('res' => true,'dt'=>'Product New Arrival status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error changing Product New Arrival status');
		}
		return $arr_return;
	}
	function unset_new_arrival($product_id){
		$data = array('new_arrival'=> 'No');			
		$this->db->where( array('product_id'=>$product_id));
		$res = $this->db->update('products', $data);
		
		if ($res){
			$arr_return = array('res' => true,'dt'=>'Product New Arrival status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error changing Product New Arrival status');
		}
		return $arr_return;
	}
	//SPECIAL OFFER
	function set_special_offer($product_id){
		$data = array('special_offer'=> 'Yes');			
		$this->db->where(array('product_id'=>$product_id));
		$res = $this->db->update('products', $data);
		
		if ($res){
			$arr_return = array('res' => true,'dt'=>'Product Special Offer status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error changing Product Special Offer status');
		}
		return $arr_return;
	}
	function unset_special_offer($product_id){
		$data = array('special_offer'=> 'No');			
		$this->db->where( array('product_id'=>$product_id));
		$res = $this->db->update('products', $data);
		
		if ($res){
			$arr_return = array('res' => true,'dt'=>'Product Special Offer status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error changing Product Special Offer status');
		}
		return $arr_return;
	}

	//DEAL OF THE WEEK
	function set_deal_of_the_week($product_id){
		$data = array('deal_of_the_week'=> 'Yes');			
		$this->db->where(array('product_id'=>$product_id));
		$res = $this->db->update('products', $data);
		
		if ($res){
			$arr_return = array('res' => true,'dt'=>'Product Deal of the Week status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error changing Product Deal of the Week status');
		}
		return $arr_return;
	}
	function unset_deal_of_the_week($product_id){
		$data = array('deal_of_the_week'=> 'No');			
		$this->db->where( array('product_id'=>$product_id));
		$res = $this->db->update('products', $data);
		
		if ($res){
			$arr_return = array('res' => true,'dt'=>'Product Deal of the Week status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error changing Product Deal of the Week status');
		}
		return $arr_return;
	}

}