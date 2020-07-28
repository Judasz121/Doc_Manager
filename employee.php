<?php
ini_set( 'display_errors', 'On' ); 
error_reporting( E_ALL );
session_start();
require_once 'employeeFunctions.php';
////error_reporting(E_ERROR | E_WARNING | E_PARSE);

	if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false)
		header('Location: login.php');
	$query = 'SELECT * FROM users WHERE userName = "'.$_SESSION['login'].'"';
	$result = mysqli_query($conn, $query);
	while($user = $result -> fetch_assoc()){
		if($user['userName'] == $_SESSION['login'] && !( $user['accountType'] == "pracownik" || $user['accountType'] == "koordynator" || $user['accountType'] == "admin"))
			header('Location: login.php');
	}
	
	
	if(count($_POST) >= 1)
		$_SESSION['POST'] = serialize($_POST);
	else{
		$_POST = unserialize($_SESSION['POST']);
		$dontSave = true;
	}
	
	
	// SAVE CHANGES
	if((isset($_POST['save']) || isset($_POST['saveOnlySelected'])) && $dontSave == false){
        $saveOnlySelected = false;
        if (isset($_POST['saveOnlySelected'])){
            $saveOnlySelected = true;
        }
        $result = SaveChanges($_POST['clientNum'], $_POST['clientNum'],$_POST['name'],$_POST['surName'],$_POST['yearHired'],$_POST['dateWorkStart'],$_POST['dateWorkEnd'],$_POST['docType'],$_POST['docImportance'], $_POST['docSpace'], $_POST['MMM'], $_POST['progress'],$_POST['asignedTo'],$_POST['comments'],$_POST['saveSelected'], $saveOnlySelected);
        echo $result;
	}
	
	
	$users = getAllUsers();
    $yearshired = getAllYearsHired();
    $docTypes = getAllDocTypes();
    $docimportances = getAllDocImportances();
	$MMM = getAllMMM();
	
	 $filterQuery = BuildFilterQuery();
	
	if(isset($_POST['NumofRowstoShow']))
		$limitQuery = BuildLimitQuery($_POST['NumofRowstoShow'], $filterQuery);
	else
		$limitQuery = BuildLimitQuery(25, $filterQuery);
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Doc Manger</title>
	<?php 
	require_once 'components/header.php';
	?>
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
<!---kod do popup -->


	<?php  include 'components/navigation.php';  ?>
	<style>
		
	</style> 
	
	<!---<table class="userLegend">
<tbody>
<tr>
<td style="background-color: yellow; width: 200px; text-align: center; vertical-align: middle;"><div data-tooltip="<?php echo $opisPa;?>">P<?php echo $opisP;?></div></td>
<td style="background-color: orange; width: 200px; text-align: center; vertical-align: middle;"><div data-tooltip="<?php echo $opisZa;?>">Z<?php echo $opisZ;?></div></td>
<td style="background-color: green; width: 200px; text-align: center; vertical-align: middle;"><div data-tooltip="<?php echo $opisWa;?>">W<?php echo $opisW;?></div></td>
</tr>
</tbody>
</table>--->
	
	<form method="POST" class="doc-list">
	
	<?php  include 'components/filtr_employee.php';
	
	if($_SESSION['accType'] == "koordynator" || $_SESSION['accType'] == "admin"){
		foreach($users as $user){
			if($user['userName'] == $_SESSION['login'])
				$group = $user['workerGroup'];
		}
		echo ' 
		<div class="workersTableOpenersContainer">
		Lista pracowników: <br>
		';
		foreach($users as $user){
			if($user['workerGroup'] == $group && $user['userName'] != $_SESSION['login']){
				echo'
				<button type="button" class="button workerTableOpener" id="'.$user['userName'].'" >'.$user['userName'].'</button>
			';
			}
			
		}
		echo'
		</div>
	<div id="workersTablePopup" ><div id="workersTableContainer"></div><div id="workersTableCloseButton"><i class="icon-cancel"></i></div> </div>
	';
	}
	?>
	
	<div class="biperContainer">
		<table>
		<thead>
		<tr>
			<th>Dokumenty</th>
			<th>Ilość</th>
		<tr>
		</thead>
		<tbody>
		<tr>
			<td>PP</td>
			<td id="PPDocsAmount"></td>
		</tr>
		</tbody>
		</table>
			<div id="PPalert">
				<div class="led-yellow"></div> Nowy dokument PP <i class="icon-cancel"style="float: right; cursor: pointer;"></i>
			</div>
			<div id="FIREalert">
				<div class="led-red"></div> <span> Nowy dokument <i class="icon-cancel" style="float: right; cursor: pointer;"></i> <br> "OGIEŃ"! </span>
			</div>
	</div>
	
