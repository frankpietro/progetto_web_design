<?php
	require_once DIR_UTIL . "mensaDbManager.php";
	
	//Stampa le statistiche in admin.php
	
	function i_o($n){
		return ($n === 1) ? 'o' : 'i';
	}
	
	function order_number($mensa){
		global $mensaDb;
		
		$orderQuery = "SELECT COUNT(*) AS tot FROM takeaway t INNER JOIN menu m ON t.dish1 = m.dishID WHERE m.mensa = " .$mensa;
		$result = $mensaDb->performQuery($orderQuery);
		$row = $result->fetch_assoc();
		return $row['tot'];
	}
	
	function count_dishes($row){
		$i = 1;
		if(isset($row['dish2'])) $i++;
		if(isset($row['dish3'])) $i++;
		if(isset($row['dish4'])) $i++;
		if(isset($row['dish5'])) $i++;
		return $i;
	}
	
	function stats($mensa){
		$retarr = [];
		$retarr['total'] = 0;
		$retarr[1] = 0;
		$retarr[2] = 0;
		$retarr[3] = 0;
		
		global $mensaDb;
		echo '<div class="mensa-stats">';
		echo '<h4>Mensa ' . $mensa . '</h4>';
		
		$orderQuery = "SELECT * FROM takeaway t INNER JOIN menu m ON t.dish1 = m.dishID WHERE m.mensa = " .$mensa;
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
		
		$t = $retarr[1] + $retarr[2] + $retarr[3];
		
		echo '<ul>';
		echo '<li>Ordini totali: ' . order_number($mensa) . '</li>';
		echo '<li>Totale piatti ordinati:  ' . $t . ' (' . $retarr[2] . ' prim' . i_o($retarr[2]) . ', ' . $retarr[3] . ' second' . i_o($retarr[3]) . ', ' . $retarr[1] . ' contorn' . i_o($retarr[1]) . ')</li>';
		echo '<li>Incasso totale: <strong>' . number_format($retarr['total'],2,'.','') . '€</strong></li>';
		echo '</ul>';
		
		echo '</div>';
	}
	
	
	function mensa_stats(){
		global $mensaDb;
		
		$mensaQuery = "SELECT * FROM mensa";
		$result = $mensaDb->performQuery($mensaQuery);
		$rows = mysqli_num_rows($result);
		for($i = 0; $i < $rows; $i++){
			$mensaRow = $result->fetch_assoc();
			
			stats($mensaRow['mensaID']);
		}
	}
?>