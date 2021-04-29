<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('issue_model');
		$data = array();
	}

	public function login()
	{
		$data['title'] = 'Login';
		$data['header'] = $this->load->view('inc/header');
		$this->load->view('login');
		$data['footer'] = $this->load->view('inc/footer');
	}

	public function loginForm()
	{
		$data = array();
		$data['username'] = $this->input->post('username', TRUE);
		$data['password'] = $this->input->post('password', TRUE);
		$check = $this->user_model->checkUser($data);

		if ($check->num_rows() > 0) {
			$sdata = $check->row_array();
			$username = $sdata['username'];
			$password = $sdata['password'];
			$role = $sdata['role'];
			$sesData = array(
				'username' => $username,
				'password' => $password,
				'role' => $role,
				'logged_in' => true
			);
			$this->session->set_userdata($sesData);

			if ($role == "admin") {
				redirect('library/home');
			} else {
				redirect('library/home');
			}
		} else {
			$sdata = array();
			$sdata['msg'] = '<span style="color:red">Username or Password Not Matched</span>';
			$this->session->set_flashdata($sdata);
			redirect('user/login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('user/login');
	}

	public function register()
	{
		$data['title'] = 'Registration';
		$data['header'] = $this->load->view('inc/header');
		$this->load->view('register');
		$data['footer'] = $this->load->view('inc/footer');
	}

	public function registerForm()
	{
		$data['username'] = $this->input->post('username');
		$data['password']  = $this->input->post('password');
		$password_retype  = $this->input->post('password_retype');
		$data['phone']  = $this->input->post('phone');
		$data['role']  = "user";

		$username = $data['username'];
		$password  = $data['password'];
		$phone  = $data['phone'];

		//new
		$user_exists = $this->user_model->getUserByName($username);
		//new
		if (empty($username) || empty($password) || empty($password_retype) || empty($phone)) {
			$sdata = array();
			//new
			if ($user_exists) {
				$sdata['msg'] = '<span style="color:red">Username already exists! Please enter new username.</span>';
				redirect("user/register");
			}
			//new
			$sdata['msg'] = '<span style="color:red">Field Must not be Empty !</span>';
			$this->session->set_flashdata($sdata);
			redirect("user/register");
		} else {
			if ($password === $password_retype) {
				$data["password"] = md5($password);
				$this->user_model->saveUser($data);
				$sdata = array();
				$sdata['msg'] = '<span style="color:green">Data Added Succesfully !</span>';
				$this->session->set_flashdata($sdata);
				redirect("user/userList");
			} else {
				$sdata = array();
				$sdata['msg'] = '<span style="color:red">Password and retype password not matched!</span>';
				$this->session->set_flashdata($sdata);
				redirect("user/register");
			}
		}
	}

	public function userList()
	{
		if ($this->session->userdata("role") === "admin") {
			$data['title'] = 'User List';
			$data['header'] = $this->load->view('inc/header', $data, TRUE);
			$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
			$data['userdata'] = $this->user_model->getAllUserData();
			$data['content'] = $this->load->view('inc/listuser', $data, TRUE);
			$data['footer'] = $this->load->view('inc/footer', '', TRUE);
			$this->load->view('home', $data);
		} else {
			redirect("library/notAccess");
		}
	}

	public function editUser($user_id)
	{
		if ($this->session->userdata("role") === "user" || $this->session->userdata("role") === "admin") {
			$data['title'] = 'Edit User';
			$data['header'] = $this->load->view('inc/header', $data, TRUE);
			$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
			$data['user'] = $this->user_model->getUserById($user_id);
			$data['content'] = $this->load->view('inc/edituser', $data, TRUE);
			$data['footer'] = $this->load->view('inc/footer', '', TRUE);
			$this->load->view('home', $data);
		} else {
			redirect("library/notAccess");
		}
	}

	public function editUserByName($name)
	{
		if ($this->session->userdata("role") === "user" || $this->session->userdata("role") === "admin") {
			$data['title'] = 'Edit User';
			$data['header'] = $this->load->view('inc/header', $data, TRUE);
			$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
			$data['user'] = $this->user_model->getUserByName($name);
			$data['content'] = $this->load->view('inc/edituser', $data, TRUE);
			$data['footer'] = $this->load->view('inc/footer', '', TRUE);
			$this->load->view('home', $data);
		} else {
			redirect("library/notAccess");
		}
	}

	public function updateUser()
	{
		$data['user_id']  = $this->input->post('user_id');
		$data['username']  = $this->input->post('username');
		$data['phone']  = $this->input->post('phone');
		$user_id = $data['user_id'];
		$username  = $data['username'];
		$phone  = $data['phone'];

		if (empty($username) && empty($phone)) {
			$sdata = array();
			$sdata['msg'] = '<span style="color:red">Field Must not be Empty !</span>';
			$this->session->set_flashdata($sdata);
			redirect("user/edituser/$user_id");
		} else {
			$this->user_model->updateUserData($data);
			$sdata = array();
			$sdata['msg'] = '<span style="color:green">Data Added Succesfully !</span>';
			$this->session->set_flashdata($sdata);
			redirect("user/edituser/$user_id");
		}
	}

	public function viewUser($name)
	{
		if ($this->session->userdata("role") === "user" || $this->session->userdata("role") === "admin") {
			$data['title'] = 'View User';
			$data['header'] = $this->load->view('inc/header', $data, TRUE);
			$data['sidebar'] = $this->load->view('inc/sidebar', '', TRUE);
			$data['user'] = $this->user_model->getUserByName($name);
			$data['issue'] = $this->user_model->getUserIssueByName($name);
			$data['content'] = $this->load->view('inc/viewUser', $data, TRUE);
			$data['footer'] = $this->load->view('inc/footer', '', TRUE);
			$this->load->view('home', $data);
		}
	}

	public function delUser($user_id)
	{
		if ($this->session->userdata("role") === "admin") {
			$this->user_model->delUserByid($user_id);
			$sdata = array();
			$sdata['msg'] = '<span style="color:green">Data Deleted Succesfully !</span>';
			$this->session->set_flashdata($sdata);
			//new
			redirect("user/userList");
			//new
		} else {
			redirect("library/notAccess");
		}
	}
}
