<?php

class bookmodel extends CI_Model
{

   ///this query is for searchbar
    public function fetch_data($query)
    {
        $this->db->like('title', $query);
        $query = $this->db->get('books');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $output[] = array(
                    'id' => $row["book_id"],
                    'g_id' => $row["genre_id"],
                    'url' => $row["url"],
                    'name'  => $row["title"],
                    'a_id' => $row["author_ID"],
                    'img'  => $row["img"],
                    'date' => $row["publishedDate"],
                    'p_id' => $row["publisher_ID"],
                    'ratingVal' => $row["ratingVal"],
                    'ratingCount' => $row["ratingcount"]
                );
            }
            echo json_encode($output);
        }
    }

    ///listing all books joinin w/ author
    public function listall()
    {
        $this->db->select('*');
        $this->db->from('books');
        $this->db->join('author', 'books.author_ID=author.Author_ID');

        $q = $this->db->get();
        return $q->result();
        

    }

   


}