<script>

</script>
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


		<div class="docList" style="margin-top: 50px;">
			<span class="limit">
				<input type="submit" name="PokazButton" value="Pokaż:" class="numofRowstoShow">
				<select name="NumofRowstoShow" class="numofRowstoShow">
				<!--	<option value="0" >Wszystkie</option> -->
					<option value="25"<?php if ($_POST['NumofRowstoShow'] == '25') echo 'selected'; ?>>25</option>
					<option value="50"<?php if ($_POST['NumofRowstoShow'] == '50') echo 'selected'; ?>>50</option>
					<option value="75"<?php if ($_POST['NumofRowstoShow'] == '75') echo 'selected'; ?>>75</option>
					<option value="100"<?php if ($_POST['NumofRowstoShow'] == '100') echo 'selected'; ?>>100</option>
				</select><?php echo '&nbsp;&nbsp;-&nbsp;&nbsp;Aktualnie masz przydzielonych spraw: <b>'.$_SESSION['numofDocs'].'</b>';?><BR>
			</span>
			<BR>
			<div class="doc info">
				<div class="clientNum">
					<a href="?orderby=clientId&order=DESC<?php echo BuildSortQuery("orderby") ?> "> 
						<span><?php echo $nrklienta;?></span>
						<?php if($_GET['orderby'] == "clientId" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
							elseif($_GET['orderby'] == "clientId" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="clientName">
					<a href="?orderby=clientName&order=DESC<?php echo BuildSortQuery("orderby") ?> "> 
						<span><?php echo $imie;?></span><?php if($_GET['orderby'] == "clientName" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "clientName" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="clientSurname">
					<a href="?orderby=clientSurname&order=DESC<?php echo BuildSortQuery("orderby") ?> "> 
						<span><?php echo $nazwisko;?></span><?php if($_GET['orderby'] == "clientSurname" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "clientSurname" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="yearHired">
					<a href="?orderby=yearHired&order=DESC<?php echo BuildSortQuery("orderby") ?> "> 
					<span><?php echo $rokzatrudnienia;?></span><?php if($_GET['orderby'] == "yearHired" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "yearHired" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="dateWorkStart">
					<a href="?orderby=workStartDate&order=DESC<?php echo BuildSortQuery("orderby") ?> "> 
					<span><?php echo $rozpoczeciepracy;?></span><?php if($_GET['orderby'] == "workStartDate" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workStartDate" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="dateWorkEnd">
					<a href="?orderby=workEndDate&order=DESC<?php echo BuildSortQuery("orderby") ?> "> 
					<span><?php echo $zakonczeniepracy;?></span><?php if($_GET['orderby'] == "workEndDate" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workEndDate" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="docType">
					<a href="?orderby=docType&order=DESC<?php echo BuildSortQuery("orderby") ?>"> 
					<span><?php echo $rodzajdokumentu;?></span><?php if($_GET['orderby'] == "docType" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "docType" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="docImportance">
					<a href="?orderby=docImportance&order=DESC<?php echo BuildSortQuery("orderby") ?> "> 
					<span><?php echo $waznoscdokumentu;?></span><?php if($_GET['orderby'] == "docImportance" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "docImportance" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="progress">
					<a href="?orderby=progress&order=DESC<?php echo BuildSortQuery("orderby") ?>"> 
					<span><?php echo $stanwykonania;?></span><?php if($_GET['orderby'] == "progress" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "progress" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="asignedTo">
					<a href="?orderby=workerAsigned&order=DESC<?php echo BuildSortQuery("orderby") ?> "> 
					<span><?php echo $przypisanedo;?></span><?php if($_GET['orderby'] == "workerAsigned" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "workerAsigned" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="docSpace">
					<a href="?orderby=docSpace&order=DESC<?php echo BuildSortQuery("orderby") ?>" >
					<span> 1 | 2</span><?php if($_GET['orderby'] == "docSpace" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
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
				<div class="comments">
					<a href="?orderby=comments&order=DESC<?php echo BuildSortQuery("orderby") ?>"> 
					<span><?php echo $uwagi;?></span><?php if($_GET['orderby'] == "comments" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "comments" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div class="saveSelected">
					<span>Zapisz</span>
				</div>
				<div class="edit">
				
				</div>
				<div class="delete">
					<span>Usuń</span>
				</div>
				<div class="dateModified" >
					<a href="?orderby=dateModified&order=DESC<?php echo BuildSortQuery("orderby") ?> "> 
					<span><?php echo $ostatniazmiana;?> / Dodał do kolejki</span><?php if($_GET['orderby'] == "dateModified" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "dateModified" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				<div>
				Monit Czasu
				</div>
				
				<div class="copy">Wycofaj</div>
				
				<div>Kopiuj dane</div>
				
			</div>
		
		
		<?PHP 
		 $years = getAllYearsHired();
		 $docTypes = getAllDocTypes();
		 $docImportances = getAllDocImportances();
		 $users = getAllUsers();
			//$limitQuery is defined at the start, before any output
			
			$orderby = $_GET['orderby'];
			$order = $_GET['order'];
			if(!isset($_GET['orderby'])){
				$orderby = 'id';
				$order = 'ASC';
			}
			$documents = getAllDocumentsAssignedToUser($_SESSION['login'], $orderby, $order, $limitQuery, $filterQuery);
			if (!empty($documents)) {
			foreach($documents as $doc) {
				$currId = $doc['id'];
				
				echo'
			<div class="doc item '; $p = $doc['progress'];
				if($p == "N") echo 'blue'; elseif($p == "P") echo 'yellow'; elseif($p == "Z") echo 'orange'; elseif($p == "W") echo 'green'; elseif($p =="PP") echo 'ppcolor'; elseif($p =="WP") echo 'wpcolor';  echo'">
				<div class="clientNum">
					<p class="docData'.$currId.'">'.$doc['clientId'].'</p>
					<input type="text" name="clientNum['.$currId.']" value="'.$doc['clientId'].'" class="hidden docInput'.$currId.'"/>
				</div>
				<div class="clientName">
					<p class="docData'.$currId.'">'.$doc['clientName'].'</p>
					<input type="text" name="name['.$currId.']" value="'.$doc['clientName'].'" class="hidden docInput'.$currId.'"/>
				</div>
				<div class="clientSurname">
					<p class="docData'.$currId.'">'.$doc['clientSurname'].'</p>
					<input type="text" name="surName['.$currId.']" value="'.$doc['clientSurname'].'" class="hidden docInput'.$currId.'"/>
				</div>
				<div class="yearHired">
					<p class="docData'.$currId.'">'.$doc['yearHired'].'</p>
					<select name="yearHired['.$currId.']" class="hidden docInput'.$currId.'">';

					foreach($years as $row){
						echo '<option value="'.$row['year'].'" '; if ($doc['yearHired'] == $row['year']) echo 'selected'; echo ' >'.$row['year'].'</option>';
					}
						


					echo '</select>
				</div>
				<div class="dateWorkStart">
					<p class="docData'.$currId.'">'.$doc['workStartDate'].'</p>
					<input type="date" name="dateWorkStart['.$currId.']" value="'.$doc['workStartDate'].'" class="hidden docInput'.$currId.'"/>
				</div>
				<div class="dateWorkEnd">
					<p class="docData'.$currId.'">'.$doc['workEndDate'].'</p>
					<input type="date" name="dateWorkEnd['.$currId.']" value="'.$doc['workEndDate'].'" class="hidden docInput'.$currId.'"/>
				</div>
				<div class="docType">
					<p class="docData'.$currId.'">'.$doc['docType'].'</p>
					<select name="docType['.$currId.']" class="hidden docInput'.$currId.'">';
						
						foreach($docTypes as $row){
							echo '<option value="'.$row['docType'].'" '; if($doc['docType'] == $row['docType']) echo'selected '; echo ' >'.$row['docType'].'</option>';
						}
						
						echo'
					</select>
				</div>
				<div class="docImportance">
					<select name="docImportance['.$currId.']">
						';
						foreach($docImportances as $row){
							echo '<option value="'.$row['docImportance'].'" '; if($doc['docImportance'] == $row['docImportance']) echo'selected '; echo ' >'.$row['docImportance'].'</option>';
						}
						echo' <!----------
						<option value="Koniec"'; if($doc['docImportance'] === "Koniec") echo 'selected'; echo'>Koniec</option>
						<option value="Pismo"'; if($doc['docImportance'] === "Pismo") echo 'selected'; echo'>Pismo</option>
						<option value="Zagr-N"'; if($doc['docImportance'] === "Zagr-N") echo 'selected'; echo'>Zagr-N</option>
						<option value="Koordy-N"'; if($doc['docImportance'] === "Koordy-N") echo 'selected'; echo'>Koordy-N</option>
						<option value="art.97 kpa"'; if($doc['docImportance'] === "art.97 kpa") echo 'selected'; echo'>art.97 kpa</option>
						<option value="W toku"'; if($doc['docImportance'] === "W toku") echo 'selected'; echo'>W toku</option>
						<option value="Projekt"'; if($doc['docImportance'] === "Projekt") echo 'selected'; echo'>Projekt</option>
						<option value="COVID-19"'; if($doc['docImportance'] === "COVID-19") echo 'selected'; echo'>COVID-19</option>--->
					</select>
					
				</div>';
				if ($doc['docImportance'] =="Koniec") {echo '<div style="background-color:#1AA71A; class="progress"><a class="tooltip" href="#">
					<font size="2"> √ </font><span class="classic">Dokument ma stan sprawy <B>"Koniec"</B> <BR> Musi być zmieniony stan wykonania na <B>"W"</B> </span></a>';
				} elseif ($doc['docImportance'] =="Projekt") {echo '<div style="background-color:#8AA64E; class="progress"><a class="tooltip" href="#">
					<font size="2">©</font><span class="classic">Projket przekazany do Sprawdzenia.<BR>Po otrzymaniu poprawionego pisma podejmij dalsze kroki</span></a>';
				}elseif ($doc['progress'] =="WP") {echo '<div class="progress"><a class="tooltip" href="#">
					<font size="2">♻</font><span class="classic">Teczka nie zarejestrowana w archiwum.<BR>Teczka musi być zdana do Archium</span></a>';
				} else echo'<div class="progress">';
				echo'
				
				<select name="progress['.$currId.']">';
						
						if ($doc['progress'] === "PP") { echo'
						<option value="PP"'; if($doc['progress'] === "PP") echo 'selected'; echo'>PP</option>';
						}else { echo'
						<option value="P"'; if($doc['progress'] === "P") echo 'selected'; echo'>P</option>
						<option value="Z"'; if($doc['progress'] === "Z") echo 'selected'; echo'>Z</option>
						<option value="WP"'; if($doc['progress'] === "WP") echo 'selected'; echo'>WP</option>';
						} echo'
					</select>
				
				<!-------------- PODSTAWOWY FILTR
					<select name="progress['.$currId.']" >
					
						
						<option value="P"'; if($doc['progress'] === "P") echo 'selected'; echo'>P</option>
						<option value="Z"'; if($doc['progress'] === "Z") echo 'selected'; echo'>Z</option>
						<option value="WP"'; if($doc['progress'] === "WP") echo 'selected'; echo'>WP</option>
						<option value="PP"'; if($doc['progress'] === "PP") echo 'selected'; echo'>PP</option>
					</select>--------->
				</div>
				<div class="asignedTo">
					<select name="asignedTo['.$currId.']">
							<option value="'.$doc['workerAsigned'].'"'; echo 'selected'; echo'>'.$doc['workerAsigned'].'</option>
							
						
					</select>
				</div>
				
				<div class="docSpace">';
					if (($doc['docSpace'] === "archiwum1" || $doc['docSpace'] === "archiwum2") && ($doc['progress'] === "P" || $doc['progress'] === "Z" || $doc['progress'] === "WP")){ echo '<a class="tooltip" href="#">
						<b>BŁĄD</b><span class="classic">Teczka nie moze być jednocześnie u pracownika i w archiwum <br><b> Poproś Archiwum o wydanie teczki <u>'.$doc['docSpace'].'</u></b></span></a>';
					} elseif ($doc['docSpace'] === "pracownik") { echo '<a class="tooltip" href="#">
						Wydano<span class="classic">Teczka jest w Twoim posiadaniu<br>Przy oddawaniu do piwnicy poproś o zmianę miejsca na A1 lub A2</span></a>';
					} elseif ($doc['docSpace'] === "archiwum1" || $doc['docSpace'] === "archiwum2"){ echo '<a class="tooltip" href="#">
						Archiwum<span class="classic">Teczka czeka na ciebie w Archiwum 1 lub 2</span></a>';
					} elseif ($doc['docSpace'] === "") { echo '<label>
							<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'pracownik" value="pracownik">
							</label><a class="tooltip" href="#">
						(!)<span class="classic">Jeśli jesteś w posiadaniu teczki <br><b> Odznacz pole i ZAPISZ</b></span></a>';
					} echo'
				</div>
				';
				if($doc['docSpace'] != "")
					echo'
					<script>
						document.getElementById("id'.$currId.$doc['docSpace'].'").checked = true;
					</script>';
				echo'
				
				<div class="mmm">
					'.$doc['MMM'].'
				</div>
				
				<div class="comments" >'; $commentLengh = strlen($doc['comments']); echo'
					<textarea type="text" id="comments" cols="20" rows="8" name="comments['.$currId.']" value="'.$doc['comments'].'" class="hidden docInput'.$currId.'" />'.$doc['comments'].'</textarea>
					<p class="docData'.$currId.'">'; 
					if ($commentLengh >=6) { echo '<a class="tooltip" href="#">'.substr($doc['comments'],0,10).' ✉<span class="classic"><font size="2"><b>Pełna treść uwagi</b><br>'.$doc['comments'].'</font></span></a></p>';
					} elseif ($commentLengh == 0) { echo '✗';
					}else echo $doc['comments'].'</p>';
					echo'
				</div>
				
				
				<div class="saveSelected" >
					<input type="checkbox" name="saveSelected['.$currId.']"  /><button type="submit" name="saveOnlySelected" class="managerkp"><img src="ikony/save.png" height="10px"></button>
				</div>
				<div class="editButton">
					<button type="button"  class="buttonokr" onclick="EditDoc('.$currId.')">Edytuj</button>
				</div>
				<div class="deleteSelected" ><a class="tooltip" href="#">
					 X <span class="classic">Dokument może usunąć tylko osoba upoważniona</span></a>
				</div>
				<div class="dateModified" >
			<span>'.substr($doc['dateModified'],0,10).' || <a class="tooltip" href="#"></b><img src="ikony/time.png" width="10px" hight="10px";><span class="classic">Modyfikacja:<br> '.$doc['dateModified'].'<br> Utworzenie: '.$doc['addedTime'].'</span></a><b style="white-space: nowrap;"> -<a class="tooltip" href="#"></b><img src="ikony/b.png" width="15px" hight="15px";><span class="classic">Przydzielił: '.$doc['userModified'].'</span></a><a class="tooltip" href="#"></b><img src="ikony/b1.png" width="15px" hight="15px";><span class="classic">Dodał do Kolejki: '.$doc['addedBy'].'</span></a></b>
					</span>
				</div>';
				
				$data1 = $doc['dateModified'];
				$datetime1 = new DateTime('NOW');
				$datetime2 = new DateTime($data1);
				$interval = $datetime1->diff($datetime2)->format('%R%a');
				$monitCzasu = $interval;
				///echo '>'; KOLUMNA MONITU
				if($interval >= 0+$czasP && $doc['progress'] === "P") { echo'<div style="background-color: #5DBB4B" ></div>';
				} elseif($interval >= 0+$czasP &&  $doc['progress'] === "P") { echo'<div style="background-color: #85C451" ><img src="ikony/gift.png" class="imgpulse" width="15px" hight="15px";></div>';
				} elseif(($interval >= -3+$czasP && $interval <= -1+$czasP ) &&  $doc['progress'] === "P") { echo'<div style="background-color: #85C451" ><img src="ikony/1.png" width="15px" hight="15px";>'.$interval.'</div>';
				} elseif(($interval >= -6+$czasP && $interval <=-4+$czasP ) &&  $doc['progress'] === "P") { echo'<div style="background-color: #ABD34E" ><img src="ikony/2.png" width="15px" hight="15px";>'.$interval.'</div>';
				} elseif(($interval >= -9+$czasP && $interval <=-7+$czasP ) &&  $doc['progress'] === "P") { echo'<div style="background-color: #FDC854" ><img src="ikony/3.png" width="15px" hight="15px";>'.$interval.'</div>';
				} elseif(($interval >= -12+$czasP && $interval <=-10+$czasP ) &&  $doc['progress'] === "P") { echo'<div tyle="background-color: #F79558" ><img src="ikony/4.png" class="imgpulse" width="15px" hight="15px";>'.$interval.'</div>';
				} elseif(($interval >= -14+$czasP && $interval <=-13+$czasP ) &&  $doc['progress'] === "P") { echo'<div class="monit5" ><a class="tooltip" href="#"><img src="ikony/5.png" width="15px" hight="15px";><b>'.$interval.' ! </b><span class="classic">Upływa Limit Czasu Przydzielenia <b>'.$doc['clientId'].'</b> <br>Podejmij jakieś działanie</span></a></div>';
				} elseif($interval <= -15+$czasP && $doc['progress'] === "P") { echo'<div><a class="tooltip" href="#"><p class="tekstblinking"><b>Zalega ! </p></b><span class="classic">Sprawa pozostaje przydzielona <b>dłużej niż 14 dni.</b><br>Zmień status sprawy na <b>Z</b> lub <b>W</b>. <br>Ewentualnie skopuj informacje i odeślij do kolejki</span></a></div>';
				} elseif(($monitCzasu+$monitCzasuPracy) == 0+$czasP && $doc['progress'] === "P") { echo'<div><a class="tooltip" href="#"><i>Ostatni Dzień</i><span class="classic">Pozostały 24h na zmienę statusu sprawy. </span></a></div>';
				}
				else echo '<div >'.$wynik11= $monitCzasu+$monitCzasuPracy.'</div>';
				///echo' ;">';
				
				if($interval <= -30+$czasP && $doc['progress'] === "Z" ) { echo'
				<div class="copyRow">
		<button class="buttonokr" onclick="copyToClip(document.getElementById(\'row'.++$idrow.'\').innerHTML)">Wycofaj nr '.$doc['clientId'].'</button>
			<div id=row'.$idrow.' style="display:none"> Prosze o wycofanie dokumentu nr '.$doc['clientId'].' '.$doc['clientName'].' '.$doc['clientSurname'].' O- '.$doc['yearHired'].'  | RD- '.$doc['docType'].' | ST- '.$doc['docImportance'].' | '.$doc['dateModified'].' | Dokument przedawnił się o '.$interval.' dni </div>
				</div>';} elseif(($monitCzasu+$monitCzasuPracy)< -15+$czasP  && $doc['progress'] === "P") { echo'<div > <button class="buttonokr" onclick="copyToClip(document.getElementById(\'row'.++$idrow.'\').innerHTML)">Kopuj nr '.$doc['clientId'].'</button> 
			<div id=row'.$idrow.' style="display:none"> Przesyłam dane dokumentu | NR- '.$doc['clientId'].' | I- '.$doc['clientName'].' | N- '.$doc['clientSurname'].' | O- '.$doc['yearHired'].' | G/Z- '.$doc['workStartDate'].' | UW- '.$doc['workEndDate'].' | RD- '.$doc['docType'].' | ST- '.$doc['docImportance'].' | K- '.$doc['comments'].' | U- '.$doc['userModified'].' | '.$doc['addedTime'].' W tej sprawię prosze o ..................</div></b></div>';
				} elseif($doc['progress'] === "P" && ($doc['docImportance'] === "art.97 kpa" || $doc['docImportance'] === "Zagr-N")) { echo'<div ><a class="tooltip" href="#">⚠ Z ⚠<span class="classic"><font size="2"><b>Stan Sprawy</b><br>Zmień Stan Wykonania na Z</font><br><font size="1"><i>Stan Sprawy jest ustawiony na '.$doc['docImportance'].'</i></font></span></a></div>';
				} elseif($doc['progress'] === "Z" && ($doc['docImportance'] === "art.97 kpa" || $doc['docImportance'] === "Zagr-N")) { echo'<div > <button class="buttonokr" onclick="copyToClip(document.getElementById(\'row'.++$idrow.'\').innerHTML)">Zwróć '.$doc['clientId'].'</button> 
			<div id=row'.$idrow.' style="display:none"> Prosze wycofać sprawę | NR- '.$doc['clientId'].' | I- '.$doc['clientName'].' | N- '.$doc['clientSurname'].' | O- '.$doc['yearHired'].' | G/Z- '.$doc['workStartDate'].' | UW- '.$doc['workEndDate'].' | RD- '.$doc['docType'].' | ST- '.$doc['docImportance'].' | K- '.$doc['comments'].' | U- '.$doc['userModified'].' | '.$doc['addedTime'].' </div></b></div>';
				} else echo '<div>X</div>';
		echo'
		<div class="copyRow">'; ////Kolumna ostatnia
		if(($monitCzasu+$monitCzasuPracy)< -15+$czasP && ($doc['progress'] === "P" || $doc['progress'] === "Z") && $doc['docImportance'] !== "Koniec"){ echo '⚠ ';
		} elseif($doc['progress'] === "Z" && ($doc['docImportance'] === "art.97 kpa" || $doc['docImportance'] === "Zagr-N")) { echo'<a class="tooltip" href="#">▒▒▒▒▒<span class="classic"><font size="2"><b>Stan Sprawy '.$doc['docImportance'].'</b><br>Sprawa powinna być <br>w Archiwum.<br><u>Zwróć Teczkę!</u></font></span></a>';
		}elseif (($monitCzasu+$monitCzasuPracy)< -15+$czasP && ($doc['progress'] === "P" || $doc['progress'] === "Z") && $doc['docImportance'] === "Koniec") { echo'<a class="tooltip" href="#">««««<span class="classic"><font size="2"><b>Stan Sprawy '.$doc['docImportance'].'</b><br>Zmień '.$stanwykonania.' na <B>"W"</B></u></font></span></a>';
		}
				
		else echo '
		<button class="buttonokr" onclick="copyToClip(document.getElementById(\'row'.++$idrow.'\').innerHTML)">Kopuj </button>
			<div id=row'.$idrow.' style="display:none"> Przesyłam dane dokumentu | NR- '.$doc['clientId'].' | I- '.$doc['clientName'].' | N- '.$doc['clientSurname'].' | O- '.$doc['yearHired'].' | G/Z- '.$doc['workStartDate'].' | UW- '.$doc['workEndDate'].' | RD- '.$doc['docType'].' | ST- '.$doc['docImportance'].' | K- '.$doc['comments'].' | U- '.$doc['userModified'].' | '.$doc['addedTime'].' W tej sprawię prosze o ..................</div>';
			echo'</div>
		
			</div>';
				
				
			}
			}
			
		?>

			
						<br><button type="submit" name="saveOnlySelected" class="saveUsers button">|----------Zapisz zaznaczone---------|</button><BR><BR>
						<!---<button type="submit" name="save" class="saveUsers button">Zapisz Wszystkie</button>--->
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
<?php require_once 'components/footer.php'; ?>
<center>
	<?php echo $stopa;?>
	<br><br>
</center>
</body>
</html>
