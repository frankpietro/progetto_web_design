<?php
	require_once __DIR__ . "/php/config.php";
	session_start();
  require_once DIR_UTIL . "sessionUtil.php";
	require_once DIR_UTIL . "date_fun.php";
	require_once DIR_UTIL . "print_menu.php";
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    <title>Menu</title>
		<link rel="stylesheet" type="text/css" href="./css/menu.css">
		<link rel="icon" href = "./img/icon.png" sizes="32x32" type="image/png">
  </head>
  <body>
		<?php
			include DIR_LAYOUT . "menu.php";
		?>
	  
		<section>
			<h2 class="foldable" onclick="unfold(this)">Calendario</h2>
			
			<div>
			
				<p>Scegli di quale periodo desideri visualizzare il menu</p>
				
				<div class="flex-form">
				
					<form action="#" method="get">
					
						<div class="flex-form-row">
							<label for="menu_start">Da</label>
							<input type="date" id="menu_start" name="menu_start" value="<?php today();?>" min="<?php today();?>" max="<?php until();?>">
						</div>
						
						<div class="flex-form-row">
							<label for="menu_end">A</label>
							<input type="date" id="menu_end" name="menu_end" value="<?php today();?>" min="<?php today();?>" max="<?php until();?>">
						</div>
						
						<input class="flex-submit" type="submit" value="Cerca">
					</form>
				
				</div>
				
			</div>
			
		</section>
		
		<?php
			if (isset($_GET['menu_start']) && isset($_GET['menu_end'])){
				echo '<h2 class="foldable" onclick="unfold(this)">Menu</h2>';
				print_menu($_GET['menu_start'], $_GET['menu_end']);
			}
		?>
		
  </body>
	
	<script src="./js/date.js"></script>
	<script src="./js/fold.js"></script>
</html>