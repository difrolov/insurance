<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

	Data::includeXtraCss();
	Data::includeXtraJS('validate_data.js');?>
<div id="inner_left_menu">
	<h2 class="txtLightBlue">Задать вопрос</h2>
    	<div class="blockMail" style="width:50%;">
    <?	echo CHtml::beginForm(Yii::app()->request->getBaseUrl(true).'/site/sendquestion','post',array('onsubmit'=>'return validateFields([\'name\',\'email\',\'message\']);'));?>
    	Ваше имя:
	<?	echo CHtml::textField('name');?>  
		Ваш email:
	<?	echo CHtml::textField('email','',array('onblur'=>'toggleFieldWarning(this.id);'));?> 
		Ваш вопрос:
	<?	echo CHtml::textArea('message','',array('rows'=>10,'onblur'=>'toggleFieldWarning(this.id);'));?>
    	<div class="row submit">
    <?php echo CHtml::submitButton('Отправить!'); ?>
    	</div>
    </div>
<? echo CHtml::endForm();?>
</div>


