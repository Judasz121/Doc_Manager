<?php
	
	require_once 'connect.php';
	require_once 'archiveFunctions.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	mysqli_query($conn,"SET NAMES utf8");
	
	if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false)
		header('Location: login.php');
	$query = 'SELECT * FROM users WHERE userName = "'.$_SESSION['login'].'"';
	$result = mysqli_query($conn, $query);
	while($user = $result -> fetch_assoc()){
		if($user['userName'] == $_SESSION['login'] && !( $user['accountType'] == "kierownik" || $user['accountType'] == "dyrektor" || $user['accountType'] == "korespondencja" || $user['accountType'] == "admin"))
			header('Location: login.php');
	}	
	
	if(count($_POST) >= 1){
		$_SESSION['POST'] = serialize($_POST);
	}
	else{
		$_POST = unserialize($_SESSION['POST']);
	}
	
	$filterQuery = BuildFilterQuery();

	if(isset($_POST['NumofRowstoShow']))
		$limitQuery = BuildLimitQuery($_POST['NumofRowstoShow'], $filterQuery);
	else
		$limitQuery = BuildLimitQuery(25, $filterQuery);
	
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
	<form method="POST" class="doc-list" >
		<div class="doc filter"><!-----------------=================== FILTER ==============--------------------->
		<h1>Filtr</h1>
			<div class="clientNum">
				<span><?php echo $nrklienta;?></span>
				 <input type="text" name="filterClientNum" class="filter" value="<?php if(isset($_POST['filterClientNum'])) echo $_POST['filterClientNum']; ?>"/></span>
			</div>
			<div class="clientName">
				<span><?php echo $imie;?> klienta</span>
				<span><input type="text" name="filterClientName" class="filter" value="<?php if(isset($_POST['filterClientName'])) echo $_POST['filterClientName']; ?>"/></span>
			</div>
			<div class="clientSurname">
				<span><?php echo $nazwisko;?> klienta</span>
				<span><input type="text" name="filterClientSurname" class="filter" value="<?php if(isset($_POST['filterClientSurname'])) echo $_POST['filterClientSurname']; ?>"/></span>
			</div>
			<div class="yearHired">
				<span><?php echo $rokzatrudnienia;?></span>
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
				<span><?php echo $rozpoczeciepracy;?></span>
				<span>Od: <input type="date" name="filterWorkStartDateFrom" class="filter" value="<?php if(isset($_POST['filterWorkStartDateFrom'])) echo $_POST['filterWorkStartDateFrom']; ?>"/></span>
				<span>Do: <input type="date" name="filterWorkStartDateTo" class="filter" value="<?php if(isset($_POST['filterWorkStartDateTo'])) echo $_POST['filterWorkStartDateTo']; ?>"/></span>
			</div>
			<div class="workEndDate">
				<span><?php echo $zakonczeniepracy;?></span>
				<span>Od: <input type="date" name="filterWorkEndDateFrom" class="filter" value="<?php if(isset($_POST['filterWorkEndDateFrom'])) echo $_POST['filterWorkEndDateFrom']; ?>"/></span>
				<span>Do: <input type="date" name="filterWorkEndDateTo" class="filter" value="<?php if(isset($_POST['filterWorkEndDateTo'])) echo $_POST['filterWorkEndDateTo']; ?>"/></span>
			</div>
			<div class="DocType">
				<span><?php echo $rodzajdokumentu;?></span>
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
				<span><?php echo $waznoscdokumentu;?></span>
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
			<div class="docSpace">
				<span><?php echo $docSpace; ?></span>
				<select name="filterDocSpace" class="filter">
					<option value="" <?php if($_POST['filterDocSpace'] == "") echo 'selected'; ?>></option>

					<option value="archiwum1" <?php if($_POST['filterDocSpace'] == "archiwum1") echo 'selected'; ?>>Archiwum 1</option>
					<option value="archiwum2" <?php if($_POST['filterDocSpace'] == "archiwum2") echo 'selected'; ?>>Archiwum 2</option>
				</select>
			</div>
			<div class="MMM">
				<span><?php echo $ogien;?></span>
				<select name="filterMMM" class="filter">
					<option value=""></option>
				<?php

					foreach($MMM as $docId => $row){
						echo '			
						<option value="'.$row['MMM'].'" '; if($_POST['filterMMM'] == $row['MMM']) echo'selected '; echo '>'.$row['MMM'].'</option>';
					}
				?>
				</select>
			</div>
			<div class="progress">
				<span><?php echo $stanwykonania;?></span>
				<select name="filterProgress" class="filter">
					<option value=""></option>
					<option value="P"<?php if($_POST['filterProgress'] == "P") echo'selected '; ?>>P</option>
					<option value="Z"<?php if($_POST['filterProgress'] == "Z") echo'selected '; ?>>Z</option>
					<option value="W"<?php if($_POST['filterProgress'] == "W") echo'selected '; ?>>W</option>
				</select>
			</div>
			<div class="asignedTo">
				<span><?php echo $przypisanedo;?></span>
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
				<span><?php echo $uwagi;?></span>
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
				<span><?php echo $datadodania;?></span>
				<span>Od: <input type="datetime-local" name="filterDateAddedFrom" class="filter" value="<?php if(isset($_POST['filterDateAddedFrom'])) echo $_POST['filterDateAddedFrom']; ?>"/></span>
				<span>Do: <input type="datetime-local" name="filterDateAddedTo" class="filter" value="<?php if(isset($_POST['filterDateAddedTo'])) echo $_POST['filterDateAddedTo']; ?>"/></span>
			</div>
			
			<input type="submit" name="filter" value="Filtruj" class="button"/>
			<input type="button" value="Wyczyść" class="button" onclick="ClearFilterInputs()"/>
			<?php echo 'Ilość wpisów do archiwum:<b> '.$_SESSION['numofDocs'].'</b>. <i>Przetworzono '.$przetworzono = $_SESSION['numofDocs']- $a.' razy</i>';?>
		</div>
		
	<div class="pageselection">
