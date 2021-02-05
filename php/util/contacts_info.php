<?php
	header('Content-Type: text/html; charset=utf-8');
	require_once DIR_UTIL . "mensaDbManager.php";
	
	function print_mense(){
		global $mensaDb;
		
		//Query per cercare le mense
		$mensaQuery = "SELECT * FROM mensa";
		
		$result = $mensaDb->performQuery($mensaQuery);
		
		//Stampo tutti i risultati
		while($mensaRow = $result->fetch_assoc()){
			echo '<div class="mensa-info">';
			$img = $mensaRow['imgLink'];
			$id = $mensaRow['mensaID'];
			$addr = $mensaRow['address'];
			$phone = $mensaRow['phone'];
			echo '<img class="mensa-img" src="./img/' . $img . '" alt="Mensa ' . $id . '" height="200">';
			echo '<p class="mensa-addr">Indirizzo: ' . $addr . '</p>';
			echo '<p class="mensa-phone">Numero di telefono: ' . $phone . '</p>';
			echo '</div>';
		}
	}
	
	function print_resp(){
		global $mensaDb;
		
		//Query per cercare le mense
		$respQuery = "SELECT * FROM `user` WHERE admin = 1";
		
		$result = $mensaDb->performQuery($respQuery);
		
		//Stampo tutti i risultati
		while($respRow = $result->fetch_assoc()){
			echo '<div class="resp-info">';
			$name = $respRow['name'];
			$surname = $respRow['surname'];
			$email = $respRow['email'];
			echo '<p class="resp-name">' . $name . ' ' . $surname . '</p>';
			echo '<p class="resp-mail">Email: <a href="mailto:' . $email . '">' . $email . '</p>';
			echo '</div>';
		}
	}
	
?>