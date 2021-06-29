<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

 class category extends CI_Controller
 {
    public function __construct()
    {
        parent::__construct();

        $this->load->model('category_model');
        $this->load->model('login_model');
    }

    public function indexCategory($limit, $start)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'GET') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $response['status'] = 200;
            $resp = $this->category_model->index($limit, $start);
            json_output($response['status'], $resp);
        }
    }

    public function getByIdCategory($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'GET' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE) {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $response['status'] = 200;
            $resp = $this->category_model->show($id);
            json_output($response['status'], $resp);
        }
    }

    public function getTotalRows()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'GET') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $response['status'] = 200;
            $resp = $this->category_model->get_total();
            json_output($response['status'], $resp);
        }
    }

    public function checkCategory($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'GET' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
            json_outout(400, array('status' => 400, 'message' => 'Bad Request.'));
        } else { 
            
            $response['status'] = 200;
            $resp = $this->category_model->check_category($id);
            json_output($response['status'], $resp);
        }
    }

    public function listArray()
    {
    	$method = $_SERVER['REQUEST_METHOD'];

    	if($method != 'GET'){
    		json_output(400, array('status' => 400, 'message' => 'Bad request.'));
    	} else {

    		$response['status'] = 200;
    		$resp = $this->category_model->insertCategory();
    		json_output($response['status'], $resp);
    	}
    }

    public function insertCategory()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad Request.'));
        } else {

            $params = json_decode(file_get_contents('php://input'), TRUE);

            $response['status'] = 200;
            $r = $this->category_model->store($params);
            json_output($response['status'], $r);
        }
    }

    public function updateCategory($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'PUT' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE) {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $params = json_decode(file_get_contents('php://input'), TRUE);
            
            $response['status'] = 200;
            $resp = $this->category_model->update($id, $params);
            json_output($response['status'], $resp);
        }
    }

    public function deleteCategory($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'DELETE') {
            json_output(400, array('status' => 400, 'message' => 'Bad Request.'));
        } else {

            $response['status'] = 200;
            $resp = $this->category_model->delete($id);
            json_output($response['status'], $resp);
        }
    }

}