<?php 
	
	if(isset($_GET['page']))
		$page = $_GET['page'];
	else 
		$page = 1;
	
	if(!($page - 20 <= 0))
	{
		echo'
		<a href="?page='.($page - 20);
		if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
		if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
		if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
		
		echo '" title="20 w lewo"> <b style="letter-spacing: -5px;" ><<</b> </a>';
	}
	if(!($page - 10 <= 0))
	{
		echo'
		<a href="?page='.($page - 10);
		if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
		if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
		if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
		
		echo '" title="10 w lewo"> <b><</b> </a>';
	}
	
	
	for($i=0; $i < 7; $i++){
		$currPage = $page + ($i - 3);
		
		if($currPage < 1 || $currPage > $_SESSION['numofPages'] + 1)
			continue;
		
		echo'
		<a href="?page='.$currPage;
		if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
		if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
		if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
		
		echo '"> '; if($page == $currPage) echo '<b>'.$currPage.'</b>'; else echo $currPage; echo' </a>';
	}
	
	
	if(!($page + 10 > $_SESSION['numofPages'] + 1))
	{
		echo'
		<a href="?page='.($page + 10);
		if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
		if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
		if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
		
		echo '" title="10 w prawo"> <b>></b> </a>';
	}
	if(!($page + 20 > $_SESSION['numofPages'] + 1))
	{
		echo'
		<a href="?page='.($page + 20);
		if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
		if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
		if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
		
		echo '" title="20 w prawo"> <b style="letter-spacing: -5px;" >>></b> </a>';
	}
	

