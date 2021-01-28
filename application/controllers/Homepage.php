<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Homepage extends CI_Controller
{

    ///searchbar
    public function fetch()
    {
        $this->load->helper('url');
        $this->load->model('bookmodel');
        echo $this->bookmodel->fetch_data($this->uri->segment(3));
    }
    ///main page
    public function showhome()
    {
       
        $this->load->helper('url');
        $this->load->view("signup");
    }
    //log in
    public function loggedin()
    {
       if(!empty($this->session->user_id))
       {
        $this->load->helper('url');
        $this->load->view("hpage");
       }
       else{
        $this->load->helper('url');
        $this->load->view("signup");
       }
      
    }
    //log out
    public function loggedout()
    {
        redirect("Register/logout");
        

    }
    ///show all books
    public function bookPage()
    {  
        $this->load->helper('url');
        $this->load->model("bookmodel");
        $data['books'] = $this->bookmodel->listall();
        $this->load->view("allbookpage",$data);
    }
    ///show browsepage
    public function browsePage()
    {
        $this->load->helper('url');
        $this->load->view("browsepage");
    }
    ///show authorpage
    public function authordata()
    {
        $this->load->helper('url');
        $this->load->model("authormodel");
        $data['author'] = $this->authormodel->getAuthorAndBooks($this->uri->segment(3));
        $this->load->view("authorpage", $data);

    }
    ///show only 1 selected book's page
    public function bookdata()
    {
        $this->load->helper('url');
        $this->load->model("authormodel");
        $data['books'] = $this->authormodel->getAuthor($this->uri->segment(3));
        $this->load->view("bookpage", $data);
    }
    //adding review to the bookpage
    function addReview()
    {
        $this->load->helper('url');
        $this->load->model("authormodel");
        if (isset($_POST['comment-button'])) {
            $book_id = $this->uri->segment(3);
            //$userRating = isset($_POST['userRating'])?$_POST['userRating']:0;
            $data['fk_user_id'] = $this->session->userdata('user_id');
            $data['review'] = $this->input->post('rev');
            $data['rate'] = intval($_POST['rate']);
            $data['fk_book_id'] = $book_id;
            $this->authormodel->insert($data);
        }
        //$data['books'] = $this->authormodel->getAuthor($this->uri->segment(3));
        redirect("Homepage/bookdata/" . $this->uri->segment(3));
    }
    //show genrepage
    public function genredata()
    {
        $this->load->helper('url');
        $this->load->model("genremodel");
        $data['genre'] = $this->genremodel->getgenre($this->uri->segment(3));
        $this->load->view("genrepage",$data);

    }
    
}
