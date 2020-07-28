<?PHP
	require_once '../connect.php';
	
	$sql = 'SELECT COUNT(*) FROM documents WHERE progress="PP" AND workerAsigned = "'.$_REQUEST['user'].'"';
	$result = mysqli_query($conn, $sql);
	if($result == false)
		echo "ERROR: ".mysqli_error($conn).'<br>'.'WITH SQL: '.$sql;
	else
		echo mysqli_fetch_assoc($result)['COUNT(*)'];
?>