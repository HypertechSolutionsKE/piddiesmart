<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model{
    public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
    }

    function get_featured_products($product_type){
        $this->db->select('*');
        $this->db->from('products');
        //$this->db->join('product_categories', 'products.product_id = product_categories.product_id', 'left outer');
        //$this->db->join('product_attributes', 'products.product_id = product_attributes.product_id', 'left outer');
        //$this->db->join('product_images', 'products.product_id = product_images.product_id', 'left outer');
        $this->db->join('brands', 'brands.brand_id = products.brand_id', 'left outer');
        $this->db->join('currencies', 'currencies.currency_id = products.currency_id', 'left outer');

        $this->db->where( array('products.is_deleted'=>0, 'products.featured'=>'Yes', 'products.product_type'=>$product_type));
        return $this->db->get()->result();

    }

}