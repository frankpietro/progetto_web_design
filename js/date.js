menu_start.onblur = change_end_date;
function change_end_date(){
	var d1 = document.getElementById("menu_start").value;
	var d2 = document.getElementById("menu_end");
	d2.setAttribute("value", d1);
	d2.setAttribute("min", d1);
}