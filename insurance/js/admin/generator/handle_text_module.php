<?
$base_url=$_GET['base_url'];
if (isset($dwshow)){?><script><? }
ob_start();?>
$(document).ready(function(){
  try{
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
function addArticleIdOrTextToModule(artID,text,header){
  try{ //alert('artID: '+artID+'\nBlock #: '+Layout.blocks.moduleClickedBlockNumber+'\nModule index in Block: '+Layout.blocks.moduleClickedLocalIndex);
	var ModuleIndex=Layout.blocks.moduleClickedLocalIndex;
	// распарсить блок, чтобы добраться до контента модулей, которые записаны в виде строки через разделитель "|" 
	var arrBlockContentArray=splitBlockContent(Layout.blocks.moduleClickedBlockNumber);
	// добавить служебный разделитель после "Текст" и идентификатор типа контента как id статьи, если получили artID:
	arrBlockContentArray[ModuleIndex]=getTextStart(artID);
	if (!artID) { // если ID статьи не передавали, стало быть, она новая; добавим её текст:
		arrBlockContentArray[ModuleIndex]+=header+'^'+text;
		
	}
	saveBlockContentString( Layout.blocks.moduleClickedBlockNumber, // # родительского блока ссылки добавления готовой статьи
							arrBlockContentArray // распарсенный и обработанный массив текстового блока
						  );
	addTextIntoEditor(''); // очистить поле редактора
	// закрыть таблицу с готовыми статьями и область предпросмотра статьи:
	hideArticlesStuff();
  }catch(e){
	  alert(e.message);
  }
}
// добавить текст полученной ajax'ом статьи в поле редактора
function addArticleTextToEditor(artBox,artID){
	//alert();
	if (artBox) { // получим html контейнера:
		//alert('artBox: '+artBox);	
		if(window.textTarget=='ready') // добавляли ID существующей статьи
			addArticleIdOrTextToModule(artID);	
		else // если уже размещали заголовок и текст статьи в области предпросмотра, выставим флаг:
			addTextIntoEditor('preview');
	}
	// загрузим статью ajax'ом, после чего добавим её в поле редактора:
	else if (artID) getArticleTextFromDB(false,artID);
	// закрыть окна предпросмотра текста и таблицы статей:
	hideArticlesStuff(true); // окно редактора оставляем открытым
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
// добавить текст в поле редактора
function addTextIntoEditor(content){
	var aHeader,aText;
	if (content=='preview'){ //
		aHeader=$('#prev_header').html();
		aText=$('#prev_content').html();
	}
	else{
		var splittedContent=splitArtContent(content);
		aHeader=splittedContent[0];
		aText=splittedContent[1];
	}
	$('input#article_header').val(aHeader);
	CKEDITOR.instances['InsurArticleContent[content]'].setData(aText);
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
				$('#tblArticles').parent('div').css('overflow-x','hidden');
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
			$('#tblArticles').css('width','auto').parent('div').css('overflow-x','hidden');
			$(aTable).css({
				display:'inline-block',
				bottom:'auto',
				left:$(this).offset().left+$(this).width()+'px',
				top: $(this).offset().top+20+'px'
			}).show()
			.appendTo('body')
			.resizable();
		}
	}).appendTo(content);
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
			if (fieldToPlace){
				var content=splitArtContent(msg);
				$('div#prev_header').html(content[0]);
				$('div#'+fieldToPlace).html(content[1]);
			}else{	
				addTextIntoEditor(msg);
			}
		}
	});
}
// получить № блока
function getBlockNumber(curColumn){
	return $('div#tmplPlace > div > div').index(curColumn)+1;
}
// забрать из поля редактора и разместить в блоке Layout'а и тестовом модуле
function getDataFromCKeditor(){
  try{
	var eText=CKEDITOR.instances['InsurArticleContent[content]'].getData();
	var eHeader=$('input#article_header').val();
	//alert(eText);
	// добавить к текстовому модулю текст статьи
	addArticleIdOrTextToModule(false,eText,eHeader);
  }catch(e){
	  alert(e.message);
  }
}
// вернуть путь отправки Ajax-запроса
function getLoadAjaxPath(){
	return "<?=$base_url?>/admin/ajax/makeartpreview";
}
// получить индекс модуля
function getModuleIndex(curColumn,curModule){
	return $(curColumn).children('div').index(curModule);
}
// получить начало текстового блока:
function getTextStart(artID){
	return "Текст"+setTextContentIdentifier(artID);
}
// спрятать окна предпросмотра, таблицы готовых статей и редактора
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
		$('div#doEdit').remove();
		$(aPrev).appendTo($('body'))
			.css({
				cursor:'move',
				display:'inline-block',
				left:pleft+25+'px',
				position:'fixed',
				top:ptop-88+'px',
				zIndex:3001
			}).draggable()
			.append('<div id="doEdit"><span class="wclose inside" onclick="parentNode.style.display=\'none\';" id="close_artprevwin"></span><div id="wrp"><div id="prev_header" title="Заголовок статьи"></div><div title="Текст статьи" id="prev_content"></div><div style="padding-right:8px;text-align:right;background:#EEE;padding:4px;"><button type="button" onClick="addArticleTextToEditor(\'prev_content\','+artID+');">Вставить</button></div></div></div>');
		getArticleTextFromDB('prev_content',artID);
	  }else{ // если БЕЗ предпросмотра, дважды клацали по названию статьи:
		addArticleTextToEditor(false,artID);// добавить текст непосредственно в окно редактора
	  }
	return false;
  }catch(e){
	  alert(e.message);
  }
}
// добавить в текстовый модуль идентификатор типа контента (id статьи/текст)
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
// разбить полученный контент статьи на заголовок и текст
function splitArtContent(content){
	return content.split("^");
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
