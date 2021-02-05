<?php
	require_once __DIR__ . "/config.php";
  require_once DIR_UTIL . "mensaDbManager.php";
  require_once DIR_UTIL . "sessionUtil.php";
	
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	
	header('location: ./../register.php?errorMessage=' . register($name, $surname, $email, $password, $password2));

	function register($name, $surname, $email, $password, $password2){
		global $mensaDb;
		
		$name = $mensaDb->filter($name);
		$surname = $mensaDb->filter($surname);
		$email = $mensaDb->filter($email);
		$password = $mensaDb->filter($password);
		$password2 = $mensaDb->filter($password2);
		
		//Controllo che la mail sia unica nel database
		$queryText = "SELECT * FROM user WHERE email = '" . $email . "'" ;
		
		//La eseguo attraverso una funzione membro della classe
		$result = $mensaDb->performQuery($queryText);
		$rows = mysqli_num_rows($result);
		//Se ho un risultato non posso registrare un'altra mail
		if($rows == 1){
			return 'Email già presente nel database';
		}
		
		//Scrivo la query di inserimento
		$insertText = "INSERT INTO user VALUES ('" . $name . "','" . $surname . "','" . $email . "','" . md5($password) . "',0,0);";
		
		//La eseguo attraverso una funzione membro della classe
		if($result = $mensaDb->performQuery($insertText))
			return 'Registrazione effettuata correttamente!';
		else
			return 'Errore nell\'inserimento dati nel database';
	}

?>