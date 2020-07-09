<?php
class Validation
{
	private $_passed = false,
		$_errors = array(),
		$_db = null,
		$_acceptable_domain;

	/**
	 * Validation Class constructor
	 */
	public function __construct()
	{
		$this->_db = DB::getInstance();
		$this->_acceptable_domain = array(
			'yahoo.com', 'gmail.com'
		);
	}

	public function check($source, $items = array())
	{
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {

				$value = trim($source[$item]);
				$item = escape($item);

				if ($rule === 'required' && empty($value)) {
					$this->addError("{$item} is Required");
				} else if (!empty($value)) {
					switch ($rule) {
						case 'min':
							if (strlen($value) < $rule_value) {
								$this->addError("{$item} must be a minimum of {$rule_value} characters. ");
							}
							break;
						case 'max':
							if (strlen($value) > $rule_value) {
								$this->addError("{$item} must be a maximum of {$rule_value} characters. ");
							}
							break;
						case 'matches':
							if ($value != $source[$rule_value]) {
								$this->addError("{$rule_value} must be match {$item}");
							}
							break;
						case 'unique':
							$check = $this->_db->get($rule_value, array($item, '=', $value));
							if ($check->count()) {
								$this->addError("{$item} already exists.");
							}
							break;
					}
				}
			}
		}

		if (empty($this->_errors)) {
			$this->_passed = true;
		}
		return $this;
	}

	/**
	 * Checkinhg if the email submitted is a valid email
	 * And Validating it by the domain names specify in the array __construct
	 */
	public function validate_email_domain($email_address)
	{
		// Getting the email and removing any white space
		$domain = $this->get_domain(trim($email_address));

		// Checking if the domain name is acceptable
		if (in_array($domain, $this->_acceptable_domain)) {
			return true;
		}

		return false;
	}

	/**
	 * Getting the domain from the email address
	 */
	public function get_domain($email_address)
	{
		// chheck if a valid email was passed
		if (!$this->is_email($email_address)) {
			return false;
		}

		// split the email address from the @ sign
		$email_parts = explode('@', $email_address);

		// Popping off the string after the @ sign
		$domain = array_pop($email_parts);

		return $domain;
	}

	/**
	 * Checking if email is valid
	 */
	public function is_email($email_address)
	{
		// Filtering the email if its a valid email format
		if (filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
			return true;
		}

		return false;
	}

	private function addError($error)
	{
		$this->_errors[] = $error;
	}

	public function errors()
	{
		return $this->_errors;
	}

	public function passed()
	{
		return $this->_passed;
	}
}
