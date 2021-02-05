<?php
	require_once __DIR__ . "/php/config.php";
  require_once DIR_UTIL . "sessionUtil.php";
	session_start();
	
	if(strpos($_SERVER['REQUEST_URI'], "index") === false)
		header('Location: ./index.php');
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    <title>Home</title>
		<link rel="stylesheet" type="text/css" href="./css/index.css">
		<link rel="icon" href = "./img/icon.png" sizes="32x32" type="image/png">
  </head>
  <body>
		<?php
			include DIR_LAYOUT . "menu.php";
		?>
		
		<div id="logo" class="flex-container">
			<div class="left">
				<img src="./img/icon.png" alt="logo" width="192" height="192">
			</div>
			
			<div class="center">
				<p id="title">UniMensa</p>
				<p id="slogan">Ristorazione a misura di studente</p>
			</div>
			
			<div class="right">
				<img src="./img/icon.png" alt="logo" width="192" height="192">
			</div>
		</div>
		
		<footer>
			<p>Consulta il <a href="./manual.php">manuale di utilizzo</a></p>
		</footer>
		
  </body>
	
	<script src="./js/fold.js"></script>

</html>