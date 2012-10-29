<?	$url=$_GET['base_url'];
	$test=$_GET['test'];
if (isset($dwshow)){?><script><? }
ob_start();?>
tBlock=false; // здесь будет сохраняться активный блок (объект)
function addModuleIntoBlock(event,divBlock){
  try{
	var srcEl=(event.target)? event.target:event.srcElement;
	if ( srcEl.parentNode==divBlock
		 && tBlock // активный блок (гл. пер.) установлен (в selectColumn())
	   ) {
		var dataModuleType=$(srcEl).attr('data-module-type');
		// получим индекс активной колонки и элемента объекта (блока):
		var cIndex=$(tBlock.parentNode).children('div').index(tBlock);
		var bi=0;
		// block - имя элемента
		// Layout.blocks[block] - значение элемента
		for(var block in Layout.blocks){
			if (bi==cIndex){
				if (Layout.blocks[block]!='')
					Layout.blocks[block]+='|';
				Layout.blocks[block]+=dataModuleType;
				//alert('block: '+block+', Layout.blocks[block]: '+Layout.blocks[block]);
			}
			bi++;
		}
<?	if (isset($test)){?>		
		// добавить данные в тестовый блок:
		test_addModuleToTestBlock(cIndex,dataModuleType);
<?	}?>		
		var newModule=$('<div>').appendTo(tBlock).attr({
			class:'innerModule',
			title:'Можно перемещать вверх-вниз...',
		}).css('cursor','move')
		  .append($('<div>').attr({
				class:'mod_trash'
			}).css('cursor','pointer')
			  .append(
				$('<a>',{
					href:'#',
					click:function(){
						removeModule(this);
						return false;
					}
				}).append(
					$('<img>',{
						src:"<?=$_GET['base_url']?>/images/trash.gif",
						title:"Удалить модуль из колонки"
					}).css('border','0'))));
		
		var content=$('<div>').appendTo(newModule)
							  .text($(srcEl).text())
							  .attr({
								  'data-module-type':dataModuleType,
								  class:'mod_content'
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
		$('#pick_out_section').fadeIn(2000);
	}
  }catch(e){
	  alert(e.message);
  }
}
// преобразовать контент блока в массив:
function splitBlockContent(blockNumer){
	// attention! blockNumer may be as "footer" as number
	return Layout.blocks[blockNumer].split("|");
}
// преобразовать контент блока в строку и сохранить в Layout:
function saveBlockContentString(blockNumer,tBlockArray){
	tBlockStr=tBlockArray.join("|"); // преобразуем в строку
	Layout.blocks[blockNumer]=tBlockStr;
	//alert(Layout.blocks[blockNumer]);
}
// удалить модуль из колонки визуально и из набора Layout "физически"
function removeModule(objSrc){ // ссылка
  try{
	var Mod=objSrc.parentNode.parentNode; // модуль (class="innerModule")
	var Block=Mod.parentNode; // блок
	// найти в активной колонке блок, распарсить его модули и удалить нужный:
	var blockNumer=getBlockNumber(Block); // № блока
	var modIndex=getModuleIndex(Block,Mod); // индекс модуля
	//alert('Удаляем модуль index '+modIndex+'\n---------------\nТекущий набор:\n'+Layout.blocks[blockNumer]);
	$(Mod).remove(); // удаляем модуль из колонки
	var tBlockArray=splitBlockContent(blockNumer); // преобразуем в массив
	tBlockArray.splice(modIndex,1); // удаляем из блока текущий модуль
	saveBlockContentString(blockNumer,tBlockArray); // преобразуем в строку, сохраняем изменённый состав блока
  }catch(e){
	alert(e.message);
  }
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
