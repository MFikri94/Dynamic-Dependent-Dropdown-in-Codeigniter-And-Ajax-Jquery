<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Product_model','product_model');
		$this->load->library('session');
	}

	function index(){
		$data['products'] = $this->product_model->get_products();
		$this->load->view('product_list_view',$data);
	}

	// add new product
	function add_new(){
		$data['category'] = $this->product_model->get_category()->result();
		$this->load->view('add_product_view', $data);
	}

	// get sub category by category_id
	function get_sub_category(){
		$category_id = $this->input->post('id',TRUE);
		$data = $this->product_model->get_sub_category($category_id)->result();
		echo json_encode($data);
	}

	//save product to database
	function save_product(){
		$product_name 	= $this->input->post('product_name',TRUE);
		$category_id 	= $this->input->post('category',TRUE);
		$subcategory_id = $this->input->post('sub_category',TRUE);
		$product_price 	= $this->input->post('product_price',TRUE);
		$this->product_model->save_product($product_name,$category_id,$subcategory_id,$product_price);
		$this->session->set_flashdata('msg','<div class="alert alert-success">Product Saved</div>');
		redirect('product');
	}

	function get_edit(){
		$product_id = $this->uri->segment(3);
		$data['product_id'] = $product_id;
		$data['category'] = $this->product_model->get_category()->result();
		$get_data = $this->product_model->get_product_by_id($product_id);
		if($get_data->num_rows() > 0){
			$row = $get_data->row_array();
			$data['sub_category_id'] = $row['product_subcategory_id'];
		}
		$this->load->view('edit_product_view',$data);
	}

	function get_data_edit(){
		$product_id = $this->input->post('product_id',TRUE);
		$data = $this->product_model->get_product_by_id($product_id)->result();
		echo json_encode($data);
	}

	//update product to database
	function update_product(){
		$product_id 	= $this->input->post('product_id',TRUE);
		$product_name 	= $this->input->post('product_name',TRUE);
		$category_id 	= $this->input->post('category',TRUE);
		$subcategory_id = $this->input->post('sub_category',TRUE);
		$product_price 	= $this->input->post('product_price',TRUE);
		$this->product_model->update_product($product_id,$product_name,$category_id,$subcategory_id,$product_price);
		$this->session->set_flashdata('msg','<div class="alert alert-success">Product Updated</div>');
		redirect('product');
	}

	//Delete Product from Database
	function delete(){
		$product_id = $this->uri->segment(3);
		$this->product_model->delete_product($product_id);
		$this->session->set_flashdata('msg','<div class="alert alert-success">Product Deleted</div>');
		redirect('product');
	}
}