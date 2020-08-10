<?PHP

	require_once 'connect.php';
	session_start();
	mysqli_query($conn,"SET NAMES utf8");
	
function SaveChanges(array $userIds, array $userLogins, array $userFullnames, array $userPasswords, array $accountTypes, array $workerGroups, $deleteUsersIds)
{
    global $conn;
    $ids = array_keys($userIds);
    foreach($ids as $currId)
	{
		if(isset($deleteUsersIds[$currId])){
			$sql = 'DELETE FROM users WHERE id='.$currId;
			mysqli_query($conn, $sql);
		}
		else{
			$sql = 'UPDATE users SET userName="'.$userLogins[$currId].'", userFullname="'.$userFullnames[$currId].'", userPassword="'.$userPasswords[$currId].'", accountType="'.$accountTypes[$currId].'", workerGroup="'.$workerGroups[$currId].'" WHERE id = '.$currId;
			$result = mysqli_query($conn, $sql);
			if($result == false)
				echo'ERROR: '. mysqli_error($conn). '<br>'.'WITH SQL: '.$sql;
		}
    }
}
function AddNewUsers(array $userIds, array $userLogins, array $userFullnames, array $userPasswords, array $accountTypes, $workerGroups, $deleteUsersIds)
{
	global $conn;
	$ids = array_keys($userIds);
	
	foreach($ids as $currId){
		if(!isset($deleteUsersIds[$currId])){
			/*
			var_dump($userLogins[$currId]);
			var_dump($userLogins);
			echo'<br>';
			var_dump($userFullNames[$currId]);
			var_dump($userFullNames);
			$fullNameString = '"'.$userFullNames[$currID].'"';
			echo '<br> fullnamestring => '.$fullNameString;
			echo '<br> fullname inside function =>>'.$userFullnames[$currId].'<<';
			*/
			$sql = 'INSERT INTO users VALUES (NULL, "'.$userLogins[$currId].'", "'.$_POST['newUserFullname'][$currId].'", "'.$userPasswords[$currId].'", "'.$accountTypes[$currId].'", "'.$workerGroups[$currId].'", 0, 0, 0, 0, 0)';
			//echo '<br>current id iteration =>'.$currId;
			//echo '<br> SQL BEFORE QUERY: '.$sql;
			$result = mysqli_query($conn, $sql);
			//echo '<br> SQL AFTER QUERY: '.$sql;
			if($result = false)
				echo'ERROR: '. mysqli_error($conn). '<br>'.'WITH SQL: '.$sql;
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

?>