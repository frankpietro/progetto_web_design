<?php
	require_once __DIR__ . "/config.php";
  require_once DIR_UTIL . "mensaDbManager.php";
  require_once DIR_UTIL . "sessionUtil.php";
	session_start();
	
	//Inserisce un ordine da order.php
	
	header('location: ./../order.php?orderMessage=' . checkout());
		
	function checkout(){
		global $mensaDb;
		
		$u = $_SESSION['email'];
		$m = $_GET['mensa'];
		$d = $_GET['date'];
		$t = $_POST['takeaway_time'];
		
		//Array in cui inserire le entry e numero della entry da inserire
		$qe = []; //queryEntries
		$dishNumber = 0;
		
		$course = array(2,3,1);
		
		$totCharge = 0.5;
		
		foreach($course as $c){
			$dishQuery = "SELECT * FROM menu WHERE dishDate = '" . $d . "' AND mensa = " . $m . ' AND course = ' . $c .' ORDER BY veg DESC';
			$result = $mensaDb->performQuery($dishQuery);
			while($dishRow = $result->fetch_assoc()){
				$id = $dishRow['dishID'];
				
				$numOrderedPortions = $_POST[$id];
				
				$totCharge += (0.5*$c*$numOrderedPortions);
					
				if($numOrderedPortions != 0){
					//Query di diminuzione porzioni
					$portionsQuery = "UPDATE menu SET portions = portions - " . $numOrderedPortions . " WHERE dishID = " . $id;
					if(!$mensaDb->performQuery($portionsQuery))
						return 'Errore nella modifica del numero di porzioni nel menu';
				}
				
				for($i=0; $i<$numOrderedPortions; $i++){
					$qe[$dishNumber] = $id;
					$dishNumber++;
				}
			}
		}
		
		//Query di sottrazione credito
		$chargeQuery = "UPDATE user SET cash = cash - " . $totCharge . " WHERE email = '" . $u . "'";
		if(!$mensaDb->performQuery($chargeQuery))
			return 'Errore nella modifica del numero di porzioni nel menu';
		
		//Query di inserimento ordine nel database
		$insertQuery = "INSERT INTO takeaway (user, dish1";
		if(isset($qe[1])){
			$insertQuery .= ", dish2";
			if(isset($qe[2])){
				$insertQuery .= ", dish3";
				if(isset($qe[3])){
					$insertQuery .= ", dish4";
					if(isset($qe[4])){
						$insertQuery .= ", dish5";
					}
				}
			}
		}
		
		$insertQuery .= ", takeaway_time) VALUES ('" . $u . "', " . $qe[0];
		if(isset($qe[1])){
			$insertQuery .= ", " . $qe[1];
			if(isset($qe[2])){
				$insertQuery .= ", " . $qe[2];
				if(isset($qe[3])){
					$insertQuery .= ", " . $qe[3];
					if(isset($qe[4])){
						$insertQuery .= ", " . $qe[4];
					}
				}
			}
		}
		
		$insertQuery .= ", '" . $t . "');";
		
		//return $insertQuery;
		if($result = $mensaDb->performQuery($insertQuery))
			return 'Ordine completato correttamente!';
		else
			return 'Problema nel completamento dell\'ordine';
	}
	
?>