<?php
	session_start();
	require_once __DIR__ . "/php/config.php";
	include DIR_UTIL . "sessionUtil.php";
	require_once DIR_UTIL . "print_cash.php";
	require_once DIR_UTIL . "print_orders.php";
	require_once DIR_UTIL . "user_stats.php";
	require_once DIR_UTIL . "mensaDbManager.php";
	require_once DIR_UTIL . "date_fun.php";
  require_once DIR_UTIL . "mensaDbManager.php";
  require_once DIR_UTIL . "sessionUtil.php";
	

	if (!isLogged()){
			header('Location: ./login.php');
			exit;
	}
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    <title>Area personale</title>
		<link rel="stylesheet" type="text/css" href="./css/personal.css">
		<link rel="icon" href = "./img/icon.png" sizes="32x32" type="image/png">
  </head>
  <body>
		<?php
			include DIR_LAYOUT . "menu.php";
		?>
		
	  
		<?php
				echo "<p>Ciao " . $_SESSION['name'] . "!</p>";
		?>
		
		<section id="personal_data">
			<h2 class="foldable" onclick="unfold(this)">Il tuo account</h2>
			
			<div>
				<h3 class="foldable" onclick="unfold(this)">Saldo</h3>
				<div>
					<?php
						print_cash();
					?>
					
					<form class="flex-form" name="recharge_form" id="recharge_form" action="./php/reload.php" method="get">
						<div class="flex-form-row">
							<label for="recharge">Cifra</label>
							<select name="recharge" id="recharge" required>
								<option value=>--
								<option value=5>5
								<option value=10>10
								<option value=15>15
								<option value=20>20
							</select>
						</div>
						
						<div>
							<input class="flex-submit" type="submit" value="Richiedi">
						</div>
					</form>
					<?php
						if (isset($_GET['rechargeMessage'])){
							echo '<div class="form-error">';
							echo '<p>' . $_GET['rechargeMessage'] . ' <button class="p-confirm" onclick="clean()">&#10004</button></p>';
							echo '</div>';
						}
					?>
				</div>
				
				<h3 class="foldable" onclick="unfold(this)">Sicurezza</h3>
				<div>
					<h4>Modifica la password</h4>
					
					<form class="flex-form" name="pass_change" id="pass_change" action="./php/pass_change.php" method="post">
						<div class="flex-form-row">
							<label for="old_password">Vecchia password</label>
							<input type="password" placeholder="Vecchia password" name="old_password" id="old_password" required>
						</div>
					
						<div class="flex-form-row">
							<label for="newPassword">Password</label>
							<input type="password" placeholder="Nuova password" name="newPassword" id="newPassword" onblur="checkPws()" onkeyup="checkPws()" required>
							<span class="error" id="newPasswordError">La password deve essere lunga da 8 a 32 caratteri e contenere almeno una lettera minuscola, una lettera maiuscola e un numero</span>
						</div>
						
						<div class="flex-form-row">
							<label for="newPassword2">Ripeti password</label>
							<input type="password" placeholder="Ripeti password" name="newPassword2" id="newPassword2" onblur="checkPws()" onkeyup="checkPws()" required>
							<span class="error" id="newPassword2Error">La password deve essere lunga da 8 a 32 caratteri e contenere almeno una lettera minuscola, una lettera maiuscola e un numero</span>
						</div>
						
						<input class="flex-submit" type="submit" id="pass_change_submit" value="Cambia" hidden>
					
					</form>
					<?php
						if (isset($_GET['changeMessage'])){
							echo '<div class="form-error">';
							echo '<p>' . $_GET['changeMessage'] . ' <button class="p-confirm" onclick="clean()">&#10004</button></p>';
							echo '</div>';
						}
					?>
				</div>
			</div>
			
		</section>
		
		<section id="personal_orders">
			<h2 class="foldable" onclick="unfold(this)">I tuoi ordini</h2>
			
			<div>			
				<?php
					if (isset($_GET['deleteMessage'])){
						echo '<div class="form-error">';
						echo '<p>' . $_GET['deleteMessage'] . ' <button class="p-confirm" onclick="clean()">&#10004</button></p>';
						echo '</div>';
					}
				
					print_orders();
				?>
			</div>
		</section>
		
		<section id="personal_stats">
			<h2 class="foldable" onclick="unfold(this)">Le tue statistiche</h2>
			
			<div class="user-stats">
				<ul>
					<li>Numero ordini: <?php echo order_number();?></li>
					<li>Numero piatti ordinati: <?php echo dishes(); ?> (<?php echo primi(); ?> primi, <?php echo secondi(); ?> secondi, <?php echo contorni(); ?> contorni)</li>
					<li>Spesa totale: <strong><?php echo number_format(charge(),2,'.','') . '€'; ?></strong></li>
				</ul>
			</div>
		</section>
		
		
  </body>
	
	<script src="./js/validity.js"></script>
	<script src="./js/confirm.js"></script>
	<script src="./js/fold.js"></script>
	<script src="./js/clean.js"></script>
	
</html>