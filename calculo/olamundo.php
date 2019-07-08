<!DOCTYPE html>
<html>
<head>
	<title>Ola PHP</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Testando PHP</h1>
	<?php
		echo "<h2>Ola, Mundo!</h2>";

		$idade = 18;
		$no = "Gabriel";
		echo "$no tem $idade anos<br><br>";

		$n1 = $_GET["a"];
		$n2 = $_GET["b"];
		$s = $n1 + $n2;
		$m = $n2 - $n1;

		echo "Os valores são: $n1 e $n2 <br>";

		echo "a soma é $s <br>";
		echo "a subtração é $m";
		echo "<br>a multiplicação é ".$n1*$n2;
		echo "<br>e a divisão ".$n1/$n2;
		echo "<br>e o resto da divisão ".$n1%$n2;

		echo "<br>O valor absoluto de $n2 é ".abs($n2);
		echo "<br>A potencia de $n1<sup>$n2</sup> é ".pow($n1,$n2);
		echo "<br>A raiz quadrada de $n1 é ".sqrt($n1);
		echo "<br>O valor de $n1 arredondado é ".round($n1);
		echo "<br>A parte inteira de $n1 é ".intval($n1);
		echo "<br>O valor de $n2em moeda é R$".number_format($n2, 2, ",", ".");




	?>
</body>
</html>