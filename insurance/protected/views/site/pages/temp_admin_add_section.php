<?	// add section in backend - temporary file ?>
<style>
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
div.fourColumnFooterInside{
	background-position:-37px -86px;
}
div.fourColumnFooterShared{
	background-position:-75px -86px;
}
div.twoColumnSubheader{
	background-position:-37px -28px;
}
div.threeColumnFooterShared{
	background-position:1px -86px;
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
// подготовить схему макета, выбрав пиктограммы для: 
// * количества колонок
// * наличия и расположения подзаголовка
// * наличия и расположения псевдофутера
function defineTemplateScheme(pyctosContainer){ // pyctosContainer - родительский блок для текущего набора пиктограмм
  try{
	var srce=false; // инициализируем источник события (пиктограмму)
	// установить target-элемент DIV:
	if (event.srcElement.className.indexOf('Column')!=-1) {
		srce=event.srcElement;
	}
	if (event.srcElement.parentNode.className.indexOf('Column')!=-1) {
		srce=event.srcElement.parentNode;
	}
	// источник - одна из пиктограмм схемы:
	if (srce) { //alert(event.srcElement.className);
		var currentPyctosContainer=srce.parentNode;
		// показать блок "текущий выбор":
		if (currentPyctosContainer.id=="tmplColSet") { 
			showBlock('currentChoice','line'); 
		}
		// обработать скрытые блоки с выбором типа размещения подзаголовка и псевдофутера
		handlePyctos(srce);
		// установить состояние прозрачности для пиктограмм, добавить информацию о подзаголовке и псевдофутере
		// указать параметры текущего выбора
		setCurrentChoiceStatus(currentPyctosContainer);  
	}
  }catch(e){
	  alert(e.message);
  }
}
// обработать блоки с пиктограммами:
function handlePyctos(srce) { // источник события
	// блоки "Выберите расположение...":
	var divsToPick=document.getElementById('txtActions').getElementsByTagName('div');
	// установить следующий блок для отображения при клике на пиктограмме текущего блока:
	var blockTextToShow,divPycto;
	// подставить для отображения блоки (текст "Выберите...", пиктограммы схемы) следующего уровня:
	switch(srce.parentNode.id){
		case "tmplColSet": // родительским блоком источника события является блок первого уровня
			// следующий блок - второго уровня (подзаголовок):
			blockTextToShow=divsToPick.item(1); // текст "Выберите..."
			var pyctosNextBlock=document.getElementById('chHeaders').getElementsByTagName('div'); // пиктограммы следующего блока
			// 
			switch(srce.className){ // определим источник события по его классу
				// блоки первого уровня:
					// инициализировать значение схемы (tmplScheme[0])
				case "oneColumn":
					tmplScheme='100';
				brak;
				case "twoColumn":	// 2 колонки
					tmplScheme='2';
					// назначить класс блоку со 2-й пиктограммой:
					pyctosNextBlock.item(1).className="twoColumnSubheader";
					// спрятать последнюю пиктограмму, т.к. для 2-х колонок она не нужна:
					pyctosNextBlock.item(2).style.display="none";
				break;
				case "threeColumn":case "fourColumn": // 3, 4 колонки
					pyctosNextBlock.item(1).className=srce.className+"Inside";
					pyctosNextBlock.item(2).className=srce.className+"Shared";
					tmplScheme=(srce.className=="threeColumn")? '3':'4';
				break;
			}
		break;
		case "chHeaders": // родительским блоком источника события является блок второго уровня
			if (srce.className!="twoColumn") { // для 2-х колонок псевдофутера быть не может
				// следующий блок - третьего уровня (псевдофутер):
				blockTextToShow=divsToPick.item(2); // текст "Выберите..."
				var pyctosNextBlock=document.getElementById('psFooter').getElementsByTagName('div'); // пиктограммы третьего блока
				// назначить класс пиктограммам:
				// первая пиктограмма (без псевдофутера для любого количества колонок):
				pyctosNextBlock.item(0).className=srce.className;
				// вторая пиктограмма:
					// колич. колонок (3 или 4):
				pyctosNextBlock.item(1).className=(srce.className.indexOf("three")!=-1)? "3":"4";
					// подзаголовок, псевдофутер:
						// threeColumn, fourColumn
				// без подзаголовка:
				if (srce.className.indexOf("Shared")==-1&&srce.className.indexOf("Inside")==-1) { // подзаголовок не указан
					pyctosNextBlock.item(1).className+="0"; // нет подзаголовка
					tmplScheme+="0";
					// псевдофутер:
					// общий - для 3-х колонок, внутренний - для 4-х:
					var setFooterValue=(srce.className.indexOf("three")!=-1)? "s":"i";
					pyctosNextBlock.item(1).className+=setFooterValue;
					tmplScheme+=setFooterValue;
				}else{ // с подзаголовком:
					// псевдофутер: 3ss, 4ii, 4ss
					if (srce.className.indexOf("Inside")!=-1) {
						pyctosNextBlock.item(1).className+="ii";
						tmplScheme+="ii";
					}else if (srce.className.indexOf("Shared")!=-1) {
						pyctosNextBlock.item(1).className+="ss";
						tmplScheme+="ss";
					}
				}
			}else{ // для 2-х колоног
				tmplScheme+=(srce.className=="twoColumnInside")? "1":"0"; // установить значение подзаголовка
				tmplScheme+="0"; // псевдофутер отсутствует в любом случае
			}
		break;
	}
	blockTextToShow.style.display='block'; // отобразить блок "Выберите..."
}
// сделать полупрозрачными неиспользуемые схемы
// разместить инйормацию о текущем выборе в блока справа
function setCurrentChoiceStatus(pyctosContainer){ //alert('setCurrentChoiceStatus');
	// блоки (div) элемента-источника события
	var pyctosNextBlock=pyctosContainer.getElementsByTagName('div'); // container/div
	var subHeaderPlacementType=false;
	var currentPycto,srcElem;
	for(i=0;i<pyctosNextBlock.length;i++){
		currentPycto=pyctosNextBlock.item(i);
		srcElem=event.srcElement;
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
// разместить и отобразить информацию о выборе юзера:
function displayUserChoice(pyctosContainer){
	switch(pyctosContainer.id){
		case "tmplColSet":
		
		break;
		case "chHeaders":
		
		break;
		case "psFooter":
		
		break;	
	}
	var cID=(plus)? 'selectedSubheaderPlacement':'selectedColumnsSet';
	document.getElementById(cID).innerHTML=(plus=='-1')? '':cText;
}
</script>
<div align="right"><button onClick="showBlock('mng');">Добавить...</button></div>
<div id="mng"<? if(!isset($_GET['test'])){?> style="display:<?="none"?>;"<? }?>>
	<div id="txtActions">
    	<div>Выберите макет создаваемой страницы:</div>
        <div>Выберите расположение подзаголовка:</div>
        <div>Выберите расположение псевдофутера:</div>
    </div>
    <div id="txtChoice"onClick="defineTemplateScheme(this);">
    	<div id="tmplColSet">
            <div class="oneColumn" title="Одна колонка">&nbsp;</div>
            <div class="twoColumn" title="Две колонки">&nbsp;</div>
            <div class="threeColumn" title="Три колонки">&nbsp;</div>
            <div class="fourColumn" title="Четыре колонки">&nbsp;</div>
        </div>
        <div id="<?="chHeaders"?>">
            <div class="ColumnSubheaderNone" title="Без подзаголовка">&nbsp;</div>
            <div title="Внутренний подзаголовок">&nbsp;</div>
            <div title="Общий подзаголовок">&nbsp;</div>
        </div>
        <div id="<?="psFooter"?>">
            <div title="Без псевдофутера">&nbsp;</div>
        	<div title="Общий псевдофутер">&nbsp;</div>
        	<div title="Внутренний псевдофутер">&nbsp;</div>
        	<div title="Общий псевдофутер">&nbsp;</div>
        </div>
    </div>
    <div id="currentChoice">Вы выбрали::
    	<span id="selectedColumnsSet"></span>
        <span id="selectedSubheaderPlacement"></span>
        <span id="selectedFooterPlacement"></span>
    </div>
</div>