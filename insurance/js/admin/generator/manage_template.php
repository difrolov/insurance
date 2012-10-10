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
		var content=document.createElement('div');
		var remove=document.createElement('div');
		newModule.appendChild(content);
		newModule.appendChild(remove);
		content.innerHTML=srcEl.innerHTML;
		remove.innerHTML='<a href="#" onClick="removeModule(this);return false;"><img src="<?=$_GET['base_url']?>/images/trash.gif" border="0" title="Удалить модуль из колонки"></a>';
		$(newModule).attr({
			class:'innerModule',
			title:'Можно перемещать вверх-вниз...'
		});
		if ($(srcEl).attr('class')=='mod_type_text'){
			var cPadding=parseInt($(newModule).css('padding-top').replace("px", ""));
			$(newModule).css({
					background:'#FFF',
					border:'solid 2px #F90',
					padding:(cPadding-2)+'px'
			});
			$(content).css('color','#08C');
			$(content).html('<b>Текст</b>: <a href="javascript:addTextContent();" title="Добавить произвольный текст">добавьте произвольное содержание</a> или <a href="javascript:PickOutTextContent();" title="Выбрать из имеющихся статей">выберите  имеющуюся статью</a>.');
		}
		$(newModule).css('cursor','move');
			$(content).attr('class','mod_content');
			$(remove).attr('class','mod_trash');
			$(remove).css('cursor','pointer');
		
		$('#pick_out_section').fadeIn(2000);	
	}
  }catch(e){
	  alert(e.message);
  }	
}
//
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
			$(srcEl).sortable();
			tBlock=srcEl;
			$(srcEl).css({
				backgroundColor:'#CEEFFF',
			});
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
