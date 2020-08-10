<div class="doc filter"><
<h1><?php echo $filtr. ' '. $userManager;?></h1>
	<div class="filterItem">
		<span>Login</span>
		<span><input type="text" name="filterLogin" class="filter" value="<?php if(isset($_POST['filterLogin'])) echo $_POST['filterLogin']; ?>"/></span>
	</div>
	<div class="filterItem">
		<span><?php echo $imie.' i '.$nazwisko; ?></span>
		<span><input type="text" name="filterFullName" class="filter" value="<?php if(isset($_POST['filterFullName'])) echo $_POST['filterFullName']; ?>"/></span>
	</div>
	<div class="filterItem">
		<span><?php echo $haslo; ?></span>
		<span><input type="text" name="filterPassword" class="filter" value="<?php if(isset($_POST['filterPassword'])) echo $_POST['filterPassword']; ?>"/></span>
	</div>
</div>
