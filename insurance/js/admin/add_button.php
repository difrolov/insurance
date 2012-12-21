<?	$url=$_GET['base_url'];
if (isset($dwshow)){?><script><? }

ob_start();?>

$( function(){
	try{
		makeButtonInPlace( $("#main_submenu li").eq(1), // блок, содержащий элемент для приаттачивания кнопки. Далее будем выбирать в нём элемент для отсчёта позиций добавляемой кнопки
						   'li', // тег создаваемой кнопки
						   'main_submenu ul',  
						   0,
						   'active command',
						   '<a href="<? echo $url;?>/admin/generator" class="command"><span>&nbsp;&nbsp;&nbsp;&nbsp;</span> Добавить подраздел</a>',
						   '32'
						 );
		var elems,oldIE=false;
		if ($('table.tblMainMenu').eq(0).size()>0){
			elems=$('table.tblMainMenu').eq(0).find('td');
			oldIE=true;
			tag='div';
			menu_block='table.tblMainMenu td';
		}else{
			elems='div#mainmenu > ul li';
			tag='li';
			menu_block='mainmenu ul';
		}
		//
		makeButtonInPlace( $(elems).eq(0),
						   tag,
						   menu_block,
						   0,
						   'active command warning',
						   '<a href="<? echo $url;?>/admin/object/orphans" style="background-color:initial; color:white;">! Без родительских разделов</a>',
						   '32',
						   oldIE
						 );
			//console.info('elems: '+$(elems).eq(0).html());	
	}catch(e){
		alert(e.message);
	}
})
function makeButtonInPlace(sPlus,tag,menu_block,eqIndex,class_name,HTML,pTop,oldIE){
	var offLeft=$(sPlus).offset();
	// offLeft: желательно в дальнейшем:
	// 1. перерасчитать отступ слева в %%
	// 2. добавить вызов функции при изменении размеров окна, чтобы смещалось за основным меню.
	//var offRight=$(sPlus).offset().right;
	var goHeight=$(sPlus).css('line-height');
	var addSubsectionButton=document.createElement(tag);
	$(addSubsectionButton).html(HTML);
	addSubsectionButton.className=class_name;
	var posTop;
	if (oldIE){
		$(menu_block).eq(eqIndex).append(addSubsectionButton);
		posTop=140;
		offLeft.left+=1;
		// для тупого oldIE в Генераторе:
		$('a',addSubsectionButton).css('background-color','#F90');
	}else{
		$('#'+menu_block).eq(eqIndex).append(addSubsectionButton);
		posTop=pTop;
		if (oldIE===false)
			offLeft.left-=137;
	}
	$(addSubsectionButton).css({
		left: offLeft.left+'px',
		top: posTop+'px'
	});
}
<?
$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
