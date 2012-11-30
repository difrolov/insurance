<form name="content_edit" method="post" action="<?php echo Yii::app()->createUrl('admin/content/edit/'.$id_content) ?>">
<div class="modal-header">
    <label>Наименование статьи</label>
    <input type="text" name="name_content" value="<?=$model[0]->name?>">
</div>
<?php
$this->widget('application.extensions.TheCKEditor.theCKEditorWidget',array(
	'id'=> 'editor',
    'model'=>$model[0],                # Data-Model (form model)
    'attribute'=>'content',         # Attribute in the Data-Model
    'height'=>'400px',
    'width'=>'100%',
    'toolbarSet'=>'Basic',          # EXISTING(!) Toolbar (see: ckeditor.js)
    'ckeditor'=>Yii::app()->basePath.'/../ckeditor/ckeditor.php',
                                    # Path to ckeditor.php
    'ckBasePath'=>Yii::app()->baseUrl.'/ckeditor/',
                                    # Relative Path to the Editor (from Web-Root)
    'css' => Yii::app()->baseUrl.'/css/index.css',
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
<div style="display: none">

</div>
<input type="submit" name="submit" onclick="" value="Сохранить">
</form>
