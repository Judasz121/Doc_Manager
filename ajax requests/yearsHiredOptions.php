<?php
    require '../connect.php';
    $sql = 'SELECT * FROM yearshired';
    $result1 = mysqli_query($conn, $sql);
    while($row = $result1 -> fetch_assoc()){
        echo '<option value="'.$row['year'].'" '; if ($_REQUEST['selected'] == $row['year']) echo 'selected'; echo ' >'.$row['year'].'</option>';
    }
?>