<?
if (isset($dwshow)){?><script><? }
ob_start();?>
tBlock=false; // здесь будет сохраняться активный блок (объект)
function addModuleIntoBlock(event,divBlock){
  try{
	var srcEl=(event.target)? event.target:event.srcElement;
	if ( srcEl.parentNode==divBlock
		 && tBlock // активный блок (гл. пер.) установлен (в selectColumn())
	   ) {
		// получим индекс активного блока:
		var cIndex=$(tBlock.parentNode).children('div').index(tBlock);
		// alert($(srcEl).attr('data-module-type'));
		var bi=0;
		// block - имя элемента
		// Layout.blocks[block] - значение элемента
		for(var block in Layout.blocks){
			bi++;
			//if (bi==cIndex){
			alert('bi: '+bi+', block: '+block+', Layout.blocks[block]: '+Layout.blocks[block]);
			//}
		}

		
		var newModule=document.createElement(srcEl.tagName); // добавленный в колонку модуль
		tBlock.appendChild(newModule); 
		var content=document.createElement('div');
		var remove=document.createElement('div');
		newModule.appendChild(content);
		newModule.appendChild(remove);
		content.innerHTML=srcEl.innerHTML;
		// скопировать атрибут типа модуля:
		$(content).attr('data-module-type',$(srcEl).attr('data-module-type'));
		
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
			// добавить ссылки (команды добавления текста/статьи) в текстовый модуль:
			addTextModuleComLinks(content);
		}
		$(newModule).css('cursor','move');

			$(content).attr('class','mod_content');
			$(remove).attr({
				class:'mod_trash',
				cursor:'pointer'
			});

		$('#pick_out_section').fadeIn(2000);
	}
	test_checkModules();
  }catch(e){
	  alert(e.message);
  }
}
//
function removeModule(objSrc){
	$(objSrc.parentNode.parentNode).remove();
}
// выделить фоном активную колонку:
function selectColumn(event,divBlock){
  try{
	var srcEl=(event.target)? event.target:event.srcElement;
	if (srcEl.parentNode==divBlock) {
		if (!$(srcEl).find('input').length) {
			$(divBlock).children('div')
				.css('background-color','#FFF')
				.removeAttr('data-column_stat');
			$(srcEl).sortable();
			tBlock=srcEl;
			$(srcEl).css({
				backgroundColor:'#CEEFFF',
			}).attr('data-column_stat','active'); // reserved
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
