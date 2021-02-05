<?php
	require_once DIR_UTIL . "mensaDbManager.php";
	
	
	function print_cash(){
		global $mensaDb;
		
		echo '<p>Il tuo saldo: ';
		
		$cashQuery = "SELECT cash FROM user WHERE email = '" . $_SESSION['email'] . "'";
		
		$result = $mensaDb->performQuery($cashQuery);
		$cashRow = $result->fetch_assoc();
		$cashString = number_format($cashRow['cash'], 2, '.', '');
		echo '<strong>' . $cashString . '€</strong> - Effettua una ricarica!</p>';
	}	
?>