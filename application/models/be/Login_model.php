<?php

class Login_model extends CI_model {

	function user_exists($email_address){
		$this->db->where('email_address',$email_address);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('system_users');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}		
	}
	function register_user($data){
		$insert = $this->db->insert('system_users', $data);
		if ($insert){
			$arr_return = array('res' => true,'dt' => 'Registration successful.');
		}else{
			$arr_return = array('res' => false,'dt' => 'Registration not successful. Please try again.');
		}
		return $arr_return;		
	}

	//check if the username and password match 
	function validate(){		
		$user_password = md5($this->input->post('user_password'));
		$this->db->where('email_address', $this->input->post('email_address'));
		$this->db->where('user_password', $user_password);
		
		$query = $this->db->get('system_users');
		
		if($query->num_rows() == 1){
			$data = array (				
				'last_update' => date("m/d/Y", time())
			);
			
			$this->db->where('email_address', $this->input->post('email_address'));
			$this->db->update('system_users', $data);
			
			foreach ($query->result() as $row){
				$user_id = $row->user_id;
				$user_email = $row->email_address;
				$user_name = $row->first_name . ' ' . $row->last_name;
				$profile_picture = $row->profile_picture;
			}			
			$arr_return = array(' mnuser_id' => $user_id, 'user_email' => $user_email, 'user_name' => $user_name, 'profile_picture' => $profile_picture, 'res' => true);			
			return $arr_return;			
			
			return true;
		}else{
			$arr_return = array('user_id' => '', 'user_email' => '', 'user_name' => '', 'profile_picture' => '','res' => false);			
			return $arr_return;
		}
	}
	
	function check_super_admin(){
		$this->db->where(array('is_super_admin' => 1,'is_active' => 1,'is_deleted' => 0));
		$query = $this->db->get('system_users');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;	
		}		
	}
	
	function verify_lock_password($username,$pwd){
		$password = md5($pwd);
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		
		$query = $this->db->get('user_admin');
		
		if($query->num_rows == 1){
			return true;
		}else{
			return false;
		}		
	}
	
	function pswupdate(){
		$data = array(
			'password' => md5('adm@htec')
		);
		$this->update_record($data);
	}
	
	//get the user id by code($md5_email)
	function get_active_account($md5_email){
	
		$this->db->from('user');
		$this->db->select('customer_id');
		$this->db->where( array('status'=>$md5_email));
		$q = $this->db->get();
		
		if ($q->num_rows()>0){
			foreach ($q->result() as $row){
				$data = $row->customer_id;
			}
			return $data;
		}
		
	}
	
	//update the user table
	function update_record($data){
		$username = $this->session->userdata('id');
		$this->db->where( array('username'=>$username));
		$this->db->update('user_admin', $data);
	}
}