<?php
	require_once DIR_UTIL . "mensaDbManager.php";
	
	function numMense(){
		global $mensaDb;
		
		$count = "SELECT COUNT(*) AS tot FROM mensa";
		
		$result = $mensaDb->performQuery($count);
		
		$rows = mysqli_num_rows($result);
		//Devo avere un solo risultato
		if($rows != 1){
			return 'Errore';
		}
		
		$out = $result->fetch_assoc();
		$mensaDb->closeConnection();
		return $out['tot'];
	}
	
	function course($a){
		if($a == 2)
			return 'Primi';
		else if ($a == 3)
			return 'Secondi';
		else if ($a == 1)
			return 'Contorni';
		else
			return 'Errore';
	}
	
	function print_daily_spec($dstr, $i, $j){
		$p = course($j);
		echo '<tr><th>' . $p . '</th>';
		
		global $mensaDb;
		
		$dishQuery = "SELECT dishName, portions, veg FROM menu WHERE dishDate = '" . $dstr . "' AND mensa = " . $i . " AND course = " . $j . " ORDER BY veg DESC;";
		
		$result = $mensaDb->performQuery($dishQuery);
		$rows = mysqli_num_rows($result);
		
		$mensaDb->closeConnection();
		
		for($k = 0; $k < 3; $k++){
			if($k >= $rows){
				echo '<td>&nbsp;</td>';
			}
			
			else {
				$dishRow = $result->fetch_assoc();
				
				echo '<td';
				//Far vedere se un piatto è terminato 
				if($dishRow['portions'] == 0)
					echo ' style="color:gray"';
				
				echo '>' . $dishRow['dishName'];
				//Se un piatto è vegetariano  
				if($dishRow['veg'] == 1)
					echo '*';
				
				echo ' (' . $dishRow['portions'] . ')</td>';
			}
		}
		
	}
	
	
	function print_daily_menu($dstr, $i){
		print_daily_spec($dstr,$i,2);
		print_daily_spec($dstr,$i,3);
		print_daily_spec($dstr,$i,1);
	}
	
	function print_menu($start, $end){
		$day = new DateTime($start);
		$stop = new DateTime($end);
		echo '<div id="menu_table">';
		while($day <= $stop){
			$dstr = $day->format('Y-m-d');
			
			echo '<h3 class="foldable" onclick="unfold(this)">' . $dstr . '</h3>';
			
			echo '<div class="menu_daily_tables">';
			$m = numMense();
			for($i = 1; $i <= $m; $i++){
				echo '<table class="menu_spec_table">';
				echo '<caption class="table_caption">Mensa ' . $i . '</caption>';
				print_daily_menu($dstr, $i);
				echo '</table>';

			}
			echo '</div>';
			
			$day->add(new DateInterval('P1D'));
		}
		
		echo '</div>';
	}
?>