<?	if (isset($dwshow)){?><script><? }
ob_start();?>
function clearDataToSendArray(){
	window.dataToSend=new Array();
//	dataToSend['schema']='';
//	dataToSend['blocks']='';
//	dataToSend['parent_section']='';
}
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
