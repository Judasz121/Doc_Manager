	<div class="navButtons">

		</div>

	<?php
include 'slownik/slownik.php';
include 'slownik/zmienne.php';
?><b><font size="8" color="#FECB00">&#9646;</font><font size="6"><?php echo $tytul;?></b></font><font size="8" color="#FECB00">&#9646;</font><br>
<font size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jesteś zalogowany jako:&nbsp;<b><?php echo $_SESSION['login'];?></b></font><BR><BR><BR><BR>
	<div class="navButtons">
		<a href="logout.php" class="logout"><button class="button"><?php echo $logout;?></button></a>
		<a href="index_a.php" class="logout"><button class="button"><?php echo $index_a;?></button></a>
		<a href="index.php" class="logout"><button class="button"><?php echo $index;?></button></a>
		<a href="view_client.php" class="logout"><button class="button"><?php echo $viewclient;?></button></a>
		<a href="employee.php?orderby=dateModified&order=DESC" class="logout"><button class="button"><?php echo $employee;?></button></a>
	</div><br><br><div class="navButtons">	
		<a href="archive.php?orderby=dateModified&order=DESC" class="logout"><button class="button"><?php echo $archive;?></button></a>
		<a href="manager_monit.php?orderby=dateModified&order=ASC" class="logout"><button class="button"><?php echo $monit;?></button></a>
		<a href="manager_new.php?orderby=addedTime&order=DESC" class="logout"><button class="button"><?php echo $manager;?></button></a>
		<a href="piwnica_new.php?orderby=dateModified&order=DESC" class="logout"><button class="button"><?php echo $piwnica;?></button></a>
	</div><br><br><div class="navButtons">	
		<a href="manager_monit.php?orderby=dateModified&order=ASC" class="logout"><button class="button"><?php echo $archive_monit1;?></button></a>
		<a href="manager_monit_zagr.php?orderby=dateModified&order=ASC" class="logout"><button class="button"><?php echo $archive_monit2;?></button></a>
		<a href="manager_monit_kpa.php?orderby=dateModified&order=ASC" class="logout"><button class="button"><?php echo $archive_monit3;?></button></a>
		</div>
	<div class="navStats">
	<?php
include 'components/stats.php';
?>
	</div>