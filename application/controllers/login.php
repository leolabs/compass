<?php

class Login extends API_Controller {
    public function get($id){
        $this->load->view('login');
    }

    public function post($id){
        $mail = $this->input->post("mail");
        $pass = $this->input->post("password");

        if($this->checkLogin($mail, $pass, true)){
            if($id == "form"){
                redirect('app');
            }else{
                $output = new stdClass();
                $output->status = 'success';
                $output->desc = 'The user is now logged in.';
                $output->num = 200;
            }
        }else{
            if($id == "form"){
                $this->load->view('login', array("Status" => "TryAgain"));
            }else{
                $output = new stdClass();
                $output->status = 'success';
                $output->desc = 'The user is now logged in.';
                $output->num = 200;
            }
        }

    }
}