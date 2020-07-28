<?php

	
	$database_host = "localhost";
	$database_user = "root";
	$database_password = "";
	$database_name = "docmanager";
	
	$conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);

	if(mysqli_connect_errno()) {
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
?>