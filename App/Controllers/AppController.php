<?php

// Set namespace
namespace App\Controllers;

// MicroFramework resources
use MF\Controller\Action;
use MF\Model\Container;

// Controller pos autentication
class AppController extends Action {
	
	// Redirect to his function if autentication have success
	public function success() {

		// Check if autentication is ok
		$this->validateAutentication();
		//Render client area 
		$this->render('success','layout_success');
		
	}

	// Validate if user made autentication
	public function validateAutentication() {

		session_start();
		// Check if autentication is on
		if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['name']) || $_SESSION['name'] == '') {
			header('Location: /?login=error');
		}	

	}

}

?>