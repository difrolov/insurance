<h3>Вакансии<h3>
<br>
<?php /** @var BootActiveForm $form */
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
        <?php echo $form->textFieldRow($model, 'jobs_name',array('style'=>'width:600px')); ?>
        <?php echo $form->html5EditorRow($model, 'requirements', array('class'=>'span8', 'rows'=>5,'height'=>'200', 'options'=>array('color'=>true))); ?>
        <?php echo $form->html5EditorRow($model, 'responsibility', array('class'=>'span8', 'rows'=>5,'height'=>'200', 'options'=>array('color'=>true))); ?>
        <?php echo $form->html5EditorRow($model, 'terms', array('class'=>'span8', 'rows'=>5,'height'=>'200', 'options'=>array('color'=>true))); ?>
        <?php echo $form->html5EditorRow($model, 'job', array('class'=>'span8', 'rows'=>5,'height'=>'200', 'options'=>array('color'=>true))); ?>
        <?php echo $form->html5EditorRow($model, 'contact_name', array('class'=>'span8', 'rows'=>5,'height'=>'200', 'options'=>array('color'=>true))); ?>
        <div style="font-size:14px;">
        	<?php echo $form->toggleButtonRow($model,'status'); ?>
        </div>
    </fieldset>
    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сохранить')); ?>
    </div>

<?php $this->endWidget(); ?>