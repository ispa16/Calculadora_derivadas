<?php
// page2.php

session_start();

echo 'Bem vindo à página #2<br />';

//unset($_SESSION);

		echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";

// Você pode querer usar o SID aqui, como fizemos em page1.php
echo '<br /><a href="page1.php">page 1</a>';
?>