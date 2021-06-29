<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

 class Users extends CI_Controller
 {
    public function __construct()
    {
        parent::__construct();

        $this->load->model('users_model');
    }

    public function index()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'GET'){
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $response['status'] = 200;
            $resp = $this->users_model->dashboard_index();
            json_output($response['status'], $resp);
        }

    }

    public function usersDashboard($limit, $start)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'GET') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $response['status'] = 200;
            $resp = $this->users_model->index($limit, $start);
            json_output($response['status'], $resp);
        }
    }

    public function usersTotalRows()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'GET') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $response['status'] = 200;
            $resp = $this->users_model->get_total();
            json_output($response['status'], $resp);
        }
    }

    public function user($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'GET' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $response['status'] = 200;
            $resp = $this->users_model->show($id);
            json_output($response['status'], $resp);
        }

    }

    public function insertUser()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'POST'){

            json_output(400,array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $params = json_decode(file_get_contents('php://input'), TRUE);
            
            $response['status'] = 200;
            $resp = $this->users_model->store($params);
            
            json_output($response['status'], $resp);

        }
    }

    public function updateUser($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'PUT' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){

            json_output(400,array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $params = json_decode(file_get_contents('php://input'), TRUE);
            
            $response['status'] = 200;
            $resp = $this->users_model->update_user($id, $params);
            
            json_output($response['status'], $resp);

        }
    }

    public function deleteUser($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'DELETE' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){

            json_output(400,array('status' => 400, 'message' => 'Bad request.'));
        } else {


            $response['status'] = 200;
            $resp = $this->users_model->destroy($id);
            
            json_output($response['status'], $resp);

        }
    }
 }