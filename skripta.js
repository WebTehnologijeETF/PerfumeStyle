function pokaziMeni(){

	var submeni=podMenu.children[0];
    var submeni1=podMenu.children[1]; 
	submeni.style.display="block";
	submeni1.style.display="block";
	podMenu.style.display="block";
    
 }
 function sakrijMeni(){
	 
  podMenu.style.display="none";
 }

 function validirajfname(fname)
{
    if(fname=="" || fname==null)
        return false;
    
    return true;
}
function validirajlname(lname)
{
    if(lname=="" || lname==null)
        return false;
    
    return true;
}

function approveName(){
	var fname=document.getElementById("fname").value;
	if(validirajfname(fname)) {
		document.getElementById("errorfname").innerHTML="";
		document.getElementById("upozorenje").style.display = "none";}    

	else {
	document.getElementById("errorfname").innerHTML="Please enter a valid name."; 
		document.getElementById("upozorenje").style.display = "inline";
	}	
}

function approveLName(){
	var lname=document.getElementById("lname").value;
	if(validirajlname(lname)) {
		document.getElementById("errorprezime").innerHTML="";
		document.getElementById("prezimeslika").style.display = "none";}    

	else {
	document.getElementById("errorprezime").innerHTML="Please enter a valid last name."; 
	document.getElementById("prezimeslika").style.display = "inline";
	}	
}


function validateEmail(mejl) {
 var re = /\S+@\S+\.\S+/;
 return re.test(mejl);
 }
 
 function approveMail(){
	var email=document.getElementById("mejl").value;
	if(validateEmail(email))
	{ document.getElementById("errormail").innerHTML=""; 
		document.getElementById("mailslika").style.display = "none";}    

	
	else 
	{
		document.getElementById("errormail").innerHTML="Please enter a valid mail.";
				document.getElementById("mailslika").style.display = "inline";

		}
}

window.onload=  function() {
  var tekst=document.getElementById("textPoruke");	
  tekst.disabled=true;
}
function approveTexarea(){
	var email = document.getElementById("mejl").value;
	
	var ime=document.getElementById("fname").value;

	var prezime=document.getElementById("lname").value;
	if(validateEmail(email) && validirajfname(ime)&& validirajlname(prezime) ){
		document.getElementById("errorTexarea").innerHTML="";
       tekst.disabled=false;
	}

	else{
		tekst.disabled=true;
		document.getElementById("errorTexarea").innerHTML="Input all data";
	}
}

function resetall(){
	
	document.getElementById("errorfname").innerHTML = "";
	document.getElementById("errormail").innerHTML="";
		document.getElementById("errorprezime").innerHTML = "";

	document.getElementById("errorTexarea").innerHTML="";
	
	document.getElementById("upozorenje").style.display = "none";
			document.getElementById("prezimeslika").style.display = "none";
					document.getElementById("mailslika").style.display = "none";
	}    
function validateSend() {
	var email = document.getElementById("mejl").value;
	var ime=document.getElementById("fname").value;
	var prezime=document.getElementById("lname").value;
	if( validateEmail(email) && validirajfname(ime) && validirajlname(prezime))
		return true;
	else return false;  
}