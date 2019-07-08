<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		//include 'session2.php';
		session_start();

		echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";

		$b = $_GET["base"];
		$b = (isset($_GET["base"])) ? $_GET["base"] : "" ;
		//$e = $_GET["exp"];
		$e = (isset($_GET["exp"])) ? $_GET["exp"] : "" ;

		$values = [];
		$values = [$b, $e];
		print_r($values);
		//echo "session class :".get_class($_SESSION);

		if(!empty($b) && !empty($e)){
			//$_SESSION["".$index] = $values;
			//$_SESSION[] = $values;
			array_unshift($values, $_SESSION);
		}
		//array_push($_SESSION["functions"], array($b, $e));

		echo "<pre>";
		print_r($values);
		echo "</pre>";//*/

		foreach ($values as $v) {
			echo "<br>$v";
		}
	?>
	<form method="GET" action="session.php">
		<input type="number" name="base">
		<input type="number" name="exp">
		<input type="submit" value="Enviar">
	</form>
</body>
</html>