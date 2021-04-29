<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata("logged_in") !== true) {
			redirect("user/login");
		}
		$this->load->model('category_model');
		$data = array();
	}

	public function addCategory()
	{
		if ($this->session->userdata("role") === "admin") {
			$data['title'] = 'Add Category Name';
			$data['header'] = $this->load->view('inc/header', $data, TRUE);
			$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
			$data['content'] = $this->load->view('inc/addCategory', '', TRUE);
			$data['footer'] = $this->load->view('inc/footer', '', TRUE);
			$this->load->view('home', $data);
		} else {
			redirect("library/notAccess");
		}
	}

	public function addCategoryForm()
	{
		$data['cat_name'] = $this->input->post('cat_name');
		$cat_name = $data['cat_name'];

		if (empty($cat_name)) {
			$sdata = array();
			$sdata['msg'] = '<span style="color:red">Field Must not be Empty !</span>';
			$this->session->set_flashdata($sdata);
			redirect("category/addCategory");
		} else {
			$this->category_model->saveCategory($data);
			$sdata = array();
			$sdata['msg'] = '<span style="color:green">Data Added Succesfully !</span>';
			$this->session->set_flashdata($sdata);
			redirect("category/addCategory");
		}
	}

	public function categoryList()
	{
		$data['title']	= 'Category List';
		$data['header']	= $this->load->view('inc/header', $data, TRUE);
		$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
		$data['allcat'] = $this->category_model->getAllCategoryData();
		$data['content'] = $this->load->view('inc/listCategory', $data, TRUE);
		$data['footer'] = $this->load->view('inc/footer', '', TRUE);
		$this->load->view('home', $data);
	}

	public function editCategory($cat_id)
	{
		if ($this->session->userdata("role") === "admin") {
			$data['title'] = 'Edit Category';
			$data['header'] = $this->load->view('inc/header', $data, TRUE);
			$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
			$data['categoryById'] = $this->category_model->getCategoryById($cat_id);
			$data['content'] = $this->load->view('inc/editCategory', $data, TRUE);
			$data['footer'] = $this->load->view('inc/footer', '', TRUE);
			$this->load->view('home', $data);
		} else {
			redirect("library/notAccess");
		}
	}

	public function updateCategory()
	{
		$data['cat_id'] = $this->input->post('cat_id');
		$data['cat_name'] = $this->input->post('cat_name');

		$cat_id = $data['cat_id'];
		$cat_name = $data['cat_name'];

		if (empty($cat_name)) {
			$sdata = array();
			$sdata['msg'] = '<span style="color:red">Field Must not be Empty !</span>';
			$this->session->set_flashdata($sdata);
			redirect("category/categoryList");
		} else {
			$this->category_model->updateCategoryName($data);
			$sdata = array();
			$sdata['msg'] = '<span style="color:green">Data Updated Succesfully !</span>';
			$this->session->set_flashdata($sdata);
			redirect("category/categoryList");
		}
	}
	public function delCategory($id)
	{
		if ($this->session->userdata("role") === "admin") {
			$this->category_model->delCategoryByid($id);
			$sdata = array();
			$sdata['msg'] = '<span style="color:green">Data Deleted Succesfully !</span>';
			$this->session->set_flashdata($sdata);
			redirect("category/categoryList");
		} else {
			redirect("library/notAccess");
		}
	}
}
