<?php

	require_once 'connect.php';
	require_once 'userManagerFunctions.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	//error_reporting(E_ALL);
	session_start();
	mysqli_query($conn,"SET NAMES utf8");
	$idrow =0;
	
	if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false)
		header('Location: login.php');
	$query = 'SELECT * FROM users WHERE userName = "'.$_SESSION['login'].'"';
	$result = mysqli_query($conn, $query);
	while($user = $result -> fetch_assoc()){
	//	if($user['userName'] == $_SESSION['login'] && !( $user['userAccountType'] == "admin"))
		//	header('Location: login.php');
	}	


	if(count($_POST) >= 1){
		$_SESSION['POST'] = serialize($_POST);
	}
	else{
		$_POST = unserialize($_SESSION['POST']);
		$dontSave = true;
	}

	if($dontSave == false && isset($_POST['save'])) {
		SaveChanges($_POST['userId'], $_POST['userName'], $_POST['userFullname'], $_POST['userPassword'], $_POST['userAccountType'], $_POST['userWorkerGroup'], $_POST['deleteUser']);
		if(isset($_POST['newUserName']) && isset($_POST['newUserPassword']))
			AddNewUsers($_POST['newUserId'], $_POST['newUserName'], $_POST['newUserFullname'], $_POST['newUserPassword'], $_POST['newUserAccountType'], $_POST['newUserWorkerGroup'], $_POST['newDeleteUser']);
    }
    $users = getAllUsers();

?>



<!DOCTYPE html>
<html>
<head>
	<title><?php echo $tytul;?></title>
	<?php 
	require_once 'components/header.php';
	?>
</head>
<body>

	<?php  include 'components/navigation.php';  ?>
	<tr><td><font size="5"><b>Panel Zarządzania Pracownikami</b></font></td></tr>
<form method="POST" class="doc-list">
		

<table class="userEditTable docList">
	<thead>
	<tr>
		<td class="col-header"><u>Login</u></td>
		<td class="col-header"><u>Imię i Nazwisko</u></td>
		<td class="col-header"><u>Hasło</u></td>
		<td class="col-header"><u>Stanowisko</u></td>
		<td class="col-header"><u>Zespół</u></td>
		<td class="col-header"><u>Usuń</u></td>
	</tr>
	</thead>
	<tbody>
<?PHP
	foreach($users as $user){
		$currId = $user['id'];

		echo'
		<tr>
			<td>
				<input type="hidden" name="userId['.$currId.'] value="'.$user['id'].'" />
				<input type="text" name="userName['.$currId.']" value="'.$user['userName'].'"/> | 
			</td>
			<td><input type="text" name="userFullname['.$currId.']" value="'.$user['userFullname'].'"/> | </td>
			<td><input type="text" name="userPassword['.$currId.']" value="'.$user['userPassword'].'"/> | </td>
			<td>
				<select name="userAccountType['.$currId.']" >
					<option value="pracownik" '; if($user['accountType'] == "pracownik") echo'selected'; echo'>
						pracownik
					</option>
					<option value="koordynator" '; if($user['accountType'] == "koordynator") echo'selected'; echo'>
						koordynator
					</option>410,
					<option value="kierownik" '; if($user['accountType'] == "kierownik") echo'selected'; echo'>
						kierownik
					</option>
					<option value="archiwum" '; if($user['accountType'] == "archiwum") echo'selected'; echo'>
						archiwum
					</option>
					<option value="korespondencja" '; if($user['accountType'] == "korespondencja") echo'selected'; echo'>
						korespondencja
					</option>
					<option value="dyrektor" '; if($user['accountType'] == "dyrektor") echo'selected'; echo'>
						dyrektor
					</option>
					<option value="admin" '; if($user['accountType'] == "admin") echo'selected'; echo'>
						administrator
					</option>
				</select> | 
			</td>
			<td><input type="text" name="userWorkerGroup['.$currId.']" value="'.$user['workerGroup'].'"/> | </td>
			<td><input type="checkbox" name="deleteUser['.$currId.']"/> | </td>
		</tr>
		';
	}
		?>
		<tr class="addUserButtonRow">
			<td colspan="100">
				<center>
				<?php echo '<script> var lastUserId = '.$currId.'</script>'; ?>
				<i class="icon-user-plus"></i>
				</center>
			</td>
		</tr>
	</tbody>
</table>
		<br> 
		<button type="submit" name="save" class="button">Zapisz</button>
</form>

<?php require 'components/footer.php'; ?>
<br><center>
<?php echo $stopa;?>
<br><br></center>
</body>

</html>
