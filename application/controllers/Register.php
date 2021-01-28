<?php

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
    public function getall()
    {

        $data['user_uid'] = $this->input->post('name');

        $this->load->model("user_model", "use");
        $result = $this->use->login($data['user_uid']);
    }

    public function signup()
    {
        $data['user_first'] = $this->input->post('first');
        $data['user_last'] = $this->input->post('last');
        $data['user_uid'] = $this->input->post('uid');
        $data['user_email'] = $this->input->post('email');
        $data['user_pwd'] = $this->input->post('pwd');

        $result = $this->user_model->findUserByEmail($data['user_email'], $data['user_uid']);
        if ($result == true) //önceden kayıtlıysa email ile
        {
            $err['alreadyregistered'] = "you have an account! Please login.";
            $this->load->view('signup', $err);
        } else {
            $this->user_model->insertuser($data);
            $this->load->view('signup');
        }
    }
    

    public function logincontrol()
    {
        if (isset($_POST['login'])) {
            $form1 = $this->form_validation->set_rules('name', 'username', 'required');
            $form2 = $this->form_validation->set_rules('password', 'password', 'required');
            $username = $this->input->post('name');
            $password = $this->input->post('password');
            if (empty($username) && !empty($password)) {
                $data['usernameError'] = 'Please enter a username.';
                $this->load->view("signup", $data);
            }
            //Validate password
            if (empty($password) && !empty($username)) {
                $data['passwordError'] = 'Please enter a password.';
                $this->load->view("signup", $data);
            }
            if ($form1->run() == TRUE & $form2->run() == TRUE) {

                $result = $this->user_model->login($username, $password);
                if ($result == 1) {

                    $data = $this->user_model->findUser($username);
                    $sessionData = array();
                    foreach ($data as $d) {
                        $sessionData = array(
                            'name' => ($d->user_first),
                            'l_name' => ($d->user_last),
                            'nick' => ($d->user_uid),
                            'user_id' => ($d->user_id)
                        );
                    }
                    // $this->createUserSession($username);
                    $this->session->set_userdata($sessionData);
                    redirect('Homepage/loggedin');
                } else {
                    $data['loginfailed'] = "enter valid username or password !";
                    $this->load->view("signup", $data);
                }
            } else {
                $data['validation_error'] = "fill all the fields.";
                $this->load->view('signup', $data);
            }
        }
    }


    public function logout()
    {
        session_destroy();
        redirect('Homepage/showhome');
    }

    public function delete()
    {
        $user = $this->session->userdata('nick');
        $this->user_model->deleteuser($user);
        redirect('Register/logout');
    }

    public function changePassword()
    {
        $data['curr_pwd'] = $this->input->post('curr_pwd');
        $data['user_pwd'] = $this->input->post('new_pwd');
        $data['confirm_pwd'] = $this->input->post('conf_pwd');
        $user = $this->session->userdata('nick');
        $flag = $this->user_model->control_pwd($user, $data['curr_pwd']);

        if ($flag == 1 && ($data['user_pwd'] == $data['confirm_pwd'])) {

            $this->user_model->updatePassword($data['user_pwd'], $user);
            redirect('Register/myprofile');
        }
        else{
            $res['passwordError']='Please enter valid password.';
            $this->load->helper('url');
            $this->load->view("changepassword",$res);
        }
    }
    public function changepwd()
    {
        $this->load->helper('url');
        $this->load->view("changepassword");
    }

    public function myprofile()
    {
        $user = $this->session->userdata('nick');
        $row['user'] = $this->user_model->getuser($user);


        if (!empty($this->session->nick)) {
            $this->load->helper('url');
            $this->load->view("myprofile", $row);
        } else {
            $this->load->helper('url');
            $this->load->view("signup");
        }
    }
}