<div class="form">
<?php	$form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>false,
	'focus'=>array($model,'login'),
	'clientOptions'=>array('validateOnSubmit'=>true),
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="row">
<?php echo $form->label($model,'login'); ?>
<?php echo $form->textField($model,'login') ?>
<?php echo $form->error($model,'login'); ?>
</div>

<div class="row">
<?php echo $form->label($model,'password'); ?>
<?php echo $form->passwordField($model,'password') ?>
<?php echo $form->error($model,'password'); ?>
</div>

<div class="row rememberMe">
<?php echo $form->checkBox($model,'rememberMe'); ?>
<?php echo $form->label($model,'rememberMe'); ?>
</div>

<div class="row submit">
<?php echo CHtml::submitButton('Войти'); ?>
</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
