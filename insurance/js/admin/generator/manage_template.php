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
		var arrows=document.createElement('div');
		var content=document.createElement('div');
		var remove=document.createElement('div');
		
		newModule.appendChild(arrows);
		newModule.appendChild(content);
		newModule.appendChild(remove);
		
		arrows.innerHTML='*<br>*';
		content.innerHTML=srcEl.innerHTML;
		remove.innerHTML='<a href="#" onClick="removeModule(this);return false;">del</a>';
		
		$(arrows).css({
			display:'inline-block'
		});
		$(content).css({
			position:'absolute',
			left:'20px',
			right:'20px',
			top:'8px'
		});
		$(remove).css({
			position:'absolute',
			right:'4px',
			top:'0'
		});
		
		var sBg=$(srcEl).css('background-color');
		$(newModule).css({
			backgroundColor:sBg,
			borderRadius:'8px',
			color:'#FFF',
			margin: '0 10px 4px 10px',
			padding: '10px',
			position: 'relative'
		});
	}
  }catch(e){
	  alert(e.message);
  }	
}
function removeModule(objSrc){
	$(objSrc.parentNode.parentNode).remove();
}
//
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
