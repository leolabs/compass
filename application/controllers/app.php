<?php

class App extends BaseController {
    public function index()
    {
        if($this->checkUser(false)){
            $data = array(
                "userData" => $this->userData,
                "customer" => $this->customermodel->getCustomerByID($this->userData['CustomerID'])
            );

            $this->load->view('app', $data);
        }else{
            redirect("login");
        }
    }
}