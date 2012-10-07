<form name="content_edit" method="post" action="<?php echo Yii::app()->createUrl('admin/object/edit/'.$id_content) ?>">
<?php
$this->widget('application.extensions.TheCKEditor.theCKEditorWidget',array(
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
			array( 'Image', 'Link', 'Unlink', 'Anchor' ),
					array('name'=> 'document',    'items'=> array( 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' )),
					array('name'=> 'clipboard',   'items'=> array( 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' )),
					array('name'=> 'editing',     'items'=> array( 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' )),
					array('name'=> 'forms',       'items'=> array( 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' )),

					array('name'=> 'basicstyles', 'items'=> array( 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' )),
					array('name'=> 'paragraph',   'items'=> array( 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' )),
					array('name'=> 'links',       'items'=> array( 'Link','Unlink','Anchor' )),
					array('name'=> 'insert',      'items'=> array( 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' )),

					array('name'=> 'styles',      'items'=> array( 'Styles','Format','Font','FontSize' )),
					array('name'=> 'colors',      'items'=> array( 'TextColor','BGColor' )),
					array('name'=> 'tools',       'items'=> array( 'Maximize', 'ShowBlocks','-','About' ))
			),
			'filebrowserBrowseUrl'=>CHtml::normalizeUrl(array('default/browser')),
	),



) ); ?>

</form>