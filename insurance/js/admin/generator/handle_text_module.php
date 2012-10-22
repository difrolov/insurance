<?
if (isset($dwshow)){?><script><? }
ob_start();?>
$(document).ready(function(){
  try{
<?	if (isset($_GET['test'])){?>
	$('div[data-test="template"]').mousedown().draggable().resizable().museup().draggable(false);
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
  }catch(e){
	alert(e.message);
  }
});
//
function addTextModuleComLinks(content){
	var aTable=$('div#upload_article_window'); // контейнер таблицы со статьями
	var aTableBar=$('table#tblArticles tbody tr:first-child');
	$('<a>',{
			text:"выберите из имеющихся статей",
			title:"Выбрать из имеющихся статей",
			click:	function(){
				
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
function submit_editor_form(){
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
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
