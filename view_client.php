<?php
	
	require_once 'connect.php';
	require_once 'view_clientFunctions.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	mysqli_query($conn,"SET NAMES utf8");
	
	$query = 'SELECT * FROM users';
	$result = mysqli_query($conn, $query);
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
	<form method="POST" class="doc-list" >
		<div class="doc filter"><!-----------------=================== FILTER ==============--------------------->
			<div class="clientNum">
				<span><?php echo $nrklienta;?></span>
				 <input type="text" name="filterClientNum" class="filter" value="<?php if(isset($_POST['filterClientNum'])) echo $_POST['filterClientNum']; ?>"/></span>
			</div>
			
			<input type="submit" name="filter" value="Pokaż" class="button"/>
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
				<div class="copyRow">
				Kopiuj wiersz
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

			$sql = 'SELECT * FROM documents '.$filterQuery.' ORDER BY '.$orderby.' '.$order.$limit;
		
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
				<div class="copyRow">
					<button onclick="copyToClip(document.getElementById(\'row'.++$idrow.'\').innerHTML)">Kopuj nr '.$doc['clientId'].'</button>
						<div id=row'.$idrow.' style="display:none"> BŁĄD KOLEJKI #### | NR- '.$doc['clientId'].' | I- '.$doc['clientName'].' | N- '.$doc['clientSurname'].' | O- '.$doc['yearHired'].' | G/Z- '.$doc['workStartDate'].' | UW- '.$doc['workEndDate'].' | RD- '.$doc['docType'].' | ST- '.$doc['docImportance'].' | K- '.$doc['comments'].' | U- '.$doc['userModified'].' | '.$doc['dateModified'].' | ################# | Prosze o zmianę danych w miejscu: NR- _ | I- _ | N- _ | O- _ | G/Z- _ | UW- _ | RD- _ |ST- _ | K- _ | U- _ </div>
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
<?php require_once 'components/footer.php'; ?>
<center><?php echo $stopa;?></center>
<br><br>
</body>

</html>
