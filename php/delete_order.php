<?php
	require_once __DIR__ . "/config.php";
  require_once DIR_UTIL . "mensaDbManager.php";
  require_once DIR_UTIL . "sessionUtil.php";
	session_start();
	
	//Eliminazione ordini da personal.php
	header('location: ./../personal.php?deleteMessage=' . delete_o($_GET['delete_dish']));
	
	function count_dishes($row){
		$i = 1;
		if(isset($row['dish2'])) $i++;
		if(isset($row['dish3'])) $i++;
		if(isset($row['dish4'])) $i++;
		if(isset($row['dish5'])) $i++;
		return $i;
	}
	
	function delete_o($id){
		global $mensaDb;
		
		$u = $_SESSION['email'];
		
		$queryText = "SELECT * FROM takeaway WHERE orderID = " . $id;
		
		$result = $mensaDb->performQuery($queryText);
		$orderRow = $result->fetch_assoc();
		if(mysqli_num_rows($result) != 1){
			$mensaDb->closeConnection();
			return 'Errore nella ricerca dell\'ordine';
		}
		
		$tot = 0.5;
		$dishes = count_dishes($orderRow);
		for($i = 1; $i <= $dishes; $i++){
			$dish = $orderRow['dish' . $i];
			$chargeQuery = "SELECT * FROM menu WHERE dishID = " . $dish;
			$chargeResult = $mensaDb->performQuery($chargeQuery);
			if(!$chargeResult)
				return 'Errore nella ricerca del piatto' . $dish;
			$chargeRow = $chargeResult->fetch_assoc();
			$tot += 0.5*$chargeRow['course'];
			$updateQuery = "UPDATE menu SET portions = portions + 1 WHERE dishID = " . $dish;
			if(!$mensaDb->performQuery($updateQuery))
				return 'Errore nella modifica del numero di porzioni nel menu';
		}
		
		$chargeQuery = "UPDATE user SET cash = cash + " . $tot . " WHERE email = '" . $u . "'";
		if(!$mensaDb->performQuery($chargeQuery))
			return 'Errore nella modifica del saldo';
		
		$deleteText = "DELETE FROM takeaway WHERE orderID = " . $id;
		
		if($result = $mensaDb->performQuery($deleteText))
			return 'Eliminazione completata con successo!';
		else
			return 'Errore nell\'eliminazione dal database';
	}

?>