<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */
	$this->widget('application.extensions.email.components.debug');		
	Data::includeXtraCss();
	Data::includeXtraJS('validate_data.js');?>
<div id="inner_left_menu">
	<h2 class="txtLightBlue">Отправить заявку</h2>
    	<div class="blockMail" style="width:50%;">
    <?	echo CHtml::beginForm(Yii::app()->request->getBaseUrl(true).'/site/sendapplication','post',array('onsubmit'=>'return validateFields([\'name\',\'email\',\'phone\',\'message\']);'));?>
    	Ваше имя:
	<?	echo CHtml::textField('name','',array('onblur'=>'toggleFieldWarning(this.id);'));?>  
		Ваш email:
	<?	echo CHtml::textField('email','',array('onblur'=>'toggleFieldWarning(this.id);'));?> 
		Контактный телефон:
	<?	echo CHtml::textField('phone','',array('onblur'=>'toggleFieldWarning(this.id);'));?> 
		Текст вашей заявки:
	<?	echo CHtml::textArea('message','',array('rows'=>10,'onblur'=>'toggleFieldWarning(this.id);'));?>
    	<div class="row submit">
    <?php echo CHtml::submitButton('Отправить!'); ?>
    	</div>
    </div>
<? echo CHtml::endForm();?>
</div>
