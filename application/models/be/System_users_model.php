<?php
class System_users_model extends CI_Model {
	
	function get_system_users_list(){
		$this->db->from('system_users');
		$this->db->join('departments', 'system_users.department_id = departments.department_id', 'left outer');
		$this->db->join('access_levels', 'access_levels.access_level_id = system_users.access_level_id', 'left outer');
		$this->db->where( array('system_users.is_deleted'=>0));
		return $this->db->get()->result();
	}
	function save($data){
		$err = '';
		$insert = $this->db->insert('system_users', $data);
		$insert_id = $this->db->insert_id();
		if ($insert){
			//Profile Picture
			$q = $this->upload_profile_picture($insert_id);
			if ($q['res'] == false){ $err = $err . $q['dt'] . '<br />'; }
			
		}else{
			$err = 'Could not save system user successfully. Please try again.';
		}		
		if ($err == ''){
			$arr_return = array('res' => true,'dt' => 'System user saved successfully');
		}else{
			$arr_return = array('res' => false,'dt' => $err);
		}

		return $arr_return;
	}
	function system_user_exists($email_address){
		$this->db->where('email_address',$email_address);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('system_users');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}
	function get_system_user($user_id){
		$this->db->from('system_users');
		$this->db->where( array('user_id'=>$user_id));
		return $this->db->get()->result_array();
	}
	function get_system_user2($user_id){
		$this->db->from('system_users');
		$this->db->where( array('user_id'=>$user_id));
		return $this->db->get()->result();
	}

	function system_user_update_exists($user_id,$email_address){
		$q = $this->db->query("SELECT * FROM system_users WHERE user_id != ".$user_id." AND email_address = '$email_address' AND is_deleted = 0");
		if ($q->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	function check_old_password($user_id,$old_password){
		$this->db->from('system_users');
		$this->db->where(array('user_id' => $user_id,'user_password' => $old_password));
		$numrows = $this->db->get()->num_rows();
		if ($numrows > 0){
			return true;
		}else{
			return false;
		}

	}
	function update($data,$user_id){
		$err = '';
		$this->db->where(array('user_id'=>$user_id));
		$update = $this->db->update('system_users', $data);

		if ($update){
			//Profile Picture
			$q = $this->upload_profile_picture($user_id);
			if ($q['res'] == false){ $err = $err . $q['dt'] . '<br />'; }
			
		}else{
			$err = 'Could not update system user successfully. Please try again.';
		}		
		if ($err == ''){
			$arr_return = array('res' => true,'dt' => 'System user updated successfully');
		}else{
			$arr_return = array('res' => false,'dt' => $err);
		}
		return $arr_return;
	}
	function update_profile($data,$user_id){
		$err = '';
		$this->db->where(array('user_id'=>$user_id));
		$update = $this->db->update('system_users', $data);

		if ($update){
		}else{
			$err = 'Could not update profile information successfully. Please try again.';
		}		
		if ($err == ''){
			$arr_return = array('res' => true,'dt' => 'Profile Information updated successfully');
		}else{
			$arr_return = array('res' => false,'dt' => $err);
		}
		return $arr_return;
	}
	function change_password($data,$user_id){
		$this->db->where(array('user_id'=>$user_id));
		$update = $this->db->update('system_users', $data);

		if ($update){
			$arr_return = array('res' => true,'dt' => 'Password changed successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Could not change password successfully. Please try again.');
		}		
		return $arr_return;

	}
	function change_profile_picture($user_id){
		if(basename($_FILES['profile_picture']['name'])!=''){
			//$imagefilename = url_title(basename($_FILES['national_id']['name']),'-',TRUE);
			
			$upload_config['upload_path'] = './uploads/profile_pictures/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
			
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
			
			$q = $this->upload->do_upload('profile_picture');
		
			if($q){				
				$det = $this->upload->data();
				$this->db->where(array('user_id' => $user_id));
				$this->db->update('system_users', array('profile_picture' => $det['file_name']));
				$this->session->set_userdata('profile_picture', $det['file_name']);
				$arr_return = array('res' => true,'dt' => 'Profile picture updated successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Profile picture updated successfully');
		}
		return $arr_return;

	}

	//UPLOAD PROFILE PICTURE
	function upload_profile_picture($user_id){
		if(basename($_FILES['profile_picture']['name'])!=''){
			//$imagefilename = url_title(basename($_FILES['national_id']['name']),'-',TRUE);
			
			$upload_config['upload_path'] = './uploads/profile_pictures/';
			$upload_config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
			//$upload_config['file_name'] = $imagefilename;
			$upload_config['max_size']	= '0';
			$upload_config['max_width']  = '0';
			$upload_config['max_height']  = '0';
			
			$this->load->library('upload');
			$this->upload->initialize($upload_config);
			
			$q = $this->upload->do_upload('profile_picture');
		
			if($q){				
				$det = $this->upload->data();
				$this->db->where(array('user_id' => $user_id));
				$this->db->update('system_users', array('profile_picture' => $det['file_name']));
				$arr_return = array('res' => true,'dt' => 'Profile picture saved successfully');
			}else{
				$arr_return = array('res' => false,'dt' => $this->upload->display_errors());
			}
		}else{
			$arr_return = array('res' => true,'dt' => 'Profile picture saved successfully');
		}
		return $arr_return;
	}

	function delete($user_id){
		$data = array(
			'is_deleted'=> 1
		);			
		$this->db->where( array('user_id'=>$user_id));
		$delupdate = $this->db->update('system_users', $data);
		
		if ($delupdate){
			$arr_return = array('res' => true,'dt'=>'System User deleted successfully');
		}else{
			$arr_return = array('res' => false,'dt' => 'Error deleting System User');
		}
		return $arr_return;
	}


}