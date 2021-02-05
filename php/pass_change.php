<?php
	require_once __DIR__ . "/config.php";
  require_once DIR_UTIL . "mensaDbManager.php";
  require_once DIR_UTIL . "sessionUtil.php";
	session_start();
	
	//Modifica la password da personal.php
	
	header('location: ./../personal.php?changeMessage=' . change($_SESSION['email'], $_POST['old_password'], $_POST['new_password']));
	
	function change($email, $old, $new){
		global $mensaDb;
		
		$old = $mensaDb->filter($old);
		$new = $mensaDb->filter($new);
		
		
		$confirmQuery = "SELECT COUNT(*) AS us FROM user WHERE password = '" . md5($old) . "' AND email = '" . $email . "'";
		$result = $mensaDb->performQuery($confirmQuery);
		$totRow = $result->fetch_assoc();
		if($totRow['us'] != 1){
			$mensaDb->closeConnection();
			return 'Errore nell\'inserimento della password';
		}
		
		$changeQuery = "UPDATE user SET password = '" . md5($new) . "' WHERE email = '" . $email . "'";
		
		if($result = $mensaDb->performQuery($changeQuery)){
			$mensaDb->closeConnection();
			return 'Password modificata con successo!';
		}
		else {
			$mensaDb->closeConnection();
			return 'Errore nella modifica della password';
		}
	}	
?>