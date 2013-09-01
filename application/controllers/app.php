<?php

class App extends BaseController {
    public function index()
    {
        if($this->checkUser(false)){
            $data = array(
                "userData" => $this->userData
            );

            $this->load->view('app', $data);
        }else{
            redirect("login");
        }
    }
}