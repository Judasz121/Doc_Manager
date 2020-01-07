<?php

	require_once 'connect.php';
	require_once 'employeeFunctions.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	mysqli_query($conn,"SET NAMES utf8");
	
	if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false)
		header('Location: login.php');
	
	
	// SAVE CHANGES
	if(isset($_POST['save']) || isset($_POST['saveOnlySelected'])){
		SaveChanges();
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
	<style>
		
	</style>
	<form method="POST" class="doc-list">
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
					<?php if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby']; ?> "> 
						<span>Nr klienta</span><?php if($_GET['orderby'] == "clientId" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "clientId" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="clientName">
					<a href="?orderby=clientName&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "clientName" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby']; ?> "> 
						<span>Imię</span><?php if($_GET['orderby'] == "clientName" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "clientName" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="clientSurname">
					<a href="?orderby=clientSurname&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "clientSurname" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby']; ?> "> 
						<span>Nazwisko</span><?php if($_GET['orderby'] == "clientSurname" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "clientSurname" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="yearHired">
					<a href="?orderby=yearHired&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "yearHired" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby']; ?> "> 
					<span>Rok zatrudnienia</span><?php if($_GET['orderby'] == "yearHired" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "yearHired" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="dateWorkStart">
					<a href="?orderby=workStartDate&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "workStartDate" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby']; ?> "> 
					<span>Rozpoczęcie pracy</span><?php if($_GET['orderby'] == "workStartDate" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workStartDate" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="dateWorkEnd">
					<a href="?orderby=workEndDate&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "workEndDate" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby']; ?> "> 
					<span>Zakończenie pracy</span><?php if($_GET['orderby'] == "workEndDate" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workEndDate" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="docType">
					<a href="?orderby=docType&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "docType" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby']; ?> "> 
					<span>Rodzaj dokumentu</span><?php if($_GET['orderby'] == "docType" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "docType" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="docImportance">
					<a href="?orderby=docImportance&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "docImportance" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby']; ?> "> 
					<span>Ważność dokumentu</span><?php if($_GET['orderby'] == "docImportance" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "docImportance" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="progress">
					<a href="?orderby=progress&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "progress" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby']; ?> "> 
					<span>Stan wykonania</span><?php if($_GET['orderby'] == "progress" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "progress" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="asignedTo">
					<a href="?orderby=workerAsigned&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "workerAsigned" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby']; ?> "> 
					<span>Przypisane do</span><?php if($_GET['orderby'] == "workerAsigned" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workerAsigned" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="comments">
					<a href="?orderby=comments&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "comments" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby']; ?> "> 
					<span>Uwagi</span><?php if($_GET['orderby'] == "comments" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "comments" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="saveSelected">
					<span>Zapisz</span>
				</div>
				<div class="edit">
				
				</div>
				<div class="dateModified" >
					<a href="?orderby=dateModified&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "dateModified" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby']; ?> "> 
					<span>Ostatnia Zmiana</span><?php if($_GET['orderby'] == "dateModified" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "dateModified" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
			</div>
		
		
		<?PHP 
		
			$limit = NULL;
			if($_POST['NumofRowstoShow'] != "0" && isset($_POST['NumofRowstoShow']))
				$limit = ' LIMIT '.$_POST['NumofRowstoShow'];
			
			$orderby = $_GET['orderby'];
			$order = $_GET['order'];
			if(!isset($_GET['orderby'])){
				$orderby = 'id';
				$order = 'ASC';
			}
			$sql = 'SELECT * FROM documents WHERE workerAsigned="'.$_SESSION['login'].'" AND progress != "N" AND progress != "W" ORDER BY '.$orderby.' '.$order.$limit;
		
			$result = mysqli_query($conn, $sql);
			
			if ($result->num_rows > 0) {
			while($doc = $result->fetch_assoc()) {
				$currId = $doc['id'];
				
				echo'
			<div class="doc item '; $p = $doc['progress'];
				if($p == "N") echo 'blue'; elseif($p == "P") echo 'yellow'; elseif($p == "Z") echo 'orange'; elseif($p == "W") echo 'green';  echo'">
				<div class="clientNum">
					<p class="docData'.$currId.'">'.$doc['clientId'].'</p>
					<input type="text" name="clientNum'.$currId.'" value="'.$doc['clientId'].'" class="hidden docInput'.$currId.'"/>
				</div>
				<div class="clientName">
					<p class="docData'.$currId.'">'.$doc['clientName'].'</p>
					<input type="text" name="name'.$currId.'" value="'.$doc['clientName'].'" class="hidden docInput'.$currId.'"/>
				</div>
				<div class="clientSurname">
					<p class="docData'.$currId.'">'.$doc['clientSurname'].'</p>
					<input type="text" name="surName'.$currId.'" value="'.$doc['clientSurname'].'" class="hidden docInput'.$currId.'"/>
				</div>
				<div class="yearHired">
					<p class="docData'.$currId.'">'.$doc['yearHired'].'</p>
					<select name="yearHired'.$currId.'" class="hidden docInput'.$currId.'">';

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
					<p class="docData'.$currId.'">'.$doc['workStartDate'].'</p>
					<input type="date" name="dateWorkStart'.$currId.'" value="'.$doc['workStartDate'].'" class="hidden docInput'.$currId.'"/>
				</div>
				<div class="dateWorkEnd">
					<p class="docData'.$currId.'">'.$doc['workEndDate'].'</p>
					<input type="date" name="dateWorkEnd'.$currId.'" value="'.$doc['workEndDate'].'" class="hidden docInput'.$currId.'"/>
				</div>
				<div class="docType">
					<p class="docData'.$currId.'">'.$doc['docType'].'</p>
					<select name="docType'.$currId.'" class="hidden docInput'.$currId.'">
					
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
					<select name="progress'.$currId.'" >
						
						<option value="N"'; if($doc['progress'] === "N") echo 'selected'; echo'>N</option>
						<option value="P"'; if($doc['progress'] === "P") echo 'selected'; echo'>P</option>
						<option value="Z"'; if($doc['progress'] === "Z") echo 'selected'; echo'>Z</option>
						<option value="W"'; if($doc['progress'] === "W") echo 'selected'; echo'>W</option>
					</select>
				</div>
				<div class="asignedTo">
					<p class="docData'.$currId.'">'.$doc['workerAsigned'].'</p>
					<select name="asignedTo'.$currId.'" class="hidden docInput'.$currId.'">';
					
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
					<input type="text" name="comments'.$currId.'" value="'.$doc['comments'].'" class="hidden docInput'.$currId.'" />
					<p class="docData'.$currId.'">'.$doc['comments'].'</p>
				</div>
				<div class="saveSelected" >
					<input type="checkbox" name="saveSelected'.$currId.'"  />
				</div>
				<div class="editButton">
					<button type="button" onclick="EditDoc('.$currId.')">Edytuj</button>
				</div>
				<div class="dateModified" >
					<span>'.$doc['dateModified'].' <b style="white-space: nowrap;">- '.$doc['userModified'].'</b></span>
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

			
			<button type="submit" name="save" class="saveUsers button">Zapisz Wszystkie</button>
			<button type="submit" name="saveOnlySelected" class="saveUsers button">Zapisz zaznaczone</button>
		</div>
	</form>


<script>
	function EditDoc(id){
	//	document.querySelector(".docData").classList.add("hidden");
	//	document.querySelector(".docInput"+id).classList.remove("hidden");
		
		var inputs = document.querySelectorAll(".docInput"+id), i, paragraphs = document.querySelectorAll(".docData"+id);

		for (i = 0; i < inputs.length; ++i) {
		  inputs[i].classList.remove("hidden");
		  paragraphs[i].classList.add("hidden");
		}
	}
</script>
<script src="script.js?v=<?php echo rand(1, 1000000) ?>"></script>
</body>

</html>
