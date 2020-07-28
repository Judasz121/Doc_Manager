<?php 
	if (($doc['docImportance'] === "Zagr-N" || $doc['docImportance'] === "art.97 kpa") && ($doc['progress'] === "P" ||$doc['progress'] === "Z")) {	
		echo'<select name="asignedTo['.$currId.']">
		<option value="'.$doc['workerAsigned'].'"'; echo 'selected'; echo'>'.$doc['workerAsigned'].'</option>
		</select></div>';
	} else {
	echo'<select name="asignedTo['.$currId.']">';
		
		foreach ($users as $workerId => $worker){
			echo '<option value="'.$worker['userName'].'"'; if($doc['workerAsigned'] == $worker['userName']) echo'selected'; echo ' >'.$worker['userName'].'</option>';
		}
		echo'
		<option value="NN"'; if($doc['workerAsigned'] == "NN") echo 'selected'; echo' >NN</option>
		</select>
		</div>';
	}
					
					
					
?>