<?php
	session_start();
	
	$b = (isset($_GET["base"])) ? $_GET["base"] : "" ;
	$e = (isset($_GET["exp"])) ? $_GET["exp"] : "" ;

	$values = [$b, $e];

	if($b!="" && $e!=""){
		array_push($_SESSION, $values);
	}

	header("location: session.php");
?>