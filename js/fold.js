function prova(){
	if(window.location.pathname == "/586997_Francaviglia/"){
		//alert(window.location.pathname);
		
		var sects = document.getElementsByTagName("section");
		
		for(var i=0; i<sects.length; i++){
			sects[i].classList.add("hidden");
		}
		
		document.getElementById("prova").classList.add("hidden");
		
		window.location.pathname += "index.php";
	}
}


function unfold(obj){
	var sib = obj.nextSibling;
	
	while(sib.tagName != "DIV")
		sib = sib.nextSibling;
	
	if(sib.classList.contains("hidden")){
		sib.classList.remove("hidden");
		obj.classList.remove("inactive");
	}
	
	else {
		sib.classList.add("hidden");
		obj.classList.add("inactive");
	}
}