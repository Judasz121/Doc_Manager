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
		
		if(!empty($_POST['filterUserModified'])){
			$query .= ' AND userModified = "'.$_POST['filterUserModified'].'"';
		}
		
		if(!empty($_POST['filterUserIpModified'])){
			$query .= ' AND userIpModified = "'.$_POST['filterUserIpModified'].'"';
		}
		
		if(!empty($_POST['filterAddedBy'])){
			$query .= ' AND addedBy = "'.$_POST['filterAddedBy'].'"';
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
	

?>