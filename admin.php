<?php
	session_start();
	require_once __DIR__ . "/php/config.php";
	require_once DIR_UTIL . "sessionUtil.php";
	require_once DIR_UTIL . "admin_recharge.php";
	require_once DIR_UTIL . "date_fun.php";
	require_once DIR_UTIL . "print_mense.php";
	require_once DIR_UTIL . "print_dish_list.php";
	require_once DIR_UTIL . "mensa_stats.php";

	if (!isLogged()){
			header('Location: ./login.php');
			exit;
	}
	
	if (!isAdmin()){
			header('Location: ./php/perm_denied.php');
			exit;
	}
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    <title>Admin</title>
		<link rel="stylesheet" type="text/css" href="./css/admin.css">
		<link rel="icon" href = "./img/icon.png" sizes="32x32" type="image/png">
  </head>
  <body>
		<?php
			include DIR_LAYOUT . "menu.php";
		?>
		
		<section>
		
			<div id="admin_alter_menu">
				<h2 class="foldable" onclick="unfold(this)">Gestisci menu</h2>
				
				<div>
					<h3 class="foldable" onclick="unfold(this)">Inserimento</h3>
					
					<div class="flex-form">
						<form onsubmit="return text_confirm(3)" name="dish_insert" id="dish_insert" action="./php/dish_insert.php" method="get">
							<div class="flex-form-row">
								<label for="dishDateI">Data</label>
								<input type="date" name="dish_date" id="dishDateI" required value="<?php today();?>" min="<?php today();?>" max="<?php until();?>">
							</div>
							
							<div class="flex-form-row">
								<label for="dishNameI">Piatto</label>
								<input type="text" placeholder="Piatto" name="dish_name" id="dishNameI" required onblur="checkDish()" onkeyup="checkDish()">
								<span class="error" id="dishNameIError">Il nome del piatto deve iniziare con una lettera maiuscola e può contenere solo caratteri alfabetici, spazi e apostrofi</span>
							</div>
							
							<div class="flex-form-row">
								<label for="courseI">Portata</label>
									<select name="course_i" id="courseI" required>
										<option value=>--
										<option value=2>Primo
										<option value=3>Secondo
										<option value=1>Contorno
									</select>
							</div>
							
							<div class="flex-form-row">
								<label for= "vegI">Vegetariano</label>
									<select name="veg_i" id="vegI" required>
										<option value=>--
										<option value=0>No
										<option value=1>Sì
									</select>
							</div>
							
							<div class="flex-form-row">
								<label for="portionsI">Porzioni</label>
								<!-- o input valido oppure il campo è lasciato bianco -->
								<input type="number" name="portions" id="portionsI" min=1 value=50 oninput="validity.valid||(value='');" required>
							</div>
							
							<?php
								print_mense('_insert');
							?>
							
							<div>
								<input class="flex-submit" type="submit" id="insert_submit" value="Inserisci" hidden>
							</div>
							
							<?php
								if (isset($_GET['insertMessage'])){
									echo '<div class="form-error">';
									echo '<p>' . $_GET['insertMessage'] . ' <button class="p-confirm" onclick="clean()">&#10004</button></p>';
									echo '</div>';
								}
							?>
						</form>

					</div>
				
				</div>
					
				<div id="menu_update">
					<h3 class="foldable" onclick="unfold(this)">Aggiornamento</h3>
					
					<div class="flex-form">
						<form onsubmit="return text_confirm(2)" name="dish_update" id="dish_update" action="./php/dish_update.php" method="get">
							
							<?php
								print_dish_list('_upd');
							?>
							
							<div class="flex-form-row">
								<label for="portionsU">Porzioni aggiunte</label>
								<!-- o input valido oppure il campo è lasciato bianco -->
								<input type="number" name="portions" id="portionsU" min=0 value=20 oninput="validity.valid||(value='');">
							</div>
							
							<div>
								<input class="flex-submit" type="submit" id="update_submit" value="Aggiorna">
							</div>
							
							<?php
								if (isset($_GET['updateMessage'])){
									echo '<div class="form-error">';
									echo '<p>' . $_GET['updateMessage'] . ' <button class="p-confirm" onclick="clean()">&#10004</button></p>';
									echo '</div>';
								}
							?>
							
						</form>

					</div>

				</div>
			
				<div id="menu_delete">
					<h3 class="foldable" onclick="unfold(this)">Eliminazione</h3>
					
					<div class="flex-form">
						<form onsubmit="return text_confirm(1)" name="dish_delete" id="dish_delete" action="./php/dish_delete.php" method="get">
							
							<?php
								print_dish_list('_del');
							?>
							
							<div>
								<input class="flex-submit" type="submit" id="delete_submit" value="Elimina">
							</div>
							
							<?php
								if (isset($_GET['deleteMessage'])){
									echo '<div class="form-error">';
									echo '<p>' . $_GET['deleteMessage'] . ' <button class="p-confirm" onclick="clean()">&#10004</button></p>';
									echo '</div>';
								}
							?>
							
						</form>
			
					</div>
			
				</div>
			
			</div>
		
		</section>
		
		<section id="admin_recharge_user">
			<h2 class="foldable" onclick="unfold(this)">Gestisci ricariche</h2>
			
			<div>
				<?php
					recharge_requests();
				?>
			</div>
		
		</section>
		
		<section id="admin_stats">
			<h2 class="foldable" onclick="unfold(this)">Statistiche generali</h2>
			
			<div class="flex-container">
			
				<?php
					mensa_stats();
				?>
				
			</div>
			
		</section>
		
  </body>
	
	<script src="./js/admin.js"></script>
	<script src="./js/fold.js"></script>
	<script src="./js/confirm.js"></script>
	<script src="./js/clean.js"></script>
	
</html>