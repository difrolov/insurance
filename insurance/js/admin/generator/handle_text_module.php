﻿<?
$base_url=$_GET['base_url'];
if (isset($dwshow)){?><script><? }
ob_start();?>
$(document).ready(function(){
  try{
<?	if (isset($_GET['test'])){?>
	$('div[data-test="template"]')
		.mousedown()
		.draggable()
		.resizable();
<?	}?>
	$('td[data-article-id]').mouseover( function(){
		this.title="Щёлкните дважды, чтобы добавить текст статьи";
	});
	$('#upload_article').click( function(){
		showArticlesTable(this);
	});

	// загрузить текст статьи в редактор, либо указать её id в случае, если хотим оставить её без изменений
	$('td[data-article-id]').dblclick(function(e) {
		// textTarget:
		// ready - намеревались вставить существующую статью;
		// editor - произвольный текст через редактор (даже если добавляли туда уже существующую)
		var article_id=$(this).attr('data-article-id');
		if (window.textTarget=='ready'){ // будем добавлять id статьи в объект Layout
			// добавить id статьи в Layout и тестовый блок:
			addArticleIdOrTextToModule(article_id);
		}else if (window.textTarget=='editor'){ // будем добавлять ТЕКСТ статьи в модуль
			// получить текст статьи (ajax), загрузить в модуль и Layout:
			manageArticleText(article_id);
		}
		//alert('textTarget: '+window.textTarget);
    });
  }catch(e){
	alert(e.message);
  }
});
// модифицировать текстовый модуль - добавить либо id, либо текст статьи
function addArticleIdOrTextToModule(artID,text){
  try{ //alert('artID: '+artID+'\nBlock #: '+Layout.blocks.moduleClickedBlockNumber+'\nModule index in Block: '+Layout.blocks.moduleClickedLocalIndex);
	var ModuleIndex=Layout.blocks.moduleClickedLocalIndex;
	// распарсить блок, чтобы добраться до контента модулей, которые записаны в виде строки через разделитель "|" 
	var arrBlockContentArray=splitBlockContent(Layout.blocks.moduleClickedBlockNumber);
	// добавить служебный разделитель после "Текст" и идентификатор типа контента как id статьи, если получили artID:
	arrBlockContentArray[ModuleIndex]="Текст"+setTextContentIdentifier(artID);
	if (!artID) // если ID статьи не передавали, стало быть, она новая; добавим её текст:
		arrBlockContentArray[ModuleIndex]+=text;
	saveBlockContentString( Layout.blocks.moduleClickedBlockNumber, // # родительского блока ссылки добавления готовой статьи
							arrBlockContentArray // распарсенный и обработанный массив текстового блока
						  );
	// закрыть таблицу с готовыми статьями и область предпросмотра статьи:
	hideArticlesStuff();
  }catch(e){
	  alert(e.message);
  }
}
// добавить текст полученной ajax'ом статьи в поле редактора:
function addArticleTextToEditor(artBox,artID){
	//alert();
	// получили либо html, либо содержащий его контейнер
	if (artBox) {
		htmlContent=$('#'+artBox).html();
		CKEDITOR.instances['InsurArticleContent[content]'].setData(htmlContent);
	}
	else if (artID) getArticleTextFromDB(false,artID);
	//htmlContent=getArticleTextFromDB(artID);
	// закрыть окна предпросмотра текста и таблицы статей:
	hideArticlesStuff(true); // окно редактора оставляем открытым
}
// добавить ссылки (команды) добавления текста (собственно текст или id статьи)
function addTextModuleComLinks(content){
	$(content).append(': ');
	var aTable=$('div#upload_article_window'); // контейнер таблицы со статьями
	// command 1: add text through editor
	$('<a>',{
		text:"добавьте произвольное содержание",
		title:"Добавить произвольный текст",
		href:"#",
		click: function(){
				window.textTarget='editor';
				identifyTextBlock(this);
				$(aTable).appendTo($('a#upload_article').parent())
				.css({
					maxHeight:'500px',
					// отсчитывается от родительского блока ссылки:
					top:'initial',
					left:'2px', 
					bottom:'36px'
				});
			},
	}).attr({
		'data-toggle':'modal',
		'data-target':'#myModal'
	}).appendTo(content);

	$(content).append(' или ');

	// command 1: add text as an existing article (editing is disabled)
	$('<a>',{
		text:"выберите из имеющихся статей",
		title:"Выбрать из имеющихся статей",
		click:	function(){
			window.textTarget='ready';
			identifyTextBlock(this);			
			$('#tblArticles').css('width','auto');
			$(aTable).css({
				display:'inline-block',
				left:$(this).offset().left+$(this).width()+'px',
				top: $(this).offset().top+20+'px'
			}).show()
			.appendTo('body')
			.resizable();
		}
	}).appendTo(content);
}
// загрузить статью в область редактора - с предпросмотром или без
// ТОЛЬКО В РЕДАКТОРЕ!
function manageArticleText( artID,
							eSrc // только, если клацали по кнопке в области предпросмотра
						  ){
  try{
	// POST
	  if (eSrc)	{ // если с предпросмотром, клацали по кнопке в его окне		
		var aPrev=$('div#article_preview_text');
		//alert(msg);
		var pTD=$(eSrc).parent();
		var pleft=$(pTD).offset().left;
		var ptop=$(pTD).offset().top;
		$(aPrev).appendTo($('body'))
			.css({
				cursor:'move',
				display:'inline-block',
				left:pleft+25+'px',
				position:'fixed',
				top:ptop-88+'px',
				zIndex:3001
			}).draggable()
			.append('<span class="wclose inside" onclick="parentNode.style.display=\'none\';" id="close_artprevwin"></span><div id="wrp"><div id="prev_content"></div><div style="padding-right:8px;text-align:right;background:#EEE;padding:4px;"><button type="button" onClick="addArticleTextToEditor(\'prev_content\','+artID+');">Вставить</button></div></div>');
		getArticleTextFromDB('prev_content',artID);
	  }else{ // если БЕЗ предпросмотра, дважды клацали по названию статьи:
		addArticleTextToEditor(false,artID);// добавить текст непосредственно в окно редактора
	  }
	return false;
  }catch(e){
	  alert(e.message);
  }
}
// добавить либо текст, либо ID статьи
function addArtText( artBox, // id поля с текстом предпросматриваемой статьи
					 artID // id предпросматриваемой статьи
				   ){ //alert(window.textTarget);
	// распарсить блок с модулем, распарсить модуль и модифицировать значение текстового блока
	if(window.textTarget=='ready'){ // добавляли ID существующей статьи
		addArticleIdOrTextToModule(artID);	
	}else if(window.textTarget=='editor'){
		addArticleTextToEditor(artBox);
	} //alert(document.getElementById('myModal').style.display);
}
// получить текст статьи из БД ajax'ом
function getArticleTextFromDB(fieldToPlace,artID){
	// POST
	var goUrl=getLoadAjaxPath();
	var uData="article_id="+artID+"&do=preview";
<?	$t=false;
	if ($t){?>
	window.open(goUrl+'/?'+uData,'ajax');
<?	}?>
	$(fieldToPlace).val('...получение текста статьи...');
	var amessage=false
	$.ajax({
		type:"POST",
		url:goUrl,
		data:uData,
		success: function(msg){
			if (fieldToPlace)
				$('div#'+fieldToPlace).html(msg);
			else
				CKEDITOR.instances['InsurArticleContent[content]'].setData(msg);
		}
	});
}
//
function getDataFromCKeditor(){
  try{
	var eText=CKEDITOR.instances['InsurArticleContent[content]'].getData();
	//alert(eText);
	// добавить к текстовому модулю текст статьи
	addArticleIdOrTextToModule(false,eText);
  }catch(e){
	  alert(e.message);
  }
}
// вернуть путь отправки Ajax-запроса
function getLoadAjaxPath(){
	return "<?=$base_url?>/admin/ajax/makeartpreview";
}
// спрятать окна предпросмотра, таблицы готовых статей и редактора:
function hideArticlesStuff(keep_editor_open){
	$('div#upload_article_window').hide(); // art table
	$('div#article_preview_text').hide();
	if (!keep_editor_open) $('a.close[data-dismiss="modal"]').trigger('click');
}
// идентифицировать текстовый модуль
// идентифицировать колонку, чтобы найти сначала блок, а затем модуль для добавления текста или id статьи
function identifyTextBlock(obj){
	storeLayoutBlockData(obj.parentNode.parentNode);
}
// получить № блока
function getBlockNumber(curColumn){
	return $('div#tmplPlace > div > div').index(curColumn)+1;
}
// получить индекс модуля
function getModuleIndex(curColumn,curModule){
	return $(curColumn).children('div').index(curModule);
}
// добавить в текстовый модуль идентификатор типа контента (id статьи/текст):
function setTextContentIdentifier(artID){
	var ctype=" :: ";
	if (artID) ctype+="article id: "+artID;
	return ctype;
}
// отобразить таблицу выбора статей
function showArticlesTable(){
	$('div#upload_article_window').css({
			display:'inline-block',
		}).fadeIn(150);
}
// сохранить в Layout номер блока и индекс модуля
function storeLayoutBlockData(curModule){
	var curColumn=curModule.parentNode;	// колонка
	Layout.blocks.moduleClickedBlockNumber=getBlockNumber(curColumn); // № блока
	Layout.blocks.moduleClickedLocalIndex=getModuleIndex(curColumn,curModule); // индекс модуля
}
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>