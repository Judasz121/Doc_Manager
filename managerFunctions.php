<?PHP

	require_once 'connect.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	mysqli_query($conn,"SET NAMES utf8");
	

	function BuildFilterQuery(){
		global $conn;
		$query = ' WHERE id > 0';
		
		if(!empty($_POST['filterClientNum'])){
			$query .= ' AND clientId  = "'.$_POST['filterClientNum'].'"';
		}
		
		if(!empty($_POST['filterClientName'])){
			$query .= ' AND LOWER(clientName) LIKE LOWER("%'.$_POST['filterClientName'].'%")';
		}
		
		if(!empty($_POST['filterClientSurname'])){
			$query .= ' AND LOWER(clientSurname) LIKE LOWER("%'.$_POST['filterClientSurname'].'%")';
		}
		
		if($_POST['filterYearHiredFrom'] != null && $_POST['filterYearHiredTo'] == null ){
			$query .= ' AND yearHired  >= "'.$_POST['filterYearHiredFrom'].'"';
		}
		if($_POST['filterYearHiredFrom'] == null && $_POST['filterYearHiredTo'] != null ){
			$query .= ' AND yearHired  <= "'.$_POST['filterYearHiredTo'].'"';
		}
		if($_POST['filterYearHiredFrom'] != null && $_POST['filterYearHiredTo'] != null ){
			$query .= ' AND yearHired  <= "'.$_POST['filterYearHiredTo'].'" AND yearHired >= "'.$_POST['filterYearHiredFrom'].'"';
		}
		
		if(!empty($_POST['filterWorkStartDateFrom']) && empty($_POST['filterWorkStartDateTo'])){
			$query .= ' AND workStartDate  >= "'.$_POST['filterWorkStartDateFrom'].'"';
		}
		if(empty($_POST['filterWorkStartDateFrom']) && !empty($_POST['filterWorkStartDateTo'])){
			$query .= ' AND workStartDate  <= "'.$_POST['filterWorkStartDateTo'].'"';
		}
		if(!empty($_POST['filterWorkStartDateFrom']) && !empty($_POST['filterWorkStartDateTo'])){
			$query .= ' AND workStartDate  <= "'.$_POST['filterWorkStartDateTo'].'" AND workStartDate >= "'.$_POST['filterWorkStartDateFrom'].'"';
		}
		
		if(!empty($_POST['filterWorkEndDateFrom']) && empty($_POST['filterWorkEndDateTo'])){
			$query .= ' AND workStartDate  >= "'.$_POST['filterWorkEndDateFrom'].'"';
		}
		if(empty($_POST['filterWorkEndDateFrom']) && !empty($_POST['filterWorkEndDateTo'])){
			$query .= ' AND workStartDate  <= "'.$_POST['filterWorkEndDateTo'].'"';
		}
		if(!empty($_POST['filterWorkEndDateFrom']) && !empty($_POST['filterWorkEndDateTo'])){
			$query .= ' AND workStartDate  <= "'.$_POST['filterWorkEndDateTo'].'" AND workStartDate >= "'.$_POST['filterWorkEndDateTo'].'"';
		}
		
		if(!empty($_POST['filterDocType'])){
			$query .= ' AND docType = "'.$_POST['filterDocType'].'"';
		}
		
		if(!empty($_POST['filterDocImportance'])){
			$query .= ' AND docImportance = "'.$_POST['filterDocImportance'].'"';
		}
		
		if(!empty($_POST['filterProgress'])){
			$query .= ' AND progress = "'.$_POST['filterProgress'].'"';
		}
		
		if(!empty($_POST['filterAsignedTo'])){
			$query .= ' AND workerAsigned = "'.$_POST['filterAsignedTo'].'"';
		}
		
		if(!empty($_POST['filterComments'])){
			$query .= ' AND LOWER(comments) LIKE LOWER("%'.$_POST['filterComments'].'%")';
		}
		
		if(!empty($_POST['filterDateModifiedFrom']) && empty($_POST['filterDateModifiedTo'])){
			$query .= ' AND dateModified  >= "'.$_POST['filterDateModifiedFrom'].'"';
		}
		if(empty($_POST['filterDateModifiedFrom']) && !empty($_POST['filterDateModifiedTo'])){
			$query .= ' AND dateModified  <= "'.$_POST['filterDateModifiedTo'].'"';
		}
		if(!empty($_POST['filterDateModifiedFrom']) && !empty($_POST['filterDateModifiedTo'])){
			$query .= ' AND dateModified  <= "'.$_POST['filterDateModifiedTo'].'" AND dateModified >= "'.$_POST['filterDateModifiedFrom'].'"';
		}
		
		
		if(!empty($_POST['filterDateAddedFrom']) && empty($_POST['filterDateAddedTo'])){
			$query .= ' AND addedTime  >= "'.$_POST['filterDateAddedFrom'].'"';
		}
		if(empty($_POST['filterDateAddedFrom']) && !empty($_POST['filterDateAddedTo'])){
			$query .= ' AND addedTime  <= "'.$_POST['filterDateAddedTo'].'"';
		}
		if(!empty($_POST['filterDateAddedFrom']) && !empty($_POST['filterDateAddedTo'])){
			$query .= ' AND addedTime  <= "'.$_POST['filterDateAddedTo'].'" AND addedTime >= "'.$_POST['filterDateAddedFrom'].'"';
		}
				
		return $query;
	}
	
	function BuildFilterQueryforClientsTable(){
		global $conn;
		
		$query = 'WHERE id > 0';
		if(!empty($_POST['filterNumOfDocsPerClientFrom']) && empty($_POST['filterNumOfDocsPerClientTo'])){
			
			$sql = 'SELECT COUNT(*) FROM clients WHERE numofDocs >= '.$_POST['filterNumOfDocsPerClientFrom'];
			$result = mysqli_fetch_array(mysqli_query($conn, $sql));
			$numOfClients = $result['COUNT(*)'];
			
			$currId = 0;
			$i = 1;
			do{
				$sql = 'SELECT * FROM clients WHERE id > '.$currId.' AND numofDocs >= '.$_POST['filterNumOfDocsPerClientFrom'];
				$result = mysqli_fetch_array(mysqli_query($conn, $sql));
				$currId = $result['id'];
			//	echo '</br> Client looped -> '.$result['clientId']; 
				
				if($numOfClients == 1)
					$query .= ' AND clientId = "'.$result['clientId'].'"';
				elseif($i == 1)
					$query .= ' AND ( clientId = "'.$result['clientId'].'" OR';
				elseif($numOfClients == $i){ // last loop
					$query .= ' clientId = "'.$result['clientId'].'" )';
			//		echo 'Last client loop'; 
				}
				else
					$query .= ' clientId = "'.$result['clientId'].'" OR';
				$i++;
			}while($i <= $numOfClients);
		}
		if(empty($_POST['filterNumOfDocsPerClientFrom']) && !empty($_POST['filterNumOfDocsPerClientTo'])){
			
			$sql = 'SELECT COUNT(*) FROM clients WHERE numofDocs <= '.$_POST['filterNumOfDocsPerClientTo'];
			$result = mysqli_fetch_array(mysqli_query($conn, $sql));
			$numOfClients = $result['COUNT(*)'];
			
			$currId = 0;
			$i = 1; 
			do{
				$sql = 'SELECT * FROM clients WHERE id > '.$currId.' AND numofDocs <= '.$_POST['filterNumOfDocsPerClientTo'];
				$result = mysqli_fetch_array(mysqli_query($conn, $sql));
				$currId = $result['id'];
			//	echo '</br> Client looped -> '.$result['clientId']; 
				
				if($numOfClients == 1)
					$query .= ' AND clientId = "'.$result['clientId'].'"';
				elseif($i == 1)
					$query .= ' AND ( clientId = "'.$result['clientId'].'" OR';
				elseif($numOfClients == $i){ // last loop
					$query .= ' clientId = "'.$result['clientId'].'" )';
				//	echo 'Last client loop'; 
				}
				else
					$query .= ' clientId = "'.$result['clientId'].'" OR';
				$i++;
			}while($i <= $numOfClients);
		}
		if(!empty($_POST['filterNumOfDocsPerClientFrom']) && !empty($_POST['filterNumOfDocsPerClientTo'])){
			
			$sql = 'SELECT COUNT(*) FROM clients WHERE numofDocs <= '.$_POST['filterNumOfDocsPerClientTo'].' AND numofDocs >= '.$_POST['filterNumOfDocsPerClientFrom'];
			$result = mysqli_fetch_array(mysqli_query($conn, $sql));
			$numOfClients = $result['COUNT(*)'];
			
			$currId = 0;
			$i = 1;
			do{
				$sql = 'SELECT * FROM clients WHERE id > '.$currId.' AND numofDocs <= '.$_POST['filterNumOfDocsPerClientTo'].' AND numofDocs >= '.$_POST['filterNumOfDocsPerClientFrom'];
				$result = mysqli_fetch_array(mysqli_query($conn, $sql));
				$currId = $result['id'];
				//echo '</br> Client looped -> '.$result['clientId']; 
				if($numOfClients == 1)
					$query .= ' AND clientId = "'.$result['clientId'].'"';
				elseif($i == 1)
					$query .= ' AND ( clientId = "'.$result['clientId'].'" OR';
				elseif($numOfClients == $i){ // last loop
					$query .= ' clientId = "'.$result['clientId'].'" )';
				//	echo 'Last client loop'; 
				}
				else
					$query .= ' clientId = "'.$result['clientId'].'" OR';
				$i++;
			}while($i <= $numOfClients);
		}
		
		return $query;
	}
	
	function SaveChanges(){
		global $conn;
		
		$query = "SELECT COUNT(*) FROM documents";
		$result = mysqli_fetch_array(mysqli_query($conn, $query));
		$numOfRows = $result["COUNT(*)"];
		$currId = 0;
		$resultInfo = NULL;
		
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
				workStartDate="'.$_POST['dateWorkStart'.$currId].'", workEndDate="'.$_POST['dateWorkEnd'.$currId].'", docType="'.$_POST['docType'.$currId].'",docImportance="'.$_POST['docImportance'.$currId].'", progress="'.$_POST['progress'.$currId].'",
				workerAsigned="'.$_POST['asignedTo'.$currId].'", comments="'.$_POST['comments'.$currId].'", dateModified="'.$date.'", userModified="'.$_SESSION['login'].'", userIpModified="'.getUserIpAddr().'"
				WHERE id="'.$currId.'"';
				$result = mysqli_query($conn, $query);
				
				if ($result == TRUE) {
					$resultInfo .= "<span>Dokument z nr klienta ".$_POST['clientNum'.$currId]." zapisano</span></br>";
				} else {
					$resultInfo .= "Error: " . $result . "<br>" . $query . "<br>" .mysqli_error($conn);
				}
				
				// ARCHIVE
				$query = 'SELECT * FROM documents WHERE clientId = "'.$_POST['clientNum'.$currId].'" AND clientName="'.$_POST['name'.$currId].'" AND clientSurname="'.$_POST['surName'.$currId].'" AND yearHired="'.$_POST['yearHired'.$currId].'" AND
				workStartDate="'.$_POST['dateWorkStart'.$currId].'" AND workEndDate="'.$_POST['dateWorkEnd'.$currId].'" AND docType="'.$_POST['docType'.$currId].'" AND docImportance="'.$_POST['docImportance'.$currId].'" AND progress="'.$_POST['progress'.$currId].'"
				AND workerAsigned="'.$_POST['asignedTo'.$currId].'" AND comments="'.$_POST['comments'.$currId].'" AND dateModified="'.$date.'" AND userModified="'.$_SESSION['login'].'"';
				
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
	function CountNumofDocsbyTypeForUsersTable(){
		global $conn;
		
		$query = 'SELECT * FROM users';
		$result = mysqli_query($conn, $query);
		while($user = $result -> fetch_assoc()){
			
			$currId = $user['id'];
			$userName = $user['userName'];
			$numofP = 0;
			$numofW = 0;
			$numofZ = 0;
			
			$query = 'SELECT * FROM documents';
			$result1 = mysqli_query($conn, $query);
			while($doc = $result1 -> fetch_assoc()){
				
				$currDocId = $doc['id'];
				$progress = $doc['progress'];
				
				if($doc['workerAsigned'] == $userName){
					if($progress == "P"){
						$numofP++;
					}
					if($progress == "W"){
						$numofW++;
					}
					if($progress == "Z"){
						$numofZ++;
					}
				}
			}
			$sql = 'UPDATE users SET PdocsNum='.$numofP.', WdocsNum='.$numofW.', ZdocsNum='.$numofZ.', PplusZ='.($numofP + $numofZ).', allDocsNum='.($numofP + $numofW + $numofZ).' WHERE userName="'.$userName.'"';
			mysqli_query($conn, $sql);
		}
	}
	
	function CountNumofDocsForClientsTable(){
		global $conn;
		
		mysqli_query($conn, 'UPDATE clients SET numofDocs = "0"');
	
		$query = 'SELECT * FROM documents WHERE workerAsigned="NN"';
		$result = mysqli_query($conn, $query);
	
		while($doc = $result -> fetch_assoc()){
			
			$createNew = true;
			$query = 'SELECT * FROM clients';
			$result1 = mysqli_query($conn, $query);

			while($client = $result1 -> fetch_assoc()){
				if($client['clientId'] == $doc['clientId']){
					
					$createNew = false;
					
					$sql = 'SELECT numofDocs FROM clients WHERE clientId = "'.$client['clientId'].'"';
					$result2 = mysqli_fetch_array(mysqli_query($conn, $sql));
					$numofDocs = $result2[0] + 1;
					
					$sql = 'UPDATE clients SET numofDocs = '.$numofDocs.', name="'.$doc['clientName'].'", surname="'.$doc['clientSurname'].'" WHERE clientId = "'.$client['clientId'].'"' ;
					mysqli_query($conn, $sql);
				}
			}
			
			if($createNew == true){
				$sql = 'INSERT INTO clients VALUES(NULL, "'.$doc['clientId'].'", "'.$doc['clientName'].'", "'.$doc['clientSurname'].'", 1)';
				mysqli_query($conn, $sql);
			}
		}
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