<?php 
	
	$addedByWorker = false;
	foreach($users as $user){
		if($doc['addedBy'] == $user['userName'] && ($user['accountType'] == "pracownik" || $user['accountType'] == "koordynator"))
			$addedByWorker = true;
	}


	if (($doc['docImportance'] === "Zagr-N" || $doc['docImportance'] === "art.97 kpa") && ($doc['progress'] === "P" ||$doc['progress'] === "Z" ||$doc['progress'] === "N")) {	
		echo'
		<select name="asignedTo['.$currId.']">
			<option value="'.$doc['workerAsigned'].'"'; echo 'selected'; echo'>'.$doc['workerAsigned'].'</option>
		</select></div>';
	}
	elseif(($doc['MMM'] === "Ogień" || $doc['MMM'] === "Zmiana") && ($doc['progress'] === "P" || $doc['progress'] === "Z")){
		echo'
	<select name="asignedTo['.$currId.']">';
						
						foreach ($users as $workerId => $worker){
							echo '<option value="'.$worker['userName'].'"'; if($doc['workerAsigned'] == $worker['userName']) echo'selected'; echo ' >'.$worker['userName'].'</option>';
						}
						echo'
						<option value="NN"'; if($doc['workerAsigned'] == "NN") echo 'selected'; echo' >NN</option>
					</select></div>';
	}
	elseif($doc['progress'] == "P"){
		echo'
		<select name="asignedTo['.$currId.']">
		<option value="'.$doc['workerAsigned'].'"'; echo 'selected'; echo'>'.$doc['workerAsigned'].'</option>
		</select>
		</div>';
	}
	elseif($doc['progress'] == "W" || $doc['progress'] == "WP"){
		echo'
		<select name="asignedTo['.$currId.']">
		<option value="'.$doc['workerAsigned'].'"'; echo 'selected'; echo'>'.$doc['workerAsigned'].'</option>
		</select>
		</div>';
	}
	elseif($doc['progress'] == "Z"){
		echo'
		<select name="asignedTo['.$currId.']">
		<option value="'.$doc['workerAsigned'].'"'; echo 'selected'; echo'>'.$doc['workerAsigned'].'</option>
		</select>
		</div>';
	}
	elseif($doc['progress'] == "NP" && $doc['workerAsigned'] == "NN" && $addedByWorker){
		echo'
		<select name="asignedTo['.$currId.']">
			<option value="NN" selected>NN</option>
			<option value="'.$doc['addedBy'].'" >'.$doc['addedBy'].'</option>
		</select>
		</div>';
	}
	
	elseif($doc['progress'] == "NP" && $doc['workerAsigned'] == "NN"){
		echo'
		<select name="asignedTo['.$currId.']">
			<option value="NN"'; echo 'selected'; echo'>NN</option>
		</select></div>';
	}
	elseif($doc['progress'] == "K" && $doc['workerAsigned'] == "→"){
		echo'
		<select name="asignedTo['.$currId.']">
		<option value="'.$doc['workerAsigned'].'"'; echo 'selected'; echo'>'.$doc['workerAsigned'].'</option>
		<option value="'.$_SESSION['login'].'"'; echo 'selected'; echo'>'.$_SESSION['login'].'</option>
		</select></div>';
	}
	else {
		echo'
		<select name="asignedTo['.$currId.']">';
		
		foreach ($users as $workerId => $worker){
			echo '<option value="'.$worker['userName'].'"'; if($doc['workerAsigned'] == $worker['userName']) echo'selected'; echo ' >'.$worker['userName'].'</option>';
		}
		echo'
		<option value="NN"'; if($doc['workerAsigned'] == "NN") echo 'selected'; echo' >NN</option>
		</select>
		</div>';
	}
					
					
					
?>