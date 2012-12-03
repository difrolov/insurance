<?php $this->beginWidget('application.extensions.bootstrap.widgets.TbModal',
			array('id'=>'myModal',
					'options'=>array(
							'width'=>'800px',
							'fade'=>false,
							))); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
</div>
<div class="modal-body">
<form name="content_edit" method="post" action="<?php echo Yii::app()->createUrl('admin/object/edit/') ?>">
	<table id="new_art_header" cellspacing="0">
      <tr>
        <td nowrap>Заголовок статьи: </td>
        <td width="100%"><input placeholder="Укажите заголовок статьи" name="article_header" id="article_header" type="text"></td>
      </tr>
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
    </div>
	<div style="position:absolute; left:10px; top:5px;"><a class="link" id="upload_article" href="#" title="Выбрать из имеющихся статей">Загрузить статью...</a></div>
<input type="submit" name="submit" onclick="getDataFromCKeditor();return false;" value="Сохранить">
</div>
</form>
</div>
<?php $this->endWidget();?>
