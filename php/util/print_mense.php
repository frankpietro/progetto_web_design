<?php
	require_once DIR_UTIL . "mensaDbManager.php";
	
	function print_mense($str){
		global $mensaDb;
		$name = "selected_mensa";
		$id = $name . $str;
		
		echo '<div class="flex-form-row">';
		echo '<label for="' . $id . '">Mensa</label>';
		echo '<select name="' . $name . '" id="' . $id . '" required>';
		echo '<option value=>--';
		
		$count = "SELECT * FROM mensa";
		
		$result = $mensaDb->performQuery($count);
		
		$rows = mysqli_num_rows($result);
		
		for($i=0; $i < $rows; $i++){
			$mensaRow = $result->fetch_assoc();
			$id = $mensaRow['mensaID'];
			$address = $mensaRow['address'];
			echo '<option value=' . $id . '>' . $id . ' - ' . $address;
		}
		
		$mensaDb->closeConnection();
	
		echo '</select></div>';
	}

?>