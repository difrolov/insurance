<?	// add section in backend - temporary file ?>
<style>
button#loadTemplate{
	border-radius:6px;
	display:none;
	margin:10px 0;
	opacity:0;
	padding:8px 12px;
}
div#chHeaders,
div#psFooter{
<? if(!isset($_GET['test'])){?>	display:none; <? }?>
}
div#mng{
	border:solid 4px #CCCCCC;
	margin-top:20px;
	padding-bottom:5px;
	padding-left:6px;
}
div#txtChoice div{
	margin-top:6px;
}
div#txtActions >div{
	line-height:43px;
}
div#txtActions >div:first-child{
	padding-top:4px;
}
div#txtActions div:last-child,
div#txtActions, 
div#txtChoice,
div#currentChoice,
div#txtChoice > div div{
	display:inline-block;
}
div#currentChoice span{
	display:block;
}
div#txtChoice >div div{ /*  */
	height:26px;
	width:35px;
	margin:0 0 0 6px;
}
div.oneColumn,
div.twoColumn,
div.threeColumn,
div.fourColumn,
div#txtChoice
	>div:first-child +div div,
div#txtChoice 
	>div:last-child div {
	background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/images/admin/add-sectiion.gif);
	background-repeat:no-repeat;
	border:solid 3px #999;
	border-radius:2px;
	cursor:pointer;
	padding:2px;
}
div.threeNoneShared{
	background-position:1px -115px;
}
div.threeSharedShared{
	background-position:1px -86px;
}
div.fourNoneInside{
	background-position:-37px -115px;
}
div.fourNoneShared{
	background-position:-74px -115px;
}
div.fourInsideInside{
	background-position:-37px -86px;
}
div.fourSharedShared{
	background-position:-75px -86px !important;
}
div.oneColumn{
	background-position:1px 1px;
}
div.twoColumn{
	background-position:-37px 1px;
}
div.threeColumn{
	background-position:-75px 1px;
}
div.fourColumn{
	background-position:1px -28px;
}
div.twoColumnSubheader{
	background-position:-37px -28px;
}
div.threeColumnInside{
	background-position:-75px -28px;
}
div.threeColumnShared{
	background-position:1px -57px;
}
div.fourColumnInside{
	background-position:-37px -57px;
}
div.fourColumnShared{
	background-position:-75px -57px;
}
div#txtActions > div:first-child +div,
div#txtActions > div:last-child{ /*	вверх не переносить, иначе возникнет конфликт отображения блока!*/
	margin-top:-4px;
