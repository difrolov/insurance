<style>

.ac_results {
	padding: 0px;
	border: 1px solid WindowFrame;
	background-color: Window;
	overflow: hidden;
}

.ac_results ul {
	width: 100%;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
}

.ac_results iframe {
	display:none;/*sorry for IE5*/
	display/**/:block;/*sorry for IE5*/
	position:absolute;
	top:0;
	left:0;
	z-index:-1;
	filter:mask();
	width:3000px;
	height:3000px;
}

.ac_results li {
	position:relative;
    margin: 0px;
	padding: 2px 5px;
	cursor: pointer;
	display: block;
	width: 100%;
	font: menu;
	font-size: 12px;
	overflow: hidden;
}

.ac_loading {
	background : Window url('autocomplete_indicator.gif') right center no-repeat;
}

.ac_over {
	background-color: Highlight;
	color: HighlightText;
}
.dropDown {
  position:absolute;
  top:10px;
  left:10px;
  width:150px;
  font-family: "Trebuchet MS", Tahoma, Verdana, Arial, Helvetica, sans-serif;
  font-size: 10pt;
}
.dropDown {
  position:absolute;
  top:10px;
  left:170px;
  width:240px;
  font-family: "Trebuchet MS", Tahoma, Verdana, Arial, Helvetica, sans-serif;
  font-size: 10pt;
}
.qnt {
  position:absolute;
  top:2px;
  right:10px;
  font-size:0.8em;
  color:#26A908;
}
</style>
<h2 class="txtLightBlue">Контакты</h2>
<?php
/* $this->pageTitle=Yii::app()->name . ' - Контакты';

$this->breadcrumbs=array(
    'О компании'=>array('index'),
    'Контакты'
); */

//google maps
Yii::import('application.extensions.gmap3.*');
/* @var $form CActiveForm */
$gridDataProvider = action::getContacts('status=1');
$arrContacts = $gridDataProvider->data;
$contr = new Controller('O_кompanii');
?>
Выберите регион &nbsp
<input id="region" type="text"  style="width:400px"/><img id="all_regions" style="height:20px;position: absolute;" src="<?=Yii::app()->homeUrl?>images/select_btn.png" alt="все регионы">
<br>

<?php
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
?>
<br>
<br>
<br>
<div data-region="<?=$cont['region']?>" style="visibility:hidden;position:absolute">
<?php
	$gmap->renderMap();
	?>
</div>
<div data-region="<?=$cont['region']?>" style="display:none;">
  <a name="job<?=$i?>" href="#" onclick="return false;" class="txtLightBlue"><?=$cont['baranch_name']?></a>
  <div class="jDef">
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
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/jquery.autocomplete.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#region").autocomplete(baseUrl+"/Ajax/autocompleteRegion", {
	  delay:10,
		minChars:2,
		matchSubset:1,
		autoFill:true,
		matchContains:1,
		cacheLength:10,
		selectFirst:true,

		maxItemsToShow:10,
  });
  $("#all_regions").click(function(){
		$.post(baseUrl+"/Ajax/autocompleteRegion",{data:'all'},function(data){
			str="";
			str+="<ul>";
			if(data){
				for(i in data){
					str+="<li onclick='$(\"#region\").val($(this).text());$(\".ac_results\").hide();show_map($(this).text())'>"+data[i]+"</li>";
				}
			}
			str+="</ul>";
			$(".ac_results").html(str);
			$(".ac_results").css({position: 'absolute',
								width: '400px',
								top: '294px',
								left: '596px',
								display:'block',
								overflow: 'scroll',
								height:'400px'});
		},"json");
	});
});


function selectItem(li) {
	if( li == null ) sValue = "Ничего не выбрано!";
	if( !!li.extra ) sValue = li.extra[2];
	else sValue = li.selectValue;
	show_map(sValue);

}
function show_map(val){
	$("div[data-region='"+val+"']").attr('style','visibility:visible');
}

</script>


