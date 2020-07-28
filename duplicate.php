
<?php
	
	require_once 'connect.php';
	require_once 'duplicateFunctions.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	mysqli_query($conn,"SET NAMES utf8");
	
	$query = 'SELECT * FROM users';
	$result = mysqli_query($conn, $query);
	if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false)
		header('Location: login.php');
    
    $dontSave = false; // check this later
	if(count($_POST) >= 1){
		$_SESSION['POST'] = serialize($_POST);
	}
	else{
        $_POST = unserialize($_SESSION['POST']);
        $dontSave = true;
    }

    if($dontSave == false && isset($_POST['duplicateRow'])){
        DuplicateRow($_POST['duplicateRow']);
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
	<form method="POST" class="doc-list" id="mainform">
    <?php require_once 'components/filtr.php'; ?>
		


        <div class="pageselection">
<?php 
	
	if(isset($_GET['page'])) {
        $page = $_GET['page'];
    }
	else {
        $page = 1;
    }
	
	if(!($page - 20 <= 0))
	{
		echo'
		<a href="?page='.($page - 20);
		echo BuildSortQuery("page");
		
		echo '" title="20 w lewo"> <b style="letter-spacing: -5px;" ><<</b> </a>';
	}
	if(!($page - 10 <= 0))
	{
		echo'
		<a href="?page='.($page - 10);
		echo BuildSortQuery("page");
		
		echo '" title="10 w lewo"> <b><</b> </a>';
	}
	
	
	for($i=0; $i < 7; $i++){
		$currPage = $page + ($i - 3);
		
		if($currPage < 1 || $currPage > $_SESSION['numofPages'] + 1)
			continue;
		
		echo'
		<a href="?page='.$currPage;
		echo BuildSortQuery("page");
		
		echo '"> '; if($page == $currPage) echo '<b>'.$currPage.'</b>'; else echo $currPage; echo' </a>';
	}
	
	
	if(!($page + 10 > $_SESSION['numofPages'] + 1))
	{
		echo'
		<a href="?page='.($page + 10);
		echo BuildSortQuery("page");
		
		echo '" title="10 w prawo"> <b>></b> </a>';
	}
	if(!($page + 20 > $_SESSION['numofPages'] + 1))
	{
		echo'
		<a href="?page='.($page + 20);
		echo BuildSortQuery("page");
		
		echo '" title="20 w prawo"> <b style="letter-spacing: -5px;" >>></b> </a>';
	}
?>
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
							
					<span><?php echo $datadodania;?></span><?php if($_GET['orderby'] == "addedTime" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "addedTime" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="duplicateRow">
				    Duplikuj wiersz
				</div>
			</div>
		
		
		<?PHP 
		
			$limit = NULL;
			if($_POST['NumofRowstoShow'] != "0" && isset($_POST['NumofRowstoShow']))
				$limit = ' LIMIT '.$_POST['NumofRowstoShow'];

			//$filterQuery and $limitQuery defined before any output
			
			$orderby = $_GET['orderby'];
			$order = $_GET['order'];
			if(!isset($_GET['orderby'])){
				$orderby = 'id';
				$order = 'ASC';
			}

			$sql = 'SELECT * FROM documents '.$filterQuery.' ORDER BY '.$orderby.' '.$order.$limitQuery;
			$result = mysqli_query($conn, $sql);
			
			if ($result->num_rows > 0 && $filterQuery != false) {
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
                <div class="duplicateRow">
                    <input type="submit" name="duplicateRow" value="Duplikuj Wpis" id="duplicate'.$doc['id'].'">
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
		echo BuildSortQuery("page");
		
		echo '" title="20 w lewo"> <b style="letter-spacing: -5px;" ><<</b> </a>';
	}
	if(!($page - 10 <= 0))
	{
		echo'
		<a href="?page='.($page - 10);
		echo BuildSortQuery("page");
		
		echo '" title="10 w lewo"> <b><</b> </a>';
	}
	
	
	for($i=0; $i < 7; $i++){
		$currPage = $page + ($i - 3);
		
		if($currPage < 1 || $currPage > $_SESSION['numofPages'] + 1)
			continue;
		
		echo'
		<a href="?page='.$currPage;
		echo BuildSortQuery("page");
		
		echo '"> '; if($page == $currPage) echo '<b>'.$currPage.'</b>'; else echo $currPage; echo' </a>';
	}
	
	
	if(!($page + 10 > $_SESSION['numofPages'] + 1))
	{
		echo'
		<a href="?page='.($page + 10);
		echo BuildSortQuery("page");
		
		echo '" title="10 w prawo"> <b>></b> </a>';
	}
	if(!($page + 20 > $_SESSION['numofPages'] + 1))
	{
		echo'
		<a href="?page='.($page + 20);
		echo BuildSortQuery("page");
		
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
<?php require_once 'components/footer.php'; ?>
<?php echo $stopa;?>
<br><br></center>
</body>

</html>
