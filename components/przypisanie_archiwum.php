<?php 
	$addedByWorker = false;
	foreach($users as $user){
		if($doc['addedBy'] == $user['userName'] && ($user['accountType'] == "pracownik" || $user['accountType'] == "koordynator"))
			$addedByWorker = true;
	}


	if($doc['progress'] == "NP" && $doc['workerAsigned'] == "NN" && $addedByWorker){
		echo'
						<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'archiwum1" value="archiwum1"  onclick="javascript: return false;" />|
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'archiwum2" value="archiwum2"  onclick="javascript: return false;" >|
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'pracownik" value="pracownik"  >|
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'kierownik" value="kierownik" onclick="javascript: return false;" >
					</label>
				</div>
				';
				if($doc['docSpace'] != "")
					echo'
					<script>
						document.getElementById("id'.$currId.$doc['docSpace'].'").checked = true;
					</script>
		';
	}
	elseif($doc['progress'] == "K"){
		echo'
						<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'archiwum1" value="archiwum1"  onclick="javascript: return false;" />|
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'archiwum2" value="archiwum2"  onclick="javascript: return false;" >|
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'pracownik" value="pracownik" onclick="javascript: return false;" >||
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'kierownik" value="kierownik" >
					</label>
				</div>
				';
				if($doc['docSpace'] != "")
					echo'
					<script>
						document.getElementById("id'.$currId.$doc['docSpace'].'").checked = true;
					</script>
		';
	}
	elseif($doc['progress'] == "PP"){
		echo'
						<label>
						<input type="radio" name="archiwum1" id="archiwum1" value="archiwum1"  onclick="javascript: return false;" >|
					</label>
					<label>
						<input type="radio" name="archiwum2" id="archiwum2" value="archiwum2"  onclick="javascript: return false;" >|
					</label>
					<label>
						<input type="radio" name="pracownik" id="pracownik" value="pracownik" onclick="javascript: return false;" >||
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'kierownik" value="kierownik"  checked >
					</label><br><a class="tooltip" href="#">
					<img src="ikony/lock.png" width="12px" hight="12px"><span class="classic"><b> Teczka Zatrzymana </b><br> Teczka została automatycznie zatrzymana u kierownika. Pracownik może potwierdzić odbiór teczki w swoim panelu </span></a>
				</div>
				';
				if($doc['docSpace'] != "")
					echo'
					<script>
						document.getElementById("id'.$currId.$doc['docSpace'].'").checked = true;
					</script>
		';
	}
	else {
		echo'				
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'archiwum1" value="archiwum1"  onclick="javascript: return false;" />|
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'archiwum2" value="archiwum2"  onclick="javascript: return false;" >|
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'pracownik" value="pracownik"  onclick="javascript: return false;" >||
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'kierownik" value="kierownik" onclick="javascript: return false;" >
					</label>
				</div>
				';
				if($doc['docSpace'] != "")
					echo'
					<script>
						document.getElementById("id'.$currId.$doc['docSpace'].'").checked = true;
					</script>'
		;
		}
		
		
		
		
	
					
					
					
?>