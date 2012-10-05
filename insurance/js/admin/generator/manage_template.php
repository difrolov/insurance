<?	if (isset($dwshow)){?><script><? }
ob_start();?>
tBlock=false; // здесь будет сохраняться активный блок (объект)ж
function addModuleIntoBlock(event,divBlock){
  try{
	var srcEl=(event.target)? event.target:event.srcElement;
	if ( srcEl.parentNode==divBlock
		 && tBlock
	   ) {
		var newModule=document.createElement(srcEl.tagName);
		tBlock.appendChild(newModule);
		newModule.innerHTML=srcEl.innerHTML;
		var sBg=$(srcEl).css('background-color');
		$(newModule).css({
			backgroundColor:sBg,
			borderRadius:'8px',
			color:'#FFF',
			margin: '0 10px 4px 10px',
			padding: '20px'
		});
	}
  }catch(e){
	  alert(e.message);
  }	
}
function selectColumn(event,divBlock){ 
  try{
	var srcEl=(event.target)? event.target:event.srcElement;
	if (srcEl.parentNode==divBlock) {
		if (!$(srcEl).find('input').length) {
			$(divBlock).children('div').css('background-color','#FFF');
			$(srcEl).css('background-color','#CEEFFF');
			tBlock=srcEl;
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
