<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Library extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata("logged_in") !== true) {
			redirect("user/login");
		}
	}

	public function index()
	{
		$this->home();
	}

	public function home()
	{
		$data = array();
		$data['title'] = 'Library Management System';
		$data['header'] = $this->load->view('inc/header', $data, TRUE);
		$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
		$data['content'] = $this->load->view('inc/content', '', TRUE);
		$data['footer'] = $this->load->view('inc/footer', '', TRUE);
		$this->load->view('home', $data);
	}

	public function notAccess()
	{
		$data = array();
		$data['title'] = 'Library Management System';
		$data['header'] = $this->load->view('inc/header', $data, TRUE);
		$data['content'] = $this->load->view('inc/notaccess', '', true);
		$data['footer'] = $this->load->view('inc/footer', '', TRUE);
		$this->load->view('home', $data);
	}
}
