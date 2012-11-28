<?	$url=$_GET['base_url'];
	$test=(isset($_GET['test']))? $_GET['test']:false;
if (isset($dwshow)){?><script><? }
ob_start();?>
$( function(){
	
	$('div#tmplPlace > div:first-child > div[data-block-type]')
			.live( 'click', function (){
				selectColumn(this);	
				// вывод информации в консоль в тестовом режиме
				// если test_mode='alert' также выводит alert
				//consoleOutput(this);
	});
	$('div#select_mod div[data-module-type]')
			.click( function (){
				addModuleIntoBlock(this);	
	});
});

tBlock=false; // здесь будет сохраняться активный блок (объект)
// добавить модуль в активную колонку:
function addModuleIntoBlock(srcEl){
  try{
	var dataModuleType=$(srcEl).attr('data-module-type');
	// получим индекс активной колонки и элемента объекта (блока):
	var stActive='div[data-column_stat="active"]';
	
	var cols=$('div[data-block-type]');
	var astat=false;
	// AHTUNG!!! 
	// по неизвестным причинам проверка $(cols).find(stActive).size() НЕ СРАБАТЫВАЕТ!!! Всегда возвращает 0
	$(cols).each( function(){
		if ($(this).attr('data-column_stat'))
			astat=true;
	});
	if (!astat) {
		if (Layout.Schema=='100') {
			$(cols).eq(0).trigger('click');
			astat=true;
		}else if (!astat){
			alert('Сначала щёлкните по колонке, в которую хотите добавить модуль.');
		}
	}
	
	if (astat) {
		var aCol=$(stActive);
		var cIndex=$(aCol).parent('div').children().index(aCol); // alert(cIndex);
		var bi=0;
		// вывод информации в консоль в тестовом режиме
		// если test_mode='alert' также выводит alert
		// Layout.blocks[block] - значение элемента
		for(var block in Layout.blocks){
			if (bi==cIndex){
				if (Layout.blocks[block]!='')
					Layout.blocks[block]+='|';
				Layout.blocks[block]+=dataModuleType; 
			}
			bi++;
		}
	}
<?	if ($test){?>		
	// добавить данные в тестовый блок:
	test_parseLayout();
<?	}?>	
	// сгенерировать html-контент модуля:
	setModContent(srcEl,dataModuleType);	
	
  }catch(e){
	  alert(e.message);
  }
}
// получить целевую колонку по идентификатору активного блока в Layout:
function getTargetColumn(){
	return (Layout.blocks.activeBlockIdentifier=='footer')? $('div#tmplPlace div[data-block-type="footer"]'):$('div#tmplPlace div[data-block-type]')[Layout.blocks.activeBlockIdentifier-1];
}
// перестроить последовательность модулей после их пересортировки:
// см. схему в сайт.xlsx!Пересортировка модулей
function rearrangeModulesOrder( column,			// колонка, содержащая сотрируемый модуль
								itemIndexStart, // индекс модуля перед сортировкой
								itemIndexStop	// индекс модуля после сортировки
							  ){
	var blockNumber=($(column).attr('data-block-type')=="footer")? 'footer':getBlockNumber(column);
	var iStartIterator,iStop;
	if (itemIndexStart>itemIndexStop){
		iStartIterator=itemIndexStop;
		iStop=itemIndexStart;
	}else{
		iStartIterator=itemIndexStart;
		iStop=itemIndexStop;
	}
	// распарсить контент блока на массив:
	var modContentArray=splitBlockContent(blockNumber);
	var tIndex;
	var newModArray=new Array();
	// пересортировать остальные модули (переместить контент с учётом изменившихся индексов):
	for( i=0;i<modContentArray.length;i++){
		if (i<iStartIterator||i>iStop){
			newModArray[i]=modContentArray[i];
		}else{
			tIndex=(itemIndexStart>itemIndexStop)? i-1:i+1;
			if (modContentArray[tIndex])
				newModArray[i]=modContentArray[tIndex];
		}
	}
	// взять контент модуля из начальной позиции (в блоке) и переместить в конечную позицию 
	newModArray[itemIndexStop]=modContentArray[itemIndexStart];
	Layout.blocks[blockNumber]=newModArray.join("|");
<?	if (isset($_GET['test'])):?>    
	test_parseLayout();
<?	endif;?>	
}
// удалить модуль из колонки визуально и из набора Layout "физически"
function removeModule(objSrc){ // ссылка
  try{
	var Mod=objSrc.parentNode.parentNode; // модуль (class="innerModule")
	var Block=Mod.parentNode; // блок
	// найти в активной колонке блок, распарсить его модули и удалить нужный:
	var blockNumber=getBlockNumber(Block); // идентификатор (№/footer) активного блока
	var modIndex=getModuleIndex(Block,Mod); // индекс модуля
	//alert('Удаляем модуль index '+modIndex+'\n---------------\nТекущий набор:\n'+Layout.blocks[blockNumber]);
	$(Mod).remove(); // удаляем модуль из колонки
	var tBlockArray=splitBlockContent(blockNumber); // преобразуем в массив
	tBlockArray.splice(modIndex,1); // удаляем из блока текущий модуль
	$('div#article_preview_text').hide(); // скрыть окно статического предпросмотра статьи (если есть)
	saveBlockContentString(blockNumber,tBlockArray); // преобразуем в строку, сохраняем изменённый состав блока
  }catch(e){
	alert(e.message);
  }
}
// преобразовать контент блока в массив:
function splitBlockContent(blockNumber){
	// attention! blockNumber may be as "footer" as number
	return Layout.blocks[blockNumber].split("|");
}
// преобразовать контент блока в строку и сохранить в Layout:
function saveBlockContentString( blockNumber, tBlockArray){
	
	if (typeof(tBlockArray)=='object')	
		tBlockStr=tBlockArray.join("|"); // преобразуем в строку
	else
		tBlockStr=tBlockArray;
	Layout.blocks[blockNumber]=tBlockStr;
	// вывод информации в консоль в тестовом режиме
	// если test_mode='alert' также выводит alert
	consoleOutput('blockNumber = '+blockNumber+'\ntBlockArray = '+tBlockArray+'\ntBlockStr = '+tBlockStr+'\nLayout.blocks[blockNumber] = '+Layout.blocks[blockNumber]);
<?	if (isset($_GET['test'])){?>
		test_parseLayout();
<?	}?>		
	//alert(Layout.blocks[blockNumber]);
}
// выделить фоном активную колонку:
function selectColumn(srcEl){
  try{
	// колонка, по которой кликали:
	$(srcEl).parent('div').children('div')
		.css('background-color','#FFF')
		.removeAttr('data-column_stat');
	
	if (!$(srcEl).find('input').size()) {
		$(srcEl).sortable({
				start: function (event,ui){
					itemIndexStart=ui.item.index();
				},
				stop: function(event,ui){
					rearrangeModulesOrder(this,itemIndexStart,ui.item.index());
				}
			});
		
		tBlock=srcEl; // сохранить в глобальной переменной активную колонку
		
		$(srcEl).css({
			backgroundColor:'#CEEFFF',
		}).attr('data-column_stat','active'); // reserved
		// вывод информации в консоль в тестовом режиме
		// если test_mode='alert' также выводит alert
		//consoleOutput('selectColumn active : '+$('div[data-column_stat="active"]').size());
	}

  }catch(e){
	  alert(e.message);
  }
}
/**
 *
 */
function setModContent(srcEl,dataModuleType){
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
	$('#save_tmpl_block').fadeIn(3000);
}
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
