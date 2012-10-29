<?
if (isset($dwshow)){?><script><? }
ob_start();?>
$(document).ready(	function(e) {
	var tInfoBlock=$('div[data-test="template"]');
	var aManage=$('#test_block_appearance');
    $(aManage).click( function(){
		if ($(this).text()=='свернуть') {
			$(tInfoBlock).animate({
				height:'40px'
			},500,function(){$(aManage).text('развернуть')});
		}
		else{
			$(tInfoBlock).animate({
				height:'400px'
			},500,function(){$(aManage).text('свернуть')});
		}
	});
});
// распарсить и отобразить объект макета:
function test_parseLayout(obj,ins){
	if (!obj) obj=Layout;
	// block - имя элемента
	// Layout.blocks[block] - значение элемента
	// obj 		- объект
	// ob		- свойство объекта
	// obj[ob] 	- значение свойства (литерал) объекта
	var toPlace=document.getElementById('obj_place');
	toPlace.innerHTML='';
	for(var ob in obj){
		var currentObj=obj[ob];
		if (typeof(currentObj)=='object'){
			toPlace.innerHTML+='<div>Блок '+ob+':</div>';
				test_parseLayout(currentObj,true);
			//toPlace.innerHTML+='</div>';
		}else{ 
			var nclass=ins? 'rd2':'rd';
			var pContent='<div>';
			pContent+='		<div class="padding10 borderRadius marginBottom4">Блок '+ob+':';
			pContent+='			<div class="padding10 borderRadius bgLightGrey">';
			var arrObj=currentObj.split("|");
			for(i=0;i<arrObj.length;i++)
				pContent+='			<div>'+arrObj[i]+'</div>';
			pContent+='			</div>';
			pContent+='		</div>';
			pContent+='</div>';
			toPlace.innerHTML+=pContent;
		}
	}	
}
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
