<?php
	session_start();
	require_once __DIR__ . "/php/config.php";
	include DIR_UTIL . "sessionUtil.php";

	if (isLogged()){
			header('Location: ./personal.php');
			exit;
	}
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="./css/login.css">
		<link rel="icon" href = "./img/icon.png" sizes="32x32" type="image/png">
	</head>
	<body>
		<?php
			include DIR_LAYOUT . "menu.php";
		?>
	
		<p>Non sei registrato? <a href="./register.php">Registrati</a>.</p>
		
		<section id="sign_in_content">
			<h2 class="foldable" onclick="unfold(this)">Login</h2>
			
			<div class="flex-form">
				<form name="login" action="./php/elab.php" method="post">
					
					<div class="flex-form-row">
						<label for="login-email">E-Mail</label>
						<input type="email" id="login-email" placeholder="mario.rossi@gmail.com" name="email" required autofocus>
					</div>
					
					<div class="flex-form-row">
						<label for="login-password">Password</label>
						<input id="login-password" type="password" placeholder="Password" name="password" required>
					</div>	
					
					<div>
						<input class="flex-submit" type="submit" value="Entra">
					</div>
					
					<?php
						if (isset($_GET['errorMessage'])){
							echo '<div class="form-error">';
							echo '<p>' . $_GET['errorMessage'] . ' <button class="p-confirm" onclick="clean()">&#10004</button></p>';
							echo '</div>';
						}
					?>
					
				</form>
			
			</div>
		
		</section>
		
		
	</body>
	
	<script src="./js/clean.js"></script>
	<script src="./js/fold.js"></script>

</html>