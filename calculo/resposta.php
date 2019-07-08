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

    <!-- Processamento php -->
    <?php
        session_start();

        $dataPoints = $_SESSION['m']['y'] = $_SESSION['m']['x'] = array();

        //*
        function calculaFuncao($val){
            $resposta = 0;
            for($i=0; $i < count($_SESSION['bases']); $i++){
                $resposta += $_SESSION['bases'][$i]*pow($val, $_SESSION['expoentes'][$i]);
            }
            return $resposta;
        }
        function calculaDerivada($val){
            $resposta = 0;
            for($i=0; $i < count($_SESSION['dbases']); $i++){
                $resposta += $_SESSION['dbases'][$i]*pow($val, $_SESSION['dexpoentes'][$i]);
            }
            return $resposta;
        }
        function verifica($ini, $fim, $points=1000){
            $precision = round(($fim-$ini)/$points, 6);
            for ($z=$ini; $z <= $fim+$precision; $z += $precision) {
                $z = round($z, 6);

                $res = calculaDerivada($z);
                // Guardando valores para montar o gráfico
                //$dataPoints['derivada'] .= "{ x: $x, y: $res },";
                // echo "{ x: $z, y: $res },<br>";

                // Logica para encontrar o Ponto min||max
                if($res==0){
                    $ant = $res;
                    array_push($_SESSION['m']['x'], $z);
                    array_push($_SESSION['m']['y'], calculaFuncao($z));
                    //break;
                }elseif(isset($ant)){
                    if(($ant<0 && $res>0) || ($ant>0 && $res<0)){
                        $ant = $res;
                        $asdf = ($z + $z-$precision)/2;
                        array_push($_SESSION['m']['x'], $asdf);
                        array_push($_SESSION['m']['y'], calculaFuncao($z));
                    }else $ant = $res;
                }else $ant = $res;
            }
        }
        //*/

        // Loop para rodar do valor minimo do dominio ao max aumentando 1%o(por mil) por vez
        for ($x = $_GET['min']; $x <= $_GET['max']+0.001; $x+=0.001) {

            // CALCULO DA RESPOSTA DA FUNCAO
                $res = calculaFuncao($x);
                // Guardando valores para montar o gráfico
                $dataPoints['function'] .= "{ x: $x, y: $res },";

            
            // CALCULO DA RESPOSTA DA FUNCAO
                $res = calculaDerivada($x);

                // Guardando valores para montar o gráfico
                $dataPoints['derivada'] .= "{ x: $x, y: $res },";

                // Logica para encontrar o Ponto min||max
                if($res==0){
                    array_push($_SESSION['m']['x'], $x);
                    array_push($_SESSION['m']['y'], calculaFuncao($x));
                }elseif(isset($ant)){
                    if(($ant<0 && $res>0) || ($ant>0 && $res<0)){
                        verifica($x-0.001, $x);
                    }
                }
                $ant = $res;
        }

        // Loop para rodar do valor minimo do dominio ao max aumentando 1%o(por mil) por vez
        // for ($x = $_GET['min']; $x <= $_GET['max']+0.001; $x+=0.001) {
        // }
    ?>

    <!-- SCRIPTS PARA MONTAR O GRAFICO -->
    <script type="text/javascript">
        window.onload = function () {
            
            $('#myModal').modal('show');

            var chart = new CanvasJS.Chart("chartContainer",
            {
                zoomEnabled: true,
                animationEnabled: true,
                theme: "theme2",
                title:{
                    text: "Grafico da Função e Derivada"
                },
                toolTip: {
                    shared: true,
                },
                axisX:{
                    title: "Valores de X",
                    lineThickness: 1
                }, 
                axisY:{
                  labelFontColor: "#369EAD",
                  titleFontColor: "#369EAD",
                  lineColor: "#369EAD",
                  tickColor: "#369EAD",
                  gridThickness: 1, 
                  lineThickness: 1
                },
                axisY2:{
                  titleFontColor: "#F0504E",                  
                  labelFontColor: "#F0504E",
                  lineThickness: 1,
                  gridThickness: 0,
                  tickThickness: 0
                },
                data: [
                {
                    type: "spline", //change type to bar, line, area, pie, etc
                    showInLegend: true,
                    name: "Função",  
                    dataPoints: [
                        <?php
                            // Print dos valores para montar o gráfico
                            echo $dataPoints['function'];
                        ?>
                    ]
                },
                    {
                    type: "spline",
                    axisYIndex: 1,
                    showInLegend: true,
                    name: "Derivada",            
                    axisYType:"secondary",      
                    dataPoints: [
                        <?php
                            // Print dos valores para montar o gráfico
                            echo $dataPoints['derivada'];
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

            setTimeout(function () {
                chart.render();
            }, 13000);
        }
    </script>
    <script type="text/javascript" src="_js/canvasjs.min.js"></script>
</head>
<body>
    <h1>Resposta</h1>
        <br>
        <!--pre id="pre">_GET
        <?php
            //if(!empty($_GET))
            print_r($_GET);
        ?>
        </pre-->
        <!--pre id="pre">_POST
        <?php
            print_r($_POST);
        ?>
        </pre>
        <pre id="pre">_SESSION
        <?php
            print_r($_SESSION);
        ?>
        </pre>
        <pre id="pre">$m
        <?php
            print_r($m);
        ?>
        </pre-->

    <!-- Paineis =================================-->

        <!-- Grupo de Painel da Funcao e Derivada -->
        <div id="panel1" class="hidden col-lg-12 col-md-12">

            <!-- Painel da Funcao -->
            <div class="col-lg-6 col-md-6">
                <div id="funcao" class="panel panel-default">
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
                                        if($_SESSION['x'][$i]) echo  "x";
                                        if($_SESSION['expoentes'][$i]!=1)
                                            echo "<sup>".$_SESSION['expoentes'][$i]."</sup> ";
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Painel da Derivada -->
            <div class="col-lg-6 col-md-6">
                <div id="derivada" class="panel panel-default">
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
        </div>

        <!-- Grupo de Painel do Ponto min/max -->
        <div id="panel2" class="hidden col-lg-12 col-md-12">

            <!-- Painel do Ponto min/max -->
            <div class="col-lg-6 col-md-6">
                <div id="Pmin/max" class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ponto Min/Max</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                            foreach ($_SESSION['m']['x'] as $x) {
                                echo "X = ".$x."<br>";
                            }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Painel da Derivada -->
            <div class="col-lg-6 col-md-6">
                <div id="Pmin/max" class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Valor Min/Max</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                            foreach ($_SESSION['m']['y'] as $y) {
                                echo "Y = ".$y."<br>";
                            }
                        ?>
                    </div>
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

        <br>
        <button id="new" class="hidden btn btn-primary btn-block">Novo Cálculo</button>
        <br>
        <br>

        <!-- Script de acionamento dos modals e animacoes -->
        <script>
            $('.modal').modal({backdrop:'static',keyboard:false,show:false});

            $('#myModal').on('shown.bs.modal', function () {
                setTimeout(function () {
                    $('#myModal').modal('hide');
                }, 4000);
            });

            $('#myModal').on('hidden.bs.modal', function (){
                $('#myModal2').modal('show');

                setTimeout(function () {
                    $('#myModal2').modal('hide');

                    $('#ani').removeClass('hidden');
                    $('#ani').addClass('ani');

                    setTimeout(function () {
                            $('#panel1').removeClass('hidden');
                            $('#panel1').addClass('animated fadeInDown');
                            $('#panel2').removeClass('hidden');
                            $('#panel2').addClass('animated fadeInDown');
                            $('#grafico').removeClass('hidden');
                            $('#grafico').addClass('animated fadeInDown');
                            $('#new').removeClass('hidden');
                            $('#new').addClass('animated fadeInDown');
                            chart.render();
                    }, 1000);

                }, 3000);
            });

            $('#new').on('click', function(){
                window.location.replace('limpa.php');
            });

            $('#myModal').modal('hide');
            $('#myModal2').modal('hide');
        </script>
</body>
</html>