<h3>Вакансии<h3>
<br>
<?
/* $address = new InsurContacts();

// init the map
$gmap = new EGmap3Widget();
$gmap->setOptions(array('zoom' => 14));

// create the marker
	$marker = new EGmap3Marker(array(
			'title' => 'Draggable address marker',
			'draggable' => true,
	));
	$marker->address = 'россия москва тверская 1';
	$marker->centerOnMap();
	$marker->capturePosition(
	// the model object
			$address,
			// model's latitude property name
			'latitude',
			// model's longitude property name
			'longitude',
			// Options set :
	//   show the fields, defaults to hidden fields
	//   update the fields during the marker drag event
			array('visible','drag')
	);
	$gmap->add($marker);

	// Capture the map's zoom level, by default generates a hidden field
	// for passing the value through POST
	$gmap->map->captureZoom(
	// model object
			$address,
			// model attribute
			'mapZoomLevel',
			// whether to auto generate the field
			true,
			// HTML options to pass to the field
			array('class' => 'myCustomClass')
	);

	$gmap->renderMap(); */ ?>
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