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
function cancelLayoutChanges(btn){
  try{
	Layout.Schema=savedLayout.Schema; // возвернуть!
	 
	stateLayoutIsLoaded();
  }catch(e){
	  alert(e.message);
  }
}
// кнопка.click изменить макет
function changeLayout(btn){ 
  try{
	savedLayout={ // сохранить выбранную схему
		Schema:Layout.Schema
	}
	initialiteLayout(); // создать макет заново
	// кнопки:
	setButtonStat([btn.id],'passive'); // пассивна
	setButtonStat(['btn_cancelLayoutChanges'],'active'); // активна
	$('#choice_init').fadeIn(300);
	$('#tmplPlace').fadeTo(500,0.2);
	$('#sel_modules').fadeOut(450);
  }catch(e){
	  alert(e.message);
  }
}
// макет загружен
function stateLayoutIsLoaded(){ 
  try{
	$("#choice_init").fadeOut(200,
		function(){
			$("#tmpl_commands").fadeIn(500,
				function(){
					// кнопки:
					setButtonStat(['btn_cancelLayoutChanges','btn_loadLayout'],'passive'); // пассивна
					setButtonStat(['btn_changeLayout'],'active'); // активна
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
