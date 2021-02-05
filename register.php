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
		<title>Registrazione</title>
		<link rel="stylesheet" type="text/css" href="./css/register.css">
		<link rel="icon" href = "./img/icon.png" sizes="32x32" type="image/png">
	</head>
	
	<body>
		<?php
			include DIR_LAYOUT . "menu.php";
		?>
	
		<p>Già registrato? Effettua il <a href="./login.php">login</a>.</p>
			
		<section id="register_content">
			<h2 class="foldable" onclick="unfold(this)">Form di registrazione</h2>
			
			<div id="register_container" class="flex-form">
				<form onsubmit="return text_confirm(4)" name="register_form" id="register_form" action="./php/signup.php" method="post">
					<div class="flex-form-row">
						<label for="name">Nome</label>
						<input type="text" placeholder="Mario" name="name" id="name" onblur="checkAll()" onkeyup="checkAll()" required autofocus>
						<span class="error" id="nameError">Il nome deve iniziare con una lettera maiuscola e può contenere solo caratteri alfabetici, spazi e apostrofi</span>
					</div>
					
					<div class="flex-form-row">
						<label for="surname">Cognome</label>
						<input type="text" placeholder="Rossi" name="surname" id="surname" onblur="checkAll()" onkeyup="checkAll()" required>
						<span class="error" id="surnameError">Il cognome deve iniziare con una lettera maiuscola e può contenere solo caratteri alfabetici, spazi e apostrofi</span>
					</div>
					
					<div class="flex-form-row">
						<label for="email">E-Mail</label>
						<input type="email" placeholder="mario.rossi@gmail.com" name="email" id="email" onblur="checkAll()" onkeyup="checkAll()" required>
						<span class="error" id="emailError">Il formato dell'indirizzo mail non è corretto</span>
					</div>
					
					<div class="flex-form-row">
						<label for="password">Password</label>
						<input type="password" placeholder="Password" name="password" id="password" onblur="checkAll()" onkeyup="checkAll()" required>
						<span class="error" id="passwordError">La password deve essere lunga da 8 a 32 caratteri e contenere almeno una lettera minuscola, una lettera maiuscola e un numero</span>
					</div>
					
					<div class="flex-form-row">
						<label for="password2">Ripeti Password</label>
						<input type="password" placeholder="Ripeti password" name="password2" id="password2" onblur="checkAll()" onkeyup="checkAll()" required>
						<span class="error" id="password2Error">La password deve essere lunga da 8 a 32 caratteri e contenere almeno una lettera minuscola, una lettera maiuscola e un numero</span>
					</div>
					
					<div>
						<input class="flex-submit" type="submit" id="register_submit" value="Registrati" hidden>
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
	
	<script src="./js/fold.js"></script>
	<script src="./js/clean.js"></script>
	<script src="./js/validity.js"></script>
	<script src="./js/confirm.js"></script>
	
</html>