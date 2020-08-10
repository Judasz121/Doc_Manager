<?php
    require '../connect.php';
    $sql = 'SELECT * FROM users';
    $result1 = mysqli_query($conn, $sql);
    while($row = $result1 -> fetch_assoc()){
        echo '<option value="'.$row['userName'].'" '; if ($_REQUEST['selected'] == $row['userName']) echo 'selected'; echo ' >'.$row['userName'].'</option>';
    }
    echo '<option value="NN" '; if ($_REQUEST['selected'] == "NN") echo 'selected'; echo ' >NN</option>';
?>