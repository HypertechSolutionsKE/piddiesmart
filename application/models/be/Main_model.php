<?php
class Main_model extends CI_Model {

	function get_total_listing_types(){
		$this->db->select('*');
		$this->db->from('listing_types');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->count_all_results();
	}
	function get_total_property_types(){
		$this->db->select('*');
		$this->db->from('property_types');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->count_all_results();
	}
	function get_total_property_subcategories(){
		$this->db->select('*');
		$this->db->from('property_subcategories');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->count_all_results();
	}
	function get_total_regions(){
		$this->db->select('*');
		$this->db->from('regions');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->count_all_results();
	}
	function get_total_cities(){
		$this->db->select('*');
		$this->db->from('cities');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->count_all_results();
	}
	function get_total_areas(){
		$this->db->select('*');
		$this->db->from('areas');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->count_all_results();
	}
	function get_total_property_feature_types(){
		$this->db->select('*');
		$this->db->from('property_feature_types');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->count_all_results();
	}
	function get_total_property_features(){
		$this->db->select('*');
		$this->db->from('property_features');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->count_all_results();
	}
	function get_total_currencies(){
		$this->db->select('*');
		$this->db->from('currencies');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->count_all_results();
	}
	function get_total_system_users(){
		$this->db->select('*');
		$this->db->from('system_users');
		$this->db->where( array('is_deleted'=>0));
		return $this->db->count_all_results();
	}


	//AGENT PROPERTIES
	function get_total_agent_active_properties(){
		$this->db->select('*');	
		$this->db->from('properties');

		$this->db->where( array('properties.publish_status'=>'Online'));

		$this->db->where( array('properties.is_deleted'=>0));
		$this->db->where( array('properties.customer_property'=>1));

		return $this->db->count_all_results();


	}
	function get_total_agent_pending_properties(){
		$this->db->select('*');	
		$this->db->from('properties');

		$this->db->where( array('properties.publish_status'=>'Offline'));
		$this->db->where('properties.created_on >= ',date('Y-m-d', strtotime($date_from)));
		//$this->db->where('properties.created_on <= ',date('Y-m-d', strtotime($date_to)));

		$this->db->where( array('properties.is_deleted'=>0));
		$this->db->where( array('properties.customer_property'=>1));

		return $this->db->count_all_results();


	}
	function get_total_agent_expired_properties(){
		$this->db->select('*');	
		$this->db->from('properties');

		$this->db->where( array('properties.publish_status'=>'Online'));

		$this->db->where( array('properties.is_deleted'=>0));
		$this->db->where( array('properties.customer_property'=>1));

		return $this->db->count_all_results();


	}

	
	/*function get_all_loan_applications(){
		$this->db->select('*');
		$this->db->from('loan_applications');
		//$this->db->join('loan_products', 'loan_products.loan_product_id=loan_applications.loan_product_id');
		//$this->db->where( array('loan_application_id'=>$loan_application_id));
		return $this->db->get()->result();
	}
	function get_pending_loan_applications(){
		$this->db->select('*');
		$this->db->from('loan_applications');
		//$this->db->join('loan_products', 'loan_products.loan_product_id=loan_applications.loan_product_id');
		$this->db->where( array('loan_status'=>0));
		return $this->db->get()->result();
	}
	function get_accepted_loan_applications(){
		$this->db->select('*');
		$this->db->from('loan_applications');
		//$this->db->join('loan_products', 'loan_products.loan_product_id=loan_applications.loan_product_id');
		$this->db->where( array('loan_status'=>1));
		return $this->db->get()->result();
	}
	function get_rejected_loan_applications(){
		$this->db->select('*');
		$this->db->from('loan_applications');
		//$this->db->join('loan_products', 'loan_products.loan_product_id=loan_applications.loan_product_id');
		$this->db->where( array('loan_status'=>2));
		return $this->db->get()->result();
	}
	
	
	function get_loan_application($loan_application_id){
		$this->db->select('*');
		$this->db->from('loan_applications');
		//$this->db->join('loan_products', 'loan_products.loan_product_id=loan_applications.loan_product_id');
		$this->db->where( array('loan_application_id'=>$loan_application_id));
		return $this->db->get()->result();
	}
	
	function mark_pending($loan_application_id){
		$data = array(
			'loan_status' => 0
		);
		$this->db->where( array('loan_application_id' => $loan_application_id));
		$this->db->update('loan_applications', $data);
	}
	function mark_accepted($loan_application_id){
		$data = array(
			'loan_status' => 1
		);
		$this->db->where( array('loan_application_id' => $loan_application_id));
		$this->db->update('loan_applications', $data);
	}
	function mark_rejected($loan_application_id){
		$data = array(
			'loan_status' => 2
		);
		$this->db->where( array('loan_application_id' => $loan_application_id));
		$this->db->update('loan_applications', $data);
	}
	
	function get_total_pending(){
		$this->db->select('*');
		$this->db->from('loan_applications');
		$this->db->where( array('loan_status'=>0));
		return $this->db->count_all_results();
	}
	function get_total_accepted(){
		$this->db->select('*');
		$this->db->from('loan_applications');
		$this->db->where( array('loan_status'=>1));
		return $this->db->count_all_results();
	}
	function get_total_rejected(){
		$this->db->select('*');
		$this->db->from('loan_applications');
		$this->db->where( array('loan_status'=>2));
		return $this->db->count_all_results();
	}
	function get_total_loan_applications(){
		$this->db->select('*');
		$this->db->from('loan_applications');
		return $this->db->count_all_results();
	}*/
	

}