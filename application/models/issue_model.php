<?php
class Issue_Model extends CI_Model
{
	public function getBookByCategory($cat_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_books');
		$this->db->where('cat_id', $cat_id);
		$qresult = $this->db->get();
		$result  = $qresult->result();
		return $result;
	}

	public function saveIssueData($data)
	{
		$this->db->insert('tbl_issues', $data);
	}

	public function getRequestIssueData()
	{
		$this->db->select('*');
		$this->db->from('tbl_issues');
		$this->db->where('isIssued', 0);
		$this->db->order_by('issue_id', 'desc');
		$qresult = $this->db->get();
		$result  = $qresult->result();
		return $result;
	}

	public function postRequestIssueData($id)
	{
		$this->db->set('isIssued', 1);
		$this->db->where('issue_id', $id);
		$this->db->update('tbl_issues');
	}

	public function getAllIssueData()
	{
		$this->db->select('*');
		$this->db->from('tbl_issues');
		$this->db->where('isIssued', 1);
		$this->db->order_by('issue_id', 'desc');
		$qresult = $this->db->get();
		$result  = $qresult->result();
		return $result;
	}

	public function getAllIssueDataByUser($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_issues');
		$this->db->where('user_id', $user_id);
		$qresult = $this->db->get();
		$result  = $qresult->result();
		return $result;
	}

	public function delListByid($id)
	{
		$this->db->where('issue_id', $id);
		$this->db->delete('tbl_issues');
	}
}
