<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Kesehatan_M extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	
	/*select * from table*/
	public function readS($table){
		$query = $this->db->get($table);
		return $query;
	}
	
	/*select from table where*/
	public function read($table,$dataCondition){
		$this->db->where($dataCondition);
		$query = $this->db->get($table);
		return $query;
	}

	/*select kolom1, kolom2 from table*/
	public function readSCol($table,$cols)
	{
		$this->db->select($cols);
		$query = $this->db->get($table);
		return $query;
	}

	/*select kolom1,kolom2 from table where*/
	public function readCol($table,$dataCondition,$cols)
	{
		$this->db->select($cols);
		$this->db->where($dataCondition);
		$query = $this->db->get($table);
		return $query;
	}

	/*
	* insert into table values
	* json_decode() @ controller untuk membuka return.
	*/
	public function create($table,$data){
		$query = $this->db->insert($table, $data);
		if (!$query) {
			return json_encode(array(
										'status' => false,
										'error_message' => $this->db->error()
			));
		}
		else{
			return json_encode(array(
										'status' => true,
										'error_message' =>""
			));
		}
	}

	/*
	* insert yang return id dari last inserted
	* gunakan json_decode()
	*/
	public function create_id($table,$data)
	{
		$query = $this->db->insert($table, $data);
		if (!$query) {
			return json_encode(array(
										'status' => false,
										'error_message' => $this->db->error()
			));
		}
		else{
			return json_encode(array(
										'status' => true,
										'message' => $this->db->insert_id()
			));
		}
	}

	/*
	* insert batch
	* gunakan json_decode()
	*/
	public function createS($table,$data){
		$query = $this->db->insert_batch($table,$data);
		if (!$query) {
			return json_encode(array(
										'status' => false,
										'error_message' => $this->db->error()
			));
		}
		else{
			return json_encode(array(
										'status' => true,
										'error_message' =>""
			));
		}
	}
	
	/*return boolean*/
	public function delete($table,$dataCondition){
		$this->db->where($dataCondition);
		$result = $this->db->delete($table);
		if (!$result) {
			$error = $this->db->error();
			return $error;
		}
		else{
			return $result;
		}
	}

	/*update from table values.... where ...*/
	public function update($table,$dataCondition,$dataUpdate){
		$this->db->where($dataCondition);
		$result = $this->db->update($table,$dataUpdate);
		if ($result) {
			return json_encode(array(
										"status"=>true,
										"error_message"=>""
			));
		}else{
			return json_encode(array(
										"status"=>false,
										"error_message"=>$this->db->error()
			));
		}
	}
	
	public function whereLike($table,$where,$like){
		$this->db->where($where);
		$this->db->like($like);
		$query = $this->db->get($table);
		return $query->result();
	}

	/*raw query. query as strings*/
	public function rawQuery($query){
		$result = $this->db->query($query);
		return $result;
	}

	public function truncateTable($tabel)
	{
		$this->db->query('TRUNCATE TABLE wm_kondisi');
	}	
}
?>