<?	if (isset($dwshow)){?><script><? }
ob_start();?>

function selectColumn(event,divBlock){ 
  try{
	var srcEl=(event.target)? event.target:event.srcElement;
	if (srcEl.parentNode==divBlock) {
		if (!$(srcEl).find('input').length) {
			$(divBlock).children('div').css('background-color','#FFF');
			$(divBlock).children('div').removeAttr("curr");
			$(srcEl).css('background-color','#CEEFFF');
			$(srcEl).attr("curr","sel");
		}
	}
  }catch(e){
	  alert(e.message);
  }
}
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
