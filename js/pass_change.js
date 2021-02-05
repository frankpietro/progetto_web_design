//Controllo validità password
function isPassword(pass){
	// ?=.* --> 'ci deve essere almeno un'
	return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}/.test(pass);
}

function checkNPassword(id){
	pass = document.getElementById(id).value.trim();
	if(!isPassword(pass)){
		document.getElementById('new_password_error').textContent = "La password deve essere lunga da 8 a 32 caratteri e contenere almeno una lettera minuscola, una lettera maiuscola e un numero";
		return false;
	}
	else{
		document.getElementById('new_password_error').textContent = "";
		return true;
	}
}

function checkNPassword2(id){
	pass2 = document.getElementById(id).value.trim();
	if(!isPassword(pass2)){
		document.getElementById('new_password2_error').textContent = "La password deve essere lunga da 8 a 32 caratteri e contenere almeno una lettera minuscola, una lettera maiuscola e un numero";
		return false;
	}
	else{
		document.getElementById('new_password2_error').textContent = "";
		return true;
	}
}

function checkPws(){
	var valid = true;
	if(!checkNPassword('new_password'))
		valid = false;
		
	if(!checkNPassword2('new_password2'))
		valid = false;
	
	if(document.getElementById('new_password').value !== document.getElementById('new_password2').value)
		valid = false;
	
	document.getElementById('pass_change_submit').hidden = !valid;
}

