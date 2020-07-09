<?php
class DB {
	private static $_instance = null;
	private $_pdo,
			$_query,
			$_error = false,
			$_results,
			$_count = 0;

	private function __construct() {
		try {
			$this->_pdo = new PDO('mysql:host='. Config::get('mysql/host').';dbname='.Config::get('mysql/db').';port='.config::get('mysql/port'),Config::get('mysql/username'),Config::get('mysql/password'));
		} catch (PDOException $e) {
			echo ($e->getMessage());
		}
	}

	public static function getInstance() {
		if(!isset(self::$_instance)) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}

	public function query($sql, $params = array()){
		$this->_error = false;
		if($this->_query = $this->_pdo->prepare($sql)){
			if(count($params)){
				$x=1;
				foreach($params as $param){
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
			if($this->_query->execute()){
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = true;
			}
		}
		return $this;
	}

	public function action($action, $table, $where = array()){
		if(count($where) == 3 ){
			$operators = array('=', '>', '<', '>=', '<=');

			$field 		= $where[0];
			$operator 	= $where[1];
			$value 		= $where[2];

			if(in_array($operator, $operators))	{
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? ";

				if(!$this->query($sql, array($value))->error()){
					return $this;
				}
			}	
		}
		return false;
	}
	
	public function get($table, $where){
		return $this->action("SELECT *", $table, $where);
	}

	public function insert($table, $fields = array()){
			$keys = array_keys($fields);
			$values = '';
			$x = 1;

			foreach($fields as $field){
				$values .= '?';
				if($x < count($fields)){
					$values .= ', ';
				}
				$x++;
			}

			$sql = "INSERT INTO {$table} (`". implode('` , `', $keys) ."`) VALUES ({$values})";

			if (!$this->query($sql, $fields)->error()) {
				return true;
			}
		
		return false;
	}

	public function answer($data, $id){
		$ans=implode("",$data);
		$right=0;
		$wrong=0;
		$no_answer=0;
		// $sql = $this->_pdo->query("SELECT `id`,`q_ans` FROM `question` WHERE `course_id`={$id}");
		$sql=$this->_pdo->query("SELECT `id`,`q_ans` FROM `questions` WHERE `course_id`={$id}");
		$result = $sql->fetchAll(PDO::FETCH_ASSOC);
		// print_r($result);
		foreach($result as $results){
			if($results['q_ans']==$_POST[$results['id']]){
				$right++;
			}elseif($_POST== "no_attempt"){
				$no_answer++;
			}else{
				$wrong++;
			}
		}
		$array=array();
		$array['right']=$right;
		$array['wrong'] = $wrong;
		$array['no_answer'] = $no_answer;
		return $array;
	}

	// public function update($table, $point, $fields, $id){
	// 	$set = '';
	// 	$x = 1;

	// 	foreach($fields as $name => $value){
	// 		$set .= "{$name} = ?";
	// 		if($x < count($fields)) {
	// 			$set .= ', ';
	// 		}
	// 		$x++;
	// 	}
	// 	$sql = "UPDATE {$table} SET {$set} WHERE {$point} = {$id}";

	// 	if(!$this->query($sql, $fields)->error()){
	// 		return true;
	// 	}
	// }

	public function update($table, $where, $id, $fields){
		$set = '';
		$x = 1;

		foreach($fields as $name => $value){
			$set .= "{$name} = ?";
			if($x < count($fields)) {
				$set .= ', ';
			}
			$x++;
		}
		$sql = "UPDATE {$table} SET {$set} WHERE {$where} = {$id}";

		if(!$this->query($sql, $fields)->error()){
			return true;
		}
	}


	public function delete($table, $where){
		return $this->action("DELETE", $table, $where);
	}

	public function result(){
		return $this->_results;
	}

	public function error(){
		return $this->_error;
	}

	public function count(){
		return $this->_count;
	}

	public function first() {
        return $this->result()[0];
    }
	
}