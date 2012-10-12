<?php $this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$gridDataProvider,
    'template'=>"{items}",
	'afterAjaxUpdate'=>'function(id, data) { alert(id);setInlineEdit(); }',
	'beforeAjaxUpdate'=>'function(id, data) { alert(id);setInlineEdit(); }',
    'columns'=>array(
       array('name'=>'id', 'header'=>'#','type'=>'html'),
        array('name'=>'name', 'header'=>'Наименование','type'=>'raw', 'value'=>'HelperAdmin::createInput($data->name,"name",$data->id,"banner.update_field")'),
        array('name'=>'src', 'type'=>'raw',  'header'=>'Изображение', 'value'=>'HelperAdmin::selectBanner($data->src,$data->id)'),
        array('name'=>'link','type'=>'raw','header'=>'Ссылка', 'value'=>'HelperAdmin::createBannerlink($data->name,"name",$data->id,"banner.update_field")'),
    	array('name'=>'date_edit', 'header'=>'Дата изменения'),
        array(
            'class'=>'application.extensions.bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        				/* 'data-toggle'=>'modal',
        				'data-target'=>'#myModal', */

        ),
    ),
	'selectionChanged'=>'js:function(id)
	{
		/* $("#dialog").val($.fn.yiiGridView.getSelection(id));
		$("#dialog").click(); */
		/* $("#id_place").val($.fn.yiiGridView.getSelection(id));
	    var select_val = $(".selected");
	    $("#place_location").val(select_val.find("td").eq(0).text());
	    $("#place_address").val(select_val.find("td").eq(1).text()+" ("+select_val.find("td").eq(2).text()+")");
	    $("#mydialog").dialog("close"); */
	}'
)); ?>

<input type="hidden" name="dialog" value="" data-toggle="modal" data-target="#myModal" id="dialog"/>
<?php $this->beginWidget('application.extensions.bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Выберите раздел</h4>
</div>

<div class="modal-body">
    <?php
    $items=HelperAdmin::menuItem(true);
    $this->widget('ext.efgmenu.EFgMenu',array(
    		'bDev'=>true,
    		'id'=>'vert',
    		'items'=>$items,
    		'menubarOptions' => array(
    				'direction'=>'vertical',
    				'width'=> 70,

    		),
    		'menuOptions' => array(
    				'flyOut'=>true
    		)
    ));
    ?>
</div>
<div class="modal-footer">
<?php $this->endWidget(); ?>
<?php $cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.jeditable.mini.js');
?>


