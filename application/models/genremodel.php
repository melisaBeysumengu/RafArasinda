<?php

class genremodel extends CI_Model{

   
    ////find books according to coming genre
    public function getgenre($bookgenre)
    {
        $this->db->select('*');
        $this->db->from('books');
        $this->db->join('author', 'books.author_ID=author.Author_ID');
        $this->db->join('genre', 'books.genre_id=genre.genre_id');
        $this->db->join('publisher', 'books.publisher_ID=publisher.publisher_ID');
        $this->db->where('books.genre_id', $bookgenre);
        $q = $this->db->get();
        return $q->result();
      
    }
}