<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Chamando de bootman</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="calculando derivadas com o batman">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 3.3.7 e JQuery 2.1.3 -->
	    <!-- Latest compiled and minified CSS -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	    <!-- Optional theme -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	    <!-- JQuery -->
	    <script src="https://code.jquery.com/jquery-2.1.3.js"></script>

	    <!-- Latest compiled and minified JavaScript -->
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<!-- Efeitose animacoes -->
	    <link rel="stylesheet" type="text/css" href="_css/myanimations.css">
	    <link rel="stylesheet" type="text/css" href="_css/animate.css">

    <!-- Logica para receber os valores e calcular a derivada -->
	<?php
		session_start();

		if(!isset($_SESSION['bases']))
			$_SESSION['bases'] = array();

		if(!isset($_SESSION['expoentes']))
			$_SESSION['expoentes'] = array();

		if(!isset($_SESSION['x']))
			$_SESSION['x'] = array();

		if(!isset($_SESSION['dbases']))
			$_SESSION['dbases'] = array();

		if(!isset($_SESSION['dexpoentes']))
			$_SESSION['dexpoentes'] = array();

		if(!isset($_SESSION['dx']))
			$_SESSION['dx'] = array();

		if(isset($_GET['base']) && isset($_GET['exp']) && isset($_GET['usaX'])){
			array_push($_SESSION['bases'], $_GET['base']);
			array_push($_SESSION['expoentes'], $_GET['exp']);
			array_push($_SESSION['x'], $_GET['usaX']);

			if($_GET['usaX']){
				array_push($_SESSION['dbases'], $_GET['base']*$_GET['exp']);
				array_push($_SESSION['dexpoentes'], $_GET[exp]-1);
				array_push($_SESSION['dx'], 1);
			}else{
				array_push($_SESSION['dbases'], 0);
				array_push($_SESSION['dexpoentes'], 0);
				array_push($_SESSION['dx'], 0);
			}
		}
		/*
		$_SESSION = array();
		//*
			echo "Session: <pre>";
			print_r($_SESSION);
			echo "</pre>";
		//*/

		$min = 0.9;
		$max = 9;
	?>

	<!-- SCRIPTS PARA MONTAR O GRAFICO -->
    <script type="text/javascript">
		window.onload = function () {
			var chart = new CanvasJS.Chart("chartContainer",
			{
				animationEnabled: true,
		      	theme: "theme2",
				title:{
					text: "Grafico da Função e Derivada"
				},
		      	axisY:[{
		          lineColor: "#4F81BC",
		          tickColor: "#4F81BC",
		          labelFontColor: "#4F81BC",
		          titleFontColor: "#4F81BC",
		          lineThickness: 2,
		      	},
		        {
		          lineColor: "#C0504E",
		          tickColor: "#C0504E",
		          labelFontColor: "#C0504E",
		          titleFontColor: "#C0504E",
		          lineThickness: 2,
		          
		      	}],
				data: [
				{
					type: "spline", //change type to bar, line, area, pie, etc
					showInLegend: true,        
					dataPoints: [
						<?php
							for ($x = $min; $x <= $max; $x+=0.1) {
								$res = 0;
								for($i=0; $i < count($_SESSION['bases']); $i++){
									$res += $_SESSION['bases'][$i]*pow($x, $_SESSION['expoentes'][$i]);
								}
								echo "{ x: $x, y: $res },";
							}
						?>
					]
					},
					{
					type: "spline",
							axisYIndex: 1,
					showInLegend: true,            
					dataPoints: [
						<?php
							for ($x = $min; $x <= $max; $x+=0.1) {
								$res = 0;
								for($i=0; $i < count($_SESSION['dbases']); $i++){
									$res += $_SESSION['dbases'][$i]*pow($x, $_SESSION['dexpoentes'][$i]);
								}
								echo "{ x: $x, y: $res },";
							}
						?>
					]
					}
				],
				legend: {
					cursor: "pointer",
					itemclick: function (e) {
						if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
							e.dataSeries.visible = false;
						} else {
							e.dataSeries.visible = true;
					}
					chart.render();
					}
				}
			});

			chart.render();
		}
	</script>
	<script type="text/javascript" src="_js/canvasjs.min.js"></script>
</head>

