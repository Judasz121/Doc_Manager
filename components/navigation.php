<?php
include 'slownik/slownik.php';
include 'slownik/zmienne.php';
?><b><font size="6" color="#FECB00">&#9646;</font><font size="5"><?php echo $tytul;?></b></font><font size="6" color="#FECB00">&#9646;</font><br>
<font size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jesteś zalogowany jako:&nbsp;<b><?php echo $_SESSION['login'].' '.$_SESSION['fullName'].'</b> | Typ konta:<b>'.$_SESSION['accType'];?></b></font><BR><BR><BR><BR>
	<div class="navButtons">
		<a href="logout.php" class="logout"><button class="button"><?php echo $logout;?></button></a>
		<?php if($_SESSION['accType'] == "korespondencja" || $_SESSION['accType'] == "admin" || $_SESSION['accType'] == "dyrektor" )
			echo'<a href="index_a.php" class="logout"><button class="button">'.$index_a.'</button></a>';
		?>
		<a href="index.php" class="logout"><button class="button"><?php echo $index;?></button></a>
		<a href="view_client.php" class="logout"><button class="button"><?php echo $viewclient;?></button></a>
		<a href="employee.php?orderby=dateModified&order=DESC" class="logout"><button class="button"><?php echo $employee;?></button></a>
		<br>
		<a href="duplicate.php?orderby=dateModified&order=DESC" class="logout"><button class="button"><?php echo $duplicate;?></button></a>
		<a href="big_brother.php?orderby=dateModified&order=DESC" class="logout" alt="BigBrother"><button class="button"><img src="ikony/eye.png" height="12"  ></button></a>
		<?php if($_SESSION['accType'] == "admin" || $_SESSION['accType'] == "dyrektor" )
			echo'<a href="archive.php?orderby=dateModified&order=DESC" class="logout"><button class="button">'.$archive.'</button></a>';
		?>
		<?php if($_SESSION['accType'] == "admin" || $_SESSION['accType'] == "dyrektor" || $_SESSION['accType'] == "kierownik")
			echo'<a href="manager_new.php?orderby=addedTime&order=DESC" class="logout"><button class="button">'.$manager.'</button></a>';
		?>
		<?php if($_SESSION['accType'] == "korespondencja" || $_SESSION['accType'] == "admin" || $_SESSION['accType'] == "dyrektor" || $_SESSION['accType'] == "archiwum" )
			echo'<a href="piwnica_new.php?orderby=dateModified&order=DESC" class="logout"><button class="button">'.$piwnica.'</button></a>';
		?>
		<?php if($_SESSION['accType'] == "admin" || $_SESSION['accType'] == "dyrektor")
			echo'<a href="userManager.php?orderby=dateModified&order=DESC" class="logout"><button class="button">'.$userManager.'</button></a>';
		?>
		<?php if($_SESSION['accType'] == "admin" || $_SESSION['accType'] == "dyrektor" || $_SESSION['accType'] == "kierownik")
			echo'
		<br>	
		<a href="manager_monit.php?orderby=dateModified&order=ASC" class="logout"><button class="button">'.$archive_monit1.'</button></a>
		<a href="manager_monit_zagr.php?orderby=dateModified&order=ASC" class="logout"><button class="button">'.$archive_monit2.'</button></a>
		<a href="manager_monit_kpa.php?orderby=dateModified&order=ASC" class="logout"><button class="button">'.$archive_monit3.'</button></a>';
		?>
		</div>
	<div class="navStats">
	<?php
include 'components/stats.php';
?>
	</div>

