<?php 

require_once '../employeeFunctions.php';
require_once '../slownik/slownik.php';


function BuildSortQueryForWorkersTable(){
	$query = "";
		
	if(isset($_REQUEST['workersTableOrder']) && $_REQUEST['workersTableOrder'] == 'ASC') 
		$query .= '&workersTableOrder=DESC';
	elseif(isset($_REQUEST['workersTableOrder']) && $_REQUEST['workersTableOrder'] == 'DESC') 
		$query .= '&workersTableOrder=ASC';
	
	return $query;
}




echo'
<table class="workerDocsTable">
<thead>
<tr>
	<th>
		<a class="workerTableSortLink" id="?workersTableOrderby=clientId&workersTableOrder=DESC' . BuildSortQuery("workersTableOrderby") . '"> 
		<span>'.$nrklienta.'</span>';
		if($_REQUEST['workersTableOrderby'] == "clientId" && $_REQUEST['workersTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
		elseif($_REQUEST['workersTableOrderby'] == "clientId" && $_REQUEST['workersTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>';
		echo'
	</th>
	<th>
		<a class="workerTableSortLink" id="?workersTableOrderby=clientName&workersTableOrder=DESC' . BuildSortQueryForWorkersTable("workersTableOrderby") . '"> 
		<span>'.$imie.'</span>';
		if($_REQUEST['workersTableOrderby'] == "clientName" && $_REQUEST['workersTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
		elseif($_REQUEST['workersTableOrderby'] == "clientName" && $_REQUEST['workersTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>';
		echo'
	</th>
	<th>
		<a class="workerTableSortLink" id="?workersTableOrderby=clientSurname&workersTableOrder=DESC' . BuildSortQueryForWorkersTable("workersTableOrderby") . '"> 
		<span>'.$nazwisko.'</span>';
		if($_REQUEST['workersTableOrderby'] == "clientSurname" && $_REQUEST['workersTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
		elseif($_REQUEST['workersTableOrderby'] == "clientSurname" && $_REQUEST['workersTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>';
		echo'
	</th>
	<th>
		<a class="workerTableSortLink" id="?workersTableOrderby=yearHired&workersTableOrder=DESC' . BuildSortQueryForWorkersTable("workersTableOrderby") . '"> 
		<span>'.$rokzatrudnienia.'</span>';
		if($_REQUEST['workersTableOrderby'] == "yearHired" && $_REQUEST['workersTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
		elseif($_REQUEST['workersTableOrderby'] == "yearHired" && $_REQUEST['workersTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>';
		echo'
	</th>
	<th>
		<a class="workerTableSortLink" id="?workersTableOrderby=workStartDate&workersTableOrder=DESC' . BuildSortQueryForWorkersTable("workersTableOrderby") . '"> 
		<span>'.$rozpoczeciepracy.'</span>';
		if($_REQUEST['workersTableOrderby'] == "workStartDate" && $_REQUEST['workersTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
		elseif($_REQUEST['workersTableOrderby'] == "workStartDate" && $_REQUEST['workersTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>';
		echo'
	</th>
	<th>
		<a class="workerTableSortLink" id="?workersTableOrderby=workEndDate&workersTableOrder=DESC' . BuildSortQueryForWorkersTable("workersTableOrderby") . '"> 
		<span>'.$zakonczeniepracy.'</span>';
		if($_REQUEST['workersTableOrderby'] == "workEndDate" && $_REQUEST['workersTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
		elseif($_REQUEST['workersTableOrderby'] == "workEndDate" && $_REQUEST['workersTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>';
		echo'
	</th>
	<th>
		<a class="workerTableSortLink" id="?workersTableOrderby=docType&workersTableOrder=DESC' . BuildSortQueryForWorkersTable("workersTableOrderby") . '"> 
		<span>'.$rodzajdokumentu.'</span>';
		if($_REQUEST['workersTableOrderby'] == "docType" && $_REQUEST['workersTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
		elseif($_REQUEST['workersTableOrderby'] == "docType" && $_REQUEST['workersTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>';
		echo'
	</th>
	<th>
		<a class="workerTableSortLink" id="?workersTableOrderby=docImportance&workersTableOrder=DESC' . BuildSortQueryForWorkersTable("workersTableOrderby") . '"> 
		<span>'.$waznoscdokumentu.'</span>';
		if($_REQUEST['workersTableOrderby'] == "docImportance" && $_REQUEST['workersTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
		elseif($_REQUEST['workersTableOrderby'] == "docImportance" && $_REQUEST['workersTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>';
		echo'
	</th>
	<th>
		<a class="workerTableSortLink" id="?workersTableOrderby=progress&workersTableOrder=DESC' . BuildSortQueryForWorkersTable("workersTableOrderby") . '"> 
		<span>'.$stanwykonania.'</span>';
		if($_REQUEST['workersTableOrderby'] == "progress" && $_REQUEST['workersTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
		elseif($_REQUEST['workersTableOrderby'] == "progress" && $_REQUEST['workersTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>';
		echo'
	</th>
	<th>
		<a class="workerTableSortLink" id="?workersTableOrderby=comments&workersTableOrder=DESC' . BuildSortQueryForWorkersTable("workersTableOrderby") . '"> 
		<span>'.$uwagi.'</span>';
		if($_REQUEST['workersTableOrderby'] == "comments" && $_REQUEST['workersTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
		elseif($_REQUEST['workersTableOrderby'] == "comments" && $_REQUEST['workersTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>';
		echo'
	</th>
	<th>
		<a class="workerTableSortLink" id="?workersTableOrderby=dateModified&workersTableOrder=DESC' . BuildSortQueryForWorkersTable("workersTableOrderby") . '"> 
		<span>'.$ostatniazmiana.' / Dodał do kolejki</span>';
		if($_REQUEST['workersTableOrderby'] == "dateModified" && $_REQUEST['workersTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>'; 
		elseif($_REQUEST['workersTableOrderby'] == "dateModified" && $_REQUEST['workersTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>';
		echo'
	</th>
	<th>Monit Czasu</th>
</tr>
<thead>
<tbody>';
if(isset($_REQUEST['workersTableOrderby']) && isset($_REQUEST['workersTableOrder']))
	$documents = getAllDocumentsAssignedToUser($_REQUEST['userName'], $_REQUEST['workersTableOrderby'], $_REQUEST['workersTableOrder'], "", "");
else
	$documents = getAllDocumentsAssignedToUser($_REQUEST['userName'], "id", "ASC", "", "");
foreach($documents as $doc){
	echo'
	<tr class="';
			$p = $doc['progress'];
			if($p == "N") echo 'blue';
			elseif($p == "P") echo 'yellow';
			elseif($p == "Z") echo 'orange';
			elseif($p == "W") echo 'green';
			elseif($p =="PP") echo 'ppcolor';
			elseif($p =="WP") echo 'wpcolor';
			echo'">
		<td>'.$doc['clientId'].'</td>
		<td>'.$doc['clientName'].'</td>
		<td>'.$doc['clientSurname'].'</td>
		<td>'.$doc['yearHired'].'</td>
		<td>'.$doc['workStartDate'].'</td>
		<td>'.$doc['workEndDate'].'</td>
		<td>'.$doc['docType'].'</td>
		<td>'.$doc['docImportance'].'</td>
		<td>'.$doc['progress'].'</td>
		<td>';
			$commentLengh = strlen($doc['comments']);
			echo'
			<textarea type="text" id="comments" cols="20" rows="8" name="comments['.$currId.']" value="'.$doc['comments'].'" class="hidden docInput'.$currId.'" />'.$doc['comments'].'</textarea>
			<p class="docData'.$currId.'">'; 
			if ($commentLengh >=6) { 
				echo '<a class="tooltip" href="#">'.substr($doc['comments'],0,10).' ✉<span class="classic"><font size="2"><b>Pełna treść uwagi</b><br>'.$doc['comments'].'</font></span></a></p>';
			} elseif ($commentLengh == 0) { 
				echo '✗';
			}else 
				echo $doc['comments'].'</p>';
			echo
		'</td>
		<td>
			<span>'.substr($doc['dateModified'],0,10).' ||
			<a class="tooltip" href="#"></b><img src="ikony/time.png" width="10px" hight="10px";><span class="classic">Modyfikacja:<br> '.$doc['dateModified'].'<br> Utworzenie: '.$doc['addedTime'].'</span></a><b style="white-space: nowrap;"> -<a class="tooltip" href="#"></b><img src="ikony/b.png" width="15px" hight="15px";><span class="classic">Przydzielił: '.$doc['userModified'].'</span></a><a class="tooltip" href="#"></b><img src="ikony/b1.png" width="15px" hight="15px";><span class="classic">Dodał do Kolejki: '.$doc['addedBy'].'</span></a></b>
		</td>';
		
		$data1 = $doc['dateModified'];
		$datetime1 = new DateTime('NOW');
		$datetime2 = new DateTime($data1);
		$interval = $datetime1->diff($datetime2)->format('%R%a');
		$monitCzasu = $interval;
		///echo '>'; KOLUMNA MONITU
		if($interval >= 0+$czasP && $doc['progress'] === "P")
			echo'<td style="background-color: #5DBB4B" ></td>';
		elseif($interval >= 0+$czasP &&  $doc['progress'] === "P") 
			echo'<td style="background-color: #85C451" ><img src="ikony/gift.png" class="imgpulse" width="15px" hight="15px";></td>';
		elseif(($interval >= -3+$czasP && $interval <= -1+$czasP ) &&  $doc['progress'] === "P") 
			echo'<td style="background-color: #85C451" ><img src="ikony/1.png" width="15px" hight="15px";>'.$interval.'</td>';
		elseif(($interval >= -6+$czasP && $interval <=-4+$czasP ) &&  $doc['progress'] === "P")
			echo'<td style="background-color: #ABD34E" ><img src="ikony/2.png" width="15px" hight="15px";>'.$interval.'</td>';
		elseif(($interval >= -9+$czasP && $interval <=-7+$czasP ) &&  $doc['progress'] === "P")
			echo'<td style="background-color: #FDC854" ><img src="ikony/3.png" width="15px" hight="15px";>'.$interval.'</td>';
		elseif(($interval >= -12+$czasP && $interval <=-10+$czasP ) &&  $doc['progress'] === "P")
			echo'<td tyle="background-color: #F79558" ><img src="ikony/4.png" class="imgpulse" width="15px" hight="15px";>'.$interval.'</td>';
		elseif(($interval >= -14+$czasP && $interval <=-13+$czasP ) &&  $doc['progress'] === "P")
			echo'<td class="monit5" ><a class="tooltip" href="#"><img src="ikony/5.png" width="15px" hight="15px";><b>'.$interval.' ! </b><span class="classic">Upływa Limit Czasu Przydzielenia <b>'.$doc['clientId'].'</b> <br>Podejmij jakieś działanie</span></a></td>';
		elseif($interval <= -15+$czasP && $doc['progress'] === "P")
			echo'<td><a class="tooltip" href="#"><p class="tekstblinking"><b>Zalega ! </p></b><span class="classic">Sprawa pozostaje przydzielona <b>dłużej niż 14 dni.</b><br>Zmień status sprawy na <b>Z</b> lub <b>W</b>. <br>Ewentualnie skopuj informacje i odeślij do kolejki</span></a></td>';
		elseif(($monitCzasu+$monitCzasuPracy) == 0+$czasP && $doc['progress'] === "P")	
			echo'<td><a class="tooltip" href="#"><i>Ostatni Dzień</i><span class="classic">Pozostały 24h na zmienę statusu sprawy. </span></a></td>';
		else 
			echo '<td >'.$wynik11= $monitCzasu+$monitCzasuPracy.'</td>';
	echo'
	</tr>
	';
}
echo'
</tbody>
</table>';
?>