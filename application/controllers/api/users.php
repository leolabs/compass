<?php

class User extends API_Controller {
    public function post($param)
    {
        $customerID = $this->input->post("customerID");
        $mail = $this->input->post("mail");
        $pass = $this->input->post("password");
        $nameFirst = $this->input->post("nameFirst");
        $nameLast = $this->input->post("nameLast");
        $level = $this->input->post("level");

        if($this->checkUser(false) && $this->userData['Level'] >= 2){
            $output = $this->usermodel->addUser($customerID, $pass, $mail, $nameFirst, $nameLast, $level);
        }else{

        }
    }
}