?>
	</div>
		
		<!-----------------=================== FIRST ROW (COLUMN DESCRIPTION) ==============--------------------->
		<div class="docList" >
		
			<span class="limit">
				<input type="submit" name="PokazButton" value="Pokaż:" class="numofRowstoShow">
				<select name="NumofRowstoShow" class="numofRowstoShow">
				<!--	<option value="0" >Wszystkie</option> -->
					<option value="25"<?php if ($_POST['NumofRowstoShow'] == '25' || !isset($_POST['NumofRowstoShow'])) echo 'selected'; ?>>25</option>
					<option value="50"<?php if ($_POST['NumofRowstoShow'] == '50') echo 'selected'; ?>>50</option>
					<option value="75"<?php if ($_POST['NumofRowstoShow'] == '75') echo 'selected'; ?>>75</option>
					<option value="100"<?php if ($_POST['NumofRowstoShow'] == '100') echo 'selected'; ?>>100</option>
				</select>
			</span>
			
			<div class="doc info">
				<div class="clientNum">
					<a href="?orderby=clientId&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "clientId" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
						<span><?php echo $nrklienta;?></span><?php if($_GET['orderby'] == "clientId" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "clientId" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="clientName">
					<a href="?orderby=clientName&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "clientName" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
						<span><?php echo $imie;?></span><?php if($_GET['orderby'] == "clientName" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "clientName" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="clientSurname">
					<a href="?orderby=clientSurname&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "clientSurname" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
						<span><?php echo $nazwisko;?></span><?php if($_GET['orderby'] == "clientSurname" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "clientSurname" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="yearHired">
					<a href="?orderby=yearHired&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "yearHired" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
					<span><?php echo $rokzatrudnienia;?></span><?php if($_GET['orderby'] == "yearHired" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "yearHired" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="dateWorkStart">
					<a href="?orderby=workStartDate&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "workStartDate" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
					<span><?php echo $rozpoczeciepracy;?></span><?php if($_GET['orderby'] == "workStartDate" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workStartDate" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="dateWorkEnd">
					<a href="?orderby=workEndDate&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "workEndDate" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
					<span><?php echo $zakonczeniepracy;?></span><?php if($_GET['orderby'] == "workEndDate" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workEndDate" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="docType">
					<a href="?orderby=docType&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "docType" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
					<span><?php echo $rodzajdokumentu;?></span><?php if($_GET['orderby'] == "docType" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "docType" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="docImportance">
					<a href="?orderby=docImportance&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "docImportance" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
					<span><?php echo $waznoscdokumentu;?></span><?php if($_GET['orderby'] == "docImportance" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "docImportance" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="docSpace">
					<a href="?orderby=docSpace&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "docSpace" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> ">
					<span><?php echo $docSpace; ?></span><?php if($_GET['orderby'] == "docSpace" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "docSpace" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="MMM">
					<a href="?orderby=MMM&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "MMM" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> ">
					<span><?php echo $ogien; ?></span><?php if($_GET['orderby'] == "MMM" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "MMM" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="progress">
					<a href="?orderby=progress&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "progress" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
					<span><?php echo $stanwykonania;?></span><?php if($_GET['orderby'] == "progress" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "progress" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="asignedTo">
					<a href="?orderby=workerAsigned&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "workerAsigned" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
					<span><?php echo $przypisanedo;?></span><?php if($_GET['orderby'] == "workerAsigned" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workerAsigned" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="comments">
					<a href="?orderby=comments&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "comments" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
					<span><?php echo $uwagi;?></span><?php if($_GET['orderby'] == "comments" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "comments" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="dateModified" >
					<a href="?orderby=dateModified&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "dateModified" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
					<span>Data Modyfikacji</span><?php if($_GET['orderby'] == "dateModified" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "dateModified" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="userModified" >
					<a href="?orderby=userModified&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "userModified" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
					<span>Zmodyfikowane przez</span><?php if($_GET['orderby'] == "userModified" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "userModified" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="userIpModified" >
					<a href="?orderby=userIpModified&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "userIpModified" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
					<span>Ip modyfikującego</span><?php if($_GET['orderby'] == "userIpModified" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "userIpModified" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="userAdded" >
					<a href="?orderby=addedBy&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "addedBy" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby']; 
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
					<span>Dodane przez</span><?php if($_GET['orderby'] == "addedBy" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "addedBy" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="dateAdded" >
					<a href="?orderby=addedTime&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "addedTime" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> "> 
							
					<span><?php echo $datadodania;?></span><?php if($_GET['orderby'] == "addedTime" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "addedTime" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
			</div>
		
		
		<?PHP 
		
			// $limitQuery and $filterQuery defined at the start, before any output
			
			$orderby = $_GET['orderby'];
			$order = $_GET['order'];
			if(!isset($_GET['orderby'])){
				$orderby = 'id';
				$order = 'ASC';
			}

			$sql = 'SELECT * FROM archive '.$filterQuery.' ORDER BY '.$orderby.' '.$order.$limitQuery;
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
				<div class="docSpace">
					'.$doc['docSpace'].'
				</div>
				<div class="docSpace">
					'.$doc['MMM'].'
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
	<div class="pageselection">
<?php 
	
	if(isset($_GET['page']))
		$page = $_GET['page'];
	else 
		$page = 1;
	
	if(!($page - 20 <= 0))
	{
		echo'
		<a href="?page='.($page - 20);
		if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
		if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
		if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
		
		echo '" title="20 w lewo"> <b style="letter-spacing: -5px;" ><<</b> </a>';
	}
	if(!($page - 10 <= 0))
	{
		echo'
		<a href="?page='.($page - 10);
		if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
		if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
		if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
		
		echo '" title="10 w lewo"> <b><</b> </a>';
	}
	
	
	for($i=0; $i < 7; $i++){
		$currPage = $page + ($i - 3);
		
		if($currPage < 1 || $currPage > $_SESSION['numofPages'] + 1)
			continue;
		
		echo'
		<a href="?page='.$currPage;
		if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
		if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
		if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
		
		echo '"> '; if($page == $currPage) echo '<b>'.$currPage.'</b>'; else echo $currPage; echo' </a>';
	}
	
	
	if(!($page + 10 > $_SESSION['numofPages'] + 1))
	{
		echo'
		<a href="?page='.($page + 10);
		if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
		if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
		if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
		
		echo '" title="10 w prawo"> <b>></b> </a>';
	}
	if(!($page + 20 > $_SESSION['numofPages'] + 1))
	{
		echo'
		<a href="?page='.($page + 20);
		if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
		if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
		if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
		
		echo '" title="20 w prawo"> <b style="letter-spacing: -5px;" >>></b> </a>';
	}
	

?>
	</div>

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
<?php require 'components/footer.php'; ?>
<br><center>
<?php echo $stopa;?>
<br><br></center>
</body>

</html>
