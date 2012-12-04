// JavaScript Document
function manageVeil(stat,text){ 
  try{
  	if (text!==false){
		var plswt=' <br />Пожалуйста, подождите...';
		if (text)
			text+=plswt;
		else
			text=plswt;
		$('#processing').html(text);
	}
	if (stat=='start'){	
	  $("div#veil").show();
	  $("div#pls_wait").show();
	}else{
	  $("div#veil").hide();
	  $("div#pls_wait").hide();
	}
  }catch(e){
	  alert(e.message);
  }
}
