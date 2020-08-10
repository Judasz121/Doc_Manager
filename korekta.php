<?php
//ini_set( 'display_errors', 'On' ); 
//error_reporting( E_ALL );
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('max_execution_time', '30');
session_start();
require_once 'korektaFunctions.php';


	if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false)
		header('Location: login.php');
	$query = 'SELECT * FROM users WHERE userName = "'.$_SESSION['login'].'"';
	$result = mysqli_query($conn, $query);
	while($user = $result -> fetch_assoc()){
		if($user['userName'] == $_SESSION['login'] && !( $user['accountType'] == "korespondencja" || $user['accountType'] == "archiwum" || $user['accountType'] == "admin"))
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
	
	<?php  include 'components/filtr_employee.php';?><br>
	
	
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
				<!----<div class="delete">
					<span>Usuń</span>
				</div>---->
				<div class="dateModified" >
					<a href="?orderby=dateModified&order=DESC<?php echo BuildSortQuery("orderby") ?> "> 
					<span><?php echo $ostatniazmiana;?> / <?php echo $dodal;?></span><?php if($_GET['orderby'] == "dateModified" && $_GET['order'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
												elseif($_GET['orderby'] == "dateModified" && $_GET['order'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
					</a>
				</div>
				
				
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
			///$documents = getAllDocumentsAssignedToUser($_SESSION['login'], $orderby, $order, $limitQuery);
			$documents = getAllDocumentsAssignedToUser($_SESSION['login'], $orderby, $order, $limitQuery, $filterQuery);
			if (!empty($documents)) {
			foreach($documents as $doc) {
				$currId = $doc['id'];
				
				echo'
			<div class="doc item '; $p = $doc['progress'];
				if($p == "N") echo 'blue'; elseif($p == "P") echo 'yellow'; elseif($p == "Z") echo 'orange'; elseif($p == "W") echo 'green'; elseif($p =="PP") echo 'ppcolor'; elseif($p =="WP") echo 'wpcolor'; elseif($p == "NP") echo 'npcolor';  echo'">
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
				
				<select name="progress['.$currId.']">
						
						<option value="NP"'; if($doc['progress'] === "NP") echo 'selected'; echo'>NP</option>
						
					</select>
				</div>
				<div class="asignedTo">
					<select name="asignedTo['.$currId.']">
							<option value="'.$doc['workerAsigned'].'"'; echo 'selected'; echo'>'.$doc['workerAsigned'].'</option>
							
						
					</select>
				</div>
				
				<div class="docSpace">
									<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'archiwum1" value="archiwum1"  onclick="javascript: return false;" />|
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'archiwum2" value="archiwum2"  onclick="javascript: return false;" >|
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'pracownik" value="pracownik" >
					</label>
				</div>
				';
				if($doc['docSpace'] != "")
					echo'
					<script>
						document.getElementById("id'.$currId.$doc['docSpace'].'").checked = true;
					</script>';
				echo'
				
				<div class="mmm">';
					if ($doc['MMM'] === "Ogień") { echo'<b><u><font color="red">'.$doc['MMM'].'</b></u></font>';} else echo $doc['MMM']; echo'
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
				<!-----<div class="deleteSelected" ><a class="tooltip" href="#">
					 X <span class="classic">Dokument może usunąć tylko osoba upoważniona</span></a>
				</div>----->
				<div class="dateModified" >
			<span>'.substr($doc['dateModified'],0,10).' || <a class="tooltip" href="#"></b><img src="ikony/time.png" width="10px" hight="10px";><span class="classic">Modyfikacja:<br> '.$doc['dateModified'].'<br> Utworzenie: '.$doc['addedTime'].'</span></a><b style="white-space: nowrap;"> -<a class="tooltip" href="#"></b><img src="ikony/b.png" width="15px" hight="15px";><span class="classic">Przydzielił: '.$doc['userModified'].'</span></a><a class="tooltip" href="#"></b><img src="ikony/b1.png" width="15px" hight="15px";><span class="classic">Dodał do Kolejki: '.$doc['addedBy'].'</span></a></b>
					</span>
				</div>
				
		
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
<center><?php echo $stopa;?></center>
<br><br>
</body>

</html>
