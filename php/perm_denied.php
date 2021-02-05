<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
	</head>
	<body>
		<div class="permission_denied">
			<h2>Permesso negato!</h2>
			<p>Non disponi dell'autorizzazione per accedere a questi contenuti.</p>
			<p>Tra <span id="countdown">5</span> second<span id="letter">i</span> sarai reindirizzato automaticamente alla <a href="./../index.php">homepage</a>.</p>
		</div>
		
		<script type="text/javascript">
			var seconds = 5;

			function countdown(){
				seconds -= 1;
				if (seconds == 0){
					window.location = "../index.php";
				} else {
					document.getElementById("countdown").textContent = seconds;
					document.getElementById("letter").textContent = (seconds == 1) ? 'o' : 'i';
					window.setTimeout("countdown()", 1000);
				}
			}

			countdown();
		</script>
	</body>
</html>

<!-- Nega il permesso di entrare sulla pagina admin.php -->