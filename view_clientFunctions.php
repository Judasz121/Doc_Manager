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
		else{
			return false;
		}
		return $query;
	}
	

?>