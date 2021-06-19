<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

 class Games extends CI_Controller
 {
    public function __construct()
    {
        parent::__construct();

        $this->load->model('games_model');
        $this->load->model('login_model');
    }

    public function index()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'GET'){
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $response['status'] = 200;
            $resp = $this->games_model->dashboard_index();
            json_output($response['status'], $resp);
        }

    }

    public function game($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'GET' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE ){
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $check_token = $this->login_model->aut();
            $response['status'] = 200;
            $resp = $this->games_model->show($id);
            json_output($response['status'], $resp);
        }

    }

    public function insertGame()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'POST'){

            json_output(400,array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $params = json_decode(file_get_contents('php://input'), TRUE);
            
            $response['status'] = 200;
            $resp = $this->games_model->store($params);
            
            json_output($response['status'], $resp);

        }
    }

    public function updateGame($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'PUT'){

            json_output(400,array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $params = json_decode(file_get_contents('php://input'), TRUE);
            
            $response['status'] = 200;
            $resp = $this->games_model->update($id, $params);
            
            json_output($response['status'], $resp);

        }
    }

    public function deleteGame($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'DELETE' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){

            json_output(400,array('status' => 400, 'message' => 'Bad request.'));
        } else {


            $response['status'] = 200;
            $resp = $this->games_model->destroy($id);
            
            json_output($response['status'], $resp);

        }
    }
 }
