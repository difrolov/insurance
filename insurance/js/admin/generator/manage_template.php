<?	
if (isset($dwshow)){?><script><? }
ob_start();?>
tBlock=false; // здесь будет сохраняться активный блок (объект)
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
		$(newModule).attr('class','innerModule');
		$(arrows).attr('class','mod_move');
		$(content).attr('class','mod_content');
		$(remove).attr('class','mod_trash');
	}
	var modParent=newModule.parentNode;
	var lowOpacity='0.35';
	var iModCount=$(modParent).find('div[class="innerModule"]').length;
	if (iModCount==1){ // других модулей в колонке нет, сделать все стрелки полупрозрачными
		$(newModule).find('img[src*="/admin/arrow"]').css('opacity',lowOpacity);
		document.title="No another ones...";
	}else{ // больше одного
		// получить индекс текущего модуля:
		var cModIndex=$(modParent).find('div[class="innerModule"]').index(newModule);
		
		if (cModIndex==0) // сделать полупрозрачной стрелку "Вверх"
			$(newModule).find('img[src*="/admin/arrowUp.png"]').css('opacity',lowOpacity);
		if (cModIndex==(iModCount-1)) {// сделать полупрозрачной стрелку "Вниз"
			$(newModule).find('img[src*="/admin/arrowDown.png"]').css('opacity',lowOpacity);
			var prevMod=$(modParent).find('div[class="innerModule"]')[cModIndex-1];
			$(prevMod).find('img[src*="/admin/arrowDown.png"]').css('opacity','1');
			//.
		}
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
