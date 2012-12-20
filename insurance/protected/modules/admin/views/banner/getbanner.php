<?php $this->pageTitle = "Управление банерами"; ?>
<div class="mainmenu_button">

	<p>
<?php
	$this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'банерный блок 1',
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'small', // null, 'large', 'small' or 'mini'
	    'htmlOptions'=>array('class'=>'btn-menu','onclick'=>'_banner.MainMenuButton($(this))','data-item'=>'banner_out'),
));
	$this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'банерный блок 2',
			'type'=>'', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size'=>'small', // null, 'large', 'small' or 'mini'
			'htmlOptions'=>array('class'=>'btn-menu','onclick'=>'_banner.MainMenuButton($(this))','data-item'=>'banner_in'),
	));
	$this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'банерный блок 3',
			'type'=>'', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size'=>'small', // null, 'large', 'small' or 'mini'
			'htmlOptions'=>array('class'=>'btn-menu','onclick'=>'_banner.MainMenuButton($(this))','data-item'=>'banner_3'),
	));
	$this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'банерный блок 4',
			'type'=>'', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size'=>'small', // null, 'large', 'small' or 'mini'
			'htmlOptions'=>array('class'=>'btn-menu','onclick'=>'_banner.MainMenuButton($(this))','data-item'=>'banner_4'),
	));

?>
	</p>
</div>

<?php
/******************
	БАНЕРНЫЙ БЛОК 1
*******************/
?>

<div class="table_baner banner_out">
<br class="clear">
<div class="out_baner_img">
<?php
foreach ($out_query as $key=>$value){

	if($out_query[$key]['src']){
?>
	<img class="banner" id="banner_<?=$out_query[$key]['id']?>" alt="<?=$out_query[$key]['name']?>" src="<?=Yii::app()->homeUrl.$out_query[$key]['src']?>">
<?php
	}
}
?>
</div>

<?php
		$this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
	    'type'=>'striped bordered condensed',
	    'dataProvider'=>$out,
	    'template'=>"{items}{pager}",
		'enablePagination' => true,
		'afterAjaxUpdate'=>'function(id, data) {}',
		'beforeAjaxUpdate'=>'function(id, data) {}',
	    'columns'=>array(
	       array('name'=>'id', 'header'=>'#','type'=>'html'),
	        array('name'=>'name', 'header'=>'Наименование','type'=>'raw', 'value'=>'HelperAdmin::createInput($data->name,"name",$data->id,"_banner.update_field")'),
	        array('name'=>'src', 'type'=>'raw',  'header'=>'Изображение', 'value'=>'HelperAdmin::selectBanner($data->src,$data->id)'),
	        array('name'=>'link','type'=>'raw','header'=>'Ссылка', 'value'=>'HelperAdmin::createBannerlink($data->link,"name",$data->id)'),
	    	array('name'=>'date_edit', 'header'=>'Дата изменения'),
	    	array('name'=>'status','header'=>'Статус',
	    			'value'=>'$data->status==1?"Включен":"Отключен"')
	    ),
	)); ?>
	<?php
	if(isset($out->data) && count($out->data)>0){
		$this->widget('bootstrap.widgets.TbButton', array(
		    'label'=>$out->data[0]->status?'Отключить':'Включить',
		    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		    'size'=>'small', // null, 'large', 'small' or 'mini'
		    'htmlOptions'=>array(
		    		'onclick'=>'_banner.statusButton("outside",'.($out->data[0]->status?0:1).',"'.$out->keys[0].','.$out->keys[1].','.$out->keys[2].'")'
		    		)
	));
}
	$this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Добавить',
			'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size'=>'small', // null, 'large', 'small' or 'mini'
			'url'=>Yii::app()->homeUrl."admin/banner/addBaner/set/out",
			'htmlOptions'=>array(),
	));

?>
</div>
<?php
/******************
	БАНЕРНЫЙ БЛОК 2
*******************/
?>
<div class="table_baner banner_in" style="display: none;">
<br class="clear">
<div class="in_baner_img">
<?php

