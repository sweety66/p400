<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Issue extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata("logged_in") !== true) {
			redirect("user/login");
		}
		$this->load->model('book_model');
		$this->load->model('user_model');
		$this->load->model('issue_model');
		$this->load->model('category_model');
		$data = array();
	}

	public function issuebook()
	{
		$data['title'] = 'Issue Book';
		$data['header'] = $this->load->view('inc/header', $data, TRUE);
		$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
		$data['allcat'] = $this->category_model->getAllCategoryData();
		$data['content'] = $this->load->view('inc/issuebook', $data, TRUE);
		$data['footer'] = $this->load->view('inc/footer', '', TRUE);
		$this->load->view('home', $data);
	}

	public function getBookByCatId($cat_id)
	{
		$getAllBook = $this->issue_model->getBookByCategory($cat_id);
		$output = null;
		$output .= '<option value="0">Select One</option>';
		foreach ($getAllBook as $book) {
			$output .= '<option value="' . $book->book_id . '">' . $book->book_name . '</option>';
		}
		echo $output;
	}

	public function addIssueForm()
	{
		$data['username'] = $this->input->post('username');
		$data['book_id'] = $this->input->post('book_name');
		$data['cat_id'] = $this->input->post('category');
		$data['isIssued'] = 0;
		$data['borrow_date'] = date("Y-m-d");
		$data['return_date'] = $this->input->post('return');

		$username = $data['username'];
		$cat_id = $data['cat_id'];
		$book_id = $data['book_id'];
		$return_date = $data['return_date'];

		$user_id = $this->user_model->getUserByName($username)->user_id;
		$cat_name = $this->category_model->getCategoryById($cat_id)->cat_name;
		$book_name = $this->book_model->bookById($book_id)->book_name;

		$data['user_id'] = $user_id;
		$data['cat_name'] = $cat_name;
		$data['book_name'] = $book_name;

		if (is_null($user_id)) {
			$sdata['msg'] = '<span style="color:red">There is no such user!</span>';
			$this->session->set_flashdata($sdata);
			redirect("issue/issuebook");
		}

		if (empty($username) || empty($book_name) || empty($return_date)) {
			$sdata = array();
			$sdata['msg'] = '<span style="color:red">Field Must not be Empty !</span>';
			$this->session->set_flashdata($sdata);
			redirect("issue/issuebook");
		} else {
			$stock = $this->book_model->bookStockUpdate($book_id);
			if ($stock == 0) {
				$sdata['msg'] = '<span style="color:red">No books in stock!</span>';
				$this->session->set_flashdata($sdata);
				redirect("issue/issuebook");
			}

			$this->issue_model->saveIssueData($data);
			$sdata = array();
			$sdata['msg'] = '<span style="color:green">Data Added Succesfully !</span>';
			$this->session->set_flashdata($sdata);
			redirect("issue/issuebook");
		}
	}

	public function issuelist()
	{
		if ($this->session->userdata("role") === "admin") {
			$data['title'] = 'Issue List';
			$data['header'] = $this->load->view('inc/header', $data, TRUE);
			$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
			$data['issuedata'] = $this->issue_model->getAllIssueData();
			$data['content'] = $this->load->view('inc/issuelist', $data, TRUE);
			$data['footer'] = $this->load->view('inc/footer', '', TRUE);
			$this->load->view('home', $data);
		}
	}

	public function requestlist()
	{
		if ($this->session->userdata("role") === "admin") {
			$data['title'] = 'Request List';
			$data['header'] = $this->load->view('inc/header', $data, TRUE);
			$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
			$data['issuedata'] = $this->issue_model->getRequestIssueData();
			$data['content'] = $this->load->view('inc/requestlist', $data, TRUE);
			$data['footer'] = $this->load->view('inc/footer', '', TRUE);
			$this->load->view('home', $data);
		}
	}

	public function requestpostlist($id)
	{
		if ($this->session->userdata("role") === "admin") {
			$this->issue_model->postRequestIssueData($id);
			redirect("issue/issuelist");
		}
	}

	public function dellist($id)
	{
		if ($this->session->userdata("role") === "admin") {
			$this->issue_model->delListByid($id);
			$sdata = array();
			$sdata['msg'] = '<span style="color:green">Data Deleted Succesfully !</span>';
			$this->session->set_flashdata($sdata);
			redirect("issue/issuelist");
		}
	}

	public function viewUser($id)
	{
		$data['title'] = 'View User';
		$data['header'] = $this->load->view('inc/header', $data, TRUE);
		$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
		$data['user'] = $this->user_model->getUserById($id);
		$data['issue'] = $this->issue_model->getAllIssueDataByUser($id);
		$data['content'] = $this->load->view('inc/viewuser', $data, TRUE);
		$data['footer'] = $this->load->view('inc/footer', '', TRUE);
		$this->load->view('home', $data);
	}

	public function viewbook($bookid)
	{
		$data['title'] = 'View Book';
		$data['header'] = $this->load->view('inc/header', $data, TRUE);
		$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
		$data['bookbyid'] = $this->book_model->bookById($bookid);
		$data['allbook'] = $this->book_model->getAllBookData();
		$data['content'] = $this->load->view('inc/viewbook', $data, TRUE);
		$data['footer'] = $this->load->view('inc/footer', '', TRUE);
		$this->load->view('home', $data);
	}
}
