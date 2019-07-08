<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<title></title>
</head>
<body>
	<?php
		$b = $_GET["base"];
		$e = $_GET["exp"];
		$f = $_GET["func"];
		$d = $_GET["drvd"];

		var_dump($b);
		var_dump($e);
		var_dump($f);
		var_dump($d);

		if ($b!="" && $e!="") {
			# Logica para motar a funcao f(x);
			$pf = abs($b);
			if ($e!=0 && $b!=0) {
				if ($b==1 && $e!=0) $pf = "";
				$pf = $pf."x";
				if ($e!=1) $pf = $pf."<sup>$e</sup>";
			}
			if($b >= 0)
				$f = (isset($f)) ? $f." + ".$pf : $pf ;#$f = $f." ".$pf;
			else
				$f = (isset($f)) ? $f." - ".$pf : $pf ;#$f = $f." ".$pf;

			# Logica para motar o derivada

			$pd = ($e*$b)."x<sup>".($e-1)."</sup>";
			$d = (isset($d)) ? $d." + ".$pd : $pd ;
		}

		var_dump($f);
		var_dump($d);

	?>
	<div class="container">
	    <a href="derivada2.php"><h1 class="text-center">Derivadas!</h1></a>
		<form>
			<div class="form-group row">
				<div class="input-group mb-2 mr-sm-2 mb-sm-0">
					<div class="input-group-addon col-3">Base</div>
					<input type="number" class="form-control" name="base" placeholder="Valor que multiplica o 'x'">
				</div>				
			</div>
			<div class="form-group row">
				<div class="input-group mb-2 mr-sm-2 mb-sm-0">
					<div class="input-group-addon col-3">Expoente</div>
					<input type="number" class="form-control" name="exp" placeholder="Potência do 'x'">
				</div>				
			</div>
			<?php if (isset($f) && isset($d)){
				echo "<input type=\"text\" class=\"hidden-xs-up\" name=\"func\" value=\"$f\">";
				echo "<input type=\"text\" class=\"hidden-xs-up\" name=\"drvd\" value=\"$d\">";
				echo "<input class=\"btn btn-outline-primary\" type=\"submit\" value=\"+\">";
			}else{
				echo "<input class=\"btn btn-primary\" type=\"submit\" value=\"Resolver\">";
			}?>
			<!--form method="GET" <?php if (isset($f) && isset($d)) echo "action=\"derivada2.php?func=$f&drvd=$d\"";?>>
				<input class="btn btn-outline-primary" type="submit" value="+">			
			</form-->
			<!--a href=<?php if (isset($f) && isset($d)) echo "\"?func=$f&drvd=$d\"";?> role="button" class="btn btn-outline-primary" >+</a-->
		</form>

		<?php 
			if (isset($f) && isset($d)) {
				echo "<br>f(x) = ".$f;
				echo "<br>f'(x) = ".$d;
			}
		?>
	</div>
</body>
</html>