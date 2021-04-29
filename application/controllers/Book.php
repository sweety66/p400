<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Book extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata("logged_in") !== true) {
			redirect("user/login");
		}
		$this->load->model('book_model');
		$this->load->model('category_model');
		$data = array();
	}

	public function addBook()
	{
		if ($this->session->userdata("role") === "admin") {
			$data['title'] = 'Add New Book';
			$data['header'] = $this->load->view('inc/header', $data, TRUE);
			$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
			$data['cat_name'] = $this->category_model->getAllCategoryData();
			$data['content'] = $this->load->view('inc/addbook', $data, TRUE);
			$data['footer'] = $this->load->view('inc/footer', '', TRUE);
			$this->load->view('home', $data);
		} else {
			redirect("libray/notAccess");
		}
	}

	public function addBookForm()
	{
		$data['book_name'] = $this->input->post('book_name');
		$data['author'] = $this->input->post('author');
		$data['stock'] = $this->input->post('stock');
		$data['cat_id']  = $this->input->post('category');

		$cat_id  = $data['cat_id'];
		$cat_name = $this->category_model->getCategoryNameById($cat_id);
		$data['cat_name'] = $cat_name;
		$author = $data['author'];
		$stock = $data['stock'];
		$data['s_no']  = $this->input->post('s_no');

		if (empty($name) && empty($cat_id) && empty($author) && empty($stock)) {
			$sdata = array();
			$sdata['msg'] = '<span style="color:red">Field Must not be Empty !</span>';
			$this->session->set_flashdata($sdata);
			redirect("book/bookList");
		} else {
			$this->book_model->saveBook($data);
			$sdata = array();
			$sdata['msg'] = '<span style="color:green">Book Data Added Succesfully !</span>';
			$this->session->set_flashdata($sdata);
			redirect("book/bookList");
		}
	}

	public function bookList()
	{
		$data['title'] = 'Book List';
		$data['header'] = $this->load->view('inc/header', $data, TRUE);
		$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
		$data['allbook'] = $this->book_model->getAllBookData();
		$data['content'] = $this->load->view('inc/listbook', $data, TRUE);
		$data['footer'] = $this->load->view('inc/footer', '', TRUE);
		$this->load->view('home', $data);
	}

	public function editBook($book_id)
	{
		if ($this->session->userdata("role") === "admin") {
			$data['title'] = 'Edit Book';
			$data['header'] = $this->load->view('inc/header', $data, TRUE);
			$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
			$data['cat_name'] = $this->category_model->getAllCategoryData();
			$data['bookbyid'] = $this->book_model->bookById($book_id);
			$data['content'] = $this->load->view('inc/editbook', $data, TRUE);
			$data['footer'] = $this->load->view('inc/footer', '', TRUE);
			$this->load->view('home', $data);
		} else {
			redirect("library/notAccess");
		}
	}

	public function viewBook($book_id)
	{
		$data['title'] = 'View Book';
		$data['header'] = $this->load->view('inc/header', $data, TRUE);
		$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
		$data['cat_name'] = $this->category_model->getAllCategoryData();
		$data['bookbyid'] = $this->book_model->bookById($book_id);
		$data['content'] = $this->load->view('inc/viewbook', $data, TRUE);
		$data['footer'] = $this->load->view('inc/footer', '', TRUE);
		$this->load->view('home', $data);
	}

	public function updateBookForm()
	{
		$data['book_id'] 	= $this->input->post('book_id');
		$data['book_name'] = $this->input->post('book_name');
		$data['author'] = $this->input->post('author');
		$data['stock'] = $this->input->post('stock');

		$data['cat_id']  = $this->input->post('category');
		$cat_id  = $data['cat_id'];
		$cat_name = $this->category_model->getCategoryNameById($cat_id);
		$data['cat_name'] = $cat_name;

		$book_name = $data['book_name'];
		$cat_name	= $data['cat_name'];
		$author = $data['author'];
		$stock = $data['stock'];

		if (empty($book_name) && empty($cat_name) && empty($author) && empty($stock)) {
			$sdata = array();
			$sdata['msg'] = '<span style="color:red">Field Must not be Empty !</span>';
			$this->session->set_flashdata($sdata);
			redirect("book/bookList");
		} else {
			$this->book_model->updateBook($data);
			$sdata = array();
			$sdata['msg'] = '<span style="color:green">Book Data Updated Succesfully !</span>';
			$this->session->set_flashdata($sdata);
			redirect("book/bookList");
		}
	}

	public function delbook($book_id)
	{
		if ($this->session->userdata("role") === "admin") {
			$this->book_model->delBookByid($book_id);
			$sdata = array();
			$sdata['msg'] = '<span style="color:green">Book Deleted Succesfully !</span>';
			$this->session->set_flashdata($sdata);
			redirect("book/bookList");
		} else {
			redirect("library/notAccess");
		}
	}
}
