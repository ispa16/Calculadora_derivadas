<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";

		//$fun = $_GET["func"];
		$fun = (isset($_POST[0])) ? $_POST : NULL;
		echo "<br>VD1 ";
		var_dump($fun);

		if(!isset($fun) || $fun==""){
			$fun = [];
			$fun[] = 2;
			$fun[] = 6;
			$fun[] = 8;
			$fun[] = [2,4];
			$fun[] = '2';
			$fun[] = "2345";
		}

		echo "<br>VD2 ";
		echo "<pre>";
		print_r($fun);
		echo "</pre>";

		function imprime($arr){
			foreach ($arr as $v) {
				echo is_array($v) ? imprime($v) : "<br>".gettype($v)." val: $v";
			}
		}

		//imprime($fun);

		echo imprime(explode("m", "lorem ipsum dolor sit amet"));

		echo "<br>".implode(" -> ", $fun);

		/*echo "<pre>";
		print_r($fun);
		echo "</pre>";*/

		//$_POST = $fun;
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";

		echo "<form method=\"POST\">";
		foreach ($_POST as $v) {
			echo "<input style=\"display: none;\" type=\"text\" name=\"nomes[]\" value=\"$v\">";
		}
		echo "<input type=\"submit\" value=\"submit\"></form>";
	?>

</body>
</html>