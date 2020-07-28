<?php
	require_once 'connect.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	mysqli_query($conn,"SET NAMES utf8");
	$idrow =0;
	
	if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false)
		header('Location: login.php');
	$query = 'SELECT * FROM users WHERE userName = "'.$_SESSION['login'].'"';
	$result = mysqli_query($conn, $query);
	while($user = $result -> fetch_assoc()){
		if($user['userName'] == $_SESSION['login'] && !($user['accountType'] == "admin" || $user['accountType'] == "korespondencja"))
			header('Location: login.php');
	}
	

	
	
	
	if(isset($_POST['add']) || isset($_POST['addNext']))
	if(empty($_POST['clientNum']) || empty($_POST['name']) || empty($_POST['surName']) || empty($_POST['yearHired']) || empty($_POST['dateWorkEnd']) || empty($_POST['docType']) 
	|| empty($_POST['docImportance']))
	{
	//	echo "Błąd: " . $result . "<br>" . $query . "<br>" .mysqli_error($conn);
		echo "<div class='sqlResultO'>Proszę wypełnić wszystkie pola!</div>";
		$errorEmpty = TRUE;
	}
	else{
		$worker = "NN";
		
		$date = date('Y-m-d H:i:s');
		if(empty($_POST['dateWorkEnd'])) $_POST['dateWorkEnd'] = "0001-01-01";
		if(empty($_POST['dateWorkStart'])) $_POST['dateWorkStart'] = "0001-01-01";
		$dateWorkEnd = explode("-", $_POST['dateWorkEnd']);
		$dateWorkStart = explode("-", $_POST['dateWorkStart']);
		if((strlen($dateWorkEnd['0']) > 4) || (strlen($dateWorkStart['0']) > 4))
			$error = "<div class='sqlResultO'>Rok nie może być większy niż 4 liczby!</div>";
		
		
		$query = 'INSERT INTO documents VALUES(NULL, "'.$_POST['clientNum'].'", "'.$_POST['name'].'", "'.$_POST['surName'].'","'.$_POST['yearHired'].'", "'.$_POST['dateWorkStart'].'","'.$_POST['dateWorkEnd'].'", "'.$_POST['docType'].'",
		"'.$_POST['docImportance'].'","'.$_POST['docSpace'].'", "'.$_POST['MMM'].'", "", "'.$worker.'","'.$_POST['comments'].'", "'.$date.'", "'.$_SESSION['login'].'", "'.getUserIpAddr().'", "'.$_SESSION['login'].'", "'.$date.'")';
		if(!isset($error))
			$result = mysqli_query($conn, $query);
		
		if ($result == TRUE && !isset($error)) {
			echo
			'<div class="sqlResultG">
				Dodano Pomyślnie
			</div>';
		}
		else{
			if(isset($error)){
				echo
				'<div class="sqlResultR">
					'.$error.'
				</div>';
			}
			else
			{
				echo
				'<div class="sqlResultR">
					Error: ' . $result . '<br> WITH SQL: ' . $query . '<br>' .mysqli_error($conn).'
				</div>'.
				'Error: ' . $result . '<br> WITH SQL: ' . $query . '<br>' .mysqli_error($conn);
			}
			$errorEmpty = TRUE;
		}
		if ($result === TRUE && !isset($error)) {
		
				// ARCHIVE
				$query = 'SELECT * FROM documents WHERE clientId = "'.$_POST['clientNum'].'" AND clientName="'.$_POST['name'].'" AND clientSurname="'.$_POST['surName'].'" AND yearHired="'.$_POST['yearHired'].'" AND workStartDate="'.$_POST['dateWorkStart'].'" AND workEndDate="'.$_POST['dateWorkEnd'].'" AND docType="'.$_POST['docType'].'" AND docImportance="'.$_POST['docImportance'].'" AND docSpace="'.$_POST['docSpace'].'" AND MMM="'.$_POST['MMM'].'" AND progress=""
				AND workerAsigned="'.$worker.'" AND comments="'.$_POST['comments'].'" AND userModified="'.$_SESSION['login'].'"';
				
				$result = mysqli_fetch_array(mysqli_query($conn, $query));
				if($result == false) echo 'Nie wprowadzono do logów</br>ERROR: '.mysqli_error($conn).' </br>WITH SQL: '.$query.'</br>';
				
				$query = 'INSERT INTO archive VALUES(NULL, "'.$_POST['clientNum'].'", "'.$_POST['name'].'", "'.$_POST['surName'].'", "'.$_POST['yearHired'].'", "'.$_POST['dateWorkStart'].'", "'.$_POST['dateWorkEnd'].'",
				"'.$_POST['docType'].'", "'.$_POST['docImportance'].'", "'.$_POST['docSpace'].'", "'.$_POST['MMM'].'", "", "'.$_POST['asignedTo'].'","'.$_POST['comments'].'", "'.$date.'", "'.$_SESSION['login'].'", "'.getUserIpAddr().'"
				, "'.$result['addedBy'].'", "'.$result['addedTime'].'" )';
				$result = mysqli_query($conn, $query);
				
				if($result == false) echo '</br>ERROR: '.mysqli_error($conn).' </br>WITH SQL: '.$query.'</br>';
		
		}
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
    <title><?php echo $tytul;?></title>
	<?php require_once 'components/header.php'; ?>
