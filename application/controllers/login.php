<?php

class Login extends API_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->requireLogin = false;
    }

    public function get($id, $data){
        if($id == 'logout'){
            $this->destroyLogin(true);
        }else{
            $this->load->view('login');
        }
    }

    public function post($id, $data){
        $mail = $this->input->post("mail");
        $pass = $this->input->post("password");

        if($this->checkLogin($mail, $pass, true)){
            redirect('');
        }else{
            $this->load->view('login', array("status" => "TryAgain"));
        }

    }

    function put($id, $data)
    {
        // TODO: Implement put() method.
    }

    function delete($id, $data)
    {
        // TODO: Implement delete() method.
    }
}