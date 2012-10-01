<div>Статьи</div>
<?php $this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$gridDataProvider,
    'template'=>"{items}",
    'columns'=>array(
       	array('name'=>'id', 'header'=>'#'),
        array('name'=>'name', 'header'=>'Наименование'),
       /*  array('name'=>'created', 'header'=>'Дата изменения'),
    	array('name'=>'status', 'header'=>'Видимость'), */

        array(
            'class'=>'application.extensions.bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        	'template'=>'{update}{delete}',
        	'buttons'=>array(
        				'update' => array(
        						'url'=>'Yii::app()->createUrl("admin/object/edit", array("id"=>$data[\'id\']))',
        				),
        				'delete' => array(
        						'url'=>'Yii::app()->createUrl("admin/object/delete", array("id"=>$data[\'id\']))',
        				),
        		),
        ),
    ),
)); ?>
<br class="clear">