<?php

class Session extends API_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->requireLogin = false;
    }

    public function delete($id, $data){
        $this->session->sess_destroy(false);

        if($this->checkUser(false)){
            $this->apiOutput(true, 200, "User is now logged out.");
        }else{
            $this->apiOutput(false, 409, "User wasn't logged in.");
        }
    }

    public function post($id, $data){
        $mail = $this->input->post("mail");
        $pass = $this->input->post("password");

        if($this->checkLogin($mail, $pass, true)){
            $this->apiOutput(true, 200, 'The user is now logged in.', $this->session->userdata('session_id'));
        }else{
            $this->apiOutput(false, 401, 'The user\'s login data is not correct.');
        }

    }

    function get($id, $data)
    {
        // TODO: Implement get() method.
    }

    function put($id, $data)
    {
        // TODO: Implement put() method.
    }
}