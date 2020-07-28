<script>
<?PHP 
	// $FN = $_SERVER['REQUEST_URI'];
	// $FN = explode("?", $FN)[0];
	// $FN = end(explode("/", $FN));
	echo 'var currFileName = "'.$currFile.'";';
	echo 'var currUserName = "'.$_SESSION['login'].'";';
?>
</script>
<script src="js/script.js?v=<?php echo rand(1, 1000000) ?>"></script>
<script src="js/script_<?php echo $currFileNoExtension ?>.js?v=<?php echo rand(1, 1000000) ?>"></script>