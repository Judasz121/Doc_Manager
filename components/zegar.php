<?php

$data1 = "2019-03-05 09:52:33";
$datetime1 = new DateTime('NOW');
$datetime2 = new DateTime($data1);
$interval = $datetime1->diff($datetime2);
echo $interval->format('%R%a days');

?>
