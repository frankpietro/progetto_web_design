<?php
	require_once __DIR__ . "/php/config.php";
  require_once DIR_UTIL . "sessionUtil.php";
	session_start();
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    <title>Manuale</title>
		<link rel="stylesheet" type="text/css" href="./css/index.css">
		<link rel="icon" href = "./img/icon.png" sizes="32x32" type="image/png">
  </head>
  <body>
		<?php
			include DIR_LAYOUT . "menu.php";
		?>
		
		<section>
			<h2 class="foldable" onclick="unfold(this)">Sull'utilizzo del sito</h2>
			
			<div>
				<h3 class="foldable" onclick="unfold(this)">La mensa</h3>

				<div>
					<p>Il sito si propone di gestire una mensa universitaria da asporto, basata su un sistema di gettoni.
					Le diverse portate hanno il seguente valore in gettoni:</p>
					
					<ul>
						<li>primo - 2 gettoni;</li>
						<li>secondo - 3 gettoni;</li>
						<li>contorno - 1 gettone.</li>
					</ul>
					
					<p>Ogni gettone costa 50 centesimi. Il costo di ogni pasto è il costo complessivo dei gettoni più 50 centesimi. Un pasto può essere composto da non più di 5 portate e non più di 9 gettoni.</p>
				</div>
				
				<h3 class="foldable" onclick="unfold(this)">Servizi utente</h3>

				<div>
					<p>Per accedere al servizio di ordinazione è necessario registrarsi.
					Una volta registrati, dopo aver eseguito il login è possibile effettuare ordini, visualizzarli, cancellarli e visualizzare le proprie statistiche storiche.
					Gli ordini sono eliminabili fino al giorno precedente, dopodiché non è concessa la cancellazione né il rimborso della spesa.</p>
					
					<p>A ogni utente è associato un credito col quale acquistare i pasti.
					Nel caso il credito non fosse sufficiente,è possibile effettuare una ricarica compilando l'apposito form.</p>
					
					<p>Tra i servizi offerti all'utente c'è anche la possibilità di modificare la password.</p>
				</div>
				
				<h3 class="foldable" onclick="unfold(this)">Amministrazione</h3>

				<div>
					<p>L'amministratore del sito ha a disposizione una pagina dedicata con alcune funzioni aggiuntive.</p>
					
					<p>L'amministratore può inserire, aggiornare o eliminare un piatto dal menu del giorno presente o dei giorni futuri;
					può convalidare ricariche richieste dagli utenti; può visualizzare le statistiche complessive della mensa.</p>
				</div>
				
				<h3 class="foldable" onclick="unfold(this)">Struttura del sito</h3>
				
				<div>
					<p>Il sito è organizzato in 6 pagine:</p>
					
					<ul>
						<li>Home</li>
						<li>Menu - visualizzazione del menu della mensa in un periodo selezionabile dall'utente</li>
						<li>Ordina - effettuazione ordini</li>
						<li>Area Personale - ricarica, modifica password, riepilogo degli ordini e statistiche personali</li>
						<li>Contatti - fotografia e indirizzo di ogni stabilimento a disposizione dell'azienda e nome e mail di ogni amministratore</li>
						<li>Admin - gestione menu, conferma ricariche e statistiche globali</li>
					</ul>
					
					<p>La pagina personale è visualizzabile solo in seguito al login; la pagina di admin è accessibile solo da utenti autorizzati.</p>		
				
					<p>Nel caso un utente non abbia ancora effettuato il login, la pagina per le ordinazioni rimanda a pagine di login o registrazione, mentre quella personale reindirizza direttamente alla pagina di login.</p>
				</div>
				
			</div>
			
		</section>
		
  </body>
	
	<script src="./js/fold.js"></script>

</html>