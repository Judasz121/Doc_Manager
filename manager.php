<?php

	require_once 'connect.php';
	require_once 'managerFunctions.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	mysqli_query($conn,"SET NAMES utf8");
	
	$query = 'SELECT * FROM users';
	$result = mysqli_query($conn, $query);
	while($user = $result -> fetch_assoc()){
		if($user['userName'] == $_SESSION['login'] && $user['permissionLevel'] < 2)
			header('Location: employee.php');
	}	
	if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false)
		header('Location: login.php');
	
	
	
	if(count($_POST) >= 1){
		$_SESSION['POST'] = serialize($_POST);
	}
	else{
		$_POST = unserialize($_SESSION['POST']);
		$dontSave = true;
	}
	
	if($dontSave == false && (isset($_POST['save']) || isset($_POST['saveOnlySelected'])))
		SaveChanges();
	

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
	<form method="POST" class="doc-list">
	<div class="clientDocList container">
		<table class="clientDocList">
			<tbody>
			<tr>
				<td>
				<a href="?clientTableOrderby=clientId&clientTableOrder=<?php if( isset($_GET['clientTableOrderby']) && $_GET['clientTableOrderby'] == "clientId" && $_GET['clientTableOrder'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order']; 
							if(isset($_GET['progressTableOrderby'])) echo '&progressTableOrderby='.$_GET['progressTableOrderby'].'&progressTableOrder='.$_GET['progressTableOrder']; ?>">
					Nr Klienta
					<?php if($_GET['clientTableOrderby'] == "clientId" && $_GET['clientTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
					elseif($_GET['clientTableOrderby'] == "clientId" && $_GET['clientTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
				</a>
				</td>
				<td>
				<a href="?clientTableOrderby=numofDocs&clientTableOrder=<?php if( isset($_GET['clientTableOrderby']) && $_GET['clientTableOrderby'] == "numofDocs" && $_GET['clientTableOrder'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
							if(isset($_GET['progressTableOrderby'])) echo '&progressTableOrderby='.$_GET['progressTableOrderby'].'&progressTableOrder='.$_GET['progressTableOrder']; ?>">
					Liczba Dokumentów 
					<?php if($_GET['clientTableOrderby'] == "numofDocs" && $_GET['clientTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
					elseif($_GET['clientTableOrderby'] == "numofDocs" && $_GET['clientTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
				</a>
				</td>
			</tr>
			<?PHP
			CountNumofDocsForClientsTable();
			
			$filterQuery = BuildFilterQueryforClientsTable();
			
			if(!empty($_POST['filterNumOfDocsPerClientFrom']) || !empty($_POST['filterNumOfDocsPerClientTo'])){
				if(!isset($_GET['clientTableOrder']))
					$sql = 'SELECT * FROM clients '.$filterQuery.' ORDER BY id ASC';
				else
					$sql = 'SELECT * FROM clients '.$filterQuery.' ORDER BY '.$_GET['clientTableOrderby'].' '.$_GET['clientTableOrder'];
				$result = mysqli_query($conn, $sql);
				if ($result->num_rows > 0) {   
					while($client = $result->fetch_assoc()) {
						echo '<tr><td>'.$client['clientId']./*'</br>'.$client['name'].' '.$client['surname'].*/'</td><td>'.$client['numofDocs'].'</td></tr>';
					}
				}	
			}
			else
				echo'<style> table.clientDocList{display: none;} </style>'
			?>	
			</tbody>
		</table>
		<div class="numOfDocsPerClient">
			<span>Klienci których liczba dokumentów wynosi</span></br>
			<span>Od: <input type="number" name="filterNumOfDocsPerClientFrom" value="<?php if(isset($_POST['filterNumOfDocsPerClientFrom'])) echo $_POST['filterNumOfDocsPerClientFrom']; ?>"/></span>
			<span>Do: <input type="number" name="filterNumOfDocsPerClientTo" value="<?php if(isset($_POST['filterNumOfDocsPerClientTo'])) echo $_POST['filterNumOfDocsPerClientTo']; ?>"/></span>
			<input type="submit" name="filter" value="Pokaż" class="button" style="margin-left:20px;"/ >
		</div>
	</div>
	<table class="userDocList">
		<tbody>
		<tr>
			<td>
			<a href="?progressTableOrderby=userName&progressTableOrder=<?php if( isset($_GET['progressTableOrderby']) && $_GET['progressTableOrderby'] == "userName" && $_GET['progressTableOrder'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
				<?php 	if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
						if(isset($_GET['clientTableOrderby'])) echo '&clientTableOrderby='.$_GET['clientTableOrderby'].'&clientTableOrder='.$_GET['clientTableOrder']; ?>">
				Pracownik
				<?php if($_GET['progressTableOrderby'] == "userName" && $_GET['progressTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
				elseif($_GET['progressTableOrderby'] == "userName" && $_GET['progressTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
			</a>
			</td>
			<td>
			<a href="?progressTableOrderby=PdocsNum&progressTableOrder=<?php if( isset($_GET['progressTableOrderby']) && $_GET['progressTableOrderby'] == "PdocsNum" && $_GET['progressTableOrder'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
				<?php 	if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
						if(isset($_GET['clientTableOrderby'])) echo '&clientTableOrderby='.$_GET['clientTableOrderby'].'&clientTableOrder='.$_GET['clientTableOrder']; ?>">
				P
				<?php if($_GET['progressTableOrderby'] == "PdocsNum" && $_GET['progressTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
				elseif($_GET['progressTableOrderby'] == "PdocsNum" && $_GET['progressTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
			</a>
			</td>
			<td>
			<a href="?progressTableOrderby=ZdocsNum&progressTableOrder=<?php if( isset($_GET['progressTableOrderby']) && $_GET['progressTableOrderby'] == "ZdocsNum" && $_GET['progressTableOrder'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
				<?php 	if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
						if(isset($_GET['clientTableOrderby'])) echo '&clientTableOrderby='.$_GET['clientTableOrderby'].'&clientTableOrder='.$_GET['clientTableOrder']; ?>">
				Z
				<?php if($_GET['progressTableOrderby'] == "ZdocsNum" && $_GET['progressTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
				elseif($_GET['progressTableOrderby'] == "ZdocsNum" && $_GET['progressTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
			</a>
			</td>
			<td>
			<a href="?progressTableOrderby=PdocsNum&progressTableOrder=<?php if( isset($_GET['progressTableOrderby']) && $_GET['progressTableOrderby'] == "PdocsNum" && $_GET['progressTableOrder'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
				<?php 	if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
						if(isset($_GET['clientTableOrderby'])) echo '&clientTableOrderby='.$_GET['clientTableOrderby'].'&clientTableOrder='.$_GET['clientTableOrder']; ?>">
				Suma
				<?php if($_GET['progressTableOrderby'] == "PdocsNum" && $_GET['progressTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
				elseif($_GET['progressTableOrderby'] == "PdocsNum" && $_GET['progressTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
			</a>
			</td>
			<td>
			<a href="?progressTableOrderby=allDocsNum&progressTableOrder=<?php if( isset($_GET['progressTableOrderby']) && $_GET['progressTableOrderby'] == "allDocsNum" && $_GET['progressTableOrder'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
				<?php 	if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
						if(isset($_GET['clientTableOrderby'])) echo '&clientTableOrderby='.$_GET['clientTableOrderby'].'&clientTableOrder='.$_GET['clientTableOrder']; ?>">
				Suma W
				<?php if($_GET['progressTableOrderby'] == "allDocsNum" && $_GET['progressTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
				elseif($_GET['progressTableOrderby'] == "allDocsNum" && $_GET['progressTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
			</a>
			</td>
		</tr>
		<?PHP
			CountNumofDocsbyTypeForUsersTable();
			
			if(!isset($_GET['progressTableOrder']))
				$sql = 'SELECT * FROM users WHERE permissionLevel="1" ORDER BY id ASC';
			else
				$sql = 'SELECT * FROM users WHERE permissionLevel="1" ORDER BY '.$_GET['progressTableOrderby'].' '.$_GET['progressTableOrder'];
			$result = mysqli_query($conn, $sql);

			if ($result->num_rows > 0) {   
				while($user = $result->fetch_assoc()) {
					echo '<tr><td>'.$user['userName'].'</td><td style="background: yellow; color:black;">'.$user['PdocsNum'].'</td><td style="background: orange; color:black;">'.$user['ZdocsNum'].'</td><td style="'; 
					if($user['PdocsNum'] == 20) echo'background: yellow;'; elseif($user['PdocsNum'] < 20) echo'background: green;'; elseif($user['PdocsNum'] > 20) echo'background: red;'; echo' color:black;">'.$user['PdocsNum'].'</td><td>'.$user['allDocsNum'].'</td></tr>';
				}
			}	
		?>
		</tbody>
	</table>

		<div class="doc filter"><!-----------------=================== FILTER ==============--------------------->
		<h1>Filtr</h1>
			<div class="clientNum">
				<span>Nr klienta</span>
				<span><input type="text" name="filterClientNum" class="filter" value="<?php if(isset($_POST['filterClientNum'])) echo $_POST['filterClientNum']; ?>"/></span>
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
					<option value="N"<?php if($_POST['filterProgress'] == "N") echo'selected '; ?>>N</option>
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
				<span>Ostatnia Zmiana</span>
				<span>Od: <input type="datetime-local" name="filterDateModifiedFrom" class="filter" value="<?php if(isset($_POST['filterDateModifiedFrom'])) echo $_POST['filterDateModifiedFrom']; ?>"/></span>
				<span>Do: <input type="datetime-local" name="filterDateModifiedTo" class="filter" value="<?php if(isset($_POST['filterDateModifiedTo'])) echo $_POST['filterDateModifiedTo']; ?>"/></span>
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
		<div class="docList">
			<span class="limit">
				<input type="submit" name="PokazButton" value="Pokaż:" class="numofRowstoShow ">
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
				<div class="saveSelected">
					<span>Zapisz</span>
				</div>
				<div class="dateModified" >
					<a href="?orderby=dateModified&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "dateModified" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span>Ostatnia Zmiana</span><?php if($_GET['orderby'] == "dateModified" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "dateModified" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
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
		
				<!-----------------=================== TABLE OF DOCS ==============--------------------->
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

			$sql = 'SELECT * FROM documents '.$filterQuery.' ORDER BY '.$orderby.' '.$order.$limit;
			$result = mysqli_query($conn, $sql);
			//if($result == false) echo'</br> ERROR: '.mysqli_error($conn).'</br> WITH SQL: '.$sql;
			
			
			if ($result->num_rows > 0) {
			while($doc = $result->fetch_assoc()) {
				$currId = $doc['id'];
				
				echo'
			<div class="doc item '; $p = $doc['progress'];
				if($p == "N") echo 'blue'; elseif($p == "P") echo 'yellow'; elseif($p == "Z") echo 'orange'; elseif($p == "W") echo 'green';  echo'">
				<div class="clientNum">
					<input type="text" name="clientNum'.$currId.'" value="'.$doc['clientId'].'"/>
				</div>
				<div class="clientName">
					<input type="text" name="name'.$currId.'" value="'.$doc['clientName'].'"/>
				</div>
				<div class="clientSurname">
					<input type="text" name="surName'.$currId.'" value="'.$doc['clientSurname'].'"/>
				</div>
				<div class="yearHired">
					<select name="yearHired'.$currId.'" >';

						$yearsCount = date("Y") - 1920;
						for($i = 0; $i <= $yearsCount; $i++){
							if($doc['yearHired'] == ($i + 1920))
							{
								echo '<option value="'.($i + 1920).'/'.($i + 1921).'" selected >'.($i + 1920).'/'.($i + 1921).'</option>';
							}else{
								echo '<option value="'.($i + 1920).'/'.($i + 1921).'">'.($i + 1920).'/'.($i + 1921).'</option>';
							}
						}
						


					echo '</select>
				</div>
				<div class="dateWorkStart">
					<input type="date" name="dateWorkStart'.$currId.'" value="'.$doc['workStartDate'].'"/>
				</div>
				<div class="dateWorkEnd">
					<input type="date" name="dateWorkEnd'.$currId.'" value="'.$doc['workEndDate'].'"/>
				</div>
				<div class="docType">
					<select name="docType'.$currId.'">
					
						<option value="X"'; if($doc['docType'] === "X") echo 'selected'; echo' >X</option>
						<option value="Y"'; if($doc['docType'] === "Y") echo 'selected'; echo' >Y</option>
						<option value="Z"'; if($doc['docType'] === "Z") echo 'selected'; echo' >Z</option>
						
					</select>
				</div>
				<div class="docImportance">
					<label>
						<input type="radio" name="docImportance'.$currId.'" id="A" value="A"'; if($doc['docImportance'] === "A") echo 'checked'; echo' />
						<span for="A">A</span>
					</label>
					<label>
						<input type="radio" name="docImportance'.$currId.'" id="B" value="B"'; if($doc['docImportance'] === "B") echo 'checked'; echo' />
						<span for="B">B</span>
					</label>
					<label>
						<input type="radio" name="docImportance'.$currId.'" id="C" value="C"'; if($doc['docImportance'] === "C") echo 'checked'; echo' />
						<span for="C">C</span>
					</label>
				</div>
				<div class="progress">
					<select name="progress'.$currId.'">
						
						<option value="N"'; if($doc['progress'] === "N") echo 'selected'; echo'>N</option>
						<option value="P"'; if($doc['progress'] === "P") echo 'selected'; echo'>P</option>
						<option value="Z"'; if($doc['progress'] === "Z") echo 'selected'; echo'>Z</option>
						<option value="W"'; if($doc['progress'] === "W") echo 'selected'; echo'>W</option>
					</select>
				</div>
				<div class="asignedTo">
					<select name="asignedTo'.$currId.'">';
					
						$query = "SELECT COUNT(*) FROM users";
						$result1 = mysqli_fetch_array(mysqli_query($conn, $query));
						$numOfUsers = $result1["COUNT(*)"];
						$k = 1;
						$currWorkerId = 0;	
						
						while($numOfUsers > 0 and $k <= $numOfUsers){
							
							$query = 'SELECT * FROM users WHERE id > '.$currWorkerId.' ORDER BY id ASC';
							$worker = mysqli_fetch_array(mysqli_query($conn, $query));
							$currWorkerId = $worker['id'];
							$k++;
							echo '<option value="'.$worker['userName'].'"'; if($doc['workerAsigned'] == $worker['userName']) echo'selected'; echo ' >'.$worker['userName'].'</option>';	
						}
						echo'
						<option value="NN"'; if($doc['workerAsigned'] == "NN") echo 'selected'; echo' >NN</option>
					</select>
				</div>
				<div class="comments" >
					<input type="text" name="comments'.$currId.'" value="'.$doc['comments'].'" />
				</div>
				<div class="saveSelected" >
					<input type="checkbox" name="saveSelected'.$currId.'"  />
				</div>
				<div class="dateModified" >
					<span>'.$doc['dateModified'].' <b style="white-space: nowrap;">- '.$doc['userModified'].'</b></span>
				</div>
				<div class="dateAdded" >
					<span>'.$doc['addedTime'].' <b style="white-space: nowrap;">- '.$doc['addedBy'].'</b></span>
				</div>
			</div>
				';
				
				
				echo '
				<script>
					document.getElemetById('.$doc['docImportance'].').checked = true;
					document.getElemetById('.$doc['docType'].').selected = true;
				</script>
				';
				
				
				
				
				
				
				
			}
			}
			
		?>


			<button type="submit" name="save" class="saveUsers button">Zapisz wszystkie</button>
			<button type="submit" name="saveOnlySelected" class="saveUsers button">Zapisz zaznaczone</button>
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
