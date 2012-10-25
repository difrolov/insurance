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
//
function saveSubHeader(iValue){
	//alert(iValue);
	var subHeaderContent='<div>Текст подзаголовка:<br>'+iValue+'</div>';
	$('div[data-test="template"] div#tmpl-blocks div:contains("Block header")')
		.append(subHeaderContent);
	dataToSend['blocks']['subheader']=iValue;
}
// прописать количество блоков макета в тестовом блоке:
function test_addBlocks(){
	var dIndex;
	var blockNumber=0;
	$('div#tmplPlace > div > div').each(
		function(){
			blockNumber++;
			if ($(this).attr('data-block-type')=="header")
				dIndex='header';
			else {
				if ($(this).attr('data-block-type')=="footer")
					dIndex='footer';			
				else
					dIndex=blockNumber;
			}
			$('#tmpl-blocks').append('<div>Block '+dIndex+'</div>');
			dataToSend['blocks'][dIndex]='';
		}
	);
}
// распарсить макет:
function test_checkModules(){
	// 
	var testTmplBlocks=$('#tmpl-blocks > div');
	var columns=$('div#tmplPlace > div:first-child > div');
	var i=0;
	var wrp=$(columns).each(
		function() {
			if ($(this).attr('data-column_stat')=="active"){
				var modTypeData=$(this)
					.children('div')
					.last('div')
					.children('div[data-module-type]:first')
					.attr('data-module-type');
				var tHTML=$(testTmplBlocks[i]).html()+'<div>'+modTypeData+'</div>';
				dataToSend['blocks'][i]=modTypeData;
				$(testTmplBlocks[i]).html(tHTML);
				return false;
			}
		i++;
	});
}
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
