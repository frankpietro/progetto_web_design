<?php
	function checkURL($string){
		if(strpos($_SERVER['REQUEST_URI'], $string) !== false)
			echo ' class="currentLink"';
	}
?>

<link rel="stylesheet" type="text/css" href="./css/nav.css">

<nav>
	<ul>
		<li><a href="./index.php"<?php checkURL("index"); checkURL("manual");?>>Home</a></li>
		<li><a href="./menu_mense.php"<?php checkURL("menu_mense")?>>Menu</a></li>
		<li><a href="./order.php"<?php checkURL("order")?>>Ordina</a></li>
		<li><a href="./personal.php"<?php checkURL("personal"); checkURL("login"); checkURL("register");?>>Area personale</a></li>
		<li><a href="./contacts.php"<?php checkURL("contacts")?>>Contatti</a></li>
		<?php
			if(isAdmin()){
				echo '<li><a href="./admin.php"';
				checkURL("admin");
				echo '>Admin</a></li>';
			}
		?>
		<?php
			if(isLogged()){
				echo '<li><a href="./php/logout.php"';
				checkURL("logout");
				echo '>Logout</a></li>';
			}
		?>
	</ul>
</nav>