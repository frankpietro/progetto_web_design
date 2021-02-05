<?php
	require_once __DIR__ . "/php/config.php";
	session_start();
  require_once DIR_UTIL . "sessionUtil.php";
	require_once DIR_UTIL . "contacts_info.php";
	
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
    <title>Contatti</title>
		<link rel="stylesheet" type="text/css" href="./css/contacts.css">
		<link rel="icon" href = "./img/icon.png" sizes="32x32" type="image/png">
  </head>
  <body>
		<?php
			include DIR_LAYOUT . "menu.php";
		?>
	  
		<section id="contacts">
			<div id="mense">
				<h2 class="foldable" onclick="unfold(this)">Le nostre mense</h2>
				
				<div class="flex-container">
					<?php
						print_mense();
					?>
				</div>
			</div>
			
			<div id="responsabili">
				<h2 class="foldable" onclick="unfold(this)">I nostri responsabili</h2>
					
				<?php
					print_resp();
				?>
				
			</div>
		</section>
		
  </body>
	
	<script src="./js/fold.js"></script>

</html>