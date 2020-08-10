<?php
    require_once '../connect.php';
    $sql = 'SELECT * FROM mmm';
    $result1 = mysqli_query($conn, $sql);
    while($row = $result1 -> fetch_assoc()){
        echo '<option value="'.$row['MMM'].'" '; if ($_REQUEST['selected'] == $row['MMM']) echo 'selected'; echo ' >'. $row['MMM']. '</option>';
    }
?>