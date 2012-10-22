<?
if (isset($dwshow)){?><script><? }
ob_start();?>
// JavaScript Document
// прописать количество блоков макета в тестовом блоке:
function test_addBlocks(){
	var dIndex;
	alert($('div#tmplPlace div > div').size());
	$('div#tmplPlace > div > div').each(
		function(){
			if ($(this).attr('data-block-type="header"'))
				dIndex='header';
			else {
				if ($(this).attr('data-block-type="footer"'))
					dIndex='footer';			
				else
					dIndex=$(this.parentNode).index(this);
			}
			alert('dIndex: '+dIndex);
			//$('#tmpl-blocks').append(dIndex);
		}
	);
}
// распарсить макет:
function test_checkModules(){
	// 
	var testTmplBlocks=$('#tmpl-blocks');
	//var tmplLocation=$('div#tmplPlace div:first-child');
	//$(tmplLocation).each( 
	// пройтись по колонкам макета
	//.each(
		// left2, right2
		var columnActive=$('div[data-column_stat="active"]');
		var columnActiveIndex=$(columnActive.parentNode).index(columnActive);
		$(testTmplBlocks)
			.append('<div>Модуль:<div>'+$('div#tmplPlace div:first-child > div[data-column_stat="active"] > div:last-child div[data-module-type]')
			.attr('data-module-type')+'</div></div>');
	//);
}
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
