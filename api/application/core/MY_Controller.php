<?php

/**
 * Class API_Controller
 *
 * @property UserModel $usermodel
 * @property EntryModel $entrymodel
 * @property CategoryModel $categorymodel
 *
 */
class API_Controller extends CI_Controller {
    protected $userData;
    protected $sessionData;

    public function __construct()
    {
        parent::__construct();

        $this->load->model("usermodel");
        $this->load->model("entrymodel");
        $this->load->model("categorymodel");

        $this->sessionData = $this->session->all_userdata();
        $this->userData = $this->usermodel->getSingleUserByID($this->sessionData["ID"]);
    }

    public function _remap( $param ) {
        $request = $_SERVER['REQUEST_METHOD'];

        if ( preg_match( "/^(?=.*[a-zA-Z])(?=.*[0-9])/", $param ) ) {
            $id = $param;
        } else {
            $id = null;
        }

        switch( strtoupper( $request ) ) {
            case 'GET':
                $method = 'read';
                break;
            case 'POST':
                $method = 'save';
                break;
            case 'PUT':
                $method = 'update';
                break;
            case 'DELETE':
                $method = 'remove';
                break;
            case 'OPTIONS':
                $method = 'options';
                break;
        }

        $this->$method( $id );
    }

    private function options() {
        $this->output->set_header( 'Access-Control-Allow-Origin: *' );
        $this->output->set_header( "Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS" );
        $this->output->set_header( 'Access-Control-Allow-Headers: content-type' );
        $this->output->set_content_type( 'application/json' );
        $this->output->set_output( "*" );
    }

    protected function checkLogin($mail, $password){
        $checkData = $this->usermodel->tryLogin($mail, $password);

        if($checkData[0] == true){
            $this->session->set_userdata("UserID", $checkData[1][0]);
            return true;
        }else{
            return false;
        }
    }
}