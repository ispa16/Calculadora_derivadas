<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Chamando de bootman</title>
    <meta name="description" content="calculando derivadas com o batman">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="_css/myanimations.css">
    <link rel="stylesheet" type="text/css" href="_css/animate.css">
</head>
<body>
    <br>
    <br>
    <pre id="pre">
    <?php
        if(!empty($_GET)) print_r($_GET);
        if(!empty($_POST)) print_r($_POST);
    ?>
    </pre>
    <br>
    <br>
    <div class="col-lg-4 col-lg-offset-4">
        <button type="button" id="butao" class="btn btn-lg btn-block btn-primary" data-target="#myModal" data-toggle="modal">Calcular</button>
    </div>

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

    <script>

        $('#myModal').on('shown.bs.modal', function () {
            $("#pre").addClass('animated fadeOutDown');
        });

        $('#myModal').modal('hide');

    </script>
</body>
</html>