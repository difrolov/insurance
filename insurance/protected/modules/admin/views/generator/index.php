<?
//
if(!isset($exclusiveView)) 
	$exclusiveView=false;
if ($exclusiveView)
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
<?	if(!$exclusiveView){?>
<br><br>
	<table id="new_art_header" cellspacing="0">
<?	$show_header=false;
	if($show_header){?>
      <tr>
        <td nowrap>Заголовок статьи: </td>
        <td width="100%"><input placeholder="Укажите заголовок статьи" name="article_header" id="article_header" type="text"></td>
      </tr>
<?	}?>
    </table>
<?php	// editor tool:
	$this->widget('application.extensions.TheCKEditor.TheCKEditorWidget',
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
)); 
	}?>
<? require_once $includes.'save_tmpl_block.php';?>
</form>
<? 	if(isset($data)){?>
<div id="preText" style="display:none;"><?
		if($arrContent=unserialize($data['content'])){
		$art_content=$arrContent['blocks'][1][0];
			if (strstr($art_content,"Текст :: article id: ")) {
				$block=explode("article id: ",$art_content);
				//echo "<hr>count: ".count($block);
				// var_dump("<h1>block:</h1><pre>",$block,"</pre>");die();
				if (count($block)){
					$article_text=str_replace("\n","",$this->getArticleContent(array_pop($block))); // otherwise FireFox go crazy....
					echo $article_text;
				}
			}else echo "&nbsp;";
		}else echo "&nbsp;";?></div>
<?	}
	if (!$exclusiveView){?>
<script>
Layout=new Object();
Layout.Schema="default";
	<?	if (isset($data)) {?>
$( function(){
	try{
		var artText=$('#preText').text();
		CKEDITOR.instances['InsurArticleContent[content]'].setData(artText);		
	}catch(e){
		alert(e.message);
	}
});
	<?	}?>
</script>    
<?	}
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
if(!$exclusiveView){
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
	if(!$exclusiveView)
		require_once $includes.'editor.php';
}
?>