<?
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
	$('#upload_article').click( function(){
	$('div#upload_article_window')
		.appendTo($('div[data-target="load_in_editor"]'))
		.css({
			display:'block',
			height:'248px',
			left:'10px',
			top:'-262px',
			width:'93%'
		})
		.fadeIn(150);
	});
	$('td[data-article-id]').mouseover( function(){
		this.title="Щёлкните дважды, чтобы добавить текст статьи";
	});
	// загрузить текст статьи в редактор, либо указать её id в случае, если хотим оставить её без изменений
	$('td[data-article-id]').dblclick(function(e) {
		// textTarget:
		// ready - намеревались вставить существующую статью;
		// editor - произвольный текст через редактор (даже если добавляли туда уже существующую)
		if (window.textTarget=='ready'){ // будем добавлять id статьи в объект Layout
			// получить идентификатор модуля-источника события:


		}else if (window.textTarget=='editor'){ // будем добавлять ТЕКСТ статьи в поле редактора



		}
		alert('textTarget: '+window.textTarget);
    });
  }catch(e){
	alert(e.message);
  }
});
//
function addArticle(artID){
  try{ //alert('addTextContent');
	articlePreview(artID);
  }catch(e){
	  alert(e.message);
  }
}
//
function addTextModuleComLinks(content){
	$(content).append(': ');
	// command 1: add text through editor
	$('<a>',{
		text:"добавьте произвольное содержание",
		title:"Добавить произвольный текст",
		href:"#",
		click: function(){
				window.textTarget='editor';
				// identifyTextBlock(this);
			},
	}).attr({
		'data-toggle':'modal',
		'data-target':'#myModal'
	}).appendTo(content);

	$(content).append(' или ');

	var aTable=$('div#upload_article_window'); // контейнер таблицы со статьями
	var aTableBar=$('table#tblArticles tbody tr:first-child');
	// command 1: add text as an existing article (editing is disabled)
	$('<a>',{
		text:"выберите из имеющихся статей",
		title:"Выбрать из имеющихся статей",
		click:	function(){
			window.textTarget='ready';
			identifyTextBlock(this);
			
			$('#tblArticles').css('width','auto');
			var aParent=this.parentNode.parentNode.parentNode; // контейнер макета

			$(aTable).css({
				display:'inline-block',
				width:'auto'
			});

			var pDivTop=$(aParent).offset().top;

			$(aTable)
				.show()
				.appendTo('body');
			var tWidth=$(aTable).width();
			var pLeft=($(document).width()-tWidth)/2;
			$(aTable).css({
				top: pDivTop+10+'px',
				left: pLeft+5+'px',
				bottom:'0'
			}).resizable();
			/*$(aTableBar)
				.mouseover()
				.css('cursor','move')
				.mousedown(
					function(){
						$(aTable).draggable();
				});*/
		}
	}).appendTo(content);
	$(aTableBar).mouseout();
}
//
function articlePreview(artID,eSrc){
  try{
	//alert(artID+' '+eSrc.tagName);
	// POST
	var goUrl=getLoadAjaxPath(artID);
<?	$t=false;
	if ($t){?>
	window.open(goUrl,'ajax');
<?	}?>
	jQuery.ajax({
		type: "POST",
		url: goUrl,
		success: function(msg){
		  if (eSrc)	{ // если с предпросмотром
			var aPrev=$('div#article_preview_text');
			//alert(msg);
			var pleft=$(eSrc).offset().left;
			var ptop=$(eSrc).offset().top;
			$(aPrev).css({
				cursor:'move',
				display:'inline-block',
				left:pleft+16+'px',
				top:ptop+16+'px',
				zIndex:2000
			}).draggable();
			$(aPrev).html('<span class="wclose inside" onclick="parentNode.style.display=\'none\';" id="close_artprevwin"></span><div id="wrp"><div id="prev_content">'+msg+'</div><div style="padding-right:8px;text-align:right;background:#EEE;padding:4px;"><button type="button" onClick="addArtText(\'prev_content\');">Вставить</button></div></div>');
		  }else{ // если без предпросмотра - сразу вставляем текст в поле редактора
			  addArtText('html',msg);
		  }
		}
	 });
	return false;
  }catch(e){
	  alert(e.message);
  }
}
//
function addArtText(artBox,htmlContent){
	// получили либо html, либо содержащий его контейнер
	if (!htmlContent) htmlContent=$('#'+artBox).html();

	//$('#'+artBox).html()
	if(textTarget=='ready'){



	}else if(textTarget=='editor'){
		/*// вставить текст в поле редактора
		var goUrl=getLoadAjaxPath(artID);
	<?	$t=false;
		if ($t){?>
		window.open(goUrl,'ajax');
	<?	}?>
		jQuery.ajax({
			type: "GET",
			url: goUrl,
			success: function(msg){*/
			// закрыть окна предпросмотра текста и таблицы статей:
		CKEDITOR.instances['InsurArticleContent[content]'].setData(htmlContent);
		$('div#upload_article_window').hide(); // art table
		$('div#article_preview_text').hide();
		//});
	}
	//alert(document.getElementById('myModal').style.display);
}
//
function getDataFromCKeditor(){
  try{
	var eText=CKEDITOR.instances['InsurArticleContent[content]'].getData();
	alert(eText);
	/*$("button#saveModuleText").click( function(){
		alert('THE TEXT IS: eText');
	});*/
  }catch(e){
	  alert();
  }
}
// вернуть путь отправки Ajax-запроса
function getLoadAjaxPath(artID){
	return "<?=$base_url?>/admin/ajax/makeartpreview?article_id="+artID+"&do=preview"
}
// идентифицировать текстовый модуль
// идентифицировать колонку, чтобы найти сначала блок, а затем модуль для добавления текста или id статьи
function identifyTextBlock(obj){
	var curModule=obj.parentNode.parentNode; // модуль
	var curColumn=curModule.parentNode;	// колонка
	Layout.blocks.moduleClickedBlockIndex=$('div#tmplPlace > div > div').index(curColumn)+1; // № блока
	Layout.blocks.moduleClickedLocalIndex=$(curColumn).children('div').index(curModule); // индекс модуля
	Layout.blocks.moduleClickedLocalIndex=$(curColumn).index($(obj.parentNode.parentNode));
	alert('moduleClickedBlockIndex: '+moduleClickedBlockIndex+'\nmoduleClickedLocalIndex: '+moduleClickedLocalIndex);
  }catch(e){
	  alert(e.message);
  }
}
//
function PickOutTextContent(obj){
  try{
	alert($(obj).html());
	//var aTable=$('div#upload_article_window');
	//$(aTable).show();
	//$(obj.parentNode.parentNode).append(aTable);
  }catch(e){
	alert(e.message);
  }
}

<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
