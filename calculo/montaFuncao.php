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
	?>
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
			<input id="add" class="btn btn-primary" type="submit" value="Adicionar">
			<button type="button" id="butao" class="btn btn-primary" data-target="#myModal" data-toggle="modal">Calcular</button>
		</form>

		<br><br>

	<!-- Painel ==================================-->

		<div id="panelFunction" class="hidden col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">

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
        </div>

	<!-- Modal ===================================-->
	    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h2 class="modal-title" id="myModalLabel">Qual o Domínio da Função?</h2>
	                </div>
	                <div class="modal-body">
	                    <form action="resposta.php">
	                        <div class="form-group row">
	                            <div class="input-group mb-2 mr-sm-2 mb-sm-0 col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
	                                <div class="input-group-addon col-3">Mínimo</div>
	                                <input type="number" class="form-control" name="min" placeholder="Valor mínimo para 'x'" required="true" step=".01">
	                            </div>              
	                        </div>
	                        <div class="form-group row">
	                            <div class="input-group mb-2 mr-sm-2 mb-sm-0 col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
	                                <div class="input-group-addon col-3">Máximo</div>
	                                <input type="number" class="form-control" name="max" placeholder="Valor máximo para 'x'" required="true" step=".01">
	                            </div>              
	                        </div>
	                        <div class="form-group row">
	                            <input class="btn btn-primary col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1" type="submit" value='Pronto!'>   
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>

	<!-- Script de acionamento do modal ==========-->
	    <script>
		    <?php
		    	if(!empty($_SESSION['x']))
		    		echo "
						$(window).load(function() {
							$('#panelFunction').removeClass('hidden');
							$('#panelFunction').addClass('animated fadeInDown');
						});
		    		";
		    ?>

	        $('#myModal').modal('hide');
	    </script>
	</div>
</body>
</html>