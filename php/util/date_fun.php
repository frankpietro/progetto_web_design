<?php
	function r_today(){
		//Alle 15 comincia a indicare la data del giorno dopo
		$t = new Datetime();
		if($t->format("H") > 14)
			$t->add(new DateInterval('P1D'));
		return $t->format("Y-m-d");
	}
	
	function today(){
		echo r_today();
	}
	
	function until(){
		$next = strtotime("next Sunday");
		$next = strtotime("+1 week", $next);
		echo date("Y-m-d", $next);
	}
?>