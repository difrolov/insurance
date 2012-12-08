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
        <?php echo $form->textFieldRow($model, 'img',array('style'=>'width:600px','onclick'=>'CKEDITOR.tools.callFunction(84, this); return false;')); ?>
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