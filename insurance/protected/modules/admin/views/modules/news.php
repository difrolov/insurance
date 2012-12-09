<h3>Новости<h3>
<br>
<?
/** @var BootActiveForm $form */
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'verticalForm',
		'htmlOptions'=>array('class'=>'well'),
		'type'=>'horizontal',
		'enableClientValidation'=>true,
			'clientOptions'=>array(
					'validateOnSubmit'=>true,
					'validateOnChange'=>true,
		)
	)); ?>
    <fieldset>
        <?php echo $form->textFieldRow($model, 'name',array('style'=>'width:600px')); ?>
        <?php echo $form->textFieldRow($model, 'img',array('style'=>'width:600px','data-toggle'=>"modal", 'data-target'=>"#myModal",'onclick'=>'CKEDITOR.tools.callFunction(84, this); return false;')); ?>
        <?php echo $form->html5EditorRow($model, 'content',array('class'=>'span4', 'rows'=>5)); ?>
        <div style="font-size:14px;">
        	<?php echo $form->toggleButtonRow($model,'status'); ?>
        </div>
    </fieldset>
    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сохранить')); ?>
    </div>

<?php $this->endWidget(); ?>

<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/admin/contacts.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/ckeditor/ckeditor.js"></script>

<?php $this->beginWidget('application.extensions.bootstrap.widgets.TbModal',
			array('id'=>'myModal',
					'options'=>array(
							'width'=>'800px',
							'fade'=>false,
							))); ?>
<div class="modal-header">
    Выберите картинку из папки news
    <a class="close" data-dismiss="modal">&times;</a>
</div>
<div class="modal-body">
	<?php echo HelperAdmin::imgNews() ?>
</div>
<?php $this->endWidget();?>
