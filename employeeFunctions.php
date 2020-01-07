<?PHP

	require_once 'connect.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	mysqli_query($conn,"SET NAMES utf8");

	

	
	function SaveChanges(){
		global $conn;
		
		$query = "SELECT COUNT(*) FROM documents";
		$result = mysqli_fetch_array(mysqli_query($conn, $query));
		$numOfRows = $result["COUNT(*)"];
		$currId = 0;
		
		for($i = 0; $i < $numOfRows; $i++){
			$query = 'SELECT * FROM documents WHERE id > '.$currId.' ORDER BY id ASC';
			$doc = mysqli_fetch_array(mysqli_query($conn, $query));
			$currId = $doc['id'];
			if(!empty($_POST['clientNum'.$currId])){
				
				if(isset($_POST['saveOnlySelected']) && !isset($_POST['saveSelected'.$currId]))
					continue;
				
				$date = date('Y-m-d H:i:s');
				if(empty($_POST['dateWorkEnd'.$currId])) $_POST['dateWorkEnd'.$currId] = "0000-00-00";
				if(empty($_POST['dateWorkStart'.$currId])) $_POST['dateWorkStart'.$currId] = "0000-00-00";
				
				$query = 'UPDATE documents SET clientId = "'.$_POST['clientNum'.$currId].'", clientName="'.$_POST['name'.$currId].'", clientSurname="'.$_POST['surName'.$currId].'", yearHired="'.$_POST['yearHired'.$currId].'",
				workStartDate="'.$_POST['dateWorkStart'.$currId].'", workEndDate="'.$_POST['dateWorkEnd'.$currId].'", docType="'.$_POST['docType'.$currId].'",docImportance="'.$_POST['docImportance'.$currId].'",
				progress="'.$_POST['progress'.$currId].'", workerAsigned="'.$_POST['asignedTo'.$currId].'", comments="'.$_POST['comments'.$currId].'", dateModified="'.$date.'", userModified="'.$_SESSION['login'].'"
				WHERE id="'.$currId.'"';
				$result = mysqli_query($conn, $query);
				
				if ($result == TRUE) {
					$resultInfo .= "Dokument z nr klienta ".$_POST['clientNum'.$currId]." zapisano </br>";
				} else {
					$resultInfo .= "Error: " . $result . "<br>" . $query . "</br>" .mysqli_error($conn).'</div>';
				}
				
				// ARCHIVE
				$query = 'SELECT * FROM documents WHERE clientId = "'.$_POST['clientNum'.$currId].'" AND clientName="'.$_POST['name'.$currId].'" AND clientSurname="'.$_POST['surName'.$currId].'" AND yearHired="'.$_POST['yearHired'.$currId].'" AND
				workStartDate="'.$_POST['dateWorkStart'.$currId].'" AND workEndDate="'.$_POST['dateWorkEnd'.$currId].'" AND docType="'.$_POST['docType'.$currId].'" AND docImportance="'.$_POST['docImportance'.$currId].'" AND progress="'.$_POST['progress'.$currId].'"
				AND workerAsigned="'.$_POST['asignedTo'.$currId].'" AND comments="'.$_POST['comments'.$currId].'" AND userModified="'.$_SESSION['login'].'"';
				
				$result = mysqli_fetch_array(mysqli_query($conn, $query));
				if($result == false) echo '</br>ERROR: '.mysqli_error($conn).' </br>WITH SQL: '.$query.'</br>';
				
				$query = 'INSERT INTO archive VALUES(NULL, "'.$_POST['clientNum'.$currId].'", "'.$_POST['name'.$currId].'", "'.$_POST['surName'.$currId].'", "'.$_POST['yearHired'.$currId].'", "'.$_POST['dateWorkStart'.$currId].'", "'.$_POST['dateWorkEnd'.$currId].'",
				"'.$_POST['docType'.$currId].'", "'.$_POST['docImportance'.$currId].'", "'.$_POST['progress'.$currId].'", "'.$_POST['asignedTo'.$currId].'","'.$_POST['comments'.$currId].'", "'.$date.'", "'.$_SESSION['login'].'", "'.getUserIpAddr().'"
				, "'.$result['addedBy'].'", "'.$result['addedTime'].'" )';
				$result = mysqli_query($conn, $query);
				
				if($result == false) echo '</br>ERROR: '.mysqli_error($conn).' </br>WITH SQL: '.$query.'</br>';
				
			}
		}
		echo 
		'<div class="sqlResult">
			'.$resultInfo.'
		</div>';
		
		
	}

	
	function getUserIpAddr(){
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			//ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			//ip pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

?>