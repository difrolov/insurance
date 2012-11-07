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
			addArticleIdOrTextToModule(article_id,false,$(this).text());
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
  try{ 	//alert('artID: '+artID+'\nBlock #: '+Layout.blocks.moduleClickedBlockNumber+'\nModule index in Block: '+Layout.blocks.moduleClickedLocalIndex);
	var ModuleIndex=Layout.blocks.moduleClickedLocalIndex;
	// распарсить блок, чтобы добраться до контента модулей, которые записаны в виде строки через разделитель "|" 
	var arrBlockContentArray=splitBlockContent(Layout.blocks.moduleClickedBlockNumber);
	arrBlockContentArray[ModuleIndex]=getTextStart(artID);
	// получить целевую колонку:
	var tBlock=$('div#tmplPlace div[data-block-type]')[Layout.blocks.moduleClickedBlockNumber-1];
	// получить модуль:
	var txtModule=$(tBlock).children('div.innerModule')[Layout.blocks.moduleClickedLocalIndex];
	// получить ВНУТРЕННИЙ блок модуля с текстом:
	var txtModuleInner=$(txtModule).children('div[data-module-type="Текст"]');
	var bg,preHeader,headerClicked;
	if (!artID) { // если ID статьи не передавали, стало быть, она новая; добавим её текст:
		arrBlockContentArray[ModuleIndex]+=header+'^'+text;
		preHeader='Новая статья';
		bg='yellow';
	}else{
		preHeader='Статья id '+artID;
		bg='greenYellow';
	}
	$(txtModule).css({
		backgroundColor:bg,
		border:'none'
	});
	var artHeader=''; //alert(63);
	if (!header){
		if (!(artHeader=$('div#prev_header').text())){
			alert('Заголовок не найден...');
		}else
			headerClicked='get';
	}else{
		artHeader=header;
		headerClicked=true;
		// спрятать блок с кнопкой "Вставить", т.к. вставлять ничего не надо. 
		// Не нравится добавленный текст? - удаляйте модуль и добавляйте новый!
		$('div#btn_wrapper').hide();
	}
	//alert('artHeader = '+artHeader+'\nheader = '+header);
	$(txtModuleInner).html(preHeader+':&nbsp;');
	$('<a>',{
		href:"#", // передаётся в качестве аргумента "this" в manageArticleText();
		click: function(){
			// alert('onClick:\nartID: '+artID+'\nthis: '+this+'\nheaderClicked: '+headerClicked);
			manageArticleText(artID,this,headerClicked);
			storeLayoutBlockData(this);
			getTextModuleContentParsedFromLayout(); // извлечь заголовок и текст модуля из Layout и разместить их в области предпросмотра
			return false;
		}
	}).text(artHeader)
	.attr('data-link-type','show')
	.appendTo($(txtModuleInner));
	// изменить содержание текстового модуля в колонке:
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
	}else{
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
	var aTable=getPreviewWindow(); // контейнер таблицы со статьями
	// command 1: add text through editor
	$('<a>',{
		text:"добавьте произвольное содержание",
		title:"Добавить произвольный текст",
		href:"#",
		click: function(){
			showEditor(this);
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
			storeLayoutBlockData(this);
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
// создать окно предпросмотра
function createPreviewWindow( artID,
							  art_header_clicked // get - при клике по заголовку текстового
							){	
	var prevArea='	<div id="doEdit">';
	prevArea+='		<span class="wclose inside" onclick="parentNode.style.display=\'none\';" id="close_artprevwin"></span>';
	prevArea+='		<div id="wrp">';
	prevArea+='			<div id="prev_header" title="Заголовок статьи"></div>';
	prevArea+='			<div title="Текст статьи" id="prev_content"></div>';
	prevArea+='			<div id="btn_wrapper">';
	if (!art_header_clicked)
		prevArea+='				<button id="btn_add_prev_content" type="button" onClick="addArticleTextToEditor(\'prev_content\','+artID+');">Вставить</button>';
	prevArea+='			</div>';
	prevArea+='		</div>';
	prevArea+='	</div>';
	return prevArea;
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
// получить окно предпросмотра текста
function getPreviewWindow(){
	return $('div#upload_article_window');
}
// получить начало текстового блока:
function getTextStart(artID){
	var ret="Текст";
	// если метод вызывали НЕ при пересортировке модулей:
	if (artID!==null)
		ret+=setTextContentIdentifier(artID);
	return ret;
}
// получить и распарсить на заголовок и текст контент текстового модуля ИЗ БЛОКА
// к этому моменту должна быть выполнена функция storeLayoutBlockData(src); src - ссылка-источник события. Элементы определяются по её parentNode.parentNode
function getTextModuleContentParsedFromLayout(){
	// получить контент заголовка и текста:
	var blockModules=splitBlockContent(Layout.blocks.moduleClickedBlockNumber);
	var mText=blockModules[Layout.blocks.moduleClickedLocalIndex]; // заголовок и текст модуля
	var mtSeparator=mText.indexOf("^"); // разделитель заголовка и текста
	$('#prev_header').html(mText.substring(getTextStart().length,mtSeparator));
	$('#prev_content').html(mText.substr(mtSeparator+1));
	return true;
}
// спрятать окна предпросмотра, таблицы готовых статей и редактора
function hideArticlesStuff(keep_editor_open){
	$('div#upload_article_window').hide(); // art table
	$('div#article_preview_text').hide();
	if (!keep_editor_open) 
		$('a.close[data-dismiss="modal"]').trigger('click');
}
// загрузить статью в область редактора - с предпросмотром или без
// ТОЛЬКО В РЕДАКТОРЕ!
function manageArticleText( artID,
							eSrc, // только, если клацали по кнопке в области предпросмотра или по ссылке в текстовом модуле
							art_header_clicked // если клацали по заголовку добавленной статьи:
							// true для новой статьи, get - для существующей
						  ){	
  try{
	// POST
	  if (eSrc)	{ // если с предпросмотром, клацали по кнопке в его окне		
		var aPrev=$('div#article_preview_text'); // alert('aPrev 1: '+$(aPrev).html());
		var pTD=(art_header_clicked)? $(eSrc):$(eSrc).parent();
		var pleft=$(pTD).offset().left;
		var ptop=$(pTD).offset().top;
		if (art_header_clicked!==true) { //alert(art_header_clicked);
			getArticleTextFromDB('prev_content',artID);
			$('div#doEdit').remove();
			//
			$(aPrev).appendTo($('body'));
			$(aPrev).append( 
						createPreviewWindow( artID,
											 art_header_clicked // get - при клике по заголовку текстового блока с добавленным id готовой статьи
										   ));
		}else
			showPreviewToEdit(eSrc);
		//alert('artID: '+artID+', eSrc: '+eSrc+', art_header_clicked: '+art_header_clicked);
		$(aPrev).css({
					cursor:'move',
					display:'inline-block',
					left:pleft+25+'px',
					position:'fixed',
					top:ptop-88+'px',
					zIndex:3001
				}).draggable();
		
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
// загрузить редактор
function showEditor(src){ //alert('showEditor');
	window.textTarget='editor';
	storeLayoutBlockData(src);
	$('#tblArticles').parent('div').css('overflow-x','hidden');
	$(getPreviewWindow()).appendTo($('a#upload_article').parent())
	.css({
		maxHeight:'500px',
		// отсчитывается от родительского блока ссылки:
		top:'initial',
		left:'2px', 
		bottom:'36px'
	});
}
// снова показать окно предпросмотра с возможностью редактирования ранее добавленного текста
// вызывается кликом по заголовку текстового блока
function showPreviewToEdit(eSrc){ //alert('showPreviewToEdit');
	$('#btn_add_prev_content').remove();
	var editButton=$('<button>',{
		type:'button',
		id:'btn_edit_text',
		'data-toggle':'modal', 
		'data-target':'#myModal',
		click:function(){
			$('div#doEdit').hide();
			showEditor(eSrc);
			addTextIntoEditor('preview');
		}
	}).text('Редактировать');
	$('div#doEdit').removeAttr('style');
	$('#btn_wrapper').css({
		backgroundColor:'#EEE',
		display:'block',
		textAlign:'right'
	}).html(editButton);
}
// разбить полученный контент статьи на заголовок и текст
function splitArtContent(content){
	return content.split("^");
}
// сохранить в Layout номер блока и индекс модуля
function storeLayoutBlockData(obj){
	var curModule=obj.parentNode.parentNode;
	var curColumn=curModule.parentNode;	// колонка
	Layout.blocks.moduleClickedBlockNumber=getBlockNumber(curColumn); // № блока
	Layout.blocks.moduleClickedLocalIndex=getModuleIndex(curColumn,curModule); // индекс модуля
	//alert(Layout.blocks.moduleClickedBlockNumber+', '+Layout.blocks.moduleClickedLocalIndex);
}
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
