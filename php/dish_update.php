<?php
	require_once __DIR__ . "/config.php";
  require_once DIR_UTIL . "mensaDbManager.php";
  require_once DIR_UTIL . "sessionUtil.php";
	
	//Modifica piatti da admin.php
	
	header('location: ./../admin.php?updateMessage=' . update($_GET['dish_id'], $_GET['portions']));
 

	function update($id, $veg, $portions){
		global $mensaDb;
		
		$name = $mensaDb->filter($name);
		
		$queryText = "SELECT * FROM menu WHERE dishID = " . $id;
		
		$result = $mensaDb->performQuery($queryText);
		$dishRow = $result->fetch_assoc();
		if(mysqli_num_rows($result) != 1){
			$mensaDb->closeConnection();
			return 'Errore nella ricerca del piatto';
		}
		
		$portions += $dishRow['portions'];
		
		//Scrivo la query di inserimento
		$updateText = "UPDATE menu SET portions = " . $portions . " WHERE dishID = " . $id;
		
		//La eseguo attraverso una funzione membro della classe
		if($result = $mensaDb->performQuery($updateText))
			return 'Aggiornamento completato con successo!';
		else
			return 'Errore nell\'aggiornamento del database';
	}

?>