<html>
<head>
 <meta charset="utf-8">
 <title>Passar Variável Javascript para PHP</title>
 <script type="text/javascript">
  var variaveljs = 'Mauricio Programador';
 </script>
</head>
<body>
 <?php
  echo "<br>ola mundo<br>";
  $v = "<script>document.write(variaveljs)</script>";
  echo "Ola $v<br>";
  echo "ola mundo<br>";
 ?>
 <p><a href="http://www.mauricioprogramador.com.br/posts/passar-variavel-javascript-para-php">http://www.mauricioprogramador.com.br/posts/passar-variavel-javascript-para-php</a></p>
</body>
</html>