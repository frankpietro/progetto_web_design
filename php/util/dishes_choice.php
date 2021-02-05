<?php
	require_once DIR_UTIL . "mensaDbManager.php";
	require_once DIR_UTIL . "date_fun.php";
	
	//Stampa il form per scegliere gli ordini in order.php
	
	function course($a){
		if($a == 2)
			return 'primi';
		else if ($a == 3)
			return 'secondi';
		else if ($a == 1)
			return 'contorni';
		else
			return 'Errore';
	}
	
	function course_($a){
		if($a == 2)
			return 'Primi';
		else if ($a == 3)
			return 'Secondi';
		else if ($a == 1)
			return 'Contorni';
		else
			return 'Errore';
	}
	
	function min_takeaway_time($day){
		$t = new Datetime();
		$h = $t->format("H");
		$m = $t->format("i");
		if($h > 14 || $h < 11 || strcmp($day, r_today()) > 0)
			return "11:30";
		else if($h == 11){
			if($m < 30)
				return "11:30";
			else if($m >= 30 && $m < 45)
				return "11:45";
			else
				return "12:00";
		}
		else {
			$m++;
			while($m%15 !== 0)
				$m++;
			if($m == 60){
				$h++;
				$m = 0;
			}
			return $h . ":" . $m;
		}
	}
	
	function print_course($d, $m, $c){
		global $mensaDb;
		
		//Cerco le entries
		$dishQuery = "SELECT * FROM menu WHERE dishDate = '" . $d . "' AND mensa = " . $m . ' AND course = ' . $c . ' ORDER BY veg DESC';
		$result = $mensaDb->performQuery($dishQuery);
		$rows = mysqli_num_rows($result);
		echo '<div>';
		
		echo '<fieldset name="' . course($c) . '"><legend>' . course_($c) . '</legend>';
		
		if($rows !== 0){
			
			while($dishRow = $result->fetch_assoc()){			
				$max = (5 < $dishRow['portions']) ? 5 : $dishRow['portions'];
					
				echo '<div class="flex-fieldset-row">';
				echo '<input type="number" min=0 name="' . $dishRow['dishID'] . '" id="' . $dishRow['dishID'] . '" value=0 max=' . $max . ' required onchange="countAll(' . $_SESSION['cash'] . ', \'' . min_takeaway_time($d) . '\')">';
				echo '<label for="' . $dishRow['dishID'] . '">' . $dishRow['dishName'] . '</label>';
				
				if($dishRow['veg'] == 1)
						echo '*';
					
				echo ' (' . $dishRow['portions'] . ')';
				echo '</div>';
			}
		}
		else 
			echo '<span>Nessun piatto presente</span>';
		
		echo '</fieldset></div>';
	}
	/*
	function print_takeaway_time($day){
		echo '<div class="flex-form-row">';
		echo '<label for="takeaway_time">Ritiro</label>';
		echo '<input type=time min="' . min_takeaway_time($day) . '" max="15:00" value="' . min_takeaway_time($day) . '" step="900" name="takeaway_time" id="takeaway_time" required onchange="countAll(' . $_SESSION['cash'] . ', \'' . min_takeaway_time($day) . '\')">';
		echo '<span class="error" id="time_error">Puoi ritirare il pasto ogni quarto d\'ora dalle ' . min_takeaway_time($day) . ' alle 15:00</span>';
		echo '</div>';
	}*/
	
	function next_quarter($t){
		$val = explode(':', $t);
		$val[1] += 15;
		if($val[1] === 60){
			$val[0]++;
			$val[1] = "00";
		}
		
		return $val[0] . ':' . $val[1];
	}
	
	function print_takeaway_time($day){
		echo '<div class="flex-form-row">';
		echo '<label for="takeaway_time">Ritiro</label>';
		echo '<select name="takeaway_time" id="takeaway_time" required onchange="countAll(' . $_SESSION['cash'] . ', \'' . min_takeaway_time($day) . '\')">';
		echo '<option value=>--';
		
		$time = min_takeaway_time($day);
		
		while(strcmp("15:15", $time) !== 0){
			echo '<option value=' . $time . '>' . $time ;
			$time = next_quarter($time);
		}
		
		echo '</select>';
		echo '<span class="error" id="time_error">Puoi ritirare il pasto ogni quarto d\'ora dalle ' . min_takeaway_time($day) . ' alle 15:00</span>';
		echo '</div>';
	}
	
	
	function print_total_order(){
		echo '<fieldset name="aggregate">';
		echo '<legend>Aggregato</legend>';
		
		echo '<div class="flex-fieldset-row">';
		echo '<input readonly="readonly" name="tot_dishes" id="tot_dishes" value="0">';
		echo '<label for="tot_dishes">Totale piatti</label>';
		echo '<span class="error" id="tot_dishes_error">(minimo 1, massimo 5 piatti)</span>';
		echo '</div>';
		
		echo '<div class="flex-fieldset-row">';
		echo '<input readonly="readonly" name="tot_charge" id="tot_charge" value="€ 0.50"></label>';
		echo '<label for="tot_charge">Totale spesa</label>';
		$max = (5 < $_SESSION['cash']) ? 5 : $_SESSION['cash'];
		echo '<span class="error" id="tot_charge_error">(massimo ' . $max . ' euro di spesa)</span>';
		echo '</div>';
		
		echo '</fieldset>';
	}
	
	function print_menu_form($day, $mensa){
		echo '<form onsubmit="return text_confirm(5)" class="flex-form" name="dish_choice" id="dish_choice" method="post" action="./php/checkout.php?date=' . $day . '&mensa=' . $mensa . '">';
		
		print_takeaway_time($day);
						
		print_course($day, $mensa, 2);
		
		print_course($day, $mensa, 3);
		
		print_course($day, $mensa, 1);
		
		print_total_order();
		
		echo '<input class="flex-submit" type="submit" id="submit_order" value="Procedi" hidden>';

		echo '</form>';
	}
?>