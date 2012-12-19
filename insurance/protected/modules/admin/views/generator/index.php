<?
//
if(!isset($inExViews)) 
	$inExViews=false;
if ($inExViews)
	$go_action='editView';
else
	$go_action=(isset($data))? "update":"save"; 

$groot=$this->groot; // директория Генератора
$includes=$groot.'includes/'; // директория подключаемых файлов
$primitive=true; 
if(setHTML::detectOldIE()||$primitive){?>
<link href="<?=Yii::app()->request->getBaseUrl(true)?>/css/admin/ie.css" type="text/css">
<form style="margin:0;" name="content_save" id="content_save" method="post" action="
<?=Yii::app()->createUrl('admin/generator/'.$go_action)?>">
<br><br>
	<table id="new_art_header" cellspacing="0">
      <!--<tr>
        <td nowrap>Заголовок статьи: </td>
        <td width="100%"><input placeholder="Укажите заголовок статьи" name="article_header" id="article_header" type="text"></td>
      </tr>-->
    </table>
<?php	$this->widget('application.extensions.TheCKEditor.TheCKEditorWidget',
  array(
    # Data-Model (form model):
	'model'=>$art_model, // а патамушта основная модель-то должна быть - InsurInsuranceObject, дурилка! (и именно она сначала извлекается в GeneratorController). А иначе будет абсолютно нелогично и чревато проблемами при извлечении данных самого объекта            
	
    'attribute'=>'content',         # Attribute in the Data-Model
    'height'=>'240px',
    'width'=>'100%',
    'toolbarSet'=>'Basic',          # EXISTING(!) Toolbar (see: ckeditor.js)
    'ckeditor'=>Yii::app()->basePath.'/../ckeditor/ckeditor.php',
                                    # Path to ckeditor.php
    'ckBasePath'=>Yii::app()->baseUrl.'/ckeditor/',
                                    # Relative Path to the Editor (from Web-Root)
    /* 'css' => Yii::app()->baseUrl.'/css/index.css', */
                                    # Additional Parameters
	'config' =>

			array('toolbar'=>array(

				array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
				array('name'=> 'paragraph',
					  'items'=>
					  		array( 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' )),
				array('name'=> 'editing',
					  'items'=>
					  		array( 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' )),
				array('name'=> 'styles',
				  	  'items'=>
							array( 'Styles','Format','Font','FontSize' )),
							array('Image', 'Link', 'Unlink', 'Anchor' ),
							array('name'=> 'colors',
								  'items'=>
									array( 'TextColor','BGColor' )),
									array('name'=> 'tools',
										  'items'=>
												array( 'Maximize', 'ShowBlocks','-','About' ))
			),
			'filebrowserBrowseUrl'=>CHtml::normalizeUrl(array('default/browser')),

	),
) ); ?>
<div style="position:relative;" data-target="load_in_editor">
    <div id="upload_article_window">
    	<span class="wclose" id="close_upartwin"></span>
    	<div style="overflow:auto; height:100%;">
  <?	$articles=HelperAdmin::getAllArticlesList(false); ?>
    <table width="100%" cellspacing="0" cellpadding="0" id="tblArticles">
      <tr bgcolor="#CCCCCC" class="bold">
        <td>id</td>
        <td>Название</td>
        <td>&nbsp;</td>
        <td>Статус</td>
      </tr>
<?	for($i=0,$j=count($articles);$i<$j;$i++){?>
      <tr>
        <td><?=($i+1)?></td>
        <td nowrap data-article-id="<?=$articles[$i]['id']?>"><?=$articles[$i]['name']?></td>
        <td><a class="view" rel="tooltip" href="#" onClick="return manageArticleText(<?=$articles[$i]['id']?>,this);" data-original-title="Предпросмотр статьи"><i class="icon-eye-open"></i></a></td>
        <td><?=$articles[$i]['status']?></td>
      </tr>
<?	}?>
    </table>
  	  </div>
    </div><?
/*
	<div style="position:absolute; left:10px; top:5px;"><a class="link" id="upload_article" href="#" title="Выбрать из имеющихся статей">Загрузить статью...</a></div>
<input type="submit" name="submit" onclick="getDataFromCKeditor();return false;" value="Сохранить">*/
	
	require_once $includes.'save_tmpl_block.php';
		
		?>
</div>
</form>
<? 	if(isset($data)){?>
<div id="preText" style="display:none;"><?
	if($arrContent=unserialize($data['content'])){
	//var_dump("<h1>arrContent:</h1><pre>",$arrContent,"</pre>");die();
	$block=explode("article id: ",$arrContent['blocks'][1][0]);
	echo $this->getArticleContent(array_pop($block));
}else echo "&nbsp;";?></div>
<?	}?>
<script>
Layout=new Object();
Layout.Schema="default";
<?
	if (isset($data)) {?>
CKEDITOR.instances['InsurArticleContent[content]'].setData(document.getElementById('preText').innerText);		
<?	}?>
</script>    
<?
}else{
	if (isset($data)) // подключить скрипт с js-обработкой существущего макета:
	require_once Yii::getPathOfAlias('webroot')."/js/admin/generator/edit_template.php";

?>
<DIV align="left" id="testBlockInfoBottom" class="testBlock pFixed" style="right:0; bottom:0; color:#F00; display:<?="none"?>;">&nbsp;</DIV>
<? // var_dump("<h1>data:</h1><pre>",$data,"</pre>"); die();
// вывести блок контроля Layout в тестовом режиме:
require_once $includes.'test_control.php';
//$this->breadcrumbs=array($this->module->id,);?>
<div id="article_preview_text">
</div>
<div align="left">
<form style="margin:0;" name="content_save" id="content_save" method="post" action="
<?=Yii::app()->createUrl('admin/generator/'.$go_action)?>">
<?	 	
if(!$inExViews){
	// подключить опции начального выбора макета:
	require_once $includes.'choice_init.php';?>
	<? // подключить кнопки управления макетом:
	require_once $includes.'tmpl_commands.php';?>
	<? // подключить текущие модули:
	require_once $includes.'sel_modules.php';?>
    <!--	БЛОК ДИНАМИЧЕСКОЙ ГЕНЕРАЦИИ МАКЕТА	-->
    <div id="<?="tmplPlace"?>">
        <div id="<?="tmplInner"?>"></div>
    </div>
<? 
	}
	// подключить опции метаописания, выбора родительского раздела, заголовка, названия страницы и алиаса:
	require_once $includes.'save_tmpl_block.php';?>  	
</form>    
</div>
<? 
	// подключить WYSWYG-редактор и его опции:
	if(!$inExViews)
		require_once $includes.'editor.php';
}
?>