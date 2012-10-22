<?
if (isset($dwshow)){?><script><? }
ob_start();?>
// JavaScript Document
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
