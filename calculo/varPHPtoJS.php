<?php
  $msg = "Seja bem vindo ao site";
?>
<html>
 <head>
  <meta charset="utf-8">
  <title>Passar Variável PHP para Javascript</title>
 </head>
 <body>

  <script type="text/javascript">
   var mensagem = "<?php echo $msg;?>";
   alert(mensagem);
   document.write(mensagem);
  </script>

 </body>
</html>