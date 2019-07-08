<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		echo (session_start()) ? "true" : "false";

		$fun = array();
		echo count($fun);
		$fun[] = 2;
		echo count($fun);
		$fun[count($fun)] = 8;
		$fun[count($fun)] = [2,4];

		print_r($fun);

		echo "<br><br>";

		print_r($_SESSION);echo "<br>";

		//$_SESSION = array();
		echo count($_SESSION);
		$_SESSION[] = 2;
		echo count($_SESSION);
		$_SESSION[count($_SESSION)] = 8;
		$_SESSION[count($_SESSION)] = [2,4];

		print_r($_SESSION);

		echo "dois a -2 = ". pow(2,-2);

	?>

</body>
</html>