foreach ($in_query as $key=>$value){
	if($in_query[$key]['src']){
?>
	<img class="banner" id="banner_<?=$in_query[$key]['id']?>" alt="<?=$in_query[$key]['name']?>" src="<?=Yii::app()->homeUrl.$in_query[$key]['src']?>">
<?php
	}
}
?>
</div>
<?php $this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$in,
    'template'=>"{items}",
	'afterAjaxUpdate'=>'function(id, data) { }',
	'beforeAjaxUpdate'=>'function(id, data) {}',
    'columns'=>array(
       array('name'=>'id', 'header'=>'#','type'=>'html'),
        array('name'=>'name', 'header'=>'Наименование','type'=>'raw', 'value'=>'HelperAdmin::createInput($data->name,"name",$data->id,"banner.update_field")'),
        array('name'=>'src', 'type'=>'raw',  'header'=>'Изображение', 'value'=>'HelperAdmin::selectBanner($data->src,$data->id)'),
        array('name'=>'link','type'=>'raw','header'=>'Ссылка', 'value'=>'HelperAdmin::createBannerlink($data->link,"name",$data->id)'),
    	array('name'=>'date_edit', 'header'=>'Дата изменения'),
/*         array(
            'class'=>'application.extensions.bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ), */
    ),
)); ?>
</div>
<div class="table_baner banner_3" style="display: none;">
<br class="clear">
<div class="out_baner_img">
<?php
foreach ($ban3->data as $key=>$value){
	if($ban3->data[$key]['src']){
?>
	<img class="banner" id="banner_<?=$ban3->data[$key]['id']?>" alt="<?=$ban3->data[$key]['name']?>" src="<?=Yii::app()->homeUrl.$ban3->data[$key]['src']?>">
<?php
	}
}
?>
<?php
/******************
	БАНЕРНЫЙ БЛОК 3
*******************/
?>
</div>
<?php $this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$ban3,
    'template'=>"{items}{pager}",
	'enablePagination' => true,
	'afterAjaxUpdate'=>'function(id, data) { }',
	'beforeAjaxUpdate'=>'function(id, data) {}',
    'columns'=>array(
       array('name'=>'id', 'header'=>'#','type'=>'html'),
        array('name'=>'name', 'header'=>'Наименование','type'=>'raw', 'value'=>'HelperAdmin::createInput($data->name,"name",$data->id,"_banner.update_field")'),
        array('name'=>'src', 'type'=>'raw',  'header'=>'Изображение', 'value'=>'HelperAdmin::selectBanner($data->src,$data->id)'),
        array('name'=>'link','type'=>'raw','header'=>'Ссылка', 'value'=>'HelperAdmin::createBannerlink($data->link,"name",$data->id)'),
    	array('name'=>'date_edit', 'header'=>'Дата изменения'),
    	array('name'=>'status','header'=>'Статус',
    			'value'=>'$data->status==1?"Включен":"Отключен"')
    ),
)); ?>
<?php
if(isset($ban3->data) && count($ban3->data)>0){
	$this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>$ban3->data[0]->status?'Отключить':'Включить',
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'small', // null, 'large', 'small' or 'mini'
	    'htmlOptions'=>array(
	    		'onclick'=>'_banner.statusButton("ban3",'.($ban3->data[0]->status?0:1).',"'.$ban3->keys[0].','.$ban3->keys[1].','.$ban3->keys[2].'")'
	    		)
));
}
?>
</div>
<?php
/******************
	БАНЕРНЫЙ БЛОК 4
*******************/
?>
<div class="table_baner banner_4" style="display: none;">
<br class="clear">
<div class="in_baner_img">
<?php
foreach ($ban4->data as $key=>$value){
	if($ban4->data[$key]['src']){
?>
	<img class="banner" id="banner_<?=$ban4->data[$key]['id']?>" alt="<?=$ban4->data[$key]['name']?>" src="<?=Yii::app()->homeUrl.$ban4->data[$key]['src']?>">
<?php
	}
}
?>
</div>
<?php $this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$ban4,
    'template'=>"{items}",
	'afterAjaxUpdate'=>'function(id, data) {}',
	'beforeAjaxUpdate'=>'function(id, data) {}',
    'columns'=>array(
       array('name'=>'id', 'header'=>'#','type'=>'html'),
        array('name'=>'name', 'header'=>'Наименование','type'=>'raw', 'value'=>'HelperAdmin::createInput($data->name,"name",$data->id,"banner.update_field")'),
        array('name'=>'src', 'type'=>'raw',  'header'=>'Изображение', 'value'=>'HelperAdmin::selectBanner($data->src,$data->id)'),
        array('name'=>'link','type'=>'raw','header'=>'Ссылка', 'value'=>'HelperAdmin::createBannerlink($data->link,"name",$data->id)'),
    	array('name'=>'date_edit', 'header'=>'Дата изменения'),
		array('name'=>'status','header'=>'Статус',
    			'value'=>'$data->status==1?"Включен":"Отключен"')
    ),
)); ?>
<?php
if(isset($ban4->data) && count($ban4->data)>0){
	$this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>$ban4->data[0]->status?'Отключить':'Включить',
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'small', // null, 'large', 'small' or 'mini'
	    'htmlOptions'=>array(
	    		'onclick'=>'_banner.statusButton("ban4",'.($ban4->data[0]->status?0:1).',"'.$ban4->keys[0].'")'
	    		)
));
}
?>
</div>

