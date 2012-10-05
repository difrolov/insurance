<?	if (isset($dwshow)){?><script><? }
ob_start();?>
// JavaScript Document
tmplSchema=false; // пер. сохранения схемы выбранного шаблона
/* 	Возможные варианты макета описываются по схеме:
	tmplSchema[0] 	// колич. колонок: 1,2,3,4
	tmplSchema[1]	// наличие/тип подзаголовка: 0 (нет), 1 (есть, тип отстуствует (для 2-х колонок)), i - внутренний (не пересекает последнюю колонку), s - общий (пересекает последнюю колонку)
	tmplSchema[2]	// наличие/тип псевдофутера: 0 (нет), i - внутренний (не пересекает последнюю колонку), s - общий (пересекает последнюю колонку). 
	Внимание! Тип псевдофутера 1 отсутствует, т.к. не может быть пседвофутера для количества колонок, меньше 3. В этом случае роль псевдофутера может выполнять любой добавляемый модуль.
*/
//проверить - допускает ли текущее состояние макета его загрузку
function checkTemplateReady(){
	tmplSchema=0;
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
				tmplSchema=getSchema(selElementClassName);
				tmplSchema=tmplSchema.toString();
				switch(levelStop){
					// уровень 1
					case 1:
						tmplSchema+='00';
					break;
					// уровень 2
					case 2:
						if (selElementClassName.indexOf('Subheader')!=-1)
							tmplSchema+='1';	
						else{ // twoColumn, threeColumn, fourColumn
							if ( selElementClassName.indexOf('Shared')==-1
							     && selElementClassName.indexOf('Inside')==-1
							   ) tmplSchema+='0';
							else
								tmplSchema+=(selElementClassName.indexOf('Shared')!=-1)? 's':'i'; 
						}
						tmplSchema+='0';
					break;
					// уровень 3
					case 3: 
						// threeColumn
						// fourColumn
						if ( selElementClassName.indexOf('Shared')==-1
							     && selElementClassName.indexOf('Inside')==-1
							   ) tmplSchema+='00';
						else{
							// threeSharedShared
							// fourSharedShared
							if (selElementClassName.indexOf('SharedShared')!=-1)
								tmplSchema+='ss';
							else{
								// fourInsideInside
								if (selElementClassName.indexOf('InsideInside')!=-1)
									tmplSchema+='ii';
								else{
									// fourColumnInside
									if (selElementClassName.indexOf('ColumnInside')!=-1)
										tmplSchema+='i0';
									else{
										// threeColumnShared
										// fourColumnShared
										if (selElementClassName.indexOf('ColumnShared')!=-1)
											tmplSchema+='s0';
										// threeNoneShared
										// fourNoneShared
										// fourNoneInside
										else if (selElementClassName.indexOf('None')!=-1) { 
											tmplSchema+='0';
											tmplSchema+=(selElementClassName.indexOf('Shared')!=-1)? 's':'i';
										}
									}
								}
							}
						}
					break;
				}
				//testBlock.innerHTML='level: '+levelStop+', className: '+selElementClassName+', tmplSchema: '+tmplSchema;
				break;
			}
		}
	}
	if (tmplSchema!=0) {
		$('#loadTemplate').css('display','block'); 
		$('#loadTemplate').animate({opacity:1});
		//document.getElementById('loadTemplate').style.display="block";
		return true;
	}else{ 
		$('#loadTemplate').animate(
			{opacity:0}, 
			function (){
				$('#loadTemplate').css('display','none');
			}
		);
		return false;
	}
} 
// подготовить схему макета, выбрав пиктограммы для: 
// * количества колонок
// * наличия и расположения подзаголовка
// * наличия и расположения псевдофутера
function defineTemplateSchema(event,pyctosContainer){ // pyctosContainer - родительский блок для текущего набора пиктограмм
  try{
	var srce=false; // инициализируем источник события (пиктограмму)
	var eventObj=(navigator.appName=="Netscape")? event.target:event.srcElement; 
	var sClass=eventObj.className;
	var sClassParent= eventObj.parentNode.className;
	// установить target-элемент DIV:
	if ( sClass.indexOf('Column')!=-1
	     || sClass.indexOf('Shared')!=-1
		 || sClass.indexOf('Inside')!=-1
	   ) srce=eventObj;
	if ( sClassParent.indexOf('Column')!=-1
	     || sClassParent.indexOf('Shared')!=-1
		 || sClassParent.indexOf('Inside')!=-1
	   ) srce=eventObj.parentNode;
	// источник - одна из пиктограмм схемы:
	if (srce) { //alert(eventObj.className);
		var currentPyctosContainer=srce.parentNode;
		// показать блок "текущий выбор":
		if (currentPyctosContainer.id=="tmplColSet") { 
			showBlock('currentChoice','line'); 
		}
		// обработать скрытые блоки с выбором типа размещения подзаголовка и псевдофутера
		handlePyctos(srce);
		// установить состояние прозрачности для пиктограмм, добавить информацию о подзаголовке и псевдофутере
		// указать параметры текущего выбора
		setCurrentChoiceStatus(event,currentPyctosContainer);
		// проверить - допускает ли текущее состояние макета его загрузку:
		checkTemplateReady();
	}
  }catch(e){
	  alert(e.message);
  }
}
// разместить и отобразить информацию о выборе юзера:
function displayUserChoice(pyctosContainer){ 
  try{
	var userInfo;
	var sText=getLevelsArray();
 	var sBlocks=document.getElementById('currentChoice').getElementsByTagName('span');
	var currentPicTitle;
	for (i=0;i<sText.length;i++){
		if (pyctosContainer.id==sText[i][0]) {
			var pBlocks=pyctosContainer.getElementsByTagName('div');
			for (j=0;j<pBlocks.length;j++){
				if (pBlocks.item(j).style.opacity==1) {
					currentPicTitle=pBlocks.item(j).title.toLowerCase();
					break;
				}
			}
			sBlocks.item(i).innerHTML='&bull; '+sText[i][1]+': '+currentPicTitle;
			// спрятать инфо ниже текущего уровня:
			for (b=i+1;b<(sBlocks.length);b++)
				sBlocks[b].innerHTML='';
		}
	}		
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
	var divsToPick=document.getElementById('txtActions').getElementsByTagName('div');
	// установить следующий блок для отображения при клике на пиктограмме текущего блока:
	var pyctosNextBlock;
	var blockTextToShowSubheader=divsToPick.item(1); // текст "Выберите..."
	var blockTextToShowFooter=divsToPick.item(2);
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
function setCurrentChoiceStatus(event,pyctosContainer){ //alert(pyctosContainer.id);
	// блоки (div) элемента-источника события
	var pyctosNextBlock=pyctosContainer.getElementsByTagName('div'); // container/div
	var subHeaderPlacementType=false;
	var currentPycto,srcElem; //alert(pyctosNextBlock.length);
	srcElem=(navigator.appName=="Netscape")? event.target:event.srcElement;
	for(i=0;i<pyctosNextBlock.length;i++){
		currentPycto=pyctosNextBlock.item(i);		
		if (srcElem==currentPycto) { // источник события - текущая пиктограмма 
			currentPycto.style.opacity=1; // сделать непрозрачной (активной)
			if (srcElem==currentPycto){ // источник события - текущая пиктограмма
				// указать выбранный тип размещения подзаголовка:
				if (srcElem.className.indexOf('Inside')!=-1) // внутренний подзаголовок
					subHeaderPlacementType="внутренний"; 
				else 
					subHeaderPlacementType=(srcElem.className.indexOf('Shared')!=-1||srcElem.className=='twoColumnSubheader')? "общий":"без подзаголовка";
			}
		}
		currentPycto.style.opacity=(srcElem==currentPycto)? 1:0.2;
	}
	// указать параметры текущего выбора
	displayUserChoice(pyctosContainer);
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
