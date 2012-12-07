// JavaScript Document
function validateFields(fields){
  try{
	var errs=0,badEmail=false;
	$(fields).each(function(index, element) {
        if (element=='email'){
			if (!validateEmail(this)){
				errs++;
				badEmail=true;
				toggleFieldWarning(this,true);
			}
		}
		else if  (!$('#'+element).val()) {
			errs++;
			toggleFieldWarning(this,true);
		}
    });
	if (errs){
		alert('Не все данные были введены правильно. Проверьте выделенные поля.');
  		return false;
	}
  }catch(e){
	  alert(e.message);
  }
}
function validateEmail(yEmail){
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return (!filter.test(document.getElementById(yEmail).value))? false:true;
}
function toggleFieldWarning(element,warning){
  try{
	var bg,brdrColor;
	if (warning){
		bg='#FF9';
		brdrColor='orange';
	}else{
		bg='initial';
		brdrColor='initial';
	} // alert('element: '+element+'\n'+bg+', '+brdrColor);
	$('#'+element).css({
		backgroundColor:bg,
		borderColor:brdrColor
	});
  }catch(e){
	  alert(e.message);
  }
}