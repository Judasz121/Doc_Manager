<?php
    require '../connect.php';
    $sql = 'SELECT * FROM docimportances';
    $result1 = mysqli_query($conn, $sql);
    while($row = $result1 -> fetch_assoc()){
        echo '<option value="'.$row['docImportance'].'" '; if ($_REQUEST['selected'] == $row['docImportance']) echo 'selected'; echo ' >'.$row['docImportance'].'</option>';
    }
?>