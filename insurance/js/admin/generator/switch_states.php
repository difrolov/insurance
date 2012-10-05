<?	if (isset($dwshow)){?><script><? }
ob_start();?>
/*// состояния блоков:
// Default
function stateDefault(){
	display(['choice_init']); // блок с пиктограммами отображён
	makeLiquid(['tmpl_commands','sel_modules'],0);// кнопки и модули прозрачны
	hide(['tmpl_commands','sel_modules']);// кнопки и модули скрыты
	makeSolid(['choice_init']); //непрозрачен
}
// макет готов к загрузке
function stateTemplateIsReady(){
	stateDefault();// блок с пиктограммами отображён
	showButtons();// кнопки отображены
}*/
// макет загружен
function stateTemplateIsLoaded(){
  try{
	// кнопки:
	setButtonStat(['btn_cancelTemplateChanges','btn_loadTemplate'],'passive'); // пассивна
	setButtonStat(['btn_changeTemplate'],'active'); // активна
	hide(['choice_init']); // отобразить блок первоначального выбора
	makeSolid(['tmplPlace','tmpl_commands','sel_modules']); // непрозрачный: блок макета, модули
  }catch(e){
	  alert(e.message);
  }	
}

///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////

// КОМАНДЫ:
// *** СКРЫТЬ *** 
function hide(objs_ids){
	for (i=0;i<objs_ids.length;i++)
		$('#'+objs_ids[i]).css('display','none');
}
// *** СДЕЛАТЬ ПОЛУПРОЗРАЧНЫМ ***
function makeLiquid(objs_ids,op,duration){
	if (!duration) var duration=150;
	if (!op) var op=0.2;
	for (i=0;i<objs_ids.length;i++)
		$('#'+objs_ids[i]).animate({opacity:op},duration);
}
// *** ОТОБРАЗИТЬ *** 
function display(objs_ids){
	for (i=0;i<objs_ids.length;i++)
		$('#'+objs_ids[i]).css('display','block');
}
// *** СДЕЛАТЬ НЕПРОЗРАЧНЫМИ ***
function makeSolid(objs_ids,duration){
	if (!duration) var duration=150;
	for (i=0;i<objs_ids.length;i++)
		$('#'+objs_ids[i]).animate({opacity:1},duration);
}
function setButtonStat(btns_ids,state){
	for (i=0;i<btns_ids.length;i++) {
		$('#'+btns_ids[i]).attr('class',state);
		if (state=='active') {
			$('#'+btns_ids[i]).attr('disabled',false);
		}else{
			$('#'+btns_ids[i]).attr('disabled',true);
		}
	}
}
<?	
$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
