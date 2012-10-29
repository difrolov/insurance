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
// прописать тип модуля в качестве иллюстрации:
function test_addModuleToTestBlock(cIndex,dataModuleType){
	var pBlock=$('#tmpl-blocks > div');
	$(pBlock[cIndex]).append('<div>'+dataModuleType+'</div>');
}
// добавить текст подзаголовка
function test_setSubHeader(iValue){
	var h=$('div#tmpl-blocks dfn:contains("Header")')[0];
	$(h).after('<div><q>'+iValue+'</q></div>');
}
// распарсить Layout и прописать в тестовый блок
function test_parseLayout(){
	$('#tmpl-blocks').html('&nbsp;'); // инициализировать контент тестового блока
	// block - имя элемента
	// Layout.blocks[block] - значение элемента
	var bn=0; // номера блоков
	var bIndex; // модифицированный индекс блока, может быть как числом, так и "footer"
	var postText; // текст новой статьи или id существующей
	var tPostFix; // постфикс идентификатора типа текста (обычный текст/id статьи) в текстовом модуле. Нужен, чтобы установить параметры (старт, длина) извлечения контента
	for(var block in Layout.blocks){
		bn++;
		var modContent=false;
		if (Layout.blocks[block]=='header'){
			b="Header";
			// проверить, есть ли у подзаголовка текст
			if(Layout.blocks[2].substr(0,7).indexOf('header:')!=-1){
				modsContent='<div>'+Layout.blocks[2].substr(7)+'</div>';
			}
		}else{
			if(block=='footer'){ 
				b="Footer";
				bIndex="footer";
			}else{
				b="Block "+block;
				bIndex=bn;
			}
			// распарсить блок
			// преобразовать в массив:
			var tBlock=splitBlockContent(bIndex);
			// получить текущий контент блока и разместить в тестовом модуле:
			for (i=0;i<tBlock.length;i++){
				// если текстовый блок:
				if ( tBlock[i].substr(0,5).indexOf("Текст")!=-1
					 && tBlock[i].length > 5 // есть или текст, или id статьи
				   ){
					// получить предустановленную подстроку-индикатор типа контента как article id:
					tPostFix=setTextContentIdentifier(true);
					// если блок реально содержит подстроку "article id":
					if (tBlock[i].indexOf(tPostFix)!=-1)
						// извлечь id статьи:
						postText="статья id: ";
					else{ // подстрока "article id" не найдена:
						// получить постфикс для идентификатора добавленного текста: 
						tPostFix=setTextContentIdentifier();
						postText="";
					}
					postText+=tBlock[i].substr(5+tPostFix.length);
					// собрать весь контент текстового модуля:
					tBlock[i]="Текст:<div>"+postText+"</div>";
				}
				modsContent+='<div>'+tBlock[i]+'</div>'; // название модуля + его контент (если модуль текстовый и содержит текст или id статьи)
			}
		}
		if (b) {
			$('#tmpl-blocks').append('<div data-test=""><dfn>'+b+'</dfn></div>');
			if (modContent) // если у модуля есть контент, дописываем и его:
				$('#tmpl-blocks').append(modsContent);
		}
	}	
}
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
