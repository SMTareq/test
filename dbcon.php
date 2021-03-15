
<?php
	$servername = "localhost";
	$username = "id6639372_dibasdebnath";
	$passwordS = "DIU12345SWE";
	$dbname = "id6639372_routine";
	
	// Create connection
	$conn = new mysqli($servername, $username, $passwordS, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
?>