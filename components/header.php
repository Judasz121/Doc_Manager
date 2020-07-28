<?PHP
	$currFile = $_SERVER['REQUEST_URI'];
	$currFile = explode("?", $currFile)[0];
	$currFile = end(explode("/", $currFile));
	$currFileNoExtension = explode(".", $currFile)[0];
?>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php echo '<link rel="stylesheet" href="css/style_'.$currFileNoExtension.'.css?v='.rand(1, 1000000).'">'; ?>
<link rel="stylesheet" href="css/style.css?v=<?php echo rand(1, 1000000) ?>">
<link rel="stylesheet" href="fontello/css/fontello.css?v=<?php echo rand(1, 1000000) ?>">
<!--FONTS-->
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">