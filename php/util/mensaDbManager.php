<?php  
	
	require_once __DIR__ . "/../config.php";
  require DIR_UTIL . "dbConfig.php";
  $mensaDb = new MensaDbManager();

	class MensaDbManager {
		//Pubblica per potervi accedere dalla funzione chiamata per il login
		private $mysqli_conn = null;
	
		function MensaDbManager(){
			$this->openConnection();
		}
    
		function openConnection(){
			if (!$this->isOpened()){
				global $dbHostname;
				global $dbUsername;
				global $dbPassword;
				global $dbName;
				
				$this->mysqli_conn = new mysqli($dbHostname, $dbUsername, $dbPassword);
				if ($this->mysqli_conn->connect_error) 
					exit("Errore di connessione al database");
				
				$this->mysqli_conn->select_db($dbName) or
					die ('Can\'t use pweb: ' . mysqli_error());
			}
		}
	
		//Controlla connessione
		function isOpened(){
				return ($this->mysqli_conn != null);
		}
		
		//Controlla eventuali caratteri di escape
		function filter($parameter){
			if(!$this->isOpened())
				$this->openConnection();
				
			return $this->mysqli_conn->real_escape_string($parameter);
		}
		
		//Esegue query
		function performQuery($queryText) {
			if (!$this->isOpened())
				$this->openConnection();
			
			return $this->mysqli_conn->query($queryText);
		}

		function closeConnection(){
     	//Chiude connessione
 	   	if($this->mysqli_conn !== null)
				$this->mysqli_conn->close();
			
			$this->mysqli_conn = null;
		}
	
	}

?>