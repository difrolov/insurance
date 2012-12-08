<h3>Новости<h3>
<br>
<?
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
        <?php echo $form->textFieldRow($model, 'baranch_name',array('style'=>'width:600px')); ?>
        <div class="control-group ">
			<label class="control-label required" for="InsurContacts_region">
				Регион
				<span class="required">*</span>
			</label>
			<div class="controls">
        	<?php $this->widget('CAutoComplete',
				    array(
				        'model'=>'InsurRegion',
				        'name'=>'name',
				        'url'=>array('Ajax/autocompleteRegion'),
				        'minChars'=>2,
				    	'htmlOptions'=>array('class'=>"ac_input", 'style'=>'width:600px')
				    )
				); ?>
			</div>
		</div>
        <?php echo $form->textFieldRow($model, 'address',array('style'=>'width:600px','onchange'=>"_contacts.address($(this).val())")); ?>
        <?php echo $form->textFieldRow($model, 'phone',array('style'=>'width:600px')); ?>
        <div style="font-size:14px;">
        	<?php echo $form->toggleButtonRow($model,'status'); ?>
        </div>
    </fieldset>
    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сохранить')); ?>
    </div>

<?php $this->endWidget(); ?>
<!-- script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=ru"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/assets/gmap3.min.js"></script-->
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/admin/contacts.js"></script>