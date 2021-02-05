<?php
	require_once __DIR__ . "/config.php";
  require_once DIR_UTIL . "mensaDbManager.php";
  require_once DIR_UTIL . "sessionUtil.php";
	
	//Autorizza le ricariche da admin.php
	
	$acks = delete_recharge($_POST['acks']);
	header('location: ./../admin.php?rechargeMessage=' . $acks);
	
	function delete_recharge($a){
		global $mensaDb;
		$i=1;
		
		foreach($a as $ack){
			//Aumento il conto
			if($_POST['action'] === "Accetta"){
				$rechargeQuery = "SELECT user, money FROM recharge WHERE rechargeID=" . $ack;
				if(!$result = $mensaDb->performQuery($rechargeQuery))	
					$i=0;
				$rechargeRow = $result->fetch_assoc();
				$user = $rechargeRow['user'];
				$money = $rechargeRow['money'];
				
				$updateQuery = "UPDATE user SET cash=cash+" . $money . " WHERE email='" . $user . "';";
				if(!$result = $mensaDb->performQuery($updateQuery))
					$i=0;
			}
			
			//Elimino la richiesta
			$rechargeDelete = "DELETE FROM recharge WHERE rechargeID=" . $ack;
		
			if(!$result = $mensaDb->performQuery($rechargeDelete))
				$i=0;
			
		}
		
		if($i == 0){
			$mensaDb->closeConnection();
			return 'Errore nelle operazioni';
		}
		else {
			$mensaDb->closeConnection();
			return 'Tutte le operazioni avvenute con successo!';
		}
			
	}
?>
	
	