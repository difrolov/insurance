<?	if (isset($dwshow)){?><script><? }
ob_start();?>
$(document).ready(	function() {
    $('.wclose').click(
		function(){
			$(this.parentNode).hide(150);
		}
	);
});
//
function cancelTemplateChanges(btn){
  try{
	tmplSchema=tmplSchemaSaved; // возвернуть!
	stateTemplateIsLoaded();
  }catch(e){
	  alert(e.message);
  }
}
// кнопка.click изменить макет
function changeTemplate(btn){ 
  try{
	tmplSchemaSaved=tmplSchema; // сохранить выбранную схему
	// кнопки:
	setButtonStat([btn.id],'passive'); // пассивна
	setButtonStat(['btn_cancelTemplateChanges'],'active'); // активна
	$('#choice_init').fadeIn(300);
	$('#tmplPlace').fadeTo(500,0.2);
	$('#sel_modules').fadeOut(450);
  }catch(e){
	  alert(e.message);
  }
}
// макет загружен
function stateTemplateIsLoaded(){ 
  try{
	$("#choice_init").fadeOut(200,
		function(){
			$("#tmpl_commands").fadeIn(500,
				function(){
					// кнопки:
					setButtonStat(['btn_cancelTemplateChanges','btn_loadTemplate'],'passive'); // пассивна
					setButtonStat(['btn_changeTemplate'],'active'); // активна
					$("#sel_modules").fadeIn(450,
						function(){
							$("#tmplPlace").fadeTo(300,1);
					});
			});
		});
  }catch(e){
	  alert(e.message);
  }	
}
// управление кнопками
function setButtonStat(btns_ids,state){ 
	for (i=0;i<btns_ids.length;i++) {
		if (state=='active'){
			$('#'+btns_ids[i]).fadeTo(300,1,
				function(){
					$(this).attr({
						class: 'active',
						disabled: false
					});
			});
		}else{
			$('#'+btns_ids[i]).fadeTo(300,0.4,
				function(){
					$(this).attr({
						class: 'passive',
						disabled: true
					});
			});
		}
	}
}
<?	
$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
