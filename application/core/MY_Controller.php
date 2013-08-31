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
        if(isset($this->sessionData['ID'])){
            $this->userData = $this->usermodel->getSingleUserByID($this->sessionData["ID"]);
        }else{
            $this->userData = null;
        }

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
                $method = 'get';
                break;
            case 'POST':
                $method = 'post';
                break;
            case 'PUT':
                $method = 'put';
                break;
            case 'DELETE':
                $method = 'delete';
                break;
            case 'OPTIONS':
                $method = 'options';
                break;
        }

        if(method_exists($this, $method)){
            $this->$method( $id );
        }else{
            $output = new stdClass();
            $output->status = 'error';
            $output->desc = 'The requested method "' . $method . '" is not available in this namespace.';
            $output->num = 409;

            $this->formatOutput($output);
        }
    }

    protected function formatOutput( $output = null ) {
        $this->output->set_header( 'Access-Control-Allow-Origin: *' );

        if( isset( $output->status ) && $output->status == 'error' ) {
            $this->output->set_status_header( $output->num, $output->desc );
        }

        $this->parseData( $output );

        $this->output->set_content_type( 'application/json' );
        $this->output->set_output( json_encode( $output ) );
    }


    private function options() {
        $this->output->set_header( 'Access-Control-Allow-Origin: *' );
        $this->output->set_header( "Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS" );
        $this->output->set_header( 'Access-Control-Allow-Headers: content-type' );
        $this->output->set_content_type( 'application/json' );
        $this->output->set_output( "*" );
    }

    protected function checkLogin($mail, $password, $createSession = true){
        $checkData = $this->usermodel->tryLogin($mail, $password);

        if($checkData[0] == true){
            if($createSession) $this->session->set_userdata("UserID", $checkData[1][0]);
            return true;
        }else{
            return false;
        }
    }

    protected function checkUser($redirect){
        if($this->userData == null){
            if($redirect) redirect("login");
            return false;
        }else{
            return true;
        }
    }
}