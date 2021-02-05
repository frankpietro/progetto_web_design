function check(id, mess1, mess2){
	var errId = id + "Error";
	string = document.getElementById(id).value.trim();
	var err = document.getElementById(errId);
	if(!(/^[A-Z][A-Za-z\s']+/.test(string))){
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

function checkDish(){
	document.getElementById('insert_submit').hidden = !check('dishNameI', 'Il nome del piatto deve iniziare con una lettera maiuscola e può contenere solo caratteri alfabetici, spazi e apostrofi', 'Formato del nome del piatto corretto');
}