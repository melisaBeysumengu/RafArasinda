<?php

class authormodel extends CI_Model
{

    public function getAllData()
    {
        $query = $this->db->query("select * from author");
        return $query->result();
    }
    function insert($data)
    {
        $this->db->insert('review', $data);
    }

    public function getAuthorAndBooks($author_id){
        $this->db->select('*');
        $this->db->from('books');
        $this->db->join('author', 'books.author_ID=author.Author_ID');
        $this->db->where('author.Author_ID', $author_id);
        $q = $this->db->get();
        return $q->result();
    }

    public function getAuthor($book_id)
    {
        $this->db->select('*');
        $this->db->from('books');
        $this->db->join('author', 'books.author_ID=author.Author_ID');
        $this->db->join('review', 'books.book_id=review.fk_book_id');
        $this->db->join('users', 'users.user_id=review.fk_user_id');
        $this->db->join('genre', 'genre.genre_id=books.genre_id');
        $this->db->join('publisher', 'books.publisher_ID=publisher.publisher_ID');
        $this->db->where('books.book_id', $book_id);
        $this->db->where('review.fk_book_id', $book_id);
        $q = $this->db->get();
        if ($q->num_rows() < 1) {
            // echo $q->num_rows();
            $this->db->flush_cache();
            $this->db->select('*');
            $this->db->from('books');
            $this->db->join('author', 'books.author_ID=author.Author_ID');
            $this->db->join('genre', 'genre.genre_id=books.genre_id');
            $this->db->join('publisher', 'books.publisher_ID=publisher.publisher_ID');
            $this->db->where('books.book_id', $book_id);
            $a = $this->db->get();
            return $a->result();
        } else {
            //echo $q->num_rows();
            return $q->result();
        }



    }
}
