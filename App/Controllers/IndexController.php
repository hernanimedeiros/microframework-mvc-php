<?php

// Set namespace
namespace App\Controllers;

// MicroFramework resources
use MF\Controller\Action;
use MF\Model\Container;

// Main controller
class IndexController extends Action {

	// Homepage
	public function index() {

		// If login exist on url get that value
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		// Call render method with  phtml_filename and layout_name as parameters
		$this->render('index', 'layout');
	}

	// Sign up 
	public function signup() {

		$this->view->user = array(
				'name' => '',
				'email' => '',
				'password' => '',
			);
		// Error parameter
		$this->view->errorSign = false;
		$this->render('signup', 'layout');
	}

	// Register information after sign up
	public function register() {
		// Access database via Container, a Class that abstract link with database and with a Query selected by Model
		$user = Container::getModel('User');
		// Get the result from the Query
		$user->__set('name', $_POST['name']);
		$user->__set('email', $_POST['email']);
		$user->__set('password', md5($_POST['password']));

		// Check if Sign up validation is accepted and a mail it's link to the user		
		if($user->signUpValidation() && count($user->getUserWithMail()) == 0) {
				// Save data
				$user->saveUser();
				$this->render('sign', 'layout');
		} else {
			// Prevent delete of data inserted by user after press submit button
			$this->view->user = array(
				'name' => $_POST['name'],
				'email' => $_POST['email'],
				'password' => $_POST['password'],
			);
			// Error parameter
			$this->view->errorSign = true;
			// Show sign up again
			$this->render('signup', 'layout');
		}

	}

}

?>