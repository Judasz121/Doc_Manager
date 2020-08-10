<?PHP
require_once 'connect.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);
mysqli_query($conn, "SET NAMES utf8");

function zegar() // deklaracja funkcji
{
$data1 = "2019-03-05 09:52:33";
$datetime1 = new DateTime('NOW');
$datetime2 = new DateTime($data1);
$interval = $datetime1->diff($datetime2);
echo $interval->format('%R%a days');
}

function BuildFilterQuery(): string
{
    $query = '';


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


function BuildLimitQuery($limit, $filter)
{
    global $conn;

    $_SESSION['limit'] = $limit;

    $sql = "SELECT COUNT(*) FROM documents WHERE workerAsigned='" . $_SESSION['login'] . "' ".$filter;
    $result = mysqli_fetch_array(mysqli_query($conn, $sql));
    $numofDocs = $result['COUNT(*)'];
    $numofPages = $numofDocs / $limit;
    $_SESSION['numofPages'] = $numofPages;
    $_SESSION['numofDocs'] = $numofDocs;


    if ($_SESSION['numofPages'] + 1 < $_GET['page']) {
        $query = null;

        if (isset($_GET['progressTableOrder'])) $query .= '&progressTableOrder=' . $_GET['progressTableOrder'] . '&progressTableOrderby=' . $_GET['progressTableOrderby'];
        if (isset($_GET['clientTableOrder'])) $query .= '&clientTableOrder=' . $_GET['clientTableOrder'] . '&clientTableOrderby=' . $_GET['clientTableOrderby'];
        if (isset($_GET['orderby'])) $query .= '&orderby=' . $_GET['orderby'] . '&order=' . $_GET['order'];

        header('Location: employee.php?page=1' . $query);
    }


    if (isset($_GET['page']))
        $page = $_GET['page'];
    else
        $page = 1;

    $result = ($limit * ($page - 1)) . ',' . $limit;
    return ' LIMIT ' . $result;

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


function SaveChanges(array $documentIds, array $clientNum, array $name, array $surName, array $yearHired, array $dateWorkStart, array $dateWorkEnd, array $docType, array $docImportance, $docSpace, $docMMM, array $progress, $asignedTo, array $comments, $saveSelected, bool $saveOnlySelected)
{
    global $conn;
    $ids = array_keys($documentIds);
    $documents = getAllDocumentsByIds($ids);
    $resultInfo = "";
    foreach ($documents as $doc) {
        $currId = (int)$doc['id'];
        if (isset($deleteSelected[$currId]) && $deleteSelected[$currId] == true) {
            $resultInfo .= deleteDocumentById($currId);
            continue;
        }
        if ($saveOnlySelected && !isset($saveSelected[$currId])) {
            continue;
        }
        $clientId = $clientNum[$currId];
        $clientName = $name[$currId];
        $clientSurname = $surName[$currId];
        $hiredStart = $yearHired[$currId];

        $dateStart = "0001-01-01";
        if (!empty($dateWorkStart[$currId])) {
            $dateStart = $dateWorkStart[$currId];
        }
        $workEndDate = "0001-01-01";
        if (!empty($dateWorkEnd[$currId])) {
            $workEndDate = $dateWorkEnd[$currId];
        }
        $docTypeDb = $docType[$currId];
        $docImportanceDb = $docImportance[$currId];
        $docSpaceDb = $docSpace[$currId];
        $docMMMDb = $docMMM[$currId];
        $progressDb = $progress[$currId];
        $assignedTo = $asignedTo[$currId];
        $comment = $comments[$currId];
        $dateModified = date('Y-m-d H:i:s');
        $userModified = $_SESSION['login'];
        $ip = getUserIpAddr();
        $query = 'UPDATE documents SET clientId = "' . $clientId . '", clientName="' . $clientName . '", clientSurname="' . $clientSurname . '", yearHired="' . $hiredStart . '",
				workStartDate="' . $dateStart . '", workEndDate="' . $workEndDate . '", docType="' . $docTypeDb . '",docImportance="' . $docImportanceDb . '", docSpace="' . $docSpaceDb . '",  progress="' . $progressDb . '",
				workerAsigned="' . $assignedTo . '", comments="' . $comment . '", dateModified="' . $dateModified . '", userModified="' . $userModified . '", userIpModified="' . $ip . '"
				WHERE id="' . $currId . '"';
        $result1 = mysqli_query($conn, $query);

        if ($result1 == TRUE) {
            $resultInfo .= "<div class='sqlResultG' >Dokument z nr klienta $currId zapisano</div>";
        } else {
            $resultInfo .= "Error: " . $result1 . "<br>" . $query . "<br>" . mysqli_error($conn);
        }

        // ARCHIVE
        $resultInfo .= archiveDocumentById($currId);

    }
    return '<div class="sqlResult">' . $resultInfo . '</div>';
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

function archiveDocumentById($currId): string
{
    global $conn;
    $query = "INSERT INTO archive (clientId, clientName, clientSurname, yearHired, workStartDate, workEndDate, docType, docImportance, docSpace, MMM, progress, workerAsigned, comments, dateModified, userModified, userIpModified, addedBy, addedTime)
SELECT clientId, clientName, clientSurname, yearHired, workStartDate, workEndDate, docType, docImportance, docSpace, MMM, progress, workerAsigned, comments, dateModified, userModified, userIpModified, addedBy, addedTime 
FROM documents WHERE id = $currId";
    $result = mysqli_query($conn, $query);

    if ($result == false) {
        return '</br>ERROR: ' . mysqli_error($conn) . ' </br>WITH SQL: ' . $query . '</br>';
    }
    return "";
}


function getDocumentQuery(string $query): array
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $docs = [];
	if($result == false){
		echo $query .'<br>';
		echo mysqli_error($conn);
	}
    while ($doc = $result->fetch_assoc()) {
        $docs[$doc['id']] = $doc;
    }
    return $docs;
}

///function getAllDocumentsAssignedToUser(string $login, string $orderBy, string $order, string $limit): array
function getAllDocumentsAssignedToUser(string $login, string $orderBy, string $order, string $limit, string $filter): array
{
    ///$sql = 'SELECT * FROM documents WHERE workerAsigned="' . $login . '" AND progress != "N" AND progress != "W" ORDER BY ' . $orderBy . ' ' . $order . $limit;
	$sql = 'SELECT * FROM documents WHERE workerAsigned="' . $login . '" ' . $filter . ' AND progress != "N" AND progress != "W" ORDER BY ' . $orderBy . ' ' . $order . $limit;
    return getDocumentQuery($sql);
}

function getAllDocumentsByIds(array $ids): array
{
    $imploded = implode(",", $ids);
    $sql = "select * from documents where id in (" . $imploded . ')';
    return getDocumentQuery($sql);
}

function deleteDocumentById(int $id): string
{
    global $conn;
    $sql = 'DELETE FROM documents WHERE id = ' . $id;
    $result = mysqli_query($conn, $sql);
    if ($result == TRUE)
        return "Dokument z nr klienta $id usunięto.";
    else
        return "Error: " . $result . "<br>" . $sql . "</br>" . mysqli_error($conn) . '</div>';
}

?>