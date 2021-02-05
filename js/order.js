function countDishes(){
	const dishes = document.dish_choice.getElementsByTagName('input');
	var tot = 0;
	for(let dish of dishes){
		let type = dish.getAttribute('type');
		if(type == "number"){
			tot += parseInt(dish.value);
		}
	}
	
	document.dish_choice.tot_dishes.value = tot;
	
	if(tot > 5 || tot == 0){
		document.getElementById('tot_dishes_error').style.color = "rgb(186, 14, 14)";
		return false;
	}
	else {
		document.getElementById('tot_dishes_error').style.color = "rgb(39, 182, 20)";
		return true;
	}
}

function countCash(cash){
	const primi = document.dish_choice.primi.getElementsByTagName('input');
	const secondi = document.dish_choice.secondi.getElementsByTagName('input');
	const contorni = document.dish_choice.contorni.getElementsByTagName('input');
	var totp = 0;
	var tots = 0;
	var totc = 0;

	for(let p of primi){
		let type = p.getAttribute('type');
		if(type == "number"){
			totp += parseInt(p.value);
		}
	}
	
	for(let s of secondi){
		let type = s.getAttribute('type');
		if(type == "number"){
			tots += parseInt(s.value);
		}
	}
	
	tots *= 1.5;
	
	for(let c of contorni){
		let type = c.getAttribute('type');
		if(type == "number"){
			totc += parseInt(c.value);
		}
	}
	
	totc *= 0.5;
	
	var tot = totp + tots + totc + 0.5;
	
	var limit = (5 > cash) ? cash : 5;
	
	document.dish_choice.tot_charge.value = "€ " + tot.toFixed(2); 
	
	if(tot > limit){
		document.getElementById('tot_charge_error').style.color = "rgb(186, 14, 14)";
		return false;
	}
	else {
		document.getElementById('tot_charge_error').style.color = "rgb(39, 182, 20)";
		return true;
	}
}

function rightTime(min){
	var time = document.getElementById('takeaway_time').value;
	
	var ret = true;
	if(time.localeCompare(min) === -1)
		ret = false;
		
	if(!(time.includes(":00") || time.includes(":15") || time.includes(":30") || time.includes(":45")))
		ret = false;
	
	if(!ret){
		document.getElementById('time_error').style.color = "rgb(186, 14, 14)";
		return false;
	}
	else {
		document.getElementById('time_error').style.color = "rgb(39, 182, 20)";
		return true;
	}
}

function countAll(cash, min){
	var ret = false;
	if(!(countDishes()))
		ret = true;
		
	if(!(countCash(cash)))
		ret = true;
	
	if(!(rightTime(min)))
		ret = true;
		
	document.getElementById('submit_order').hidden = ret;
}