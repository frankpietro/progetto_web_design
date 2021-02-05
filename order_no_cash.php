<?php
	require_once __DIR__ . "/php/config.php";
	session_start();
  require_once DIR_UTIL . "sessionUtil.php";
	
	if (!isLogged()){
		header('Location: ./order_log.php');
		exit;
	}
	
	if($_SESSION['cash'] >= 1){
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
			<p>Il tuo saldo è di <?php echo number_format($_SESSION['cash'],2,'.',''); ?>€ e non è sufficiente per nessun tipo di ordine.</p>
			<p>Effettua una ricarica dalla tua <a href="./personal.php">area personale</a>.</p>
		</section>
		
  </body>
</html>