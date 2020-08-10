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
			$query .= ' AND workEndDate  >= "'.$_POST['filterWorkEndDateFrom'].'"';
		}
		if(empty($_POST['filterWorkEndDateFrom']) && !empty($_POST['filterWorkEndDateTo'])){
			$query .= ' AND workEndDate  <= "'.$_POST['filterWorkEndDateTo'].'"';
		}
		if(!empty($_POST['filterWorkEndDateFrom']) && !empty($_POST['filterWorkEndDateTo'])){
			$query .= ' AND workEndDate  <= "'.$_POST['filterWorkEndDateTo'].'" AND workEndDate >= "'.$_POST['filterWorkEndDateTo'].'"';
		}
		
		if(!empty($_POST['filterDocType'])){
			$query .= ' AND docType = "'.$_POST['filterDocType'].'"';
		}
		
		if(!empty($_POST['filterDocImportance'])){
			$query .= ' AND docImportance = "'.$_POST['filterDocImportance'].'"';
		}
		
		if (!empty($_POST['filterDocSpace'])) {
			$query .= ' AND docSpace = "' . $_POST['filterDocSpace'] . '"';
		}
		
		if (!empty($_POST['filterMMM'])) {
			$query .= ' AND MMM = "' . $_POST['filterMMM'] . '"';
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
		
	function getAllMMMs(): array
	{
		global $conn;
		$sql = 'SELECT * FROM mmm';
		$result = mysqli_query($conn, $sql);
		$yearsHired = [];
		while ($year = $result->fetch_assoc()) {
			$yearsHired[$year['id']] = $year;
		}
		return $yearsHired;
	}
	
	function BuildLimitQuery($limit, $filter){
		global $conn;
	
		$_SESSION['limit'] = $limit;
		
		if($limit == 0)
			$limit = 25;
		
		$sql = "SELECT COUNT(*) FROM archive ". $filter;
		$result = mysqli_fetch_array(mysqli_query($conn, $sql));
		$numofDocs = $result['COUNT(*)'];
		$numofPages = $numofDocs / $limit;
		$_SESSION['numofPages'] = $numofPages;
		$_SESSION['numofDocs'] = $numofDocs;
		
		
		if($_SESSION['numofPages'] + 1 < $_GET['page'])
		{
			$query = null;
			
			if(isset($_GET['progressTableOrder'])) $query .= '&progressTableOrder='.$_GET['progressTableOrder'].'&progressTableOrderby='.$_GET['progressTableOrderby'];
			if(isset($_GET['clientTableOrder'])) $query .='&clientTableOrder='.$_GET['clientTableOrder'].'&clientTableOrderby='.$_GET['clientTableOrderby'];
			if(isset($_GET['orderby'])) $query .= '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
			
			header('Location: archive.php?page=1'.$query);
		}
		
		
		if(isset($_GET['page']))
			$page = $_GET['page'];
		else
			$page = 1;
		
		$result = ($limit * ($page - 1)).','.$limit;
		return ' LIMIT '.$result;
	
	}
	

?>