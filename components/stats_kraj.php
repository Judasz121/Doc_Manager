
<center><table cellspacing="5" cellpadding="5">
<tbody>
<tr><td style="background-color: #ffffff; font-size: 14px;">Kraje</td><tr>
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
<tr><td style="background-color: #fff; font-size: 14px;">UK
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%UK. %'")) {


    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b1 = $row_cnt;
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
<tr><td style="background-color: #fff; font-size: 14px;">DE
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%DE.%'")) {

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
<tr><td style="background-color: #fff; font-size: 14px;">NO
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%NO.%'")) {

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
<tr><td style="background-color: #fff; font-size: 14px;">NL
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%NL.%'")) {

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
<tr><td style="background-color: #fff; font-size: 14px;">BE
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%BE.%'")) {

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
<tr><td style="background-color: #fff; font-size: 14px;">AT
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%AT.%'")) {

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
<tr><td style="background-color: #fff; font-size: 14px;">PT
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%PT.%'")) {

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
<tr><td style="background-color: #fff; font-size: 14px;">BG
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%BG.%'")) {

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
<tr><td style="background-color: #fff; font-size: 14px;">HR
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%HR.%'")) {

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
<tr><td style="background-color: #fff; font-size: 14px;">CY
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%CY.%'")) {

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
<tr><td style="background-color: #fff; font-size: 14px;">CZ
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%CZ.%'")) {

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
<tr><td style="background-color: #fff; font-size: 14px;">DK
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%DK.%'")) {

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
<tr><td style="background-color: #fff; font-size: 14px;">EE
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%EE.%'")) {

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
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">FI
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%FI.%'")) {

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
<tr><td style="background-color: #fff; font-size: 14px;">FR
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%FR.%'")) {

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
<tr><td style="background-color: #fff; font-size: 14px;">GR
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%GR.%'")) {

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
<tr><td style="background-color: #fff; font-size: 14px;">ES
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%ES.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b17=$row_cnt;
	$bp17 = round(($b17/$a)*100,2);
	$color = $bp17;
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
echo $bp17.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">IE
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%IE.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b18=$row_cnt;
	$bp18 = round(($b18/$a)*100,2);
	$color = $bp18;
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
echo $bp18.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">IS
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%IS.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b19=$row_cnt;
	$bp19 = round(($b19/$a)*100,2);
	$color = $bp19;
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
echo $bp19.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">LI
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%LI.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b20=$row_cnt;
	$bp20 = round(($b20/$a)*100,2);
	$color = $bp20;
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
echo $bp20.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">LT
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%LT.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b22=$row_cnt;
	$bp22 = round(($b22/$a)*100,2);
	$color = $bp22;
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
echo $bp22.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">LU
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%LU.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b23=$row_cnt;
	$bp23 = round(($b23/$a)*100,2);
	$color = $bp23;
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
echo $bp23.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">LV
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%LV.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b34=$row_cnt;
	$bp34 = round(($b34/$a)*100,2);
	$color = $bp34;
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
echo $bp34.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">PT
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%PT.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b35=$row_cnt;
	$bp35 = round(($b35/$a)*100,2);
	$color = $bp35;
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
echo $bp35.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">MT
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%MT.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b36=$row_cnt;
	$bp36 = round(($b36/$a)*100,2);
	$color = $bp36;
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
echo $bp36.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">PT
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%PT.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b37=$row_cnt;
	$bp37 = round(($b37/$a)*100,2);
	$color = $bp37;
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
echo $bp37.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">RO
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%RO.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b38=$row_cnt;
	$bp38 = round(($b38/$a)*100,2);
	$color = $bp38;
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
echo $bp38.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">SK
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%SK.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b39=$row_cnt;
	$bp39 = round(($b39/$a)*100,2);
	$color = $bp39;
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
echo $bp39.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">SI
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%SI.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b40=$row_cnt;
	$bp40 = round(($b40/$a)*100,2);
	$color = $bp40;
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
echo $bp40.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">CH
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%CH.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b41=$row_cnt;
	$bp41 = round(($b41/$a)*100,2);
	$color = $bp41;
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
echo $bp41.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">SE
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%SE.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b42=$row_cnt;
	$bp42 = round(($b42/$a)*100,2);
	$color = $bp42;
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
echo $bp42.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">HU
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%HU.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b43=$row_cnt;
	$bp43 = round(($b43/$a)*100,2);
	$color = $bp43;
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
echo $bp43.' %';

?>
</td></tr>
<tr><td style="background-color: #fff; font-size: 14px;">IT
<?php
////2019

  if ($resultN = $mysqli->query("SELECT * FROM `documents` WHERE `comments` LIKE '%IT.%'")) {

    /* determine number of rows result set */
     $row_cnt = $resultN->num_rows;

    printf(" - %d \n", $row_cnt);

   /* close result set */
    $b44=$row_cnt;
	$bp44 = round(($b44/$a)*100,2);
	$color = $bp44;
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
echo $bp44.' %';

?>
</td></
</tr>

</tbody>
</table>
</center>

