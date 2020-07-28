
<center><table cellspacing="5" cellpadding="5">
<tbody>
<tr><td style="background-color: #ffffff; font-size: 14px;">Wpływ do gminy</td><tr>
<tr><td style="background-color: #ffffff; font-size: 14px;">Wszystkich
 <?php
	
  $mysqli = new mysqli("localhost", "serwer_www", "RP_Kpuw011!", "kolejka");
  //$mysqli = new mysqli("localhost", "root", "", "docmanager");

   /* check connection */
   if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
     exit();
   }

  if ($result = $mysqli->query("SELECT id from documents")) {

    /* determine number of rows result set */
     $row_cnt = $result->num_rows;

    printf(" - %d\n", $row_cnt);
	$a = $row_cnt;
   /* close result set */

 }
?></td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2021
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2021-01-01' AND '2021-12-31'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b1=$row_cnt;
	$bp1 = round(($b1/$a)*100,2);
	$color = $bp1;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp1.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2020
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2020-01-01' AND '2020-12-31'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b2=$row_cnt;
	$bp2 = round(($b2/$a)*100,2);
	$color = $bp2;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp2.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2019
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2019-01-01' AND '2019-12-31' ")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b3=$row_cnt;
$bp3 = round(($b3/$a)*100,2);
	$color = $bp3;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp3.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2018
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2018-01-01' AND '2018-12-31' ")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b4=$row_cnt;
$bp4 = round(($b4/$a)*100,2);
	$color = $bp4;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp4.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2017
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2017-01-01' AND '2017-12-31' ")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b5=$row_cnt;
 $bp5 = round(($b5/$a)*100,2);
	$color = $bp5;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp5.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2016
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2016-01-01' AND '2016-12-31' ")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b6=$row_cnt;
$bp6 = round(($b6/$a)*100,2);
	$color = $bp6;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp6.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2015
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2015-01-01' AND '2015-12-31' ")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b7=$row_cnt;
$bp7 = round(($b7/$a)*100,2);
	$color = $bp7;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp7.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2014
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2014-01-01' AND '2014-12-31' ")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b8=$row_cnt;
$bp8 = round(($b8/$a)*100,2);
	$color = $bp8;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp8.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2013
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2013-01-01' AND '2013-12-31' ")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b9=$row_cnt;
$bp9 = round(($b9/$a)*100,2);
	$color = $bp9;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp9.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2012
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2012-01-01' AND '2012-12-31' ")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b10=$row_cnt;
$bp10 = round(($b10/$a)*100,2);
	$color = $bp10;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp10.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2011
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2011-01-01' AND '2011-12-31' ")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b11=$row_cnt;
$bp11 = round(($b11/$a)*100,2);
	$color = $bp11;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp11.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2010
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2010-01-01' AND '2010-12-31' ")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b12=$row_cnt;
 $bp12 = round(($b12/$a)*100,2);
	$color = $bp12;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp12.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2009
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2009-01-01' AND '2009-12-31' ")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b13=$row_cnt;
$bp13 = round(($b13/$a)*100,2);
	$color = $bp13;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp13.' %';

?>
</td>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2008
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2008-01-01' AND '2008-12-31' '")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b14=$row_cnt;
$bp14 = round(($b14/$a)*100,2);
	$color = $bp14;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp14.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2007
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2007-01-01' AND '2007-12-31' ")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b15=$row_cnt;
$bp15 = round(($b15/$a)*100,2);
	$color = $bp15;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp15.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">2006
<?php
////Nieprzydzielone

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `workStartDate` BETWEEN '2006-01-01' AND '2006-12-31' ")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b16=$row_cnt;
 $bp16 = round(($b16/$a)*100,2);
	$color = $bp16;
 }


?>
</td><?php echo '<td style="';
				if($color == 0 & $color <=1) echo'background-color:'.$kolor1.''; 
				elseif($color >= 2 & $color <=5) echo'background-color:'.$kolor2.''; 
				elseif($color >=6 & $color <=8) echo'background-color:'.$kolor3.''; 
				elseif($color >=9 & $color <=11) echo'background-color:'.$kolor4.''; 
				elseif($color >=12 & $color <=14) echo'background-color:'.$kolor5.''; 
				elseif($color >=15 & $color <=17) echo'background-color:'.$kolor6.''; 
				elseif($color >=18 & $color <=20) echo'background-color:'.$kolor7.'';
				elseif($color >=21 & $color <=23) echo'background-color:'.$kolor8.'';
				elseif($color >=24 & $color <=26) echo'background-color:'.$kolor9.'';
				elseif($color >=27 & $color <=29) echo'background-color:'.$kolor10.'';
				elseif($color >=30 & $color <=32) echo'background-color:'.$kolor11.'';
				elseif($color >=33 & $color <=35) echo'background-color:'.$kolor12.'';
				elseif($color >=36 & $color <= 38) echo'background-color:'.$kolor13.'';
				elseif($color >=39 & $color <= 41) echo'background-color:'.$kolor14.'';
				elseif($color >=42 & $color <= 44) echo'background-color:'.$kolor15.'';
				elseif($color >=45 & $color <= 47) echo'background-color:'.$kolor16.'';
				elseif($color >=48 & $color <= 50) echo'background-color:'.$kolor17.'';
				elseif($color >=51 & $color <= 53) echo'background-color:'.$kolor18.'';
				elseif($color >=54 & $color <= 56) echo'background-color:'.$kolor19.'';
				elseif($color >=57 & $color <= 59) echo'background-color:'.$kolor20.'';
				elseif($color >=60 & $color <= 62) echo'background-color:'.$kolor21.'';
				elseif($color >=63 & $color <= 65) echo'background-color:'.$kolor22.'';
				elseif($color >=66 & $color <= 68) echo'background-color:'.$kolor23.'';
				elseif($color >=69 & $color <= 71) echo'background-color:'.$kolor24.'';
				elseif($color >=72 & $color <= 74) echo'background-color:'.$kolor25.'';
				elseif($color >=75 & $color <= 76) echo'background-color:'.$kolor26.'';
				elseif($color >=77 & $color <= 79) echo'background-color:'.$kolor27.'';
				elseif($color >=80 & $color <= 82) echo'background-color:'.$kolor28.'';
				elseif($color >=83 & $color <= 85) echo'background-color:'.$kolor29.'';
				elseif($color >=86 & $color <= 91) echo'background-color:'.$kolor30.'';
				elseif($color > 92 ) echo'background-color:'.$kolor30.'';
				echo ' font-size: 14px; text-align: center;">';
echo $bp16.' %';

?>
</td></tr>
</tbody>
</table>
</center>

