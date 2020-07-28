<?php 

require_once 'connect.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
mysqli_query($conn, "SET NAMES utf8");


function BuildFilterQuery(): string
{
    $query = ' WHERE id > 0';


    if (!empty($_POST['filterClientNum'])) {
        $query .= ' AND clientId  = "' . $_POST['filterClientNum'] . '"';
    }

    if (!empty($_POST['filterClientName'])) {
        $query .= ' AND LOWER(clientName) LIKE LOWER("%' . $_POST['filterClientName'] . '%")';
    }

    if (!empty($_POST['filterClientSurname'])) {
        $query .= ' AND LOWER(clientSurname) LIKE LOWER("%' . $_POST['filterClientSurname'] . '%")';
    }

    if ($_POST['filterYearHiredFrom'] != null && $_POST['filterYearHiredTo'] == null) {
        $query .= ' AND yearHired  >= "' . $_POST['filterYearHiredFrom'] . '"';
    }
    if ($_POST['filterYearHiredFrom'] == null && $_POST['filterYearHiredTo'] != null) {
        $query .= ' AND yearHired  <= "' . $_POST['filterYearHiredTo'] . '"';
    }
    if ($_POST['filterYearHiredFrom'] != null && $_POST['filterYearHiredTo'] != null) {
        $query .= ' AND yearHired  <= "' . $_POST['filterYearHiredTo'] . '" AND yearHired >= "' . $_POST['filterYearHiredFrom'] . '"';
    }

    if (!empty($_POST['filterWorkStartDateFrom']) && empty($_POST['filterWorkStartDateTo'])) {
        $query .= ' AND workStartDate  >= "' . $_POST['filterWorkStartDateFrom'] . '"';
    }
    if (empty($_POST['filterWorkStartDateFrom']) && !empty($_POST['filterWorkStartDateTo'])) {
        $query .= ' AND workStartDate  <= "' . $_POST['filterWorkStartDateTo'] . '"';
    }
    if (!empty($_POST['filterWorkStartDateFrom']) && !empty($_POST['filterWorkStartDateTo'])) {
        $query .= ' AND workStartDate  <= "' . $_POST['filterWorkStartDateTo'] . '" AND workStartDate >= "' . $_POST['filterWorkStartDateFrom'] . '"';
    }

    if (!empty($_POST['filterWorkEndDateFrom']) && empty($_POST['filterWorkEndDateTo'])) {
        $query .= ' AND workEndDate  >= "' . $_POST['filterWorkEndDateFrom'] . '"';
    }
    if (empty($_POST['filterWorkEndDateFrom']) && !empty($_POST['filterWorkEndDateTo'])) {
        $query .= ' AND workEndDate  <= "' . $_POST['filterWorkEndDateTo'] . '"';
    }
    if (!empty($_POST['filterWorkEndDateFrom']) && !empty($_POST['filterWorkEndDateTo'])) {
        $query .= ' AND workEndDate  <= "' . $_POST['filterWorkEndDateTo'] . '" AND workEndDate >= "' . $_POST['filterWorkEndDateFrom'] . '"';
    }

    if (!empty($_POST['filterDocType'])) {
        $query .= ' AND docType = "' . $_POST['filterDocType'] . '"';
    }

    if (!empty($_POST['filterDocImportance'])) {
        $query .= ' AND docImportance = "' . $_POST['filterDocImportance'] . '"';
    }
	
    if (!empty($_POST['filterDocSpace'])) {
        $query .= ' AND docSpace = "' . $_POST['filterDocSpace'] . '"';
    }
	
    if (!empty($_POST['filterMMM'])) {
        $query .= ' AND MMM = "' . $_POST['filterMMM'] . '"';
    }

    if (!empty($_POST['filterProgress'])) {
        $query .= ' AND progress = "' . $_POST['filterProgress'] . '"';
    }

    if (!empty($_POST['filterAsignedTo'])) {
        $query .= ' AND workerAsigned = "' . $_POST['filterAsignedTo'] . '"';
    }
	
	if (!empty($_POST['filteraddedBy'])) {
        $query .= ' AND addedBy = "' . $_POST['filteraddedBy'] . '"';
    }

    if (!empty($_POST['filterComments'])) {
        $query .= ' AND LOWER(comments) LIKE LOWER("%' . $_POST['filterComments'] . '%")';
    }

    if (!empty($_POST['filterDateModifiedFrom']) && empty($_POST['filterDateModifiedTo'])) {
        $query .= ' AND dateModified  >= "' . $_POST['filterDateModifiedFrom'] . '"';
    }
    if (empty($_POST['filterDateModifiedFrom']) && !empty($_POST['filterDateModifiedTo'])) {
        $query .= ' AND dateModified  <= "' . $_POST['filterDateModifiedTo'] . '"';
    }
    if (!empty($_POST['filterDateModifiedFrom']) && !empty($_POST['filterDateModifiedTo'])) {
        $query .= ' AND dateModified  <= "' . $_POST['filterDateModifiedTo'] . '" AND dateModified >= "' . $_POST['filterDateModifiedFrom'] . '"';
    }


    if (!empty($_POST['filterDateAddedFrom']) && empty($_POST['filterDateAddedTo'])) {
        $query .= ' AND addedTime  >= "' . $_POST['filterDateAddedFrom'] . '"';
    }
    if (empty($_POST['filterDateAddedFrom']) && !empty($_POST['filterDateAddedTo'])) {
        $query .= ' AND addedTime  <= "' . $_POST['filterDateAddedTo'] . '"';
    }
    if (!empty($_POST['filterDateAddedFrom']) && !empty($_POST['filterDateAddedTo'])) {
        $query .= ' AND addedTime  <= "' . $_POST['filterDateAddedTo'] . '" AND addedTime >= "' . $_POST['filterDateAddedFrom'] . '"';
    }

    return $query;
}

