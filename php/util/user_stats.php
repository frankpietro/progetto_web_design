<?php
	require_once DIR_UTIL . "mensaDbManager.php";
	
	//Stampa le statistiche in personal.php

	function order_number(){
		global $mensaDb;
		
		$orderQuery = "SELECT COUNT(*) AS tot FROM takeaway WHERE user = '" . $_SESSION['email'] . "'";
		$result = $mensaDb->performQuery($orderQuery);
		$row = $result->fetch_assoc();
		return $row['tot'];
	}
	
	function various_counts(){
		$retarr = [];
		$retarr['total'] = 0;
		$retarr[1] = 0;
		$retarr[2] = 0;
		$retarr[3] = 0;
		
		global $mensaDb;
		
		$orderQuery = "SELECT * FROM takeaway WHERE user = '" . $_SESSION['email'] . "'";
		$result = $mensaDb->performQuery($orderQuery);
		$rows = mysqli_num_rows($result);

		for($i=0; $i < $rows ;$i++){
			$orderRow = $result->fetch_assoc();
			$total = 0.5;
			for($j=1; $j<=count_dishes($orderRow); $j++){
				$id = 'dish' . $j;
				$dishQuery = "SELECT * FROM menu WHERE dishID = " . $orderRow[$id];
				$dishResult = $mensaDb->performQuery($dishQuery);
				$dishRow = $dishResult->fetch_assoc();
				$c = $dishRow['course'];
				$retarr[$c]++;
				$total += $c/2;
			}
			
			$retarr['total'] += $total;
		}
		
		return $retarr;
	}
	
	function primi(){
		$p = various_counts();
			return $p[2];
	}
	
	function secondi(){
		$p = various_counts();
			return $p[3];
	}
	
	function contorni(){
		$p = various_counts();
			return $p[1];
	}
	
	function dishes(){
		$p = various_counts();
			return $p[1]+$p[2]+$p[3];
	}
	
	function charge(){
		$p = various_counts();
			return $p['total'];
	}
	
?>