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
// прописать количество блоков макета в тестовом блоке:
function test_addBlocks(){
	$('#tmpl-blocks').html('&nbsp;');
	var b=false;
	// block - имя элемента
	// Layout.blocks[block] - значение элемента
	for(var block in Layout.blocks){
		if (Layout.blocks[block]=='header')
			b="Header";
		else
			b=(block=='footer')? "Footer":"Block "+block;
		if (b)
			$('#tmpl-blocks').append('<div data-test=""><dfn>'+b+'</dfn></div>');
	}
}
// добавить в тестовый блок в качестве иллюстрации:
function test_setModuleToTestBlock(cIndex,dataModuleType){
	var pBlock=$('#tmpl-blocks > div');
	$(pBlock[cIndex]).append('<div>'+dataModuleType+'</div>');
}
function test_setSubHeader(iValue){
	var h=$('div#tmpl-blocks dfn:contains("Header")')[0];
	$(h).after('<div><q>'+iValue+'</q></div>');
}
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
