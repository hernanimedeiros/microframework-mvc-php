<?php

// Set namespace
namespace App\Controllers;

// MicroFramework resources
use MF\Controller\Action;
use MF\Model\Container;

// Controller for autentication procedures
class AuthController extends Action {
	
	// Autentication start procedure
	public function autenticate() {

		// Load model User
		$user = Container::getModel('User');
		// Set to a user model object the email and password inserted by user
		$user->__set('email', $_POST['email']);
		$user->__set('password', md5($_POST['password']));
		// Method call
		$user->autenticate();
		// If autenticate start session
		if($user->__get('id') != '' && $user->__get('name')) {
			session_start();
			$_SESSION['id'] = $user->__get('id');
			$_SESSION['name'] = $user->__get('name');
			// Client area
			header('Location: /success');
		} else {
			// Return to index with a error displayed on url
			header('Location: /?login=error');
		}

	}

	// Log off
	public function exit() {

		//Standart procedure: destroy session and reset url to index
		session_start();
		session_destroy();
		header('Location: /');
		
	}

}

?>