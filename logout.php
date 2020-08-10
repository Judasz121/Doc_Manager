<?php

	session_start();
	
	$_SESSION['loggedIn'] = false;
	unset($_SESSION['login']);
	unset($_SESSION['POST']);
	unset($_SESSION['accType']);
	header('Location: login.php');
	
 ?>