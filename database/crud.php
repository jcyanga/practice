<?php
include_once 'database/connection.php';
$myconn = new My_Conn();
$conn = $myconn->connection();

global $conn;

class My_Crud {
	public function read($table) {
		global $conn;

		$sql = "SELECT * FROM $table";
		$data = $conn->query($sql);

		return $data;
	}

	public function create($table,$user,$password,$fullname) {
		global $conn;

		$sql = "INSERT INTO $table (user,password,fullname) VALUES ('$user','$password','$fullname')";

		if($conn->query($sql) === TRUE) {
			Header("Location: index.php");
		}else {
			echo "Error, " . $sql . " or Connection Failed," . $conn->connect_error;
		}
	}

	public function delete($table,$id) {
		global $conn;

		$sql = "DELETE FROM $table WHERE ID = '$id'";
		$conn->query($sql);

		Header("Location: index.php");		
	}

	public function get($table,$id) {
		global $conn;

		$sql = "SELECT * FROM $table WHERE ID = '$id'";
		$data = $conn->query($sql);
		
		return $data;		
	}
}
?>