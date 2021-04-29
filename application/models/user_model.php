<?php
class User_Model extends CI_Model
{

	public function saveUser($data)
	{
		$this->db->insert('tbl_users', $data);
	}

	public function getAllUserData()
	{
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->order_by('user_id', 'desc');
		$qresult = $this->db->get();
		$result  = $qresult->result();
		return $result;
	}

	public function getUserById($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where('user_id', $user_id);
		$qresult = $this->db->get();
		$result  = $qresult->row();
		return $result;
	}

	public function getUserByName($name)
	{
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where('username', $name);
		$qresult = $this->db->get();
		$result  = $qresult->row();
		return $result;
	}

	public function getUserIssueById($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_issues');
		$this->db->where('user_id', $id);
		$qresult = $this->db->get();
		$result  = $qresult->result();
		return $result;
	}

	public function getUserIssueByName($name)
	{
		$this->db->select('*');
		$this->db->from('tbl_issues');
		$this->db->where('username', $name);
		$qresult = $this->db->get();
		$result  = $qresult->result();
		return $result;
	}

	//new
	public function updateUserData($data)
	{
		$this->db->set('phone', $data['phone']);
		$this->db->set('username', $data['username']);
		$this->db->where('user_id', $data['user_id']);
		$this->db->update('tbl_users');
	}
	//new

	public function delUserByid($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete('tbl_users');
	}

	public function checkUser($data)
	{
		$username = $data["username"];
		$password = md5($data["password"]);

		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$check = $this->db->get();
		return $check;
	}
}
