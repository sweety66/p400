<?php
class Book_Model extends CI_Model
{
	public function saveBook($data)
	{
		$this->db->insert('tbl_books', $data);
	}
	public function getAllBookData()
	{
		$this->db->select('*');
		$this->db->from('tbl_books');
		$this->db->order_by('book_id', 'desc');
		$qresult = $this->db->get();
		$result  = $qresult->result();
		return $result;
	}

	public function getAllBookByCategory($cat_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_books');
		$this->db->where('cat_id', $cat_id);
		$this->db->order_by('book_id', 'desc');
		$qresult = $this->db->get();
		$result  = $qresult->result();
		return $result;
	}

	public function bookById($book_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_books');
		$this->db->where('book_id', $book_id);
		$qresult = $this->db->get();
		$result  = $qresult->row();
		return $result;
	}

	public function bookStockUpdate($book_id)
	{
		$book = $this->bookById($book_id);
		$stock = $book->stock - 1;
		$this->db->set('stock', $stock);
		$this->db->where('book_id', $book_id);
		$this->db->update('tbl_books');

		return $stock;
	}

	public function updateBook($data)
	{
		$this->db->set('book_id', $data['book_id']);
		$this->db->set('book_name', $data['book_name']);
		$this->db->set('cat_id', $data['cat_id']);
		$this->db->set('author', $data['author']);
		$this->db->set('stock', $data['stock']);
		$this->db->where('book_id', $data['book_id']);
		$this->db->update('tbl_books');
	}

	public function delBookByid($bookid)
	{
		$this->db->where('book_id', $bookid);
		$this->db->delete('tbl_books');
	}
}
