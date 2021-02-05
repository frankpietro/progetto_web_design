<?php
	require_once __DIR__ . "/config.php";
	session_start();
  require_once DIR_UTIL . "mensaDbManager.php";
  require_once DIR_UTIL . "sessionUtil.php";
	
	//Richiede una ricarica da personal.php
	
	header('location: ./../personal.php?rechargeMessage=' . recharge($_SESSION['email'], $_GET['recharge']));
	
	function recharge($user, $money){
		global $mensaDb;
		
		$rechargeInsert = "INSERT INTO recharge (user, money) VALUES ('" . $user . "'," . $money . ")";
		
		if($result = $mensaDb->performQuery($rechargeInsert)){
			$mensaDb->closeConnection();
			return 'Ricarica richiesta con successo!';
		}
		else {
			$mensaDb->closeConnection();
			return 'Errore nell\'inserimento dati nel database';
		}
	}
?>