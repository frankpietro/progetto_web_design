<?php
	require_once __DIR__ . "/config.php";
  require_once DIR_UTIL . "mensaDbManager.php";
  require_once DIR_UTIL . "sessionUtil.php";
	
	//Inserisce piatti da admin.php
	
	header('location: ./../admin.php?insertMessage=' . insert($_GET['dish_date'], $_GET['dish_name'], $_GET['veg_i'], $_GET['course_i'], $_GET['portions'], $_GET['selected_mensa']));

	function insert($date, $name, $veg, $course, $portions, $mensa){
		global $mensaDb;
		
		$name = $mensaDb->filter($name);
		
		//Non più di tre piatti per ciascuna portata
		$queryText = "SELECT COUNT(*) AS tot FROM menu WHERE dishDate = '" . $date . "' AND course = " . $course . " AND mensa = " . $mensa;
		
		$result = $mensaDb->performQuery($queryText);
		$totRow = $result->fetch_assoc();
		if($totRow['tot'] == 3){
			$mensaDb->closeConnection();
			return 'Già tre piatti presenti nel menu';
		}
		
		//Scrivo la query di inserimento
		$insertText = "INSERT INTO menu (dishDate, dishName, mensa, course, portions, veg) VALUES ('" . $date . "', '"  . $name . "', " . $mensa . ", " . $course . ", " . $portions . ", " . $veg . ");";
		
		//La eseguo attraverso una funzione membro della classe
		if($result = $mensaDb->performQuery($insertText))
			return 'Inserimento completato con successo!';
		else
			return 'Errore nell\'inserimento nel database';
	}

?>