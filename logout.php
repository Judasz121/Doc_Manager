<?php

	session_start();
	
	$_SESSION['loggedIn'] = false;
	unset($_SESSION['login']);
	unset($_SESSION['POST']);
	header('Location: login.php');
	
 ?>