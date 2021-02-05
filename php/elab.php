<?php
	require_once __DIR__ . "/config.php";
  require_once DIR_UTIL . "mensaDbManager.php";
  require_once DIR_UTIL . "sessionUtil.php";
 
 //Gestisce il login da login.php
 
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	//Se il login è effettuato correttamente non ci sono messaggi di errore
	$errorMessage = login($email, $password);
	if($errorMessage === null)
		header('location: ./../personal.php');
	else
		header('location: ./../login.php?errorMessage=' . $errorMessage );
 

	function login($email, $password){   
		if ($email != null && $password != null){
			global $mensaDb;
			
			$email = $mensaDb->filter($email);
			$password = $mensaDb->filter($password);
			
			//Scrivo la query
			$queryText = "SELECT * FROM user WHERE email = '" . $email . "' AND `password` = '" . md5($password) . "'";
			
			//La eseguo attraverso una funzione membro della classe
			$result = $mensaDb->performQuery($queryText);
			$rows = mysqli_num_rows($result);
			//Devo avere un solo risultato
			if($rows != 1){
				return 'Email o password errate';
			}
			else {
				$userRow = $result->fetch_assoc();
				$mensaDb->closeConnection();
				session_start();
				setSession($email, $userRow['name'], $userRow['admin'], $userRow['cash']);
				return null;
			}
		}
		//Ovviamente i campi non possono essere lasciati vuoti
		else 
			return 'I campi non possono essere vuoti';
	}

?>