<?
if (isset($dwshow)){?><script><? }
ob_start();?>
$(document).ready(	function(e) {
	testCount=0;
	var tInfoBlock=$('div[data-test="template"]');
	var aManage=$('#test_block_appearance');
	//$(tInfoBlock).mousedown().resizable();
	//.draggable()
    $(aManage).click( function(){
		if ($(this).text()=='свернуть') {
			$(tInfoBlock).animate({
				height:'68px'
			},500,function(){$(aManage).text('развернуть')});
		}
		else{
			$(tInfoBlock).animate({
				height:'100%'
			},500,function(){$(aManage).text('свернуть')});
		}
	});
});
// распарсить и отобразить объект макета:
function test_parseLayout(obj){
	testCount++;
	document.title='tCnt: '+testCount+', aId: '+Layout.blocks.activeBlockIdentifier;
	if (!obj){ 
		if (obj===false){
			// alert('parsed activeBlockIdentifier START: '+Layout.blocks.activeBlockIdentifier);
		}
		obj=Layout;
	}
	// obj 		- объект
	// ob		- свойство объекта
	// currentObj[ob] 	- значение свойства (литерал) объекта
	var toPlace=document.getElementById('obj_place');
	toPlace.innerHTML='';
	for(var ob in obj){
		var currentObj=obj[ob];
		if (typeof(currentObj)=='object'){
			toPlace.innerHTML+='<div>Блок '+ob+':</div>';
			test_parseLayout(currentObj);
		}else{ 
			var pContent='<div>';
			pContent+='		<div class="padding10 borderRadius marginBottom4">Блок ['+ob+']:';
			pContent+='			<div class="padding10 borderRadius bgLightGrey">';
			if (ob.indexOf('moduleClicked')==-1){ 
				var arrObj;
				
				if (ob!="Schema") alert('Тип элемента: '+typeof(currentObj)+'\nLayouts.blocks['+ob+'] = '+currentObj);
				
				if ( typeof currentObj == 'string'
					 && currentObj.indexOf("|")!=-1
				   )
					var	arrObj=currentObj.split("|");
				
				else arrObj=new Array(currentObj);
				
				for(i=0;i<arrObj.length;i++)
					pContent+='			<div>arrObj['+i+'] = '+arrObj[i]+'</div>';
			
			}else{
				pContent+='			<div style="background:#CEEFFF; padding:10px; margin:-10px;">Layouts.blocks['+ob+'] = '+currentObj+'</div>';
			}
			pContent+='			</div>';
			pContent+='		</div>';
			pContent+='</div>';
			toPlace.innerHTML+=pContent;
		}
	} //alert('parsed activeBlockIdentifier FINISH: '+Layout.blocks.activeBlockIdentifier);	
}
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
