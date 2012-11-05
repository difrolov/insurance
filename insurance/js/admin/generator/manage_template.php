<?	$url=$_GET['base_url'];
	$test=$_GET['test'];
if (isset($dwshow)){?><script><? }
ob_start();?>
tBlock=false; // здесь будет сохраняться активный блок (объект)
// добавить модуль в активную колонку:
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
		test_parseLayout();
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
// перестроить последовательность модулей после их пересортировки:
// см. схему в сайт.xlsx!Пересортировка модулей
function rearrangeModulesOrder( column,			// колонка, содержащая сотрируемый модуль
								itemIndexStart, // индекс модуля перед сортировкой
								itemIndexStop	// индекс модуля после сортировки
							  ){
	
	
	//var modContent,tText;
	//var mTest='';
	
	
	var blockNumber=($(column).attr('data-block-type')=="footer")? 'footer':getBlockNumber(column);

	var iStartIterator,iStop;
	if (itemIndexStart>itemIndexStop){
		iStartIterator=itemIndexStop;
		iStop=itemIndexStart;
	}else{
		iStartIterator=itemIndexStart;
		iStop=itemIndexStop;
	} //alert('before:\nitemIndexStart: '+itemIndexStart+'\nitemIndexStop: '+itemIndexStop+'\n-----------\niStartIterator: '+iStartIterator+'\niStop: '+iStop);
	// распарсить контент блока на массив:
	var modContentArray=splitBlockContent(blockNumber);
	var tIndex;
	// получить все модули с контентом (текст и прочие) в колонке:
	$(column).find('div[data-module-type]').each( // только содержащие контент
		// перенести контент текущего модуля в блок
		function(i){
		  if (i>=iStartIterator) {
			
			//test:
			var from='\nЗАМЕНИТЬ\n'+modContentArray[i]+'\nНА:\n';			
			
			// модуль - текстовый:
			//if ($(this).attr('data-module-type')=='Текст') {
			// текущий модуль - это тот, который перемещали:
			if (i==itemIndexStop){
				// взять контент из модуля с позицией ДО перемещения и заменить им элемент массива с новым индексом для послудующего преобразования в контент блока:
				modContentArray[i]=modContentArray[itemIndexStart];
			}else{
				// в зависимости от того, куда перемещали модуль (вверх или вниз), будем корректировать индексы остальных модулей:
				tIndex=(itemIndexStart>itemIndexStop)? i-1:i+1;
				modContentArray[i]=modContentArray[tIndex];
			}
			//}else{
				// заменить контент модуля БЛОКА текстом текущего модуля КОЛОНКИ:
				//modContentArray[i]=$(this).text();
			//}
			
			alert('i = '+i+'\nТип модуля: '+$(this).attr('data-module-type')+'\nКонтент перемещаемого модуля: \n'+modContentArray[i]+'\nmodContentArray: \n'+modContentArray+from+modContentArray[i]);
			if (i==iStop){
				//alert('after:\ni: '+i+'\niStop: '+iStop);
				Layout.blocks[blockNumber]=modContentArray.join("|");
				//alert(Layout.blocks[blockNumber]);
				return false;
			}
		}
			/*// проверить, не является ли модуль текстовым; получить добавленный контент
			if ($(this).attr('data-module-type')=='Текст') {
				
				
				
				// индекс ТЕКУЩЕГО модуля (в данной итерации) в колонке после сортировки:
				var currentModuleIndex=$(column).index(this.parent);
				var tInfo='\n\ni= '+i+'\nitemIndexStop= '+itemIndexStop+'\nitemIndexStart= '+itemIndexStart;
				var modContentArray=splitBlockContent(blockNumber);
				// подставить "Текст":
				if( ( //индекс ТЕКУЩЕГО модуля не совпадает с индексом ОТСОРТИРОВАННОГО модуля:
					  currentModuleIndex!=itemIndexStop	
					  && i==currentModuleIndex
					)
					// ИЛИ
					// контент БЛОКА (Layout) не содержит " :: "
					|| modContentArray[itemIndexStart].indexOf(setTextContentIdentifier())==-1
				  ) {
					// если текущий текстовый блок содержит суффикс, являющийся флагом добавления новой или существующей статьи, заберём этот контент:
					tText=getTextStart(null); // вернёт "Текст"
					alert('Должен быть просто "Текст":\n'+tText+tInfo);
				}else{ // подставить контент блока:
					tText=modContentArray[itemIndexStart]; // вернёт контент текстового БЛОКА В Layout
					//alert('Должен быть контент текстового БЛОКА В Layout:\n'+tText+tInfo);
				}//alert('modContentArray: \n----------------- \n' + modContentArray + '\n \n \nsetTextContentIdentifier: \n-----------------\n' + setTextContentIdentifier() + '\n\n\ntText:\n-----------------\n' + tText);
			
			
			
			
			
			}else
				tText=$(this).text();
			
			if (i) {
				//--------------
				mTest+="\n";
				mTest+=tText;
				//--------------
				modContent+="|";
				modContent+=tText;
			}else{
				mTest=tText;
				//--------------
				modContent=tText;
			}	// alert(itemIndexStart+' :: '+itemIndexStop+'\ntText:\n'+tText+'\nmodContent:\n'+'\n'+mTest);*/
	}); 
	//Layout.blocks[blockNumber]=modContent;
<?	if (isset($_GET['test'])):?>    
	//alert('Контент БЛОКА:\n-----------------\n'+mTest+'\n==================\n'+modContent);
	test_parseLayout();
<?	endif;?>	
}
// удалить модуль из колонки визуально и из набора Layout "физически"
function removeModule(objSrc){ // ссылка
  try{
	var Mod=objSrc.parentNode.parentNode; // модуль (class="innerModule")
	var Block=Mod.parentNode; // блок
	// найти в активной колонке блок, распарсить его модули и удалить нужный:
	var blockNumber=getBlockNumber(Block); // № блока
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
function saveBlockContentString(blockNumber,tBlockArray){
	tBlockStr=tBlockArray.join("|"); // преобразуем в строку
	Layout.blocks[blockNumber]=tBlockStr;
<?	if (isset($_GET['test'])){?>
		test_parseLayout();
<?	}?>		
	//alert(Layout.blocks[blockNumber]);
}
// выделить фоном активную колонку:
function selectColumn(event,divBlock){
  try{
	// колонка, по которой кликали:
	var srcEl=(event.target)? event.target:event.srcElement;
	if (srcEl.parentNode==divBlock) {
		if (!$(srcEl).find('input').length) {
			$(divBlock).children('div')
				.css('background-color','#FFF')
				.removeAttr('data-column_stat');
			$(srcEl).sortable({
					start: function (event,ui){
						//alert();
						itemIndexStart=ui.item.index();
					},
					stop: function(event,ui){
						var blockNumber=($(this).attr('data-block-type')=="footer")? 'footer':getBlockNumber(this);
						alert('modContentArray BEFORE:\n'+splitBlockContent(blockNumber));
						rearrangeModulesOrder(this,itemIndexStart,ui.item.index());
					}
				});
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
