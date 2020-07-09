<?php
class Admin
{
	private $_db,
		$_data,
		$_sessionName,
		$_cookieName,
		$_isLoggedIn;

	public function __construct()
	{
		$this->_db = DB::getInstance();
	}

	public function update($table, $point, $fields = array(), $id)
	{

		if (!$this->_db->update($table, $point, $fields, $id)) {
			throw new Exception('There was a Problem Updating your Data!.');
		}
	}

	public function create($table, $fields = array())
	{
		if (!$this->_db->insert($table, $fields)) {
			throw new Exception('There was a problem creating an account!.');
		}
	}

	public function find($user = null, $table, $fieldName)
	{
		if ($user) {
			$field =  $fieldName;
			$data = $this->_db->get($table, array($field, '=', $user));

			if ($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}

	public function login($username = null, $password = null, $remember = false, $table, $fieldName)
	{

		if (!$username && !$password && $this->exists()) {
			Session::put($this->_sessionName, $this->data()->id);
		} else {

			$user = $this->find($username, $table, $fieldName);

			if ($user) {

				$passwordCovert = str_replace("$2b$", "$2y$", $this->data()->password);
				$value = password_verify($password, $passwordCovert);
				if ($value === true) {

					$_SESSION['user_details'] = $this->data();

					return true;
				}
			}
		}

		return false;
	}

	public function hasPermission($key)
	{
		$group = $this->_db->get('groups', array('id', '=', $this->data()->groups));
		if ($group->count()) {
			$permissions = json_decode($group->first()->permission, true);
			if ($permissions[$key] == true) {
				return true;
			}
		}
		return false;
	}

	public function exists()
	{
		return (!empty($this->_data)) ? true : false;
	}

	public function logout()
	{
		Session::delete($this->_sessionName);
		if (isset($this->_cookieName)) {
			Cookie::delete($this->_cookieName);
		}
	}

	public function delete($table, $where, $point)
	{
		$this->_db->delete($table, array($where, '=', $point));
	}

	public function deactiveAccount($table, $where, $point)
	{
		$this->_db->delete($table, array($where, '=', $point));
		Session::delete($this->_sessionName);
		if (isset($this->_cookieName)) {
			Cookie::delete($this->_cookieName);
		}
	}

	public function data()
	{
		return $this->_data;
	}

	public function isLoggedIn()
	{
		return $this->_isLoggedIn;
	}
}
