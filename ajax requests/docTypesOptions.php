<?php
    require '../connect.php';
    $sql = 'SELECT * FROM doctypes';
    $result1 = mysqli_query($conn, $sql);
    while($row = $result1 -> fetch_assoc()){
        echo '<option value="'.$row['docType'].'" '; if ($_REQUEST['selected'] == $row['docType']) echo 'selected'; echo ' >'.$row['docType'].'</option>';
    }
?>