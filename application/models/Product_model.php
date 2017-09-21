<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{
    public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
    }

    function get_product($product_id){
        $this->db->select('*');
        $this->db->from('products');
        //$this->db->join('product_categories', 'products.product_id = product_categories.product_id', 'left outer');
        //$this->db->join('product_attributes', 'products.product_id = product_attributes.product_id', 'left outer');
        //$this->db->join('product_images', 'products.product_id = product_images.product_id', 'left outer');
        $this->db->join('brands', 'brands.brand_id = products.brand_id', 'left outer');
        $this->db->join('currencies', 'currencies.currency_id = products.currency_id', 'left outer');

        $this->db->where( array('products.product_id'=>$product_id));
        return $this->db->get()->result();

    }
    function get_product_categories($product_id){
        $this->db->select('*');
        $this->db->from('product_categories');        
        $this->db->join('categories', 'categories.category_id = product_categories.category_id');

        $this->db->where( array('product_categories.product_id'=>$product_id, 'product_categories.is_deleted'=>0));
        return $this->db->get()->result();

    }
    function get_product_attributes($product_id){
        $this->db->select('*');
        $this->db->from('product_attributes');        

        $this->db->where( array('product_attributes.product_id'=>$product_id, 'product_attributes.is_deleted'=>0));
        return $this->db->get()->result();

    }
    function get_product_images($product_id){
        $this->db->select('*');
        $this->db->from('product_images');        

        $this->db->where( array('product_images.product_id'=>$product_id, 'product_images.is_deleted'=>0));
        return $this->db->get()->result();

    }

}