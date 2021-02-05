<?php
	require_once __DIR__ . "/config.php";
  require_once DIR_UTIL . "mensaDbManager.php";
  require_once DIR_UTIL . "sessionUtil.php";
	
	//Eliminazione piatti da admin.php
	
	header('location: ./../admin.php?deleteMessage=' . delete($_GET['dish_id']));
	
	
	function delete($id){
		global $mensaDb;
		
		$name = $mensaDb->filter($name);
		
		$queryText = "SELECT * FROM menu WHERE dishID = " . $id;
		
		$result = $mensaDb->performQuery($queryText);
		$dishRow = $result->fetch_assoc();
		if(mysqli_num_rows($result) != 1){
			$mensaDb->closeConnection();
			return 'Errore nella ricerca del piatto';
		}
		
		//Non posso cancellare piatti per cui esistono già ordini
		$orderQuery = "SELECT * FROM takeaway WHERE (dish1 = " . $id . " OR dish2 = " . $id . " OR dish3 = " . $id . " OR dish4 = " . $id . " OR dish5 = " . $id . ");";
		$result = $mensaDb->performQuery($orderQuery);
		if(mysqli_num_rows($result) != 0){
			$mensaDb->closeConnection();
			return 'Impossibile cancellare, esistono già ordini associati al piatto';
		}
		
		//Scrivo la query di cancellazione
		$deleteText = "DELETE FROM menu	WHERE dishID = " . $id;
		
		//La eseguo attraverso una funzione membro della classe
		if($result = $mensaDb->performQuery($deleteText))
			return 'Eliminazione completata con successo!';
		else
			return 'Errore nell\'eliminazione dal database';
	}

?>