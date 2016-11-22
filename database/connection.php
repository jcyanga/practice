<?php 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '062893');
define('DB_NAME', 'practice_db');

class My_Conn {
	public function connection() {
		$conn = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

		if($conn->connect_error) {
			die("Failed to connect to database," . $conn->connect_error);
		}

		return $conn;		
	}
}

?>