function DuplicateRow(string $id){
    global $conn;

    $sql = "INSERT INTO documents (clientId, clientName, clientSurname, yearHired, workStartDate, workEndDate, docType, docImportance, docSpace, MMM, progress, workerAsigned, comments, dateModified, userModified, userIpModified, addedBy, addedTime)
    SELECT clientId, clientName, clientSurname, yearHired, workStartDate, workEndDate, docType, docImportance, docSpace, MMM, progress, workerAsigned, comments, dateModified, userModified, userIpModified, addedBy, addedTime 
    FROM documents WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    echo ' result => '; var_dump($result);
    if($result == false){
        $error =  "ERROR: " . mysqli_error($conn) . "<br>" .
        "WITH SQL: " . $sql; 
        echo $error;
        return $error;
    }
    else return true;
}

function BuildSortQuery(string $target){
	$query = "";
	if(isset($_GET['progressTableOrder']) && $target != "progressTableOrder" && $_GET['progressTableOrder'] == 'ASC') 
		$query .= '&progressTableOrder=DESC';
	elseif(isset($_GET['progressTableOrder']) && $target != "progressTableOrder" && $_GET['progressTableOrder'] == 'DESC') 
		$query .= '&progressTableOrder=ASC';
	if(isset($_GET['progressTableOrderBy']) && $target != 'progressTableOrderBy')
		$query .= '&progressTableOrderby='.$_GET['progressTableOrderby'];
	
	if(isset($_GET['clientTableOrder']) && $target != 'clientTableOrder' && $_GET['clientTableOrder'] == 'ASC') 
		$query .= '&clientTableOrder=DESC';
	elseif(isset($_GET['clientTableOrder']) && $target != 'clientTableOrder' && $_GET['clientTableOrder'] == 'DESC')
		$query .= '&clientTableOrder=ASC';
	if(isset($_GET['clientTableOrderby']) && $target != 'clientTableOrderby') 
		$query .= '&clientTableOrderby='.$_GET['clientTableOrderby'];
	
	if(isset($_GET['orderby']) && $target != 'orderby') 
		$query .= '&orderby='.$_GET['orderby'];
	if(isset($_GET['order']) && $target != 'order' && $_GET['order'] == 'ASC')
		$query .= '&order=DESC';
	elseif(isset($_GET['order']) && $target != 'order' && $_GET['order'] == 'DESC') 
		$query .= '&order=ASC';
		
	if(isset($_GET['workersTableOrderby']) && $target != 'workersTableOrderby') 
		$query .= '&workersTableOrderby='.$_GET['workersTableOrderby'];
	if(isset($_GET['workersTableOrder']) && $target != 'workersTableOrder' && $_GET['workersTableOrder'] == 'ASC') 
		$query .= '&workersTableOrder=DESC';
	elseif(isset($_GET['workersTableOrder']) && $target != 'workersTableOrder' && $_GET['workersTableOrder'] == 'DESC') 
		$query .= '&workersTableOrder=ASC';
	
	if(isset($_GET['page']) && $target != 'page')
		$query .= '&page='.$_GET['page'];
	
	return $query;
}

function BuildLimitQuery($limit, $filter)
{
    global $conn;

    $_SESSION['limit'] = $limit;

    $sql = "SELECT COUNT(*) FROM documents ".$filter;
    $result = mysqli_fetch_array(mysqli_query($conn, $sql));
    if($result == false){
        $error =  "ERROR: " . mysqli_error($conn) . "<br>" .
        "WITH SQL: " . $sql; 
        echo $error;
        return $error;
    }

    $numofDocs = $result['COUNT(*)'];
    $numofPages = $numofDocs / $limit;
    $_SESSION['numofPages'] = $numofPages;
    $_SESSION['numofDocs'] = $numofDocs;


    if ($_SESSION['numofPages'] + 1 < $_GET['page']) {
        $query = null;

        if (isset($_GET['progressTableOrder'])) $query .= '&progressTableOrder=' . $_GET['progressTableOrder'] . '&progressTableOrderby=' . $_GET['progressTableOrderby'];
        if (isset($_GET['clientTableOrder'])) $query .= '&clientTableOrder=' . $_GET['clientTableOrder'] . '&clientTableOrderby=' . $_GET['clientTableOrderby'];
        if (isset($_GET['orderby'])) $query .= '&orderby=' . $_GET['orderby'] . '&order=' . $_GET['order'];

        header('Location: duplicate.php?page=1' . $query);
    }


    if (isset($_GET['page']))
        $page = $_GET['page'];
    else
        $page = 1;

    $result = ($limit * ($page - 1)) . ',' . $limit;
    return ' LIMIT ' . $result;

}


?>