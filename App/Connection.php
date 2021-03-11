<?php

// Set namespace
namespace App;

// Set connection with database
class Connection {

	// To use in Controllers call it using App\Connection
	public static function getDb() {
		// Check connection
		try{
			// Database PDO connection parameters
			$conn = new \PDO(
				"mysql:host=127.0.0.1;port=3306;dbname=microframework;charset=utf8mb4",'root',''
			);
			// Return the PDO object
			return $conn;
		// Error message
		} catch (\PDOException $e) {
			// echo '<p>'.$e->getMessege().'</p>';
			echo '<p>'.'Cannot access database'.'</p>';
		}
	}
}

?>
