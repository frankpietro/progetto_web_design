<?php
	require_once DIR_UTIL . "mensaDbManager.php";
	
	function recharge_requests(){
		global $mensaDb;
	
		$rechargeQuery = "SELECT * FROM recharge";
		$result = $mensaDb->performQuery($rechargeQuery);
		$rows = mysqli_num_rows($result);
		if($rows > 0){
			echo '<form id="accept_recharge" action="./php/delete_recharge.php" class="flex-form" method="post">';
			echo '<div class="flex-form-row">';
			echo '<label for="acks">Richieste</label>';
			echo '<select name="acks[]" id="acks" multiple="multiple" required>';
			for($i=0; $i < $rows; $i++){
				$rechargeRow = $result->fetch_assoc();
				$id = $rechargeRow['rechargeID'];
				$user = $rechargeRow['user'];
				$money = $rechargeRow['money'];
				echo '<option value=' . $id . '>' . $user . ', ' . $money . '</option>';
			}
			
			$mensaDb->closeConnection();
			
			echo '</select></div>';
			
			echo '<div><input class="flex-submit" type="submit" name="action" value="Accetta"><input class="flex-submit" type="submit" name="action" value="Rifiuta"></div>';
			
			echo '</form>';
			
			if (isset($_GET['rechargeMessage'])){
				echo '<div class="recharge_message">';
				echo '<p>' . $_GET['rechargeMessage'] . ' <button class="p-confirm" onclick="clean()">&#10004</button></p>';
				echo '</div>';
			}
		}
		else {
			echo '<p>Nessuna ricarica da confermare!</p>';
		}
		
	}
?>