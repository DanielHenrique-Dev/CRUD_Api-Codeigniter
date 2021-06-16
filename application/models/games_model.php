<?php

class Games_model extends CI_model
{
	public function index($limit, $start)
	{
		$this->db->order_by("name", "ASC");
		$this->db->limit($limit, $start);

		$query = $this->db->get("tb_games");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function dashboard_index()
	{
		return $this->db->get("tb_games")->result();
	}

	public function store($game)
	{
		$this->db->insert("tb_games", $game);

		return array('status' => 201, 'menssage' => 'Jogo adicionado com sucesso.');
	}

	public function show($id)
	{
		return $this->db->get_where("tb_games", array(
			"id" => $id
		))->row_array();
	}

	public function update($id, $game)
	{
		$this->db->where("id", $id);
		$this->db->update("tb_games", $game);
		return array('status' => 201, 'menssage' => 'Jogo atualizado com sucesso.');
	}

	public function destroy($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("tb_games");

		return array('status' => 201, 'menssage' => 'Jogo excluido com sucesso.');
	}

	public function mygames_index($limit, $start)
	{
		$this->db->where("user_id", $this->session->logged_user['id']);
		$this->db->order_by("name", "ASC");
		$this->db->limit($limit, $start);

		$query = $this->db->get("tb_games");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function get_total()
	{

		return $this->db->count_all("tb_games");
	}

	public function number_games_by_id()
	{
		$this->db->where("user_id", $this->session->logged_user['id']);
		return $this->db->get("tb_games")->num_rows();
	}

	public function number_games()
	{
		
		return $this->db->get("tb_games")->num_rows();
	}
}
