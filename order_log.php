<?php
	require_once __DIR__ . "/php/config.php";
	session_start();
  require_once DIR_UTIL . "sessionUtil.php";
	
	if (isLogged()){
			header('Location: ./order.php');
			exit;
	}
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    <title>Ordina</title>
		<link rel="stylesheet" type="text/css" href="./css/all.css">
		<link rel="icon" href = "./img/icon.png" sizes="32x32" type="image/png">
  </head>
  <body>
		<?php
			include DIR_LAYOUT . "menu.php";
		?>
		
		<section>
			<p>Per ordinare un pasto, effettua il <a href="./login.php">login</a> oppure <a href="./register.php">registrati</a>.</p>
		</section>
		
  </body>
</html>