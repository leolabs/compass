<?php

/**
 * Class API_Controller
 */
abstract class API_Controller extends BaseController {
    protected $requireLogin = true;

    abstract function get($id, $data);
    abstract function post($id, $data);
    abstract function put($id, $data);
    abstract function delete($id, $data);

    public function _remap( $param ) {
        $request = $_SERVER['REQUEST_METHOD'];
        $data = json_decode(file_get_contents('php://input'), true);

        if($data == null) $data = $_POST;

        $id = $param;

        if($this->requireLogin){
            if(!$this->checkUser(false)){
                $this->apiOutput(false, 401, "User is not logged in.");
                return;
            }
        }

        switch( strtoupper( $request ) ) {
            case 'GET':
                $this->get($id, $data);
                break;
            case 'POST':
                $this->post($id, $data);
                break;
            case 'PUT':
                $this->put($id, $data);
                break;
            case 'DELETE':
                $this->delete($id, $data);
                break;
            case 'OPTIONS':
                $this->options();
                break;
        }
    }

    protected function apiOutput($success = true, $code, $message, $data = null){
        $status = array(
            'success' => $success,
            'code' => $code,
            'message' => $message
        );
        $this->formatOutput($data, $status);
    }

    protected function formatOutput( $output = null, $status = array("success" => true, "code" => 200, "message" => "OK.") ) {
        if(isset($_GET['debug'])){
            $output->status = $status;
        }

        $this->output->set_header( 'Access-Control-Allow-Origin: *' );
        $this->output->set_status_header($status['code'] , $status['message'] );
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
 * @property CustomerModel $customermodel
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
        $this->load->model("customermodel");

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