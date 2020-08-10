<?PHP
	require_once '../connect.php';
	
	$sql = 'SELECT COUNT(*) FROM documents WHERE progress="PP"';
	$result = mysqli_query($conn, $sql);
	if($result == false)
		echo "ERROR: ".mysqli_error($conn).'<br>'.'WITH SQL: '.$sql;
	else
		echo mysqli_fetch_assoc($result)['COUNT(*)'];
?>