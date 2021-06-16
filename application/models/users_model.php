<?php

	class Users_model extends CI_model
	{

		public function dashboard_index()
		{
			return $this->db->get("tb_users")->result_array();
		}

		public function store($user)
		{
			$this->db->insert("tb_users", $user);

			return array('status' => 201, 'menssage' => 'Usuário adicionado com sucesso.');
		}

		public function show($id)
		{
			return $this->db->get_where("tb_users", array(
				"id" => $id
			))->row_array();
		}

		public function update_user($id, $user)
		{
			$this->db->where("id", $id);
			$this->db->update("tb_users", $user);

			return array('status' => 201, 'menssage' => 'Usuário atualizado com sucesso.');
		}

		public function destroy($id)
		{
			$this->db->where("id", $id);
			$this->db->delete("tb_users");

			return array('status' => 201, 'menssage' => 'Usuário excluido com sucesso.');
		}

		
	}
