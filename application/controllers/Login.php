<?php 
defined('BASEPATH') OR exit('Acesso não permitido');

class Login extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('login_model');
    }

    public function userLogin()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'POST'){

            json_output(400, array('status' => 400, 'message' => 'Bad request'));
        } else {
            
            $params = json_decode(file_get_contents('php://input'), TRUE);;
            
            $email = $params['email'];
            $password = $params['password'];

            $response = $this->login_model->login($email, $password);
            json_output($response['status'], $response);
        }
    }

    public function userLogout()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'POST'){

            json_output(400, array('status' => 400, 'message' => 'Bad request'));
        } else {
            
            $response = $this->login_model->logout();
            json_output($response['status'], $response);
        }
    }
}