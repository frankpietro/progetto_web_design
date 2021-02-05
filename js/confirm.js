function confirm_message(i){
	switch(i){
		case 1:
			return "Vuoi procedere all'eliminazione?";
			break;
		case 2:
			return "Vuoi procedere all'aggiornamento?";
			break;
		case 3:
			return "Vuoi procedere all'inserimento?";
			break;
		case 4:
			return "Vuoi procedere alla registrazione?";
			break;
		case 5:
			return "Vuoi procedere all'ordine?";
			break;
	}
}

function text_confirm(i){
	return confirm(confirm_message(i));
}