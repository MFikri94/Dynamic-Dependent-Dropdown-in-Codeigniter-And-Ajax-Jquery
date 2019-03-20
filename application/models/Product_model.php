<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model{
	
	function get_category(){
		$query = $this->db->get('category');
		return $query;	
	}

	function get_sub_category($category_id){
		$query = $this->db->get_where('sub_category', array('subcategory_category_id' => $category_id));
		return $query;
	}
	
	function save_product($product_name,$category_id,$subcategory_id,$product_price){
		$data = array(
			'product_name' => $product_name,
			'product_price' => $product_price,
			'product_category_id' => $category_id,
			'product_subcategory_id' => $subcategory_id 
		);
		$this->db->insert('product',$data);
	}

	function get_products(){
		$this->db->select('product_id,product_name,product_price,category_name,subcategory_name');
		$this->db->from('product');
		$this->db->join('category','product_category_id = category_id','left');
		$this->db->join('sub_category','product_subcategory_id = subcategory_id','left');	
		$query = $this->db->get();
		return $query;
	}

	function get_product_by_id($product_id){
		$query = $this->db->get_where('product', array('product_id' =>  $product_id));
		return $query;
	}

	function update_product($product_id,$product_name,$category_id,$subcategory_id,$product_price){
		$this->db->set('product_name', $product_name);
		$this->db->set('product_price', $product_price);
		$this->db->set('product_category_id', $category_id);
		$this->db->set('product_subcategory_id', $subcategory_id);
		$this->db->where('product_id', $product_id);
		$this->db->update('product');
	}

	//Delete Product
	function delete_product($product_id){
		$this->db->delete('product', array('product_id' => $product_id));
	}

	
}