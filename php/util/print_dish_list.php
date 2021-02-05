<?php
	require_once DIR_UTIL . "mensaDbManager.php";
	
	function print_dish_list($str){
		global $mensaDb;
		
		$name = "dish_id";
		$id = $name . $str;
		
		//Calcola la data dalla quale consentire modifiche
		$t = time();
		if(date("h", $t) > 14)
			$t += 86400;
		echo '<div class="flex-form-row">';
		echo '<label for="' . $id . '">Piatto</label>';
		echo '<select name="' . $name . '" id="' . $id .'" required>';
		echo '<option value=>--';
		
		$dishes = "SELECT * FROM menu WHERE dishDate >= '" . date("Y-m-d", $t) . "' ORDER BY dishDate, mensa, dishName";
		
		$result = $mensaDb->performQuery($dishes);
		$rows = mysqli_num_rows($result);
		
		for($i=0; $i < $rows; $i++){
			$dishRow = $result->fetch_assoc();
			echo '<option value=' . $dishRow['dishID'] . '>' . $dishRow['dishName'] . ', ' . $dishRow['dishDate'] . ', mensa ' . $dishRow['mensa'];
		}
		
		echo '</select></div>';
		
	}
?>