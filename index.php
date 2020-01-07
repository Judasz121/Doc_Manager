<?php
	require_once 'connect.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	mysqli_query($conn,"SET NAMES utf8");
	
	$query = 'SELECT * FROM users';
	$result = mysqli_query($conn, $query);
	while($user = $result -> fetch_assoc()){
		if($user['userName'] == $_SESSION['login'] && $user['permissionLevel'] < 0)
			header('Location: employee.php');
	}	
	if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false)
		header('Location: login.php');
	
	
	
	
	
	
	
	if(isset($_POST['name'])){
		
		$worker = "NN";
		
		$date = date('Y-m-d H:i:s');
		if(empty($_POST['dateWorkEnd'])) $_POST['dateWorkEnd'] = "0000-00-00";
		if(empty($_POST['dateWorkStart'])) $_POST['dateWorkStart'] = "0000-00-00";
		
		$query = 'INSERT INTO documents VALUES(NULL, "'.$_POST['clientNum'].'", "'.$_POST['name'].'", "'.$_POST['surName'].'","'.$_POST['yearHired'].'", "'.$_POST['dateWorkStart'].'","'.$_POST['dateWorkEnd'].'", "'.$_POST['docType'].'",
		"'.$_POST['docImportance'].'", "N", "'.$worker.'","'.$_POST['comments'].'", "'.$date.'", "'.$_SESSION['login'].'", "'.getUserIpAddr().'", "'.$_SESSION['login'].'", "'.$date.'")';
		
		$sql = mysqli_query($conn, $query);
		
		if ($sql === TRUE) {
			echo
			'<div class="sqlResult">
				Dodano Pomyślnie
			</div>';
		} else {
		//	echo "Błąd: " . $sql . "<br>" . $query . "<br>" .mysqli_error($conn);
			echo "<div class='sqlResult'>Proszę wypełnić wszystkie pola!</div>";
		}
		// ARCHIVE
		
				// ARCHIVE
				$query = 'SELECT * FROM documents WHERE clientId = "'.$_POST['clientNum'].'" AND clientName="'.$_POST['name'].'" AND clientSurname="'.$_POST['surName'].'" AND yearHired="'.$_POST['yearHired'].'" AND
				workStartDate="'.$_POST['dateWorkStart'].'" AND workEndDate="'.$_POST['dateWorkEnd'].'" AND docType="'.$_POST['docType'].'" AND docImportance="'.$_POST['docImportance'].'" AND progress="N"
				AND workerAsigned="'.$worker.'" AND comments="'.$_POST['comments'].'" AND userModified="'.$_SESSION['login'].'"';
				
				$result = mysqli_fetch_array(mysqli_query($conn, $query));
				if($result == false) echo '</br>ERROR: '.mysqli_error($conn).' </br>WITH SQL: '.$query.'</br>';
				
				$query = 'INSERT INTO archive VALUES(NULL, "'.$_POST['clientNum'].'", "'.$_POST['name'].'", "'.$_POST['surName'].'", "'.$_POST['yearHired'].'", "'.$_POST['dateWorkStart'].'", "'.$_POST['dateWorkEnd'].'",
				"'.$_POST['docType'].'", "'.$_POST['docImportance'].'", "N", "'.$_POST['asignedTo'].'","'.$_POST['comments'].'", "'.$date.'", "'.$_SESSION['login'].'", "'.getUserIpAddr().'"
				, "'.$result['addedBy'].'", "'.$result['addedTime'].'" )';
				$result = mysqli_query($conn, $query);
				
				if($result == false) echo '</br>ERROR: '.mysqli_error($conn).' </br>WITH SQL: '.$query.'</br>';
		
		
	}
	$next = false;
	if(isset($_POST['addNext'])){
		$nextClientId = $_POST['clientNum'];
		$nextName = $_POST['name'];
		$nextSurname = $_POST['surName'];
		$nextDocImportance = $_POST['docImportance'];
		$nextDocType = $_POST['docType'];
		$next = true;
	}
	
	
	function getUserIpAddr(){
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			//ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			//ip pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	?>
<!DOCTYPE html>
<html>
<head>
    <title>Doc Manager</title>
    <meta charset="utf-8">
	<link rel="stylesheet" href="style.css?v=<?php echo rand(1, 1000000) ?>">
	<link rel="stylesheet" href="font/css/fontello.css?v=<?php echo rand(1, 1000000) ?>">
	<!--FONTS-->
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet"> 
</head>
<body>
	<?php  include 'navigation.php';  ?>
	<form method="POST" class="">
		<div>
			<span>Nr klienta:</span>
			<input type="text" name="clientNum" <?php if($next) echo 'value="'.$nextClientId.'"'; ?>/>
		</div>
		<div>
			<span>Imię:</span>
			<input type="text" name="name" <?php if($next) echo 'value="'.$nextName.'"'; ?>/>
		</div>
		<div>
			<span>Nazwisko:</span>
			<input type="text" name="surName" <?php if($next) echo 'value="'.$nextSurname.'"'; ?>/>
		</div>
		<div>
			<span>Rok zatrudnienia:</span>
			<select name="yearHired" >
			
			<?php
				$sql = 'SELECT * FROM yearshired';
				$result = mysqli_query($conn, $sql);
				while($row = $result -> fetch_assoc()){
					echo '<option value="'.$row['year'].'">'.$row['year'].'</option>';
				}
			?>
			</select>
		</div>
		<div>
			<span>Rozpoczęcie pracy:</span>
			<input type="date" name="dateWorkStart"/>
		</div>
		<div>
			<span>Zakończenie pracy:</span>
			<input type="date" name="dateWorkEnd"/>
		</div>
		<div>
			<span>Rodzaj dokumentu:</span>
			<select name="docType">
			<?php
				$sql = 'SELECT * FROM doctypes';
				$result = mysqli_query($conn, $sql);
				while($row = $result -> fetch_assoc()){
					echo '<option value="'.$row['docType'].'">'.$row['docType'].'</option>';
				}
			?>
			</select>
		</div>
		<div>
			<span>Ważność dokumentu:</span>
			<?php
				$sql = 'SELECT * FROM docimportances';
				$result = mysqli_query($conn, $sql);
				while($row = $result -> fetch_assoc()){
					echo '			
						<label>
							<input type="radio" name="docImportance" id="'.$row['docImportance'].'" value="'.$row['docImportance'].'" />
							<span for="'.$row['docImportance'].'">'.$row['docImportance'].'</span>
						</label>';
				}
			?>
		</div>
		<div>
			<span>Uwagi:</span>
			<input type="text" name="comments" />
		</div>
		<button type="submit" name="add" class="saveUsers button">Dodaj</button>
		<button type="submit" name="addNext" class="saveUsers button">Dodaj następny</button>
		<button type="button" onclick="ClearForm()" class="new button">Wyczyść</button>
	</form>
		<div class="docList" style="margin-top: 50px;">
		<h3>Ostatnio Dodane</h3>
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
							
					<span>Zmodyfikowano przez</span><?php if($_GET['orderby'] == "userModified" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "userModified" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
			</div>
	<?PHP
	$orderby = $_GET['orderby'];
	$order = $_GET['order'];
	if(!isset($_GET['orderby'])){
		$orderby = 'id';
		$order = 'ASC';
	}
	$dateMinusDay = date('Y-m-d H:m:s', strtotime("-1 day"));
	$sql = 'SELECT * FROM documents WHERE addedBy="'.$_SESSION['login'].'" AND addedTime >= "'.$dateMinusDay.'" ';

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
	</div>
		';
	}
	}
			
		
	
	
?>


<script>
	function ClearForm(){
		document.querySelector("form").reset();
	}
	function SelectNextFields(docImp, docType){
		docImp.checked = true;
		docType.selected = true;
	}
	<?php if($next) echo 'SelectNextFields('.$nextDocImportance.', '.$nextDocType.');'; ?>
	if ( window.history.replaceState ) {
    //    window.history.replaceState( null, null, window.location.href );
    }
</script>
<script src="script.js?v=<?php echo rand(1, 1000000) ?>"></script>
</body>

</html>