</head>
<body>
<script>
function copyToClip(str) {
  function listener(e) {
    e.clipboardData.setData("text/html", str);
    e.clipboardData.setData("text/plain", str);
    e.preventDefault();
  }
  document.addEventListener("copy", listener);
  document.execCommand("copy");
  document.removeEventListener("copy", listener);
};
</script>
	<?php  include 'components/navigation.php';  ?>
	<form method="POST" class="">
		<div><font size="3">
			<span><?php echo $nrklienta;?>:</span>
			<input type="text" name="clientNum" <?php if($next) echo 'value="'.$nextClientId.'"'; elseif(!empty($_POST['clientNum']) && $errorEmpty) echo 'value="'.$_POST['clientNum'].'"' ?>/>
			<a class="tooltip" href="#">(?)<span class="classic"><font size="2"><?php echo $opis1; ?></font></span></a>
		</div>
		<div>
			<span><?php echo $imie;?>:</span>
			<input type="text" name="name" <?php if($next) echo 'value="'.$nextName.'"'; elseif(!empty($_POST['name'])  && $errorEmpty) echo 'value="'.$_POST['name'].'"' ?>/>
		</div>
		<div>
			<span><?php echo $nazwisko;?>:</span>
			<input type="text" name="surName" <?php if($next) echo 'value="'.$nextSurname.'"'; elseif(!empty($_POST['surName']) && $errorEmpty) echo 'value="'.$_POST['surName'].'"' ?>/>
		</div>
		<div>
			<span><?php echo $rokzatrudnienia;?>:</span>
			<select name="yearHired" >
				<option value="" <?php if(!isset($_POST['yearHired']) && $errorEmpty) echo ' selected '; ?> ></option>
			<?php
				$sql = 'SELECT * FROM yearshired';
				$result = mysqli_query($conn, $sql);
				while($row = $result -> fetch_assoc()){
					echo '<option value="'.$row['year'].'"'; if($_POST['yearHired'] == $row['year'] && $errorEmpty) echo ' selected '; echo'>'.$row['year'].'</option>';
				}
			?>
			</select> <a class="tooltip" href="#">(?)<span class="classic"><font size="2"><?php echo $opis2; ?></font></span></a>
		</div>
		<div>
			<span><?php echo $rozpoczeciepracy;?>:</span>
			<input type="date" name="dateWorkStart" <?php if(!empty($_POST['dateWorkStart']) && $errorEmpty) echo 'value="'.$_POST['dateWorkStart'].'"' ?>/>
		<a class="tooltip" href="#">(?)<span class="classic"><font size="2"><?php echo $opis3; ?></font></span></a></div>
		<div>
			<span><?php echo $zakonczeniepracy;?>:</span>
			<input type="date" name="dateWorkEnd" <?php if(!empty($_POST['dateWorkEnd']) && $errorEmpty) echo 'value="'.$_POST['dateWorkEnd'].'"' ?>/>
		</div>
		<div>
			<span><?php echo $rodzajdokumentu;?>:</span>
			<select name="docType">
				<option value="" <?php if(!isset($_POST['yearHired']) && $errorEmpty) echo ' selected '; ?>></option>
			<?php
				$sql = 'SELECT * FROM doctypes';
				$result = mysqli_query($conn, $sql);
				while($row = $result -> fetch_assoc()){
					echo '<option value="'.$row['docType'].'"'; if($_POST['docType'] == $row['docType'] && $errorEmpty) echo ' selected '; echo' >'.$row['docType'].'</option>';
				}
				
			?>
			</select>
		</div>
		<div class="wybor">
			<span><BR><?php echo $waznoscdokumentu;?>:.................................</span><a class="tooltip" href="#">(?)<span class="classic"><font size="2"><?php echo $opis7; ?></font></span></a>
			<?php
					echo '			
						<label>
						<input type="radio" name="docImportance" id="'.$row['docImportance'].'" value="Nierozp" checked="checked">
							<span >Nierozp</span>
						</label>';
				
			?>
		</div>
		<div class="wybor">
			<span><?php echo $docSpace;?>:</span><br>
			<label>
				<input type="radio" name="docSpace" id="archiwum1" value="archiwum1" />
				<span>1</span>
			</label>
			<label>
				<input type="radio" name="docSpace" id="archiwum2" value="archiwum2"> 
				<span>2</span>
			</label>
			<?PHP
				if($errorEmpty){
						echo'
						<script>
							document.getElementById("'.$_POST['docSpace'].'").checked = true;
						</script>
						';
				}
			?>
		</div>
		<div>
			<span><?php echo $ogien;?>:</span>
			<select name="MMM" class="colorSelect">
				<option style="" value="" <?php if(!isset($_POST['MMM']) && $errorEmpty) echo ' selected '; ?>></option>
			<?php
				$sql = 'SELECT * FROM mmm ORDER BY id ASC';
				$result = mysqli_query($conn, $sql);
				$firstRow = true;
				while($row = $result -> fetch_assoc()){
					if(strpos($row['MMM'], "ogien") !== false){
						echo '<option style="color:red;" value="'.$row['MMM'].'"'; if(($_POST['MMM'] == $row['MMM'] && $errorEmpty) || $firstRow == true) echo ' selected '; echo' >'.$row['MMM'].'</option>';
					}
					$firstRow = false;
				}
			?>
			</select>
		</div>
		<div class="<?php echo $uwagi;?>">
		<br><span>Państwo:</span>.................................<a class="tooltip" href="#">(?)<span class="classic"><font size="2"><?php echo $opis4; ?></font></span></a><br>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('UK. ');">Wielka Brytania</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('DE. ');">Niemcy</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('NO. ');">Norwegia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('NL. ');">Holandia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('BE. ');">Belgia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('UE. - kierowca');">UE Kierowca</button><br>-----------------------------------------------------------<br>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('AT. ');">Austria</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('PT. ');">Azory</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('BG. ');">Bułgaria</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('HR. ');">Chorwacja</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('CY. ');">Cypr</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('CZ. ');">Czechy</button><br>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('DK. ');">Dania</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('EE. ');">Estonia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('FI. ');">Finlandia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('FR. ');">Francja</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('UK. ');">Gibraltar</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('GR. ');">Grecja</button><br>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('FR. ');">Gujana Francuska</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('FR. ');">Gwadelupa</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('ES. ');">Hiszpania</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('IE. ');">Irlandia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('IS. ');">Islandia</button><br>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('LI. ');">Lichtenstein</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('LT. ');">Litwa</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('LU. ');">Luksemburg</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('LV. ');">Łotwa</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('PT. ');">Madera</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('MT. ');">Malta</button><br>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('FR. ');">Martynika</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('PT. ');">Portugalia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('FR. ');">Reunion</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('RO. ');">Rumunia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('SK. ');">Słowacja</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('SI. ');">Słowenia</button><br>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('CH. ');">Szwajcaria</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('SE. ');">Szwecja</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('HU. ');">Węgry</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input('IT. ');">Włochy</button>
		
		
			<span><br><br><?php echo $uwagi;?>:.................................</span><a class="tooltip" href="#">(?)<span class="classic"><font size="2"><?php echo $opis5; ?></font></span></a><br>
			<textarea cols="30" rows="5" maxlength="100"id="<?php echo $uwagi;?>" type="text" name="comments" ><?php if ($errorEmpty )echo $_POST['comments'];?></textarea>
					</div>-----------------------------------------------------------<br>
		<button type="submit" name="add" class="saveUsers button">Dodaj Nowe</button>
		<button type="submit" name="addNext" class="saveUsers button">Dodaj Kolejny Wniosek</button>
		<button type="button" onclick="ClearForm()" class="new button">Wyczyść</button>
		<a class="tooltip" href="#">(?)<span class="classic"><font size="1"><?php echo $opis6; ?></font></span></a>
	</form>
	
	
	
	
	
	
	
	
		<div class="docList" style="margin-top: 50px;">
		<h3>Ostatnio Dodane</h3>
			<div class="doc info">
				<div class="clientNum">
					<a href="?orderby=clientId&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "clientId" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
						<span><?php echo $nrklienta;?></span><?php if($_GET['orderby'] == "clientId" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "clientId" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="clientName">
					<a href="?orderby=clientName&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "clientName" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
						<span><?php echo $imie;?></span><?php if($_GET['orderby'] == "clientName" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "clientName" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="clientSurname">
					<a href="?orderby=clientSurname&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "clientSurname" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
						<span><?php echo $nazwisko;?></span><?php if($_GET['orderby'] == "clientSurname" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "clientSurname" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="yearHired">
					<a href="?orderby=yearHired&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "yearHired" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span><?php echo $rokzatrudnienia;?></span><?php if($_GET['orderby'] == "yearHired" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "yearHired" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="dateWorkStart">
					<a href="?orderby=workStartDate&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "workStartDate" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span><?php echo $rozpoczeciepracy;?></span><?php if($_GET['orderby'] == "workStartDate" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workStartDate" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="dateWorkEnd">
					<a href="?orderby=workEndDate&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "workEndDate" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span><?php echo $zakonczeniepracy;?></span><?php if($_GET['orderby'] == "workEndDate" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workEndDate" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="docType">
					<a href="?orderby=docType&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "docType" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span><?php echo $rodzajdokumentu;?></span><?php if($_GET['orderby'] == "docType" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "docType" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="docImportance">
					<a href="?orderby=docImportance&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "docImportance" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span><?php echo $waznoscdokumentu;?></span><?php if($_GET['orderby'] == "docImportance" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "docImportance" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="progress">
					<a href="?orderby=progress&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "progress" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span><?php echo $stanwykonania;?></span><?php if($_GET['orderby'] == "progress" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "progress" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="asignedTo">
					<a href="?orderby=workerAsigned&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "workerAsigned" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span><?php echo $przypisanedo;?></span><?php if($_GET['orderby'] == "workerAsigned" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workerAsigned" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="comments">
					<a href="?orderby=comments&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "comments" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; ?> "> 
							
					<span><?php echo $uwagi;?></span><?php if($_GET['orderby'] == "comments" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
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
				<div class="copyRow">
				Kopiuj wiersz
				</div>
			</div>
	<?PHP
	$orderby = $_GET['orderby'];
	$order = $_GET['order'];
	if(!isset($_GET['orderby'])){
		$orderby = 'addedTime';
		$order = 'DESC';
	}
	$dateMinusDay = date('Y-m-d H:m:s', strtotime("-1 day"));
	$sql = 'SELECT * FROM documents WHERE addedBy="'.$_SESSION['login'].'" AND addedTime >= "'.$dateMinusDay.'" ORDER BY '.$orderby.' '.$order.' LIMIT 25';

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
		<div class="copyRow">
		<button onclick="copyToClip(document.getElementById(\'row'.++$idrow.'\').innerHTML)">Kopuj nr '.$doc['clientId'].'</button>
			<div id=row'.$idrow.' style="display:none"> BŁĄD KOLEJKI #### | NR- '.$doc['clientId'].' | I- '.$doc['clientName'].' | N- '.$doc['clientSurname'].' | O- '.$doc['yearHired'].' | G/Z- '.$doc['workStartDate'].' | UW- '.$doc['workEndDate'].' | RD- '.$doc['docType'].' | ST- '.$doc['docImportance'].' | K- '.$doc['comments'].' | U- '.$doc['userModified'].' | '.$doc['dateModified'].' | ################# | Prosze o zmianę danych w miejscu: NR- _ | I- _ | N- _ | O- _ | G/Z- _ | UW- _ | RD- _ |ST- _ | K- _ | U- _ </div>
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
		document.getElementById(docImp).checked = true;
		docType.selected = true;
	}
	function AddTo<?php echo $uwagi;?>Input(what){
		document.getElementById("<?php echo $uwagi;?>").value += what;
	}
	
	
	
	
	<?php if($next || ($errorEmpty && isset($_POST['docImportance']))) echo 'SelectNextFields("'.$_POST['docImportance'].'", "'.$_POST['docType'].'");'; ?>
	
</script>
<?php require 'components/footer.php'; ?>
<br><center>
<?php echo $stopa;?>
<br><br></center>
</body>

</html>
