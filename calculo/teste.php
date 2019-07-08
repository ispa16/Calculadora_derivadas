<?php
	session_start();

		/*
		echo "Session:<pre>";
		print_r($_SESSION);
		echo "</pre>";

		echo "Get:<pre>";
		print_r($_GET);
		echo "</pre>";
		//*/

		echo "BASE: ".$_GET['base']."<br>";
		echo "EXPOENTE: ".$_GET['exp']."<br>";

	if(!isset($_SESSION['bases']))
		$_SESSION['bases'] = array();

	if(!isset($_SESSION['expoentes']))
		$_SESSION['expoentes'] = array();

	if(!isset($_SESSION['dbases']))
		$_SESSION['dbases'] = array();

	if(!isset($_SESSION['dexpoentes']))
		$_SESSION['dexpoentes'] = array();

	if(isset($_GET['base']) && isset($_GET['exp'])){
		array_push($_SESSION['bases'], $_GET['base']);
		array_push($_SESSION['expoentes'], $_GET['exp']);

		array_push($_SESSION['dbases'], $_GET['base']*$_GET['exp']);
		array_push($_SESSION['dexpoentes'], $_GET[exp]-1);

	}


		echo "Session:<pre>";
		print_r($_SESSION);
		echo "</pre>";

	/*
	$_SESSION = array();

		echo "ini<pre>";
		print_r($_SESSION);
		echo "</pre>";
	//*/

	echo "<form>";
		echo "<input type=\"number\" name=\"base\" required>";
		echo "<input type=\"number\" name=\"exp\" required>";
		echo "<input type=\"submit\" value=\"Resolver\">";
	echo "</form>";

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
				echo "x";
				if($_SESSION['expoentes'][$i]!=1)
					echo "<sup>".$_SESSION['expoentes'][$i]."</sup> ";
			}
		}
	}

	echo "<br>";

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