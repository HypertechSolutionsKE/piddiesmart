<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');	
		$this->load->model('be/customers_model');
		$this->load->model('be/countries_model');
		$this->load->model('be/towns_model');
		
	}
	function index(){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['customers'] = $this->customers_model->get_customers_list();
			$data['countries'] = $this->countries_model->get_countries_list();
			$data['towns'] = $this->towns_model->get_towns_list();

			$data['page_title'] = 'Customers | ';
			$data['main_content'] = 'be/customers';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}
	}
	function save(){
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'phone_number' => $this->input->post('phone_number'),
			'password' => md5($this->input->post('password')),
			'email_address' => $this->input->post('email_address'),
			'gender' => $this->input->post('gender'),
			'country_id' => $this->input->post('country_id'),
			'town_id' => $this->input->post('town_id')
		);	
		$email_address = $this->input->post('email_address');
		if($this->customers_model->customer_exists($email_address) == false){
			$q = $this->customers_model->save($data);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Customer added successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Customer already exists in the database');
		}
			
		echo json_encode($resp);
	}
	function loadjs(){
		$data['customers'] = $this->customers_model->get_customers_list();
		$this->load->view('be/jsloads/customers',$data);
	}
	function get_customer($customer_id){
		$customer = $this->customers_model->get_customer($customer_id);
		echo json_encode($customer);
	}
	function update(){
		$customer_id = $this->input->post('customer_id');
		$email_address = $this->input->post('$email_address');
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'phone_number' => $this->input->post('phone_number'),
			'email_address' => $this->input->post('email_address'),
			'gender' => $this->input->post('gender'),
			'country_id' => $this->input->post('country_id'),
			'town_id' => $this->input->post('town_id')
		);	
		if($this->customers_model->customer_update_exists($customer_id,$email_address) == false){
			$q = $this->customers_model->update($data,$customer_id);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Customer updated successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'This Customer already exists in the database');
		}
		echo json_encode($resp);
	}
	function change_customer_password(){
		$customer_id = $this->input->post('password_customer_id');

		$data = array(
			'password' => md5($this->input->post('new_password'))
		);	

		$q = $this->customers_model->change_password($data,$customer_id);
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => 'Customer password changed successfully.');
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);
	}	
/*	function update_profile(){
		$customer_id = $this->input->post('customer_id');
		$email_address = $this->input->post('$email_address');
		$user_name = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'phone_number' => $this->input->post('phone_number'),
			'email_address' => $this->input->post('email_address'),
			'gender' => $this->input->post('gender'),
			'country_id' => $this->input->post('country_id'),
			'town_id' => $this->input->post('town_id')
		);	
		if($this->customers_model->customer_update_exists($customer_id,$email_address) == false){
			$q = $this->customers_model->update_profile($data,$customer_id);
			if ($q['res'] == true){
				$this->session->set_userdata('user_email', $email_address);
				$this->session->set_userdata('user_name', $user_name);					
				$resp = array('status' => 'SUCCESS','message' => 'Profile Information updated successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'A customer with a similar Email Address already exists. Please use a different Email Address');
		}
		echo json_encode($resp);

	}
*/	function change_password(){
		$customer_id = $this->input->post('password_customer_id');
		$old_password = md5($this->input->post('old_password'));

		$data = array(
			'password' => md5($this->input->post('new_password'))
		);	

		if($this->customers_model->check_old_password($customer_id,$old_password) == true){
			$q = $this->customers_model->change_password($data,$customer_id);
			if ($q['res'] == true){
				$resp = array('status' => 'SUCCESS','message' => 'Password changed successfully.');
			}else{
				$resp = array('status' => 'ERR','message' => $q['dt']);
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'The old password you entered is incorrect');
		}
		echo json_encode($resp);
	}
	function change_profile_picture(){
		$customer_id = $this->input->post('profile_picture_customer_id');		
		$q = $this->customers_model->change_profile_picture($customer_id);
		if ($q['res'] == true){
			$resp = array('status' => 'SUCCESS','message' => 'Profile picture updated successfully.');
		}else{
			$resp = array('status' => 'ERR','message' => $q['dt']);
		}
		echo json_encode($resp);

	}
	function delete($customer_id){
		if($this->session->userdata('piddie_be_loginstate')){
			$q = $this->customers_model->delete($customer_id);
			if($q['res'] == TRUE){
				$resp = array('status' => 'SUCCESS','message' => 'Customer deleted successfully');			
			}else{					
				$resp = array('status' => 'ERR','message' => $q['dt']);			
			}
		}else{
			$resp = array('status' => 'ERR','message' => 'Your session seems to have expired. Please login again to continue');			
    	}
		echo json_encode($resp);
	}

/*	//USER PROFILE
	function profile($customer_id){
		if($this->session->userdata('piddie_be_loginstate')) {
			$data['countries'] = $this->countries_model->get_countries_list();
			$data['towns'] = $this->towns_model->get_towns_list();
			$data['customer'] = $this->customers_model->get_customer2($customer_id);

			$data['page_title'] = 'My Profile | ';
			$data['main_content'] = 'be/user_profile';
			$this->load->view('be/includes/template',$data);
        } 
		else {
            redirect('be/auth');
		}

	}
*/

}