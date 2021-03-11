<?php

// Set namespace
namespace App\Models;

// MicroFramework resources
use MF\Model\Model;

class User extends Model {

    private $id;
    private $name;
    private $email;
    private $password;
    // private $profile;
    // private $register;
    // private $status;
	
	// Method to read values from object
    public function __get($attribute) {
        return $this->$attribute;
    }

	// Method to edit values from object
    public function __set($attribute, $value) {
        $this->$attribute = $value;
	}

	// Save new user
	public function saveUser() {
		// Preparing a query to bindValue link
		$query = "insert into user_info(name, email, password)values(:name, :email, :password)";
		// Prepare instructions prevents SQL injection
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':name', $this->__get('name'));
		$stmt->bindValue(':email', $this->__get('email'));
		// password with md5() -> hash 32 caracteres
		$stmt->bindValue(':password', $this->__get('password')); 
		$stmt->execute();
		// Return object New User
		return $this;
	}

	// Sign up rules
	public function signUpValidation() {
		$accepted = true;

		if(strlen($this->__get('name')) < 3){
			$accepted = false;
		}

		if(strlen($this->__get('email')) < 5){
			$accepted = false;
		}

		if(strlen($this->__get('password')) < 5){
			$accepted = false;
		}

		// Return result of validation
		return $accepted;
	}

	// Return user by email
	public function getUserWithMail() {
		$query = "select name, email from user_info where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->execute();
		// Return user using key in associative array
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	// Autenticate data inserted in database
	public function autenticate() {
		// Query the values inserted: user and password
		$query = "select id, name, email from user_info where email = :email and password = :password";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':password', $this->__get('password'));
		$stmt->execute();
		// User load. Use fetch because its the first of the stack 
		$user = $stmt->fetch(\PDO::FETCH_ASSOC);
		// Compare values
		if($user['id'] != '' && $user['name'] != '') {
			$this->__set('id', $user['id']);
			$this->__set('name', $user['name']);
		}
		// Return current object
		return $this;
	}

}

?>