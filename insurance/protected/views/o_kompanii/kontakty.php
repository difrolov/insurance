<style>
a.txtLightBlue{
	font-size:14.5px;
}
div.jDef{
	padding-top:0 !important;
	padding-left:0 !important;
}
dl{
	display:<?="none"?>;
}
dl *{
	font-size:13.5px;
}
dt {
	margin-top:22px;
}
dd{
	margin-left:15px;
}
dl p{
	margin:0;
	line-height:20px;
}
</style>
<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

/* $this->pageTitle=Yii::app()->name . ' - Контакты';

$this->breadcrumbs=array(
    'О компании'=>array('index'),
    'Контакты'
); */

//google maps
Yii::import('application.extensions.gmap3.*');

?>

<h1>Контакты</h1>
<?	//var_dump("<h1>this:</h1><pre>",$this,"</pre>");?>

<?php
$gridDataProvider = action::getContacts('status=1');
$arrContacts = $gridDataProvider->data;
$contr = new Controller('O_кompanii');
$contr->widget('CAutoComplete',
		array(
				'model'=>'InsurRegion',
				'name'=>'name',
				'url'=>array('admin/Ajax/autocompleteRegion'),
				'minChars'=>2,
				'htmlOptions'=>array('onchange'=>'$("."+$(this).val()).show()')
		)
);
for ($i=0,$j=count($arrContacts);$i<$j;$i++){
	$cont=$arrContacts[$i];
	$gmap = new EGmap3Widget();
	$options = array(
			'scaleControl' => true,
			'streetViewControl' => false,
			'zoom' => 1,
			'center' => array(0,0),
			'mapTypeId' => EGmap3MapTypeId::HYBRID,
			'mapTypeControlOptions' => array(
					'style' => EGmap3MapTypeControlStyle::DROPDOWN_MENU,
					'position' => EGmap3ControlPosition::TOP_CENTER,
			),
			'zoomControlOptions' => array(
					'style' => EGmap3ZoomControlStyle::SMALL,
					'position' => EGmap3ControlPosition::BOTTOM_CENTER
			),
	);
	$gmap->setOptions($options);
	$address = new InsurContacts();

	// init the map
	$gmap = new EGmap3Widget();
	$gmap->setOptions(array('zoom' => 14));

	// create the marker
	$marker = new EGmap3Marker(array(
			'title' => 'Draggable address marker',
			'draggable' => true,
	));
	$marker->address = $cont['region']." ".$cont['address'];
	$marker->centerOnMap();
// 	$marker->capturePosition(
// 	// the model object
// 			$address,
// 			// model's latitude property name
// 			'latitude',
// 			// model's longitude property name
// 			'longitude',
// 			// Options set :
// 	//   show the fields, defaults to hidden fields
// 	//   update the fields during the marker drag event
// 			array('visible','drag')
// 	);
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
?><div class="<?=$cont['region']?>" style="display:none">><?php
	$gmap->renderMap();
	?>
  <a name="job<?=$i?>"></a>
  <div class="jDef">
    	<?=$cont['baranch_name']?>
	  <dl>
        <dt>Адрес:</dt>
            <dd><?=$cont['region']." ".$cont['address']?></dd>

        <dt>Телефон:</dt>
            <dd><?=$cont['phone']?></dd>


      </dl>
  </div>
  </div>
<?
}?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=ru"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/assets/gmap3.min.js"></script>
