<?php

class Login_model extends CI_Model
{
	public function login($email_user, $password)
	{ 
		$user = $this->db->query('SELECT * FROM `tb_users` WHERE email = ? AND password = ?', array($email_user, $password))
						 ->row(0);		
		
		if($user == " "){

			return array('status' => 204, 'message' => 'Username not found');
		} else {

			$senha = $user->password;
			$email = $user->email;
			$user_id = $user->id;
			$ativo = $user->ativo;
			$nivel = $user->nivel;

			$last_login = date('Y-m-d H:i:s');
			$token = substr( md5(rand()), 0, 7);
			$expired_at = date('Y-m-d H:i:s', strtotime('+12 hours'));
			$this->db->trans_start();
			$this->db->where('email',$email)->update('tb_users',array('last_login' => $last_login));
			$this->db->insert('tb_token', array('user_id' => $user_id, 'token' => $token, 'dt_expired' => $expired_at));

			if($this->db->trans_status() == FALSE){
				$this->db->trans_rollback();
				return array('status' => 500, 'message' => 'Internal server error.');
			} else {

				$this->db->trans_commit();
				return array('status' => 200, 'message' => 'Sucesso no login.', 'email' => $email, 'token' => $token, 'user_id' => $user_id, 'ativo' => $ativo, 'nivel' => $nivel);
			}
		}
	}

	public function logout()
	{
		$user_id = $this->input->get_request_header('user_id', TRUE);
		$token = $this->input->get_request_header('token', TRUE);
		$this->db->where('user_id', $user_id)->delete('tb_token');
		return array('status' => 200, 'message' => 'Sucesso ao deslogar.');
	}

	public function aut()
	{
		$user_id = $this->input->get_request_header('user_id', TRUE);
		$token = $this->input->get_request_header('token', TRUE);

		$aut = $this->db->select('dt_expired')->from('tb_token')->where('user_id',$user_id)->where('token', $token)->get()->row();

		if($aut == ""){
			return json_output(401,array('status' => 400, 'message' => 'Sua sessão foi expirada!'));
		} else {

			$dt_att = date('Y-m-d H:i:s');
			$dt_expired = date('Y-m-d H:i:s', strtotime('+12 hours'));
			$this->db->where('user_id',$user_id)->where('token',$token)->update('tb_token', array('dt_expired' => $dt_expired, 'dt_att' => $dt_att));
			return array('status' => 200,'message' => 'Altorizado!');
		}
	}
	
}