<? if(!isset($_GET['test'])){?>	display:none; <? }?>
}
div#currentChoice{
	background:#CCFFCC;
	border-radius:2px;
	display:inline-block;
	min-height:24px;
	margin-left:20px;
	margin-top:8px;
	opacity:0;
	padding:6px 10px 6px 8px;
	vertical-align:top;
	width:40%;
}
</style>
<script type="text/javascript">
tmplScheme=false; // пер. сохранения схемы выбранного шаблона
/* 	Возможные варианты макета описываются по схеме:
	tmplScheme[0] 	// колич. колонок: 1,2,3,4
	tmplScheme[1]	// наличие/тип подзаголовка: 0 (нет), 1 (есть, тип отстуствует (для 2-х колонок)), i - внутренний (не пересекает последнюю колонку), s - общий (пересекает последнюю колонку)
	tmplScheme[2]	// наличие/тип псевдофутера: 0 (нет), i - внутренний (не пересекает последнюю колонку), s - общий (пересекает последнюю колонку). 
	Внимание! Тип псевдофутера 1 отсутствует, т.к. не может быть пседвофутера для количества колонок, меньше 3. В этом случае роль псевдофутера может выполнять любой добавляемый модуль.
*/
//проверить - допускает ли текущее состояние макета его загрузку
function checkTemplateReady(){
	tmplScheme=0;
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
	var testBlock=document.getElementById('test');
	testBlock.innerHTML='';
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
				tmplScheme=getScheme(selElementClassName);
				tmplScheme=tmplScheme.toString();
				switch(levelStop){
					// уровень 1
					case 1:
						tmplScheme+='00';
					break;
					// уровень 2
					case 2:
						if (selElementClassName.indexOf('Subheader')!=-1)
							tmplScheme+='1';	
						else{ // twoColumn, threeColumn, fourColumn
							if ( selElementClassName.indexOf('Shared')==-1
							     && selElementClassName.indexOf('Inside')==-1
							   ) tmplScheme+='0';
							else
								tmplScheme+=(selElementClassName.indexOf('Shared')!=-1)? 's':'i'; 
						}
						tmplScheme+='0';
					break;
					// уровень 3
					case 3: 
						// threeColumn
						// fourColumn
						if ( selElementClassName.indexOf('Shared')==-1
							     && selElementClassName.indexOf('Inside')==-1
							   ) tmplScheme+='00';
						else{
							// threeSharedShared
							// fourSharedShared
							if (selElementClassName.indexOf('SharedShared')!=-1)
								tmplScheme+='ss';
							else{
								// fourInsideInside
								if (selElementClassName.indexOf('InsideInside')!=-1)
									tmplScheme+='ii';
								else{
									// fourColumnInside
									if (selElementClassName.indexOf('ColumnInside')!=-1)
										tmplScheme+='i0';
									else{
										// threeColumnShared
										// fourColumnShared
										if (selElementClassName.indexOf('ColumnShared')!=-1)
											tmplScheme+='s0';
										// threeNoneShared
										// fourNoneShared
										// fourNoneInside
										else if (selElementClassName.indexOf('None')!=-1) { 
											tmplScheme+='0';
											tmplScheme+=(selElementClassName.indexOf('Shared')!=-1)? 's':'i';
										}
									}
								}
							}
						}
					break;
				}
				testBlock.innerHTML='level: '+levelStop+', className: '+selElementClassName+', tmplScheme: '+tmplScheme;
				break;
			}
		}
	}
	if (tmplScheme!=0) {
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
function defineTemplateScheme(event,pyctosContainer){ // pyctosContainer - родительский блок для текущего набора пиктограмм
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
function getScheme(pyctClassName){
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
// разместить инйормацию о текущем выборе в блока справа
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
</script>
<div align="right"><button onClick="showBlock('mng');">Добавить...</button></div>
<div id="mng"<? if(!isset($_GET['test'])){?> style="display:<?="none"?>;"<? }?>>
	<div id="txtActions">
    	<div>Выберите макет создаваемой страницы:</div>
        <div>Выберите расположение подзаголовка:</div>
        <div>Выберите расположение псевдофутера:</div>
    </div>
    <div id="txtChoice" onClick="defineTemplateScheme(event,this);">
    	<div id="tmplColSet">
            <div class="oneColumn" title="Одна колонка">&nbsp;</div>
            <div class="twoColumn" title="Две колонки">&nbsp;</div>
            <div class="threeColumn" title="Три колонки">&nbsp;</div>
            <div class="fourColumn" title="Четыре колонки">&nbsp;</div>
        </div>
        <div id="<?="chHeaders"?>">
            <div title="Без подзаголовка">&nbsp;</div>
            <div title="Внутренний подзаголовок">&nbsp;</div>
            <div title="Общий подзаголовок">&nbsp;</div>
        </div>
        <div id="<?="psFooter"?>">
            <div title="Без псевдофутера">&nbsp;</div>
        	<div>&nbsp;</div>
        	<div>&nbsp;</div>
        </div>
    </div>
    <div id="currentChoice">Вы выбрали следующие параметры макета:
    	<span id="selectedColumnsSet"></span>
        <span id="selectedSubheaderPlacement"></span>
        <span id="selectedFooterPlacement"></span>
    </div>
</div>
<div id="tmpl_scheme"></div>
<div id="test">test block</div>
<button id="loadTemplate">Загрузить макет</button>