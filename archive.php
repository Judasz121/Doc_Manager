<?php
	
	require_once 'connect.php';
	require_once 'archiveFunctions.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	mysqli_query($conn,"SET NAMES utf8");
	
	$query = 'SELECT * FROM users';
	$result = mysqli_query($conn, $query);
	while($user = $result -> fetch_assoc()){
		if($user['userName'] == $_SESSION['login'] && $user['permissionLevel'] < 3)
			header('Location: manager.php');
	}	
	if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false)
		header('Location: login.php');
	
	if(count($_POST) >= 1){
		$_SESSION['POST'] = serialize($_POST);
	}
	else{
		$_POST = unserialize($_SESSION['POST']);
	}
	
	
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>Doc Manager</title>
    <meta charset="utf-8">
	<link rel="stylesheet" href="style.css?v=<?php echo rand(1, 1000000) ?>">
	<link rel="stylesheet" href="fontello/css/fontello.css?v=<?php echo rand(1, 1000000) ?>">
	<!--FONTS-->
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet"> 
</head>
<body>
	<?php  include 'navigation.php';  ?>
	<form method="POST" class="doc-list" >
		<div class="doc filter"><!-----------------=================== FILTER ==============--------------------->
		<h1>Filtr</h1>
			<div class="clientNum">
				<span>Nr klienta</span>
				 <input type="text" name="filterClientNum" class="filter" value="<?php if(isset($_POST['filterClientNum'])) echo $_POST['filterClientNum']; ?>"/></span>
			</div>
			<div class="clientName">
				<span>Imię klienta</span>
				<span><input type="text" name="filterClientName" class="filter" value="<?php if(isset($_POST['filterClientName'])) echo $_POST['filterClientName']; ?>"/></span>
			</div>
			<div class="clientSurname">
				<span>Nazwisko klienta</span>
				<span><input type="text" name="filterClientSurname" class="filter" value="<?php if(isset($_POST['filterClientSurname'])) echo $_POST['filterClientSurname']; ?>"/></span>
			</div>
			<div class="yearHired">
				<span>Rok zatrudnienia</span>
				<span>Od:
					<select name="filterYearHiredFrom" class="filter">
					<?php 
					
					echo '<option '; if(empty($_POST['filterYearHiredFrom'])) echo 'selected'; echo' value="" ></option>';
					$sql = 'SELECT * FROM yearshired';
					$result = mysqli_query($conn, $sql);
					while($row = $result -> fetch_assoc()){
						echo '<option value="'.$row['year'].'" '; if ($_POST['filterYearHiredFrom'] == $row['year']) echo 'selected'; echo ' >'.$row['year'].'</option>';
					}
					?>
					</select>
				</span>
				<span>Do: 					
					<select name="filterYearHiredTo" class="filter">
					<?php 
					
					echo '<option '; if(empty($_POST['filterYearHiredTo'])) echo 'selected'; echo' value="" ></option>';
					$sql = 'SELECT * FROM yearshired';
					$result = mysqli_query($conn, $sql);
					while($row = $result -> fetch_assoc()){
						echo '<option value="'.$row['year'].'" '; if ($_POST['filterYearHiredTo'] == $row['year']) echo 'selected'; echo ' >'.$row['year'].'</option>';
					}
					?>
					</select>
				</span>
			</div>
			<div class="workStartDate">
				<span>Rozpoczęcie pracy</span>
				<span>Od: <input type="date" name="filterWorkStartDateFrom" class="filter" value="<?php if(isset($_POST['filterWorkStartDateFrom'])) echo $_POST['filterWorkStartDateFrom']; ?>"/></span>
				<span>Do: <input type="date" name="filterWorkStartDateTo" class="filter" value="<?php if(isset($_POST['filterWorkStartDateTo'])) echo $_POST['filterWorkStartDateTo']; ?>"/></span>
			</div>
			<div class="workEndDate">
				<span>Zakończenie pracy</span>
				<span>Od: <input type="date" name="filterWorkEndDateFrom" class="filter" value="<?php if(isset($_POST['filterWorkEndDateFrom'])) echo $_POST['filterWorkEndDateFrom']; ?>"/></span>
				<span>Do: <input type="date" name="filterWorkEndDateTo" class="filter" value="<?php if(isset($_POST['filterWorkEndDateTo'])) echo $_POST['filterWorkEndDateTo']; ?>"/></span>
			</div>
			<div class="DocType">
				<span>Rodzaj dokumentu</span>
				<select name="filterDocType" class="filter">
					<option value=""></option>
				<?php
					$sql = 'SELECT * FROM doctypes';
					$result = mysqli_query($conn, $sql);
					while($row = $result -> fetch_assoc()){
						echo '<option value="'.$row['docType'].'" '; if($_POST['filterDocType'] == $row['docType']) echo'selected '; echo ' >'.$row['docType'].'</option>';
					}
				?>
				</select>
			</div>
			<div class="DocImportance">
				<span>Ważność dokumentu</span>
				<select name="filterDocImportance" class="filter">
					<option value=""></option>
				<?php
					$sql = 'SELECT * FROM docimportances';
					$result = mysqli_query($conn, $sql);
					while($row = $result -> fetch_assoc()){
						echo '			
						<option value="'.$row['docImportance'].'" '; if($_POST['filterDocImportance'] == $row['docImportance']) echo'selected '; echo '>'.$row['docImportance'].'</option>';
					}
				?>
				</select>
			</div>
			<div class="progress">
				<span>Stan Wykonania</span>
				<select name="filterProgress" class="filter">
					<option value=""></option>
					<option value="P"<?php if($_POST['filterProgress'] == "P") echo'selected '; ?>>P</option>
					<option value="Z"<?php if($_POST['filterProgress'] == "Z") echo'selected '; ?>>Z</option>
					<option value="W"<?php if($_POST['filterProgress'] == "W") echo'selected '; ?>>W</option>
				</select>
			</div>
			<div class="asignedTo">
				<span>Przypisane do</span>
				<select name="filterAsignedTo" class="filter">
					<option value=""></option>
				<?php 
					$sql = 'SELECT * FROM users';
					$result = mysqli_query($conn, $sql);
					while($user = $result -> fetch_assoc()){
						echo '<option value="'.$user['userName'].'"'; if($_POST['filterAsignedTo'] == $user['userName']) echo 'selected'; echo ' >'.$user['userName'].'</option>';
					}
				?>
					<option value="NN" <?php if($_POST['filterAsignedTo'] == "NN") echo 'selected '; ?>>NN</option>
				</select>
			</div>
			<div class="comments">
				<span>Uwagi</span>
				<span><input type="text" name="filterComments" class="filter" value="<?php if(isset($_POST['filterComments'])) echo $_POST['filterComments']; ?>"/></span>
			</div>
			<div class="dateModified">
				<span>Data modyfikacji</span>
				<span>Od: <input type="datetime-local" name="filterDateModifiedFrom" class="filter" value="<?php if(isset($_POST['filterDateModifiedFrom'])) echo $_POST['filterDateModifiedFrom']; ?>"/></span>
				<span>Do: <input type="datetime-local" name="filterDateModifiedTo" class="filter" value="<?php if(isset($_POST['filterDateModifiedTo'])) echo $_POST['filterDateModifiedTo']; ?>"/></span>
			</div>
			<div class="userModified">
				<span>Zmodyfikowano przez</span>
				<select name="filterUserModified" class="filter">
					<option value=""></option>
				<?php 
					$sql = 'SELECT * FROM users';
					$result = mysqli_query($conn, $sql);
					while($user = $result -> fetch_assoc()){
						echo '<option value="'.$user['userName'].'"'; if($_POST['filterUserModified'] == $user['userName']) echo 'selected'; echo ' >'.$user['userName'].'</option>';
					}
				?>
					<option value="NN" <?php if($_POST['filterAsignedTo'] == "NN") echo 'selected '; ?>>NN</option>
				</select>
			</div>
			<div class="userIpModified">
				<span>Ip modyfikującego</span>
				<span><input type="text" name="filterUserIpModified" class="filter" value="<?php if(isset($_POST['filterUserIpModified'])) echo $_POST['filterUserIpModified']; ?>"/></span>
			</div>
			<div class="AddedBy">
				<span>Dodane Przez</span>
				<select name="filterAddedBy" class="filter">
					<option value=""></option>
				<?php 
					$sql = 'SELECT * FROM users';
					$result = mysqli_query($conn, $sql);
					while($user = $result -> fetch_assoc()){
						echo '<option value="'.$user['userName'].'"'; if($_POST['filterAddedBy'] == $user['userName']) echo 'selected'; echo ' >'.$user['userName'].'</option>';
					}
				?>
					<option value="NN" <?php if($_POST['filterAddedBy'] == "NN") echo 'selected '; ?>>NN</option>
				</select>
			</div>
			<div class="dateAdded">
				<span>Data dodania</span>
				<span>Od: <input type="datetime-local" name="filterDateAddedFrom" class="filter" value="<?php if(isset($_POST['filterDateAddedFrom'])) echo $_POST['filterDateAddedFrom']; ?>"/></span>
				<span>Do: <input type="datetime-local" name="filterDateAddedTo" class="filter" value="<?php if(isset($_POST['filterDateAddedTo'])) echo $_POST['filterDateAddedTo']; ?>"/></span>
			</div>
			
			<input type="submit" name="filter" value="Filtruj" class="button"/>
			<input type="button" value="Wyczyść" class="button" onclick="ClearFilterInputs()"/>
		</div>
		
		<!-----------------=================== FIRST ROW (COLUMN DESCRIPTION) ==============--------------------->
		<div class="docList" style="margin-top: 50px;">
			<span class="limit">
				<input type="submit" name="PokazButton" value="Pokaż:" class="numofRowstoShow">
				<select name="NumofRowstoShow" class="numofRowstoShow">
					<option value="0" >Wszystkie</option>
					<option value="25"<?php if ($_POST['NumofRowstoShow'] == '25') echo 'selected'; ?>>25</option>
					<option value="50"<?php if ($_POST['NumofRowstoShow'] == '50') echo 'selected'; ?>>50</option>
					<option value="75"<?php if ($_POST['NumofRowstoShow'] == '75') echo 'selected'; ?>>75</option>
					<option value="100"<?php if ($_POST['NumofRowstoShow'] == '100') echo 'selected'; ?>>100</option>
				</select>
			</span>
			<div class="doc info">
				<div class="clientNum">
					<a href="?orderby=clientId&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "clientId" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
						<span>Nr klienta</span><?php if($_GET['orderby'] == "clientId" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "clientId" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="clientName">
					<a href="?orderby=clientName&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "clientName" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
						<span>Imię</span><?php if($_GET['orderby'] == "clientName" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "clientName" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="clientSurname">
					<a href="?orderby=clientSurname&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "clientSurname" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
						<span>Nazwisko</span><?php if($_GET['orderby'] == "clientSurname" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "clientSurname" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="yearHired">
					<a href="?orderby=yearHired&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "yearHired" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span>Rok zatrudnienia</span><?php if($_GET['orderby'] == "yearHired" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "yearHired" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="dateWorkStart">
					<a href="?orderby=workStartDate&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "workStartDate" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span>Rozpoczęcie pracy</span><?php if($_GET['orderby'] == "workStartDate" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workStartDate" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="dateWorkEnd">
					<a href="?orderby=workEndDate&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "workEndDate" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span>Zakończenie pracy</span><?php if($_GET['orderby'] == "workEndDate" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workEndDate" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="docType">
					<a href="?orderby=docType&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "docType" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span>Rodzaj dokumentu</span><?php if($_GET['orderby'] == "docType" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "docType" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="docImportance">
					<a href="?orderby=docImportance&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "docImportance" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span>Ważność dokumentu</span><?php if($_GET['orderby'] == "docImportance" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "docImportance" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="progress">
					<a href="?orderby=progress&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "progress" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span>Stan wykonania</span><?php if($_GET['orderby'] == "progress" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "progress" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="asignedTo">
					<a href="?orderby=workerAsigned&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "workerAsigned" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span>Przypisane do</span><?php if($_GET['orderby'] == "workerAsigned" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workerAsigned" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="comments">
					<a href="?orderby=comments&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "comments" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span>Uwagi</span><?php if($_GET['orderby'] == "comments" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "comments" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="dateModified" >
					<a href="?orderby=dateModified&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "dateModified" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span>Data Modyfikacji</span><?php if($_GET['orderby'] == "dateModified" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "dateModified" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="userModified" >
					<a href="?orderby=userModified&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "userModified" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span>Zmodyfikowane przez</span><?php if($_GET['orderby'] == "userModified" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "userModified" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="userIpModified" >
					<a href="?orderby=userIpModified&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "userIpModified" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span>Ip modyfikującego</span><?php if($_GET['orderby'] == "userIpModified" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "userIpModified" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="userAdded" >
					<a href="?orderby=addedBy&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "addedBy" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span>Dodane przez</span><?php if($_GET['orderby'] == "addedBy" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "addedBy" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="dateAdded" >
					<a href="?orderby=addedTime&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "addedTime" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span>Data Dodania</span><?php if($_GET['orderby'] == "addedTime" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "addedTime" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
			</div>
		
		
		<?PHP 
		
			$limit = NULL;
			if($_POST['NumofRowstoShow'] != "0" && isset($_POST['NumofRowstoShow']))
				$limit = ' LIMIT '.$_POST['NumofRowstoShow'];

			$filterQuery = BuildFilterQuery();
			
			$orderby = $_GET['orderby'];
			$order = $_GET['order'];
			if(!isset($_GET['orderby'])){
				$orderby = 'id';
				$order = 'ASC';
			}

			$sql = 'SELECT * FROM archive '.$filterQuery.' ORDER BY '.$orderby.' '.$order.$limit;
		
			$result = mysqli_query($conn, $sql);
			
			if ($result->num_rows > 0) {
			while($doc = $result->fetch_assoc()) {
				$currId = $doc['id'];
				
echo'
			<div class="doc item '; $p = $doc['progress'];
				if($p == "N") echo 'blue'; elseif($p == "P") echo 'yellow'; elseif($p == "Z") echo 'orange'; elseif($p == "W") echo 'green';  echo'">
				<div class="clientNum">
					'.$doc['clientId'].'
				</div>
				<div class="clientName">
					'.$doc['clientName'].'
				</div>
				<div class="clientSurname">
					'.$doc['clientSurname'].'
				</div>
				<div class="yearHired">
					'.$doc['yearHired'].'
				</div>
				<div class="dateWorkStart">
					'.$doc['workStartDate'].'
				</div>
				<div class="dateWorkEnd">
					'.$doc['workEndDate'].'
				</div>
				<div class="docType">
					'.$doc['docType'].'
				</div>
				<div class="docImportance">
					'.$doc['docImportance'].'
				</div>
				<div class="progress">
					'.$doc['progress'].'
				</div>
				<div class="asignedTo">
					'.$doc['workerAsigned'].'
				</div>
				<div class="comments" >
					'.$doc['comments'].'
				</div>
				<div class="dateModified" >
					'.$doc['dateModified'].'
				</div>
				<div class="userModified">
					'.$doc['userModified'].'
				</div>
				<div class="userIpModified">
					'.$doc['userIpModified'].'
				</div>
				<div class="addedBy">
					'.$doc['addedBy'].'
				</div>
				<div class="dateAdded">
					'.$doc['addedTime'].'
				</div>

			</div>
				';
			}
			}
			
		?>
		</div>
	</form>


<script>
	
	function ClearFilterInputs(){
		var inputs = document.querySelectorAll("input.filter"), selects = document.querySelectorAll("select.filter");
		for (i = 0; i < inputs.length; ++i) {
		  inputs[i].value="";
		}
		for (i = 0; i < selects.length; ++i) {
		  selects[i].value = "";
		}
	}
</script>
<script src="script.js?v=<?php echo rand(1, 1000000) ?>"></script>
</body>

</html>
