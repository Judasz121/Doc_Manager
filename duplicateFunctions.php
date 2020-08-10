<?php 

require_once 'connect.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
mysqli_query($conn, "SET NAMES utf8");


function BuildFilterQuery(): string
{
    $query = ' WHERE id > 0';
    $filterUsed = false;

    if (!empty($_POST['filterClientNum'])) {
		$filterUsed = true;
        $query .= ' AND clientId  = "' . $_POST['filterClientNum'] . '"';
    }

    if (!empty($_POST['filterClientName'])) {
		$filterUsed = true;
        $query .= ' AND LOWER(clientName) LIKE LOWER("%' . $_POST['filterClientName'] . '%")';
    }

    if (!empty($_POST['filterClientSurname'])) {
		$filterUsed = true;
        $query .= ' AND LOWER(clientSurname) LIKE LOWER("%' . $_POST['filterClientSurname'] . '%")';
    }

    if ($_POST['filterYearHiredFrom'] != null && $_POST['filterYearHiredTo'] == null) {
		$filterUsed = true;
        $query .= ' AND yearHired  >= "' . $_POST['filterYearHiredFrom'] . '"';
    }
    if ($_POST['filterYearHiredFrom'] == null && $_POST['filterYearHiredTo'] != null) {
		$filterUsed = true;
        $query .= ' AND yearHired  <= "' . $_POST['filterYearHiredTo'] . '"';
    }
    if ($_POST['filterYearHiredFrom'] != null && $_POST['filterYearHiredTo'] != null) {
		$filterUsed = true;
        $query .= ' AND yearHired  <= "' . $_POST['filterYearHiredTo'] . '" AND yearHired >= "' . $_POST['filterYearHiredFrom'] . '"';
    }

    if (!empty($_POST['filterWorkStartDateFrom']) && empty($_POST['filterWorkStartDateTo'])) {
		$filterUsed = true;
        $query .= ' AND workStartDate  >= "' . $_POST['filterWorkStartDateFrom'] . '"';
    }
    if (empty($_POST['filterWorkStartDateFrom']) && !empty($_POST['filterWorkStartDateTo'])) {
		$filterUsed = true;
        $query .= ' AND workStartDate  <= "' . $_POST['filterWorkStartDateTo'] . '"';
    }
    if (!empty($_POST['filterWorkStartDateFrom']) && !empty($_POST['filterWorkStartDateTo'])) {
		$filterUsed = true;
        $query .= ' AND workStartDate  <= "' . $_POST['filterWorkStartDateTo'] . '" AND workStartDate >= "' . $_POST['filterWorkStartDateFrom'] . '"';
    }

    if (!empty($_POST['filterWorkEndDateFrom']) && empty($_POST['filterWorkEndDateTo'])) {
		$filterUsed = true;
        $query .= ' AND workEndDate  >= "' . $_POST['filterWorkEndDateFrom'] . '"';
    }
    if (empty($_POST['filterWorkEndDateFrom']) && !empty($_POST['filterWorkEndDateTo'])) {
		$filterUsed = true;
        $query .= ' AND workEndDate  <= "' . $_POST['filterWorkEndDateTo'] . '"';
    }
    if (!empty($_POST['filterWorkEndDateFrom']) && !empty($_POST['filterWorkEndDateTo'])) {
		$filterUsed = true;
        $query .= ' AND workEndDate  <= "' . $_POST['filterWorkEndDateTo'] . '" AND workEndDate >= "' . $_POST['filterWorkEndDateFrom'] . '"';
    }

    if (!empty($_POST['filterDocType'])) {
		$filterUsed = true;
        $query .= ' AND docType = "' . $_POST['filterDocType'] . '"';
    }

    if (!empty($_POST['filterDocImportance'])) {
		$filterUsed = true;
        $query .= ' AND docImportance = "' . $_POST['filterDocImportance'] . '"';
    }
	
    if (!empty($_POST['filterDocSpace'])) {
		$filterUsed = true;
        $query .= ' AND docSpace = "' . $_POST['filterDocSpace'] . '"';
    }
	
    if (!empty($_POST['filterMMM'])) {
		$filterUsed = true;
        $query .= ' AND MMM = "' . $_POST['filterMMM'] . '"';
    }

    if (!empty($_POST['filterProgress'])) {
		$filterUsed = true;
        $query .= ' AND progress = "' . $_POST['filterProgress'] . '"';
    }

    if (!empty($_POST['filterAsignedTo'])) {
		$filterUsed = true;
        $query .= ' AND workerAsigned = "' . $_POST['filterAsignedTo'] . '"';
    }
	
	if (!empty($_POST['filteraddedBy'])) {
		$filterUsed = true;
        $query .= ' AND addedBy = "' . $_POST['filteraddedBy'] . '"';
    }

    if (!empty($_POST['filterComments'])) {
		$filterUsed = true;
        $query .= ' AND LOWER(comments) LIKE LOWER("%' . $_POST['filterComments'] . '%")';
    }

    if (!empty($_POST['filterDateModifiedFrom']) && empty($_POST['filterDateModifiedTo'])) {
		$filterUsed = true;
        $query .= ' AND dateModified  >= "' . $_POST['filterDateModifiedFrom'] . '"';
    }
    if (empty($_POST['filterDateModifiedFrom']) && !empty($_POST['filterDateModifiedTo'])) {
		$filterUsed = true;
        $query .= ' AND dateModified  <= "' . $_POST['filterDateModifiedTo'] . '"';
    }
    if (!empty($_POST['filterDateModifiedFrom']) && !empty($_POST['filterDateModifiedTo'])) {
		$filterUsed = true;
        $query .= ' AND dateModified  <= "' . $_POST['filterDateModifiedTo'] . '" AND dateModified >= "' . $_POST['filterDateModifiedFrom'] . '"';
    }


    if (!empty($_POST['filterDateAddedFrom']) && empty($_POST['filterDateAddedTo'])) {
		$filterUsed = true;
        $query .= ' AND addedTime  >= "' . $_POST['filterDateAddedFrom'] . '"';
    }
    if (empty($_POST['filterDateAddedFrom']) && !empty($_POST['filterDateAddedTo'])) {
		$filterUsed = true;
        $query .= ' AND addedTime  <= "' . $_POST['filterDateAddedTo'] . '"';
    }
    if (!empty($_POST['filterDateAddedFrom']) && !empty($_POST['filterDateAddedTo'])) {
		$filterUsed = true;
        $query .= ' AND addedTime  <= "' . $_POST['filterDateAddedTo'] . '" AND addedTime >= "' . $_POST['filterDateAddedFrom'] . '"';
    }
    
    if($filterUsed == false)
        return false;
    else
        return $query;
}

