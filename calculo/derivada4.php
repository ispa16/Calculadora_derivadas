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
		$f = $b;
		if ($e!=0 && $b!=0) {
			if ($b==1 && $e!=0) $f = "";
			$f = $f."x";
			if ($e!=1) $f = $f."<sup>$e</sup>";
		}

		$d = $e*$b."x<sup>".($e-1)."</sup>";
	?>
	<div class="container">
	    <h1 class="text-center">Derivadas!</h1>
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
			<input class="btn btn-primary" type="submit" value="Resolver">
			<button type="button" class="btn btn-outline-primary">+</button>
		</form>

		<?php 
			echo "<br>f(x) = ".$f;
			echo "<br>f'(x) = ".$d;
		?>
	</div>
</body>
</html>