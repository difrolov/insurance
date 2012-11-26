<div>Статьи</div>
<br class="clear">
<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>"Добавить статью",
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'small', // null, 'large', 'small' or 'mini'
	    'htmlOptions'=>array(
	    		'data-toggle'=>"modal",
	    		'data-target'=>"#myModal"
	    		),
)); ?>
<br class="clear">
<?php
if (isset($gridDataProvider)){
 $this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$gridDataProvider,
    'template'=>"{items}{pager}",
 	'filter'=>$model,
    'columns'=>array(
       	array('name'=>'id', 'header'=>'#'),
        array('name'=>'name', 'header'=>'Наименование'),
        array('name'=>'status','header'=>'Статус','type'=>'html',
        		'value'=>'HelperAdmin::createStatusContent($data->status,$data->id)'),
    	/*array('name'=>'status', 'header'=>'Видимость'), */

        array(
            'class'=>'application.extensions.bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        	'template'=>'{update}{delete}',
        	'buttons'=>array(
        				'update' => array(
        						'url'=>'Yii::app()->createUrl("admin/content/edit", array("id"=>$data[\'id\']))',
        				),

        		),
        ),
    ),
));
} ?>
<br class="clear">


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

<form name="content_edit" method="post" action="<?php echo Yii::app()->createUrl('admin/object/setcontent/') ?>">
<div class="modal-header">
    <label>Наименование статьи</label>
    <input type="text" name="name_content">
</div>

    <?php
$this->widget('application.extensions.TheCKEditor.TheCKEditorWidget',
			  array(
    'model'=>$model,                # Data-Model (form model)
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

<input type="hidden" name="object_id" value="<?php echo @$_GET['id']; ?> ">
<div class="modal-footer">
<input type="submit" name="submit" onclick="" value="Сохранить">
</div>
</form>
</div>
<?php $this->endWidget(); ?>