function AddNewRows(array $clientNums,array $clientNames,array $clientSurNames,array $yearsHired, array $datesWorkStart, array $datesWorkEnd, array $docTypes, array $docImportances, array $docSpaces, array $MMM, array $progresses, array $asignedTo, array $comments){
    global $conn;

    $ids = array_keys($clientNums);
    $ip = getUserIpAddr();
    $dateModified = date('Y-m-d H:i:s');
    $userModified = $_SESSION['login'];
    foreach($ids as $id){
        $sql = "INSERT INTO documents VALUES(NULL, '".$clientNums[$id]."', '".$clientNames[$id]."', '".$clientSurNames[$id]."', '".$yearsHired[$id]."', '".$datesWorkStart[$id]."', '".$datesWorkEnd[$id]."', '".$docTypes[$id]."', '".$docImportances[$id]."', '".$docSpaces[$id]."', '".$MMM[$id]."', '".$progresses[$id]."', '".$asignedTo[$id]."', '".$comments[$id]."', '".$dateModified."', '".$userModified."', '".$ip."', '".$userModified."', '".$dateModified."' )";

        $result = mysqli_query($conn, $sql);
        if ($result == TRUE) {
            $result .= "<span class='zapisok'>Dodano nowy dokument o nr klienta '".$clientNums[$id]."'</span>";
            ArchiveDocument($clientNums[$id], $clientNames[$id], $clientSurNames[$id], $yearsHired[$id], $datesWorkStart[$id], $datesWorkEnd[$id], $docTypes[$id], $docImportances[$id], $docSpaces[$id], $MMM[$id], $progresses[$id], $asignedTo[$id], $comments[$id], $dateModified, $userModified, $ip, $userModified, $dateModified);
        } else {
            $result .= "ERROR: " . mysqli_error($conn) . "<br>WITH SQL: " . $query . "<br>";
        }
    }

    return '<div class="sqlResult">' . $result . '</div>';
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
    if($filter == false || $limit == 0){
        $_SESSION['numofPages'] = 0;
        $_SESSION['numofDocs'] = 0;

        if($_GET['page'] > 1){
            $query = null;

            if (isset($_GET['progressTableOrder'])) $query .= '&progressTableOrder=' . $_GET['progressTableOrder'] . '&progressTableOrderby=' . $_GET['progressTableOrderby'];
            if (isset($_GET['clientTableOrder'])) $query .= '&clientTableOrder=' . $_GET['clientTableOrder'] . '&clientTableOrderby=' . $_GET['clientTableOrderby'];
            if (isset($_GET['orderby'])) $query .= '&orderby=' . $_GET['orderby'] . '&order=' . $_GET['order'];
    
            header('Location: duplicate.php?page=1' . $query);
        }
        return "";
    }

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

function ArchiveDocument($clientNum, $clientName, $clientSurName, $yearHired, $dateWorkStart, $dateWorkEnd, $docType, $docImportance, $docSpace, $MMM, $progress, $asignedTo, $comments, $dateModified, $userModified, $userIPModified, $userAdded, $timeAdded){
    global $conn;
    $sql = "INSERT INTO archive VALUES(NULL, '".$clientNum."', '".$clientName."', '".$clientSurName."', '".$yearHired."', '".$dateWorkStart."', '".$dateWorkEnd."', '".$docType."', '".$docImportance."', '".$docSpace."', '".$MMM."', '".$progress."', '".$asignedTo."', '".$comments."', '".$dateModified."', '".$userModified."', '".$userIPModified."', '".$userAdded."', '".$timeAdded."')";
    $result = mysqli_query($conn, $sql);
    if($result == false){
        echo '<br>ERROR: ' .mysqli_error($conn). '<br>WITH SQL: ' .$sql;
    }
}

function getAllUsers(): array
{
    global $conn;
    $query = 'SELECT * FROM users';
    $result = mysqli_query($conn, $query);
    $users = [];
    while ($user = $result->fetch_assoc()) {
        $users[$user['id']] = $user;
    }
    return $users;
}

function getUserIpAddr(): string
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getAllYearsHired(): array
{
    global $conn;
    $sql = 'SELECT * FROM yearshired';
    $result = mysqli_query($conn, $sql);
    $yearsHired = [];
    while ($year = $result->fetch_assoc()) {
        $yearsHired[$year['id']] = $year;
    }
    return $yearsHired;
}

function getAllDocTypes(): array
{
    global $conn;
    $sql = 'SELECT * FROM doctypes';
    $result = mysqli_query($conn, $sql);
    $yearsHired = [];
    while ($year = $result->fetch_assoc()) {
        $yearsHired[$year['id']] = $year;
    }
    return $yearsHired;
}

function getAllDocImportances(): array
{
    global $conn;
    $sql = 'SELECT * FROM docimportances';
    $result = mysqli_query($conn, $sql);
    $yearsHired = [];
    while ($year = $result->fetch_assoc()) {
        $yearsHired[$year['id']] = $year;
    }
    return $yearsHired;
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


?>