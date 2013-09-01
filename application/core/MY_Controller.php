<?php

/**
 * Class API_Controller
 *
 */
class API_Controller extends BaseController {
    public function _remap( $param ) {
        $request = $_SERVER['REQUEST_METHOD'];

        $id = $param;

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
            $this->apiOutput(false, 409, 'The requested method "' . $method . '" is not available in this namespace.');
        }
    }

    protected function apiOutput($success = true, $code, $message, $data = null){
        $output = new stdClass();

        $output->status = array(
            'success' => $success,
            'code' => $code,
            'message' => $message
        );
        $output->data = $data;

        $this->formatOutput($output);
    }

    protected function formatOutput( $output = null ) {
        $this->output->set_header( 'Access-Control-Allow-Origin: *' );
        $this->output->set_status_header($output->status['code'] , $output->status['message'] );
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
}

/**
 * Class BaseController
 *
 * @property UserModel $usermodel
 * @property EntryModel $entrymodel
 * @property CategoryModel $categorymodel
 */
class BaseController extends CI_Controller {
    protected $userData;
    protected $sessionData;

    public function __construct()
    {
        parent::__construct();

        $this->load->model("usermodel");
        $this->load->model("entrymodel");
        $this->load->model("categorymodel");

        $this->sessionData = $this->session->all_userdata();
        if(isset($this->sessionData['UserID'])){
            $this->userData = $this->usermodel->getSingleUserByID($this->sessionData["UserID"]);
        }else{
            $this->userData = null;
        }

    }

    protected function checkLogin($mail, $password, $createSession = true){
        $checkData = $this->usermodel->tryLogin($mail, $password);

        if($checkData[0] == true){
            if($createSession) $this->session->set_userdata("UserID", $checkData[1]["ID"]);
            return true;
        }else{
            return false;
        }
    }

    protected function destroyLogin($redirect = true){
        $this->session->sess_destroy();
        if($redirect) redirect('login');
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