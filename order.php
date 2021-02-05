<?php
	require_once __DIR__ . "/php/config.php";
	session_start();
  require_once DIR_UTIL . "sessionUtil.php";
	require_once DIR_UTIL . "print_mense.php";
	require_once DIR_UTIL . "date_fun.php";
	require_once DIR_UTIL . "dishes_choice.php";
	
	if (!isLogged()){
		header('Location: ./order_log.php');
		exit;
	}
	
	if($_SESSION['cash'] < 1){
		header('Location: ./order_no_cash.php');
		exit;
	}
	
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    <title>Ordina</title>
		<link rel="stylesheet" href="./css/order.css" type="text/css">
		<link rel="icon" href = "./img/icon.png" sizes="32x32" type="image/png">
  </head>
  <body>		
		<?php
			include DIR_LAYOUT . "menu.php";
		?>
		
		<section>
			<h2 class="foldable" onclick="unfold(this)">Ordinazione pasto</h2>
			
			<div>
				<h3 class="foldable" onclick="unfold(this)">Giorno e mensa</h3>
				<div>
					<form class="flex-form" name="day_and_mensa" id="day_and_mensa" action="#" method="get">
						
						<div class="flex-form-row">
							<label for="date">Data</label>
								<input type="date" name="date" id="date" required value="<?php today();?>" min="<?php today();?>" max="<?php until();?>">
						</div>
					
						<?php
							print_mense('_order');
						?>
						
						<div>
							<input class="flex-submit" type="submit" id="day_and_mensa_submit" value="Cerca">
						</div>
						
					</form>
				</div>
				
				<?php
					if(isset($_GET['date']) && isset($_GET['selected_mensa'])){
						echo '<h3 class="foldable" onclick="unfold(this)">Scelta piatti</h3>';
						echo '<div>';
						echo '<p>Giorno <strong>' . $_GET['date'] . '</strong>, mensa <strong>' . $_GET['selected_mensa'] . '</strong></p>';
						
						print_menu_form($_GET['date'], $_GET['selected_mensa']);
						
						echo '</div>';
					}
				?>

				<?php
					if (isset($_GET['orderMessage'])){
						echo '<div class="form-error">';
						echo '<p>' . $_GET['orderMessage'] . ' <button class="p-confirm" onclick="clean()">&#10004</button></p>';
						echo '</div>';
					}
				?>
				
			</div>
	
		</section>
			
  </body>
	
	<script src="./js/order.js"></script>
	<script src="./js/clean.js"></script>
	<script src="./js/fold.js"></script>
	<script src="./js/confirm.js"></script>
	
</html>