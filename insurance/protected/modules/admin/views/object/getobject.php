<br class="clear">
<? if ($gridDataProvider['parent']){?>
<div>Продукт</div>
<?php
	$this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
		'type'=>'striped bordered condensed',
		'dataProvider'=>$gridDataProvider['parent'],
		'template'=>"{items}",
		'columns'=>array(
		   array('name'=>'id', 'header'=>'#','type'=>'html', 'value'=>'HelperAdmin::createUrl($data->id,$data->id)'),
			array('name'=>'name', 'header'=>'Наименование','type'=>'html', 'value'=>'HelperAdmin::createUrl($data->id,$data->name)'),
			/* array('name'=>'status', 'header'=>'Видимость'), */
			array('name'=>'alias', 'header'=>'Алиас'),
			array('name'=>'date_changes', 'header'=>'Дата изменения'),
			array('name'=>'status','header'=>'Статус','type'=>'html',
					'value'=>'HelperAdmin::createStatusContent($data->status,$data->id)'),
			array(
				'class'=>'application.extensions.bootstrap.widgets.TbButtonColumn',
				'htmlOptions'=>array('style'=>'width: 50px'),
				'template'=>'{update}{delete}',
				'buttons'=>array(
						'update' => array(
								'url'=>'Yii::app()->controller->createUrl("/admin/generator/edit/$data->id")',
					),
				),
			),
		),
	)); ?>
	<br class="clear">

	<?php
	$this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Упорядочить разделы в меню',
			'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size'=>'small', // null, 'large', 'small' or 'mini'
			'url'=>Yii::app()->controller->createUrl("/admin/object/PriorityObject/".$_GET['id'])
	));
?>
<br class="clear">
<br class="clear">
<div>Подкатегории</div>
<?php
}else{?>
	<h4>Страницы без родительских разделов</h4>
<?
}
$this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$gridDataProvider['child'],
    'template'=>"{items}",
    'columns'=>array(
       array('name'=>'id', 'header'=>'#','type'=>'html', 'value'=>'HelperAdmin::createUrl($data->id,$data->id)'),
        array('name'=>'name', 'header'=>'Наименование','type'=>'html', 'value'=>'HelperAdmin::createUrl($data->id,$data->name)'),
        /* array('name'=>'status', 'header'=>'Видимость'), */
        array('name'=>'alias', 'header'=>'Алиас'),
    	array('name'=>'date_changes', 'header'=>'Дата изменения'),
    		array('name'=>'status','header'=>'Статус','type'=>'html',
        		'value'=>'HelperAdmin::createStatusContent($data->status,$data->id)'),
        array(
            'class'=>'application.extensions.bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        	'template'=>'{update}{delete}',
        	'buttons'=>array(
        			'update' => array(
        					'url'=>'Yii::app()->controller->createUrl("/admin/generator/edit/$data->id")',
        			),
        	),
        ),
    ),
)); ?>

<?php $cs = Yii::app()->getClientScript();
/* $cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.jeditable.mini.js'); */
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/admin/toogle-button.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/admin/object.js');
?>
<?php
if ($oldIE=setHTML::detectOldIE()||isset($_GET['iexp'])){?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/toogle-button_ie9.css" />
<?
}else{
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/toogle-button.css" />
<?php
}
?>

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
			_object.updateObjectStatus(id,val);
		});
		$('.toggle').bind('click',function(){
			id = $(this).parent().parent().attr('class');
			if($(this).children().hasClass('active')){
				val=1;
			}else{
				val=0;
			}
			_object.updateObjectStatus(id,val);

		});
})
</script>
