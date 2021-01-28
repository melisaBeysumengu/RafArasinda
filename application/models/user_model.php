<?php

class user_model extends CI_Model
{


    public function getAllData($username)
    {
        // $query=$this->db->get('users');
        $query = $this->db->get_where('users', array('user_uid' => $username));
        //$query= $this->db->query("select * from users");
        return $query->result();
    }
    public function insertuser($data)
    {

        $this->db->insert('users', $data);
        //$query= "INSERT INTO users(user_first,user_last,user_email,user_uid,user_pwd) values(?,?,?,?,?)";
        //$this->db->query($query,array($data['user_first'],$data['user_last'],$data['user_email'],$data['user_uid'],$data['user_pwd']));
        //return $query->result();
    }

    public function login($username, $password)
    {

        //$sql = "SELECT user_uid FROM users WHERE user_uid = ?";

        $this->db->where('user_uid', $username);
        $this->db->where('user_pwd', $password);
        $row = $this->db->get('users');
        if ($row->num_rows() > 0) //tthat means if there is a user named like input
        {
            return 1;
        } else {
            return 0;
        }
    }
    public function getuser($user)
    {
        $this->db->where('user_uid', $user);
        $row = $this->db->get('users');
        return $row->row();
    }
    public function deleteuser($user)
    {
        $this->db->where('user_uid', $user);
        $row = $this->db->get('users');
        if ($row->num_rows() > 0) {
            $this->db->where('user_uid', $user);
            $this->db->delete('users');
        }
    }
    public function control_pwd($username, $password)
    {
        $this->db->where('user_uid', $username);
        $this->db->where('user_pwd', $password);
        $row = $this->db->get('users');
        if ($row->num_rows() > 0) {

            return 1;
        } else {

            return 0;
        }
    }

    public function updatePassword($user_pwd, $user)
    {
        $data = array('user_pwd' => $user_pwd);

        return  $this->db->where('user_uid', $user)->update('users', $data);
    }
    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email, $username)
    {

        // $this->db->query('SELECT * FROM users WHERE user_email = ?');
        $this->db->where('user_email', $email);
        $this->db->or_where('user_uid', $username);
        $row = $this->db->get('users');


        //Check if email and user is already registered
        if ($row->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findUser($userName)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_uid', $userName);
        $q = $this->db->get();
        return $q->result();
    }
}
