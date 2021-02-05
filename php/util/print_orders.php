<?php
	require_once DIR_UTIL . "mensaDbManager.php";
	require_once DIR_UTIL . "date_fun.php";
	
	//Stampa gli ordini in personal.php
	
	class OrderElem {
		public $name;
		public $qty;
		public $c;
		
		function OrderElem($n, $c){
			$this->name = $n;
			$this->qty = 1;
			$this->c = $c;
		}
		
		function isSame($n){
			if($this->name == $n){
				$this->qty++;
				return true;
			}
			else
				return false;
		}
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
	
	function cmp($a, $b){
		if($a->c == 2 && $b->c == 3) return false;
		if($a->c == 2 && $b->c == 1) return false;
		if($a->c == 3 && $b->c == 1) return false;
		return true;
	}
	
	function count_dishes($row){
		$i = 1;
		if(isset($row['dish2'])) $i++;
		if(isset($row['dish3'])) $i++;
		if(isset($row['dish4'])) $i++;
		if(isset($row['dish5'])) $i++;
		return $i;
	}
	
	function print_orders(){
		global $mensaDb;
		
		$print = 0;
		
		$orderQuery = "SELECT * FROM takeaway WHERE user = '" . $_SESSION['email'] . "'";
		$result = $mensaDb->performQuery($orderQuery);
		$rows = mysqli_num_rows($result);
		if($rows > 0){
			for($i=0; $i < $rows ;$i++){
				$date = 0;
				$total = 0.5;
				//Array di elementi dell'ordine
				$arr = [];
				
				$orderRow = $result->fetch_assoc();
				
				for($j=1; $j<=count_dishes($orderRow); $j++){
					//Cerca la riga associata a quel piatto
					$id = 'dish' . $j;
					$dishQuery = "SELECT * FROM menu WHERE dishID = " . $orderRow[$id];
					$dishResult = $mensaDb->performQuery($dishQuery);
					$dishRow = $dishResult->fetch_assoc();
					//Data dell'ordine
					if($j == 1)
						$date = $dishRow['dishDate'];
					
					$n = $dishRow['dishName'];
					
					$c = $dishRow['course'];
					$total += $c/2;
					
					//Se il piatto è già presente aumenta di 1 il suo counter
					$old = false;
					foreach($arr as $a){
						$old = $a->isSame($n);
						if($old) break;
					}
					//Altrimenti lo aggiunge all'array
					if(!$old)
						$arr[] = new OrderElem($n,$c);
					
				}
				
				if(strcmp($date, r_today()) > 0 || (strcmp($date, r_today()) == 0 && strcmp($orderRow['takeaway_time'], min_takeaway_time($date)) >= 0)){
					$print = 1;
					
					echo '<h4 class="foldable" onclick="unfold(this)">Ordine numero ' . $orderRow['orderID'] . '</h4>';
					echo '<div class="order-elem">';
					$d = new DateTime($orderRow['takeaway_time']);
					echo '<ul>';
					echo '<li>Ritiro: <strong>' . $date . '</strong></li>';
					echo '<li>Orario: <strong>' . $d->format("H:i") . '</strong></li>';
					echo '<li>Totale spesa: <strong>' . number_format($total,2,'.',''). '€</strong></li>';
					
					echo '<li>Dettaglio:';
					echo '<ul>';
					usort($arr, "cmp");
					foreach($arr as $a)
						echo '<li>' . $a->qty . '&times ' . $a->name . '</li>';		
					echo '</ul></li>';
					
					echo '</ul>';
					echo '<form onsubmit="return text_confirm(1)" name="delete-order" action="./php/delete_order.php">';
					echo '<input type="number" name="delete_dish" value=' . $orderRow['orderID'] . ' readonly hidden>';
					echo '<input class="flex-submit" type="submit" value="Elimina">';
					echo '</form>';
					echo '</div>';
				}
				
			}
		}
		
		if($print !== 1)
			echo '<p>Nessun ordine da visualizzare!</p>';
	
	}
	
?>