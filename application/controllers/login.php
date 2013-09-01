<?php

class Login extends API_Controller {
    public function get($id){
        if($id == 'logout'){
            $this->destroyLogin(true);
        }else{
            $this->load->view('login');
        }
    }

    public function post($id){
        $mail = $this->input->post("mail");
        $pass = $this->input->post("password");

        if($this->checkLogin($mail, $pass, true)){
            redirect('');
        }else{
            $this->load->view('login', array("status" => "TryAgain"));
        }

    }
}