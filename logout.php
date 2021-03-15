<?php

	session_start();
	ob_start();
 
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
	session_destroy();
		header("location: index.php");
	} else {
    
	header("location: index.php");
}
?>