<!-- Pagina ===================================================================-->
<body>
	<div class="container">

	    <h1 class="text-center">Derivadas!</h1>

	<!-- Formulario ==============================-->

		<form id="formulario">
			<div class="form-group row">
				<div class="input-group col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
					<div class="input-group-addon col-3">Base</div>
					<input type="number" class="form-control" name="base" placeholder="Valor que multiplica o 'x'" required="true" step=".01">
				</div>				
			</div>
			<div class="form-group row col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
				<div class="btn-group btn-group-justified" data-toggle="buttons">
					<label for="" class="btn btn-primary active">
						<input type="radio" name="usaX" id="0" value="1" checked="true"> Com X
					</label>
					<label for="" class="btn btn-primary">
						<input type="radio" name="usaX" id="1" value="0"> Sem X
					</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="input-group col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
					<div class="input-group-addon col-3">Expoente</div>
					<input type="number" class="form-control" name="exp" placeholder="Potência do 'x'" required="true" step=".01">
				</div>				
			</div>
			<input class="btn btn-primary" type="submit" value="Adicionar">
			<button type="button" id="butao" class="btn btn-primary" data-target="#myModal" data-toggle="modal">Calcular</button>
		</form>

		<br><br>

	<!-- Paineis =================================-->

	    <!-- Grupo de Painel da Funcao e Derivada-->
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">

	    	<!-- Painel da Funcao -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Função</h3>
                </div>
                <div class="panel-body">

	    			<!-- Logica para printar a funcao -->
					<?php
						for ($i=0; $i < count($_SESSION['bases']); $i++) {

							// So printa algo se a base nao for 0
							if($_SESSION['bases'][$i]!=0){

								// Verificar e printar '+ ou '-'
								if($i!=0 && $_SESSION['bases'][$i]>0) echo " + ";
								elseif ($_SESSION['bases'][$i]<0) echo " - ";

								// Verificacao para printar a base
								if( abs($_SESSION['bases'][$i])!=1 || $_SESSION['expoentes'][$i]==0 )
									echo abs($_SESSION['bases'][$i]);

								// Verificacao para printar o 'x' e o expoente
								if($_SESSION['expoentes'][$i]!=0){
									if($_SESSION['x'][$i]) echo	 "x";
									if($_SESSION['expoentes'][$i]!=1)
										echo "<sup>".$_SESSION['expoentes'][$i]."</sup> ";
								}
							}
						}
					?>
                </div>
            </div>

	    	<!-- Painel da Derivada -->
            <div id="derivadas" class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Derivada</h3>
                </div>
                <div class="panel-body">
	    			
	    			<!-- Logica para printar a derivada -->
					<?php
						for ($i=0; $i < count($_SESSION['dbases']); $i++) {

							// So printa algo se a base nao for 0
							if($_SESSION['dbases'][$i]!=0){

								// Verificar e printar '+ ou '-'
								if($i!=0 && $_SESSION['dbases'][$i]>0) echo " + ";
								elseif ($_SESSION['dbases'][$i]<0) echo " - ";

								// Verificacao para printar a base
								if( abs($_SESSION['dbases'][$i])!=1 || $_SESSION['dexpoentes'][$i]==0 )
									echo abs($_SESSION['dbases'][$i]);

								// Verificacao para printar o 'x' e o expoente
								if($_SESSION['dexpoentes'][$i]!=0){
									echo "x";
									if($_SESSION['dexpoentes'][$i]!=1)
										echo "<sup>".$_SESSION['dexpoentes'][$i]."</sup> ";
								}
							}
						}
					?>
                </div>
            </div>
        </div>

	    <!-- Painel do grafico -->
		<div id="grafico" class="hidden col-lg-12 col-md-12">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <h3 class="panel-title">Gráfico</h3>
	            </div>
	            <div class="panel-body">
	            	<div id="chartContainer" style="height: 500px; width: 100%;"></div>
	            </div>
	        </div>
		</div>

	<!-- Modals ==================================-->

	    <!-- Modal 1 - Calculando -->
	    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h2 class="modal-title" id="myModalLabel">Calculando...</h2>
	                </div>
	                <div class="modal-body">
	                    <img src="_img/calculando.gif">
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- Modal 2 - Chamando Batman -->
	    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h2 class="modal-title" id="myModalLabel">Muito difícil. Vamos chamar o Batman!</h2>
	                </div>
	                <div class="modal-body">
	                    <img src="_img/batsignal.gif">
	                </div>
	            </div>
	        </div>
	    </div>

	<!-- Animacao ================================-->

	    <!-- Morcego -->
	    <div id="ani" class="hidden">
	        <div class="parent">
	            <div class="bat"></div>
	        </div>
	    </div>

	    <!-- Script de acionamento dos modals e animacoes -->
	    <script>
	        $('.modal').modal({backdrop:'static',keyboard:false});

	        $('#myModal').on('shown.bs.modal', function () {
	            $('#ani').removeClass('ani');
	            $('#ani').addClass('hidden');
	            setTimeout(function () {
	                $('#myModal').modal('hide');
	            }, 4000);
	        });

	        $('#myModal').on('hidden.bs.modal', function (){
	            $('#myModal2').modal('show');
	        });

	        $('#myModal2').on('shown.bs.modal', function () {
	            setTimeout(function () {
	                $('#myModal2').modal('hide');
	                $('#ani').removeClass('hidden');
	                $('#ani').addClass('ani');
	                setTimeout(function () {
	                    $('#formulario').addClass('animated fadeOutDown');
	                    setTimeout(function () {
	                        $('#formulario').addClass('hidden');
	                        $('#derivadas').removeClass('hidden');
	                        $('#derivadas').addClass('animated fadeInDown');
	                        $('#grafico').removeClass('hidden');
	                        $('#grafico').addClass('animated fadeInDown');
	                    }, 900);
	                }, 1000);
	            }, 3000);
	        });

	        $('#myModal').modal('hide');
	        $('#myModal2').modal('hide');
	    </script>
	</div>
</body>
</html>