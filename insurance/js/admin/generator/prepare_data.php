<?	if (isset($dwshow)){?><script><? }
ob_start();?>
// JavaScript Document
textTarget=false; // будет определять, куда вставлять текст - в редактор или в модуль
/* 	Возможные варианты макета описываются по схеме:
	Layout.Schema[0] 	// колич. колонок: 1,2,3,4
	Layout.Schema[1]	// наличие/тип подзаголовка: 0 (нет), 1 (есть, тип отстуствует (для 2-х колонок)), i - внутренний (не пересекает последнюю колонку), s - общий (пересекает последнюю колонку)
	Layout.Schema[2]	// наличие/тип псевдофутера: 0 (нет), i - внутренний (не пересекает последнюю колонку), s - общий (пересекает последнюю колонку). 
	Внимание! Тип псевдофутера 1 отсутствует, т.к. не может быть пседвофутера для количества колонок, меньше 3. В этом случае роль псевдофутера может выполнять любой добавляемый модуль.
*/
jQuery(	function(){
		initializeLayout(); // инициализировать (и РЕинициализировать) макет
		$('div#txtChoice > div > div').click( function (){
				defineLayoutSchema(this);
			});
	});
// инициализировать объект сохранения данных макета
function initializeLayout(){
  try{	
	delete Layout;
	Layout=new Object();
  }catch(e){
	alert(e.message);
  }
}
//проверить - допускает ли текущее состояние макета его загрузку
function checkLayoutReady(){
	Layout.Schema=0;
	// родительский блок для всех уровней:
	var bLevels=document.getElementById('txtChoice').getElementsByTagName('div');
	//alert(i); 
	var levelsArray=getLevelsArray();
	var dLevel;
	var opCount=0;
	var levelStop=false;
	var nextLevel=false;
	var nextDisplay=false;
	var selIndex=false;
	var selElementClassName=false;
	// будем искать уже выбранные варианты, начиная с самого нижнего блока. Как только найдём первый, значит - можно загружать макет!
	//var testBlock=document.getElementById('test');
	//testBlock.innerHTML='';
	for (i=levelsArray.length-1;i>=0;i--){
		dLevel=document.getElementById(levelsArray[i][0]);
		if ( dLevel.style.display=='block'
			 || i==0 // самый первый уровень, в цикле будет последним
		   ){
			   
			opCount=$(dLevel).find("div[style*='opacity: 0.2']").length;
			if (levelsArray[i+1]) { 
				nextLevel=document.getElementById(levelsArray[i+1][0]);
				if (nextLevel.style.display=='block') nextDisplay=true;
			}else{
				nextLevel=false;
				nextDisplay=false;
			}
			//
			if ( opCount>0
				 && (nextLevel==false||nextDisplay==false)
			   ){	 
				// получим уровень блока:
				levelStop=i+1; 
				// получим класс отмеченной пиктограммы:
				selElementClassName=$(dLevel).find("div[style*='opacity: 1']")[0].className;
				Layout.Schema=getSchema(selElementClassName);
				Layout.Schema=Layout.Schema.toString();
				switch(levelStop){
					// уровень 1
					case 1:
						Layout.Schema+='00';
					break;
					// уровень 2
					case 2:
						if (selElementClassName.indexOf('Subheader')!=-1)
							Layout.Schema+='1';	
						else{ // twoColumn, threeColumn, fourColumn
							if ( selElementClassName.indexOf('Shared')==-1
							     && selElementClassName.indexOf('Inside')==-1
							   ) Layout.Schema+='0';
							else
								Layout.Schema+=(selElementClassName.indexOf('Shared')!=-1)? 's':'i'; 
						}
						Layout.Schema+='0';
					break;
					// уровень 3
					case 3: 
						// threeColumn
						// fourColumn
						if ( selElementClassName.indexOf('Shared')==-1
							     && selElementClassName.indexOf('Inside')==-1
							   ) Layout.Schema+='00';
						else{
							// threeSharedShared
							// fourSharedShared
							if (selElementClassName.indexOf('SharedShared')!=-1)
								Layout.Schema+='ss';
							else{
								// fourInsideInside
								if (selElementClassName.indexOf('InsideInside')!=-1)
									Layout.Schema+='ii';
								else{
									// fourColumnInside
									if (selElementClassName.indexOf('ColumnInside')!=-1)
										Layout.Schema+='i0';
									else{
										// threeColumnShared
										// fourColumnShared
										if (selElementClassName.indexOf('ColumnShared')!=-1)
											Layout.Schema+='s0';
										// threeNoneShared
										// fourNoneShared
										// fourNoneInside
										else if (selElementClassName.indexOf('None')!=-1) { 
											Layout.Schema+='0';
											Layout.Schema+=(selElementClassName.indexOf('Shared')!=-1)? 's':'i';
										}
									}
								}
							}
						}
					break;
				}
				var tSchm=false;
				if (tSchm=document.getElementById('tmpl-shema'))
					tSchm.innerHTML=(Layout.Schema)? Layout.Schema:'Не создана';
				break;
			}
		}
	}
	// управлять видимостью остальных блоков:
	if (Layout.Schema!=0) { 
		$("#tmpl_commands").fadeIn(1000);
		if ($('#btn_cancelLayoutChanges').attr('class')=='active') {
			setButtonStat(['btn_loadLayout'],'active');
		}
		return true;
	}else{
		if ($('#btn_cancelLayoutChanges').attr('class')=='active') {
			setButtonStat(['btn_loadLayout'],'passive');
		}else{
			$("#tmpl_commands").fadeOut(1000);
		}
		return false;
	}
} 
// подготовить схему макета, выбрав пиктограммы для: 
// * количества колонок
// * наличия и расположения подзаголовка
// * наличия и расположения псевдофутера
function defineLayoutSchema(activePycto){ // кнопка активного макета
  try{
	if ($(activePycto).parent().attr('id')=="tmplColSet") { 
		showBlock('currentChoice','line'); 
	}
	// обработать скрытые блоки с выбором типа размещения подзаголовка и псевдофутера
	handlePyctos(activePycto);
	// указать параметры текущего выбора
	// установить состояние прозрачности для пиктограмм, добавить информацию о подзаголовке и псевдофутере
	setCurrentChoiceStatus(activePycto);
	// проверить - допускает ли текущее состояние макета его загрузку:
	checkLayoutReady();
	return true;
  }catch(e){
	  alert(e.message);
  }
}
// разместить и отобразить информацию о выборе юзера:
function displayUserChoice(activePycto){ // контейнер с пиктограммами
  try{
	var userInfo,
		spans=$('#currentChoice span'),
		pyctosContainer=$(activePycto).parent();
	var sText=getLevelsArray();
	$(sText).each(	function(i) { // перебираем контейнеры пиктограмм
		// 'tmplColSet'=>'количество колонок',
		// 'chHeaders'=>'расположение подзаголовка',
		// 'psFooter'=>'расположение псевдофутера'
       	if ($(pyctosContainer).attr('id')==$(this)[0]){ 
			// 'tmplColSet', 'chHeaders', 'psFooter'
			$(pyctosContainer).find('div').each(  function (){
				if($(this).css('opacity')==1){
					//alert(this.title);
					if (currentPicTitle=$(this).attr('title'))
						currentPicTitle.toLowerCase();
					return false;
				}	
			});
			var tSpan=$(spans)[i];
			$(tSpan).html('<b>&bull; '+currentPicTitle+'</b>');
		} 
    });
  }catch(e){
	  alert(e.message);
  }
}
// сделать все пиктограммы непрозрачными
function dropPyctosOpacity(divPyctos){ 
	$(divPyctos).find('div').css('opacity','1');
}
// вернуть массив уровней с пиктограммами:
function getLevelsArray(){
	return new Array( new Array('tmplColSet','количество колонок'),
					  new Array('chHeaders','расположение подзаголовка'),
					  new Array('psFooter','расположение псевдофутера')
					);
} 
// получить начальное значение схемы макета
function getSchema(pyctClassName){
	var columns=new Array('one','two','three','four');
	for (i=0;i<columns.length;i++){
		if ( pyctClassName.indexOf(columns[i])!=-1
		     && pyctClassName.indexOf(columns[i])==0
		   ){
			return i+1;
		}
	}
}
// обработать блоки с пиктограммами:
function handlePyctos(srce) { // источник события
	var titleFooterInside="Внутренний псевдофутер";
	var titleFooterShared="Общий псевдофутер";
	// блоки "Выберите расположение...":
	var divsToPick=$('#txtActions div');
	// установить следующий блок для отображения при клике на пиктограмме текущего блока:
	var pyctosNextBlock;
	var blockTextToShowSubheader=divsToPick[1]; // текст "Выберите..."
	//alert(blockTextToShowSubheader);
	var blockTextToShowFooter=divsToPick[2];
	var divPyctosSubheader=document.getElementById('chHeaders');
	var divPyctosFooter=document.getElementById('psFooter');
	// подставить для отображения блоки (текст "Выберите...", пиктограммы схемы) следующего уровня:
	switch(srce.parentNode.id){
		// КЛАЦАЛИ ПО ПИКТОГРАММАМ ПЕРВОГО БЛОКА:
		case "tmplColSet": 
			// отобразить блоки следующего уровня, назначить класс первой пиктограмме
			pyctosNextBlock=startHandleBlock(srce,blockTextToShowSubheader,divPyctosSubheader);
			// сбросить видимость блоков третьего уровня:
			blockTextToShowFooter.style.display=divPyctosFooter.style.display="none";
			// сделать все пиктограммы блоков 2 и 3 непрозрачными:
			dropPyctosOpacity(divPyctosFooter);
			dropPyctosOpacity(divPyctosSubheader);
			// 
			switch(srce.className){ // определим источник события по его классу
				// блоки первого уровня:
				case "oneColumn":
					// сбросить видимость блока второго уровня:
					blockTextToShowSubheader.style.display=divPyctosSubheader.style.display="none";
				break;
				case "twoColumn":	// 2 колонки
					// назначить класс блоку со 2-й пиктограммой:
					pyctosNextBlock.item(1).className="twoColumnSubheader";
					// спрятать последнюю пиктограмму, т.к. для 2-х колонок она не нужна:
					pyctosNextBlock.item(2).style.display="none";
				break;
				case "threeColumn":case "fourColumn": // 3, 4 колонки
					pyctosNextBlock.item(1).className=srce.className+"Inside";
					pyctosNextBlock.item(2).className=srce.className+"Shared";
					// отобразить последнюю пиктограмму:
					pyctosNextBlock.item(2).style.display="inline-block";
				break;
			}
		break;
		// КЛАЦАЛИ ПО ПИКТОГРАММАМ ВТОРОГО БЛОКА:
		case "chHeaders": // родительским блоком источника события является блок второго уровня
			// сделать все пиктограммы последнего блока непрозрачными:
			dropPyctosOpacity(divPyctosFooter);
			if (srce.className.indexOf("twoColumn")==-1) { // для 2-х колонок псевдофутера быть не может
				// отобразить блоки следующего уровня, назначить класс первой пиктограмме
				pyctosNextBlock=startHandleBlock(srce,blockTextToShowFooter,divPyctosFooter);
				
				// вторая пиктограмма:
					// колич. колонок (3 или 4):
				if (srce.className.indexOf("three")!=-1) { // 3 колонки
					pyctosNextBlock.item(2).style.display="none"; // т.к. не нужна
					pyctosNextBlock.item(1).title=titleFooterShared;
					switch(srce.className){
						// pyctosNextBlock.item(0).className уже установлен
						case "threeColumn":
							pyctosNextBlock.item(1).className="threeNoneShared"; // нет подзаголовка
						break;
						case "threeColumnInside":
							// сбросить видимость блоков третьего уровня, т.к. для данного варианта псевдофутер не предусмотрен:
							blockTextToShowFooter.style.display=divPyctosFooter.style.display="none";
						break;
						case "threeColumnShared":
							pyctosNextBlock.item(1).className="threeSharedShared"; // нет подзаголовка
						break;
					}					
				}else{ // 4 колонки
					pyctosNextBlock.item(1).className=pyctosNextBlock.item(2).className="Four";
					switch(srce.className){
						// pyctosNextBlock.item(0).className уже установлен
						case "fourColumn":
							// вернуть видимость последней пиктограмме:
							pyctosNextBlock.item(2).style.display="inline-block"; 
							pyctosNextBlock.item(1).className="fourNoneInside";
							pyctosNextBlock.item(2).className="fourNoneShared";
							pyctosNextBlock.item(1).title=titleFooterInside;
							pyctosNextBlock.item(2).title=titleFooterShared;
						break;
						case "fourColumnInside":
							pyctosNextBlock.item(2).style.display="none";
							pyctosNextBlock.item(1).className="fourInsideInside";
							pyctosNextBlock.item(1).title=titleFooterInside;
						break;
						case "fourColumnShared":
							pyctosNextBlock.item(1).className="fourSharedShared";
							pyctosNextBlock.item(2).style.display="none"; // т.к. не нужна
							pyctosNextBlock.item(1).title=titleFooterShared;
						break;
					}
				}
			}
		break;
	}
}
// сделать полупрозрачными неиспользуемые схемы
// разместить информацию о текущем выборе в блока справа
function setCurrentChoiceStatus(activePycto){ 
	$(activePycto).parent().find('div').css('opacity',0.2);
	$(activePycto).css('opacity',1);
	displayUserChoice(activePycto);
}
// показать блок
function showBlock(tShow,line){
  try{
	var tObj='#'+tShow;
	if (line) {
		$(tObj).animate({opacity:1});
	}
	$(tObj).show('fast');
  }catch(e){
	  alert(e.message);
  }
}
// отобразить блоки следующего уровня, назначить класс первой пиктограмме
function startHandleBlock( srce,blockTextToShow,divPyctos){
	pyctosNextBlock=divPyctos.getElementsByTagName('div'); // пиктограммы следующего блока
	// отобразить блоки следующего уровня:
	blockTextToShow.style.display=divPyctos.style.display="block";
	pyctosNextBlock.item(0).className=srce.className;
	return pyctosNextBlock;			
}
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
