<?php

// Set namespace
namespace App;

// Non functional part of Routes
use MF\Init\Bootstrap;

// Routes of the web app
class Route extends Bootstrap {

	// Initialize routes array
	protected function initRoutes() {
		// Home route
		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);
		// Sign up route
		$routes['signup'] = array(
			'route' => '/signup',
			'controller' => 'indexController',
			'action' => 'signup'
		);
		// Register
		$routes['register'] = array(
			'route' => '/register',
			'controller' => 'indexController',
			'action' => 'register'
		);
		// Autenticate route
		$routes['autenticate'] = array(
			'route' => '/autenticate',
			'controller' => 'AuthController',
			'action' => 'autenticate'
		);
		// Exit route
		$routes['exit'] = array(
			'route' => '/exit',
			'controller' => 'AuthController',
			'action' => 'exit'
		);

		$routes['success'] = array(
			'route' => '/success',
			'controller' => 'AppController',
			'action' => 'success'
		);

		$this->setRoutes($routes);
	}

}

?>
