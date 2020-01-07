<?php

	require_once 'connect.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	mysqli_query($conn,"SET NAMES utf8");
	
if($_SESSION['loggedIn'] == true) 
	header('Location: archive.php');
	
	
	
if(isset($_POST['login'])){
	
	
	if($conn->connect_errno!=0){
		$error = "Error: ".$conn->connect_errno;
	}
	else{
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		mysqli_real_escape_string($conn,$login);
		mysqli_real_escape_string($conn,$password);
		
		$query = "SELECT * FROM users";
		$result = mysqli_query($conn, $query);
		while($user = $result -> fetch_assoc()){
			if($user['userName'] == $login && $user['userPassword'] == $password){	
			$_SESSION['loggedIn'] = true; 	
			$_SESSION['login'] = $user['userName']; 	
			
			header('Location: manager.php');	
			die();	
			}
		}
		
		if(empty($login) || empty($password)) 
			$login_error = "proszę wypełnić obydwa pola";
		else 
			$login_error = "login lub hasło jest nieprawidłowe";
		
	}
}


?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
		<title>Doc Manager </title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="keywords" content="wiktor,">
		<link rel="shortcut icon" href="logo.ico" />
		<link rel="stylesheet" href="addons.css">
		<link rel="stylesheet" href="resize.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
		<!--FONTS-->
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet"> 
		<link rel="stylesheet" href="css/typicons.css">
		
</head>
<style>
	
	body{
		background-image: url("IMGs/white_noisy.png");
	}
	.centerer{
		color:white;
		margin:250px auto;
		padding:30px 50px 50px 50px;
		border-radius: 50px;
		display: table;
		background: #252525;
		border: 2px solid #2b2b2b;
	}
	input{
		border: 2px solid #d5d5d5;
		color: black;
		font-family: 'Roboto Condensed',Arial,Helvetica,sans-serif !important;
		width:250px;
		text-align:center;
	}
	.send{
		margin-top:5px;
		border-radius: 0px 0px 10px 10px;
		background: #d5d5d5;
		cursor:pointer;
		color: black;
	}
	.send:hover{
		color:#d5d5d5;
		background: black;
	}
	.errors{
		margin: 0 auto;
		display: table;
		position:absolute;
	}
	.title{
		color: #d5d5d5;;
		font-weight: 900;
		width: 115px;
		margin: -10px auto 10px auto;
		z-index: 0;
		position: relative;
		font-size: 21px;
	}
	
	
	
	
	
</style>
<body>
	
	
	<div class="centerer">
		
		<div class="title">Zaloguj się</div>
		
		<form method="post" action="login.php">
			Login</br>
			<input type="text" name="login" style="border-radius: 10px 10px 0px 0px;"/></br>
			Hasło</br>
			<input type="password" name="password"/></br>
			<input class="send" type="submit" value="Zaloguj"/>
		</form>
		<div class="errors">
			<?php if(isset($error))echo $error; ?>
			<?php if(isset($login_error))echo $login_error;?>
		</div>
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<script src="JQuery/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
</html>

