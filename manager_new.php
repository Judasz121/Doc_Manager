<?php

	require_once 'connect.php';
	require_once 'managerFunctions_new.php';
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
		if($user['userName'] == $_SESSION['login'] && !( $user['accountType'] == "kierownik" || $user['accountType'] == "dyrektor" || $user['accountType'] == "admin"))
			header('Location: login.php');
	}	


	if(count($_POST) >= 1){
		$_SESSION['POST'] = serialize($_POST);
	}
	else{
		$_POST = unserialize($_SESSION['POST']);
		$dontSave = true;
	}

	if($dontSave == false && (isset($_POST['save']) || isset($_POST['saveOnlySelected']))) {
	    $saveOnlySelected = false;
	    if (isset($_POST['saveOnlySelected'])){
	        $saveOnlySelected = true;
        }
        $result = SaveChanges($_POST['clientNum'], $_POST['clientNum'],$_POST['name'],$_POST['surName'],$_POST['yearHired'],$_POST['dateWorkStart'],$_POST['dateWorkEnd'],$_POST['docType'],$_POST['docImportance'],$_POST['docSpace'],$_POST['MMM'],$_POST['progress'],$_POST['asignedTo'],$_POST['comments'],$_POST['saveSelected'],$_POST['deleteSelected'], $saveOnlySelected);
        echo $result;
    }

    $users = getAllUsers();
    $yearshired = getAllYearsHired();
    $docTypes = getAllDocTypes();
    $docimportances = getAllDocImportances();
	$MMMs = getAllMMMs();

	$filterQuery = BuildFilterQuery();

	if(isset($_POST['NumofRowstoShow']))
		$limitQuery = BuildLimitQuery($_POST['NumofRowstoShow'], $filterQuery);
	else
		$limitQuery = BuildLimitQuery(25, $filterQuery);

?>



