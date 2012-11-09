<?	if (isset($dwshow)){?><script><? }
ob_start();?>
$(function(){
	$('button#save_page').click( function (){
		alert('*Проверить радиокнопки\n*Забрать данные из и Layout отослать на ACTION формы с JSON!');
		return false;
	});
});
/*function clearDataToSendArray(){
//	window.dataToSend=new Array();
//	dataToSend['schema']='';
//	dataToSend['blocks']='';
//	dataToSend['parent_section']='';
}*/
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
