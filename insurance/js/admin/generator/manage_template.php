<?	
if (isset($dwshow)){?><script><? }
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
		
		arrows.innerHTML='<div><img src="<?=$_GET['base_url']?>/images/admin/arrowUp.png" border="0" title="Переместить выше" onClick="moveModule(\'up\');"></div><div><img src="<?=$_GET['base_url']?>/images/admin/arrowDown.png" border="0" title="Переместить ниже" onClick="moveModule(\'down\');"></div>';
		content.innerHTML=srcEl.innerHTML;
		remove.innerHTML='<a href="#" onClick="removeModule(this);return false;"><img src="<?=$_GET['base_url']?>/images/trash.gif" border="0" title="Удалить модуль из колонки"></a>';
		
		$(arrows).css({
			height:'44px',
			marginLeft:'-2px',
			marginTop:'-2px',
			padding:'0',
			position:'absolute',
		});
		$(content).css({
			color:'#FFF',
			lineHeight:'16px',
			marginLeft:'18px',
		});
		$(remove).css({
			position:'absolute',
			right:'1px',
			top:'2px'
		});
		
		var sBg=$(srcEl).css('background-color');
		$(newModule).css({
			backgroundColor:sBg,
			borderRadius:'8px',
			color:'#FFF',
			margin:'0 10px 4px 10px',
			minHeight:'32px',
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
