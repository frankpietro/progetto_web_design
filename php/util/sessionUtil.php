<?php
	
	function setSession($email, $name, $admin, $cash){
		$_SESSION['email'] = $email;
		$_SESSION['name'] = $name;
		$_SESSION['admin'] = $admin;
		$_SESSION['cash'] = $cash;
	}

	function isLogged(){		
		if(isset($_SESSION['email']))
			return $_SESSION['email'];
		else
			return false;
	}

	function isAdmin(){
		if(isset($_SESSION['admin']))
			return $_SESSION['admin'];
		else
			return false;
	}

?>