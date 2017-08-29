<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Piddiesmart extends CI_Model{
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->model('piddiesmart'); 

        }
        public function buyer_details($buyer_details)
            { 
                $insert = $this->db->insert('piddiesmart', $buyer_details); 
        
            if ($insert){
                $arr_return = array(
                'res' => true,
                'dt' => 'Listing Type added successfully.');
                }

            else {
                $arr_return = array(
                'res' => false,
                'dt' => 'Could not add listing type successfully. Please try again.'
                );
                }
            return $arr_return;
                }
       }