<!DOCTYPE html>
<html>
<head>
    <title><?php echo $tytul; ?></title>
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
	<form method="POST" class="doc-list">
	<div class="clientDocList container">
		<table class="clientDocList">
			<tbody>
			<tr>
				<td>
				<a href="?clientTableOrderby=clientId&clientTableOrder=<?php if( isset($_GET['clientTableOrderby']) && $_GET['clientTableOrderby'] == "clientId" && $_GET['clientTableOrder'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
							if(isset($_GET['progressTableOrderby'])) echo '&progressTableOrderby='.$_GET['progressTableOrderby'].'&progressTableOrder='.$_GET['progressTableOrder'];
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?>">
					<?php echo $nrklienta;?>
					<?php if($_GET['clientTableOrderby'] == "clientId" && $_GET['clientTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>';
					elseif($_GET['clientTableOrderby'] == "clientId" && $_GET['clientTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>';
					?>
				</a>
				</td>
				<td>
				<a href="?clientTableOrderby=numofDocs&clientTableOrder=<?php if( isset($_GET['clientTableOrderby']) && $_GET['clientTableOrderby'] == "numofDocs" && $_GET['clientTableOrder'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
							if(isset($_GET['progressTableOrderby'])) echo '&progressTableOrderby='.$_GET['progressTableOrderby'].'&progressTableOrder='.$_GET['progressTableOrder'];
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?>">
					Liczba Dokumentów
					<?php if($_GET['clientTableOrderby'] == "numofDocs" && $_GET['clientTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>';
					elseif($_GET['clientTableOrderby'] == "numofDocs" && $_GET['clientTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
				</a>
				</td>
			</tr>
			<?php
			if(!empty($_POST['filterNumOfDocsPerClientFrom']) || !empty($_POST['filterNumOfDocsPerClientTo'])){
			    $from = null;
			    if (isset($_POST['filterNumOfDocsPerClientFrom'])){
			        $from = $_POST['filterNumOfDocsPerClientFrom'];
                }

			    $to = null;
			    if (isset($_POST['filterNumOfDocsPerClientTo'])){
			        $to = $_POST['filterNumOfDocsPerClientTo'];
                }
			    $orderBy = 'clientId';
			    if (isset($_GET['clientTableOrderby'])) {
                    $orderBy = $_GET['clientTableOrderby'];
                }
			    $orderSort = 'ASC';
			    if (isset($_GET['clientTableOrder'])){
                    $orderSort = $_GET['clientTableOrder'];
                }
			    $clients = getClientStatistics($from, $to, $orderBy, $orderSort);
                foreach($clients as $client) {
                    echo '<tr><td>'.$client['clientId'].'</td><td>'.$client['numofDocs'].'</td></tr>';
                }
			}
			else {
                echo '<style> table.clientDocList{display: none;} </style>';
            }
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
	
	<?php include 'components/podzial.php';?> <!-----< TABELA PODZIAŁU SPRAW --->
	<?php include 'components/filtr.php';?> <!-----< FILTR --->	



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

		echo '" title="20 w prawo"> <b style="letter-spacing: -5px;">>></b> </a>';
	}


?>
	</div>
		<!-----------------=================== FIRST ROW (COLUMN DESCRIPTION) ==============--------------------->
		<div class="docList">
		
			<span class="limit">
				<input type="submit" name="PokazButton" value="Pokaż:" class="numofRowstoShow ">
				<select name="NumofRowstoShow" class="numofRowstoShow">
				<!--	<option value="0" >Wszystkie</option> -->
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
					<span><?php echo $docSpace;?></span><?php if($_GET['orderby'] == "docSpace" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
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
				<div style="background-color:#C0C0C0" class="progress">
					<a href="?orderby=progress&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "progress" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> ">

					<span><?php echo $stanwykonania;?></span><?php if($_GET['orderby'] == "progress" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>';
												elseif($_GET['orderby'] == "progress" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div  style="background-color:#C0C0C0" class="asignedTo">
					<a href="?orderby=workerAsigned&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "workerAsigned" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> ">

					<span><?php echo $przypisanedo;?></span><?php if($_GET['orderby'] == "workerAsigned" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>';
												elseif($_GET['orderby'] == "workerAsigned" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div style="background-color:#C0C0C0" class="saveSelected">
					<span>Zapisz</span>
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
				
				
				<div class="saveSelected">
					<span>Kopiuj</span>
				</div>
				<div class="dateModified" >
					<a href="?orderby=dateModified&order=<?php if( isset($_GET['orderby']) && $_GET['orderby'] == "dateModified" && $_GET['order'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
					<?php 	if(isset($_GET['progressTableOrder'])) echo'&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
							if(isset($_GET['clientTableOrder'])) echo'&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
							if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?> ">

					<span><?php echo $ostatniazmiana;?></span><?php if($_GET['orderby'] == "dateModified" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>';
												elseif($_GET['orderby'] == "dateModified" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
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
				<div style="background-color:#F0CDBD" class="saveSelected">
					<span>Usuń</span>
				</div>
			</div>

				<!-----------------=================== TABLE OF DOCS ==============--------------------->
		<?PHP



			// $limitQuery and $filterQuery defined at the start, before any output

			$orderby = $_GET['orderby'];
			$order = $_GET['order'];
			if(!isset($_GET['orderby'])){
				$orderby = 'id';
				$order = 'ASC';
			}

			$sql = 'SELECT * FROM documents '.$filterQuery.' ORDER BY '.$orderby.' '.$order.$limitQuery;
			$result = mysqli_query($conn, $sql);
			//if($result == false) echo'</br> ERROR: '.mysqli_error($conn).'</br> WITH SQL: '.$sql;


			if ($result->num_rows > 0) {
			while($doc = $result->fetch_assoc()) {
				$currId = $doc['id'];

				echo'
			<div class="doc item '; $p = $doc['progress'];
				if($p == "N") echo 'blue'; elseif($p == "P") echo 'yellow'; elseif($p == "Z") echo 'orange'; elseif($p == "W") echo 'green'; elseif($p =="PP") echo 'ppcolor'; elseif($p =="WP") echo 'wpcolor'; elseif($p == "NP") echo 'npcolor' ; elseif($p == "K") echo 'kcolor';  echo'">
				<div class="clientNum">
					<input type="text" name="clientNum['.$currId.']" value="'.$doc['clientId'].'"/>
				</div>
				<div class="clientName">
					<input type="text" name="name['.$currId.']" value="'.$doc['clientName'].'"/>
				</div>
				<div class="clientSurname">
					<input type="text" name="surName['.$currId.']" value="'.$doc['clientSurname'].'"/>
				</div>
				<div class="yearHired">
					<select name="yearHired['.$currId.']" >';

					foreach($yearshired as $yearId => $row){
						echo '<option value="'.$row['year'].'" '; if ($doc['yearHired'] == $row['year']) echo 'selected'; echo ' >'.$row['year'].'</option>';
					}



					echo '</select>
				</div>
				<div class="dateWorkStart">
					<input type="date" name="dateWorkStart['.$currId.']" value="'.$doc['workStartDate'].'"/>
				</div>
				<div class="dateWorkEnd">
					<input type="date" name="dateWorkEnd['.$currId.']" value="'.$doc['workEndDate'].'"/>
				</div>
				<div class="docType">
					<select name="docType['.$currId.']">';
						foreach($docTypes as $docTypeId => $row){
							echo '<option value="'.$row['docType'].'" '; if($doc['docType'] == $row['docType']) echo'selected '; echo ' >'.$row['docType'].'</option>';
						}
						echo'
					</select>
				</div>
				<div class="docImportance">
					<select name="docImportance['.$currId.']">';


						foreach($docimportances as $docimportanceId => $row){
							echo '<option value="'.$row['docImportance'].'" '; if($doc['docImportance'] == $row['docImportance']) echo'selected '; echo ' >'.$row['docImportance'].'</option>';
						}
						echo'
					</select>
					
				</div>	
				<div class="docSpace" style="inline">';
				
				include "components/przypisanie_manager.php";
				
				 echo'
				</div>
				<div class="mmm">
					<select name="MMM['.$currId.']" class="colorSelect">
					<option value=" "'; if($doc['MMM'] == " ") echo ' selected '; echo'></option>';

					$sql = 'SELECT * FROM mmm';
					$res = mysqli_query($conn, $sql);
					while($row = $res -> fetch_assoc()){
					if(strpos($row['MMM'], "ogien") !== false){
					echo '<option style="color:red;" value="'.$row['MMM'].'"'; if($doc['MMM'] == $row['MMM']) echo ' selected '; echo' >'.$row['MMM'].'</option>';
					}
					else{echo '<option style="" value="'.$row['MMM'].'"'; if($doc['MMM'] == $row['MMM']) echo ' selected '; echo' >'.$row['MMM'].'</option>';}
					}
					echo'
					</select>

					</div>
				<div class="progress">
				
					<select name="progress['.$currId.']">';
						if ($doc['progress'] === "N") { echo'
							<option value="N"'; if($doc['progress'] === "N") echo 'selected'; echo'>N</option>
							<option value="PP"'; if($doc['progress'] === "PP") echo 'selected'; echo'>PP</option>';
							
						}elseif ($doc['progress'] === "NP") {
							$addedByWorker = false;
							foreach($users as $user){
								if(($user['accountType'] == 'pracownik' || $user['accountType'] == "koordynator") && $user['userName'] == $doc['addedBy']){
									echo'
									<option value="NP"'; if($doc['progress'] === "NP") echo 'selected'; echo'>NP</option>
									<option value="P"'; if($doc['progress'] === "P") echo 'selected'; echo'>P</option>';
									$addedByWorker = true;
								}
							}
							if($addedByWorker == false){
								echo'
								<option value="NP"'; if($doc['progress'] === "NP") echo 'selected'; echo'>NP</option>';
							}
						}
						elseif ($doc['progress'] === "PP") { echo'
							<option value="PP"'; if($doc['progress'] === "PP") echo 'selected'; echo'>PP</option>
							<option value="P"'; if($doc['progress'] === "P") echo 'selected'; echo'>P</option>';
						}elseif ($doc['progress'] === "K" && ($doc['docSpace'] === "pracownik" || $doc['docSpace'] === "archiwum1" || $doc['docSpace'] === "archiwum2")) { echo'
							<option value="K"'; if($doc['progress'] === "K") echo 'selected'; echo'>K</option>
							</select> <a class="tooltip" href="#">
					[!]<span class="classic"><b> Odbierz Teczkę </b><br> Musisz zaznaczyć, że posiadasz teczkę</span></a>';
						}
						elseif ($doc['progress'] === "K"  && $doc['docSpace'] === "kierownik" ) { echo'
							<option value="K"'; if($doc['progress'] === "K") echo 'selected'; echo'>K</option>
							<option value="PP"'; if($doc['progress'] === "PP") echo 'selected'; echo'>PP</option>';
						}elseif ($doc['progress'] === "W") { echo'
							<option value="W"'; if($doc['progress'] === "W") echo 'selected'; echo'>W</option></select> <a class="tooltip" href="#">
					<img src="ikony/check.png" width="15px" hight="15px"><span class="classic"><b> Sprawa Wykonana </b><br> Sprawa została wykonana i mozna ją jedynie ponowić jako nową - "Duplikuj". <br><i>Sprawę może przywrócić jedynie SuperAdmin</i></span></a>';
						}elseif ($doc['progress'] !== "N") { echo'
							<option value="N"'; if($doc['progress'] === "N") echo 'selected'; echo'>N</option>
							<option value="PP"'; if($doc['progress'] === "PP") echo 'selected'; echo'>PP</option>
							<option value="P"'; if($doc['progress'] === "P") echo 'selected'; echo'>P</option>
							<option value="Z"'; if($doc['progress'] === "Z") echo 'selected'; echo'>Z</option>
							<option value="WP"'; if($doc['progress'] === "WP") echo 'selected'; echo'>WP</option>
							<option value="W"'; if($doc['progress'] === "W") echo 'selected'; echo'>W</option>';
						}elseif($doc['progress'] === "NN"){ echo'
							<option value="P"'; if($doc['progress'] === "P") echo 'selected'; echo'>P</option>';
						}
						
						
						
					echo'
					</select>
					</div>
				<div class="asignedTo">';?> <!--------------plik algorytmu--->
				<?php include "components/przypisanie.php";?>
				<?php
				echo'
				<div class="saveSelected" >
					<input type="checkbox" name="saveSelected['.$currId.']"  /><button type="submit" name="saveOnlySelected" class="managerkp"><img src="ikony/save.png" height="10px"></button>
				</div>'; $commentLengh = strlen($doc['comments']); echo'
				
				<div class="comments" >';
				if ($commentLengh >=4) { echo '<table border="0">
  <tr>
				<td><a class="tooltip" href="#">✉<span class="classic"><font size="2"><b>Pełna treść uwagi</b><br>'.$doc['comments'].'</font></span></a></td>'; } else echo'<table border="0">
  <tr>
				<td>✗</td>';
				echo'
    <td><input type="text" size="10" name="comments['.$currId.']" value="'.$doc['comments'].'" /></td>
  </tr>
</table>
					
				</div>
				

				<div class="copySelected" >
					<div class="copyRow">
		<button class="managerkp" onclick="copyToClip(document.getElementById(\'row'.++$idrow.'\').innerHTML)">K</button>
			<div id=row'.$idrow.' style="display:none"> ISTNIEJĄCE DANE #### | NR- '.$doc['clientId'].' | I- '.$doc['clientName'].' | N- '.$doc['clientSurname'].' | O- '.$doc['yearHired'].' | G/Z- '.$doc['workStartDate'].' | UW- '.$doc['workEndDate'].' | RD- '.$doc['docType'].' | ST- '.$doc['docImportance'].' | K- '.$doc['comments'].' | U- '.$doc['userModified'].' | '.$doc['dateModified'].' | ################# | Podaj zmiany: NR- _ | I- _ | N- _ | O- _ | G/Z- _ | UW- _ | RD- _ |ST- _ | K- _ | U- _ </div>
			
			<button class="managerkp" onclick="copyToClip(document.getElementById(\'row'.++$idrow.'\').innerHTML)">P</button>
			<div id=row'.$idrow.' style="display:none"> Sprawa Nr. '.$doc['clientId'].'  '.$doc['clientName'].'  '.$doc['clientSurname'].'. Okres '.$doc['yearHired'].', Rodzaj '.$doc['docType'].' Przydzielono: '.$doc['workerAsigned'].'</div>
			
		</div>
				</div>
				<div class="dateModifiedA" >
					<span>'.$doc['dateModified'].' <b style="white-space: nowrap;">- '.$doc['userModified'].'</b></span>
				</div>
				<div class="dateAddedA" >
					<span>'.$doc['addedTime'].' <b style="white-space: nowrap;">- '.$doc['addedBy'].'</b></span>
				</div>
								<div style="background-color:#D16433" class="deleteSelected" >
					<input type="checkbox" name="deleteSelected['.$currId.']"  />
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
<br> 
			<button type="submit" name="saveOnlySelected" class="saveUsers button">||---------------Zapisz zaznaczone------------||</button><BR><BR><BR>
			<button type="submit" name="save" class="saveUsers button">Zapisz wszystkie</button>
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

		echo '" title="20 w prawo"> <b style="letter-spacing: -5px;">>></b> </a>';
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