<input type="hidden" name="dialog" value="" data-toggle="modal" data-target="#myModal" id="dialog"/>
<?php $this->beginWidget('application.extensions.bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Выберите раздел</h4>
</div>

<div class="modal-body" id="<?="save_tmpl_block"?>">
<div class="modal-section">
<?
// ПОЛУЧИМ ВСЕ РАЗДЕЛЫ САЙТА:
// Начиная с главных:
$allObjectsArray=Data::getObjectsRecursive();
// Те, у которых parent_id = -2:
$allObjectsSecondArray=Data::getObjectsRecursive(false,-2);


if (!isset($allObjectsArray)){ // ...
	$allObjectsArray=Data::getObjectsRecursive();
}
if (!isset($allObjectsSecondArray)){ // ...
	$allObjectsSecondArray=Data::getObjectsRecursive(false,-2);
}
$edit_mode=false;
//-------------------------
$section_name=false;
$section_parent_id=false;
$section_alias=false;
$section_title=false;
$section_keywords=false;
$section_description=false;

// если в режиме редактирования, получим данные макета:
if (isset($data)&&isset($modules)){
	$edit_mode=true;
	//var_dump("<h1>data:</h1><pre>",$data,"</pre>");
	//var_dump("<h1>model_modules:</h1><pre>",$model_modules,"</pre>");
	$section_name=$data['name'];
	$section_parent_id=$data['parent_id'];
	$section_alias=$data['alias'];
	$section_title=$data['title'];
	$section_keywords=$data['keywords'];
	$section_description=$data['description'];
}?>
   <div id="sections_radios" style="text-align:left">

	<?	HelperAdmin::makeSectionsMap($allObjectsArray,$section_parent_id);?>
    	<hr>
    	</div>
	</div>
</div>
<div class="modal-footer">
    <?php $this->widget('application.extensions.bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Сохранить',
        'url'=>'#',
    	'htmlOptions'=>array('data-dismiss'=>'modal',
    							'onclick'=>'_banner.update_field(
    													"link",
    													$("input[name=menu]:checked").val(),
    													$("input[name=menu]:checked").attr("data-banner"))'),
    )); ?>
    <?php $this->widget('application.extensions.bootstrap.widgets.TbButton', array(
        'label'=>'Отмена',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
<?php $this->endWidget(); ?>
<?php $cs = Yii::app()->getClientScript();
/* $cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.jeditable.mini.js'); */
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/admin/toogle-button.js');
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/toogle-button.css" />
<script type="text/javascript">
$(document).ready(function(){
		$('.toggle_off').toggles({on:false,dragable:false});
		$('.toggle').toggles({dragable:false});
		$('.toggle_off').bind('click',function(){
			id = $(this).parent().parent().attr('class');
			if($(this).children().hasClass('active')){
				val=1;
			}else{
				val=0;
			}
			console.info(val)
		})
		$('.toggle').bind('click',function(){
			id = $(this).parent().parent().attr('class');
			if($(this).children().hasClass('active')){
				val=1;
			}else{
				val=0;
			}

			//$.post('')
		})
})
</script>
