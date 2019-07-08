<?php
// page1.php

session_destroy();

		echo "ini<pre>";
		print_r($_SESSION);
		echo "</pre>";

session_start();

		echo "ini<pre>";
		print_r($_SESSION);
		echo "</pre>";

	/*
	$_SESSION = array();

		echo "ini<pre>";
		print_r($_SESSION);
		echo "</pre>";
	//*/

echo 'Bem vindo à página #1';

$_SESSION['favcolor'] = 'red';
$_SESSION['animal']   = 'cat';
$_SESSION['time']     = time();
//$_SESSION['ola']     = "mundo";
if(!isset($_SESSION['functions']))
	$_SESSION['functions'] = array();
array_push($_SESSION['functions'], 1);
array_push($_SESSION['functions'], 1);
array_push($_SESSION['functions'], 1);

		echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";

//unset($_SESSION['functions']);

// Funciona se o cookie de seção foi aceito
echo '<br /><a href="page2.php">page 2</a>';

// Ou talves passando o ID da seção se necessário
echo '<br /><a href="page2.php?' . SID . '">page 2</a>';
?>