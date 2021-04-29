<?php
class Category_Model extends CI_Model
{
	public function saveCategory($data)
	{
		$this->db->insert('tbl_categories', $data);
	}

	public function getAllCategoryData()
	{
		$this->db->select('*');
		$this->db->from('tbl_categories');
		$this->db->order_by('cat_id', 'desc');
		$qresult = $this->db->get();
		$result  = $qresult->result();
		return $result;
	}

	public function getCategoryById($cat_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_categories');
		$this->db->where('cat_id', $cat_id);
		$qresult = $this->db->get();
		$result  = $qresult->row();
		return $result;
	}

	public function getCategoryByName($cat_name)
	{
		$this->db->select('*');
		$this->db->from('tbl_categories');
		$this->db->where('cat_name', $cat_name);
		$qresult = $this->db->get();
		$result  = $qresult->row();
		return $result;
	}

	public function getCategoryNameById($cat_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_categories');
		$this->db->where('cat_id', $cat_id);
		$result = $this->db->get()->row()->cat_name;
		return $result;
	}

	public function updateCategoryName($data)
	{
		$this->db->set('cat_name', $data['cat_name']);
		$this->db->where('cat_id', $data['cat_id']);
		$this->db->update('tbl_categories');
	}

	public function delCategoryById($cat_id)
	{
		$this->db->where('cat_id', $cat_id);
		$this->db->delete('tbl_categories');
	}
}
