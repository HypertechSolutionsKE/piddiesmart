	<?php
class Ads_model extends CI_Model {


	//HOME IMAGE
	function get_home_image(){
		$this->db->from('ad_home_image');
		return $this->db->get()->result();
	}	

	function home_image_exists(){
		$query = $this->db->get('ad_home_image');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}		
	}

	function upload_home_image(){
		if(basename($_FILES['home_image']['name'])!=''){
			
			$upload_config['upload_path'] = './uploads/home_image/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
			
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
			
			$q = $this->upload->do_upload('home_image');
		
			if($q){				
				$det = $this->upload->data();
				if ($this->home_image_exists() == false){
					$this->db->insert('ad_home_image', array('home_image' => $det['file_name']));
				}else{
					$this->db->update('ad_home_image', array('home_image' => $det['file_name']));
				}				
				$arr_return = array('res' => true,'dt' => 'Homepage background image uploaded successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Homepage background image uploaded successfully');
		}
		return $arr_return;
	}
	

	//HEADER ADVERTS
	function get_header_adverts(){
		$this->db->from('ad_header_adverts');
		$this->db->where( array('is_deleted'=>0));		
		return $this->db->get()->result();
	}
	function get_header_adverts2(){
		$this->db->from('ad_header_adverts');
		$this->db->where( array('is_deleted'=>0,'is_active'=>1));		
		return $this->db->get()->result();
	}

	function upload_header_advert($header_advert_id){
		if(basename($_FILES['header_advert_'.$header_advert_id]['name'])!=''){
				
			$upload_config['upload_path'] = './uploads/header_adverts/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
				
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
				
			$q = $this->upload->do_upload('header_advert_'.$header_advert_id);
			
			if($q){				
				$det = $this->upload->data();					
				$this->db->where(array('header_advert_id'=>$header_advert_id));
				$this->db->update('ad_header_adverts', array('header_advert_image' => $det['file_name']));
				$arr_return = array('res' => true,'dt' => 'Ad uploaded successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Ad uploaded successfully');
		}    		
		return $arr_return;
	}

	function upload_header_advert2(){
		if(basename($_FILES['hd_img']['name'])!=''){
				
			$upload_config['upload_path'] = './uploads/header_adverts/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
				
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
				
			$q = $this->upload->do_upload('hd_img');
			
			if($q){				
				$det = $this->upload->data();					
				$this->db->insert('ad_header_adverts', array('header_advert_image' => $det['file_name']));
				$arr_return = array('res' => true,'dt' => 'Ad uploaded successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Ad uploaded successfully');
		}    		
		return $arr_return;
	}
	function header_advert_inactive($header_advert_id){
		$data = array(
			'is_active'=> 0
		);			
		$this->db->where( array('header_advert_id'=>$header_advert_id));
		$update = $this->db->update('ad_header_adverts', $data);
		
		if ($update){
			$arr_return = array('res' => true,'dt'=>'Ad status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'There was an error changing Ad status. Please try again');
		}
		return $arr_return;
	}
	function header_advert_active($header_advert_id){
		$data = array(
			'is_active'=> 1
		);			
		$this->db->where( array('header_advert_id'=>$header_advert_id));
		$update = $this->db->update('ad_header_adverts', $data);
		
		if ($update){
			$arr_return = array('res' => true,'dt'=>'Ad status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'There was an error changing Ad status. Please try again');
		}
		return $arr_return;
	}
	function header_advert_delete($header_advert_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('header_advert_id'=>$header_advert_id));
		$update = $this->db->update('ad_header_adverts', $data);
		
		if ($update){
			$arr_return = array('res' => true,'dt'=>'Ad deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'There was an error deleting Ad. Please try again');
		}
		return $arr_return;
	}



	//SIDEBAR ADVERTS
	function get_sidebar_adverts(){
		$this->db->from('ad_sidebar_adverts');
		$this->db->where( array('is_deleted'=>0));		
		return $this->db->get()->result();
	}
	function get_sidebar_adverts2(){
		$this->db->from('ad_sidebar_adverts');
		$this->db->where( array('is_deleted'=>0,'is_active'=>1));		
		return $this->db->get()->result();
	}

	function upload_sidebar_advert($sidebar_advert_id){
		if(basename($_FILES['sidebar_advert_'.$sidebar_advert_id]['name'])!=''){
				
			$upload_config['upload_path'] = './uploads/sidebar_adverts/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
				
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
				
			$q = $this->upload->do_upload('sidebar_advert_'.$sidebar_advert_id);
			
			if($q){				
				$det = $this->upload->data();					
				$this->db->where(array('sidebar_advert_id'=>$sidebar_advert_id));
				$this->db->update('ad_sidebar_adverts', array('sidebar_advert_image' => $det['file_name']));
				$arr_return = array('res' => true,'dt' => 'Ad uploaded successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Ad uploaded successfully');
		}    		
		return $arr_return;
	}

	function upload_sidebar_advert2(){
		if(basename($_FILES['hd_img']['name'])!=''){
				
			$upload_config['upload_path'] = './uploads/sidebar_adverts/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
				
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
				
			$q = $this->upload->do_upload('hd_img');
			
			if($q){				
				$det = $this->upload->data();					
				$this->db->insert('ad_sidebar_adverts', array('sidebar_advert_image' => $det['file_name']));
				$arr_return = array('res' => true,'dt' => 'Ad uploaded successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Ad uploaded successfully');
		}    		
		return $arr_return;
	}
	function sidebar_advert_inactive($sidebar_advert_id){
		$data = array(
			'is_active'=> 0
		);			
		$this->db->where( array('sidebar_advert_id'=>$sidebar_advert_id));
		$update = $this->db->update('ad_sidebar_adverts', $data);
		
		if ($update){
			$arr_return = array('res' => true,'dt'=>'Ad status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'There was an error changing Ad status. Please try again');
		}
		return $arr_return;
	}
	function sidebar_advert_active($sidebar_advert_id){
		$data = array(
			'is_active'=> 1
		);			
		$this->db->where( array('sidebar_advert_id'=>$sidebar_advert_id));
		$update = $this->db->update('ad_sidebar_adverts', $data);
		
		if ($update){
			$arr_return = array('res' => true,'dt'=>'Ad status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'There was an error changing Ad status. Please try again');
		}
		return $arr_return;
	}
	function sidebar_advert_delete($sidebar_advert_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('sidebar_advert_id'=>$sidebar_advert_id));
		$update = $this->db->update('ad_sidebar_adverts', $data);
		
		if ($update){
			$arr_return = array('res' => true,'dt'=>'Ad deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'There was an error deleting Ad. Please try again');
		}
		return $arr_return;
	}



	//DETAIL ADVERTS
	function get_detail_adverts(){
		$this->db->from('ad_detail_adverts');
		$this->db->where( array('is_deleted'=>0));		
		return $this->db->get()->result();
	}
	function get_detail_adverts2(){
		$this->db->from('ad_detail_adverts');
		$this->db->where( array('is_deleted'=>0,'is_active'=>1));		
		return $this->db->get()->result();
	}

	function upload_detail_advert($detail_advert_id){
		if(basename($_FILES['detail_advert_'.$detail_advert_id]['name'])!=''){
				
			$upload_config['upload_path'] = './uploads/detail_adverts/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
				
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
				
			$q = $this->upload->do_upload('detail_advert_'.$detail_advert_id);
			
			if($q){				
				$det = $this->upload->data();					
				$this->db->where(array('detail_advert_id'=>$detail_advert_id));
				$this->db->update('ad_detail_adverts', array('detail_advert_image' => $det['file_name']));
				$arr_return = array('res' => true,'dt' => 'Ad uploaded successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Ad uploaded successfully');
		}    		
		return $arr_return;
	}

	function upload_detail_advert2(){
		if(basename($_FILES['hd_img']['name'])!=''){
				
			$upload_config['upload_path'] = './uploads/detail_adverts/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
				
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
				
			$q = $this->upload->do_upload('hd_img');
			
			if($q){				
				$det = $this->upload->data();					
				$this->db->insert('ad_detail_adverts', array('detail_advert_image' => $det['file_name']));
				$arr_return = array('res' => true,'dt' => 'Ad uploaded successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Ad uploaded successfully');
		}    		
		return $arr_return;
	}
	function detail_advert_inactive($detail_advert_id){
		$data = array(
			'is_active'=> 0
		);			
		$this->db->where( array('detail_advert_id'=>$detail_advert_id));
		$update = $this->db->update('ad_detail_adverts', $data);
		
		if ($update){
			$arr_return = array('res' => true,'dt'=>'Ad status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'There was an error changing Ad status. Please try again');
		}
		return $arr_return;
	}
	function detail_advert_active($detail_advert_id){
		$data = array(
			'is_active'=> 1
		);			
		$this->db->where( array('detail_advert_id'=>$detail_advert_id));
		$update = $this->db->update('ad_detail_adverts', $data);
		
		if ($update){
			$arr_return = array('res' => true,'dt'=>'Ad status changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'There was an error changing Ad status. Please try again');
		}
		return $arr_return;
	}
	function detail_advert_delete($detail_advert_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('detail_advert_id'=>$detail_advert_id));
		$update = $this->db->update('ad_detail_adverts', $data);
		
		if ($update){
			$arr_return = array('res' => true,'dt'=>'Ad deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'There was an error deleting Ad. Please try again');
		}
		return $arr_return;
	}


}