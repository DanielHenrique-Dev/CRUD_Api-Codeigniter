<?php

	class Users_model extends CI_model
	{
		public function index($limit, $start)
		{
			$this->db->order_by("name", "ASC");
			$this->db->limit($limit, $start);

			$query = $this->db->get("tb_users");

			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
			return false;
		}

		public function index_usuarios($id)
		{
			$this->db->where('id', $id);
			return $this->db->get('tb_users')->result_array();
		}

		public function dashboard_index()
		{
				   $this->db->limit(5);	
				   $this->db->order_by('id', 'desc');
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

		public function get_total()
		{
			return $this->db->count_all("tb_games");
		}

		
	}
