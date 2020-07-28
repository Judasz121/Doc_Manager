<?php

	require_once 'connect.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	mysqli_query($conn,"SET NAMES utf8");
	
if($_SESSION['loggedIn'] == true) 
{
	if($_SESSION['accType'] == "pracownik")
		header('Location: employee.php');
	if($_SESSION['accType'] == "koordynator")
		header('Location: employee.php');
	if($_SESSION['accType'] == "kierownik")
		header('Location: manager_new.php');
	if($_SESSION['accType'] == "archiwum")
		header('Location: piwnica_new.php');
	if($_SESSION['accType'] == "korespondencja")
		header('Location: piwnica_new.php');
	if($_SESSION['accType'] == "dyrektor")
		header('Location: manager_new.php');
	if($_SESSION['accType'] == "admin")
		header('Location: manager_new.php');
}
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
				$_SESSION['fullName'] = $user['fullName'];
				$_SESSION['accType'] = $user['accountType'];
				
				if($_SESSION['accType'] == "pracownik")
					header('Location: employee.php');
				if($_SESSION['accType'] == "koordynator")
					header('Location: employee.php');
				if($_SESSION['accType'] == "kierownik")
					header('Location: manager_new.php');
				if($_SESSION['accType'] == "archiwum")
					header('Location: piwnica_new.php');
				if($_SESSION['accType'] == "korespondencja")
					header('Location: piwnica_new.php');
				if($_SESSION['accType'] == "dyrektor")
					header('Location: manager_new.php');
				if($_SESSION['accType'] == "admin")
					header('Location: manager_new.php');
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
	<title><?php echo $tytul;?></title>
	<?php 
	require_once 'components/header.php'; 
	?>
</head>
<style>
	input[type=text]{
		
	}
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
	input, input[type=text]{
		border: 2px solid #d5d5d5;
		color: black;
		font-family: 'Roboto Condensed',Arial,Helvetica,sans-serif !important;
		width:250px;
		text-align:center;
		background: white;
		height: 30px;
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
		margin: -10px auto 10px auto;
		z-index: 0;
		position: relative;
		font-size: 21px;
	}
	
	
	
	
	
</style>
<body>
	
	
	<div class="centerer">
		<center>
		<div class="title">Zaloguj się</div>
		
		<form method="post" action="login.php">
			Login</br>
			<input type="text" name="login" style="border-radius: 10px 10px 0px 0px;"/></br>
			Hasło</br>
			<input type="password" name="password"/></br>
			<input class="send" type="submit" value="Zaloguj"/>
		</form><br>Czeskie Przysłowie na dziś:<br>
		<div style="width: 250px;"><i>
		<?php include'slownik/cytat.php';?></i></div>
		
		<div class="errors">
			<?php if(isset($error))echo $error; ?>
			<?php if(isset($login_error))echo $login_error;?></center>
		</div>
	</div>
	

	
	
	<script src="JQuery/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
</html>

