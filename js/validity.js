function validInput(string, id){
	switch(id){
		case 'name':
		case 'surname':
			return /^[A-Z][A-Za-z\s']+/.test(string);
		case 'email':
			return /^[a-z0-9._]+@[a-z0-9.]+\.[a-z]{2,}$/.test(string);
		case 'password':
		case 'password2':
		case 'newPassword':
		case 'newPassword2':
			// ?=.* --> 'ci deve essere almeno un'
			return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}/.test(string);
		default:
			console.log('Errore!');
	}
}

function check(id, mess1, mess2){
	var errId = id + "Error";
	string = document.getElementById(id).value.trim();
	var err = document.getElementById(errId);
	if(!validInput(string, id)){
		err.textContent = mess1;
		err.style.color = "rgb(186, 14, 14)";
		return false;
	}
	else{
		err.textContent = mess2;
		err.style.color = "rgb(39, 182, 20)";
		return true;
	}
}

function checkAll(){
	var valid = true;
	
	if(!check('name', 'Il nome deve iniziare con una lettera maiuscola e può contenere solo caratteri alfabetici, spazi e apostrofi', 'Formato del nome corretto'))
		valid = false;
	
	if(!check('surname', 'Il cognome deve iniziare con una lettera maiuscola e può contenere solo caratteri alfabetici, spazi e apostrofi', 'Formato del cognome corretto'))
		valid = false;
	
	if(!check('email', 'Il formato dell\'indirizzo mail non è corretto', 'Formato dell\'indirizzo mail corretto'))
		valid = false;
	
	if(!check('password', 'La password deve essere lunga da 8 a 32 caratteri e contenere almeno una lettera minuscola, una lettera maiuscola e un numero', 'Formato della password corretto'))
		valid = false;
	
	if(!check('password2', 'La password deve essere lunga da 8 a 32 caratteri e contenere almeno una lettera minuscola, una lettera maiuscola e un numero', 'Formato della password corretto'))
		valid = false;
	
	if(document.getElementById('password').value !== document.getElementById('password2').value)
		valid = false;
	
	document.getElementById('register_submit').hidden = !valid;
}

function checkPws(){
	var valid = true;
	
	if(!check('newPassword', 'La password deve essere lunga da 8 a 32 caratteri e contenere almeno una lettera minuscola, una lettera maiuscola e un numero', 'Formato della password corretto'))
		valid = false;
	
	if(!check('newPassword2', 'La password deve essere lunga da 8 a 32 caratteri e contenere almeno una lettera minuscola, una lettera maiuscola e un numero', 'Formato della password corretto'))
		valid = false;
	
	if(document.getElementById('newPassword').value !== document.getElementById('newPassword2').value)
		valid = false;
	
	document.getElementById('pass_change_submit').hidden = !valid;
}
