<div>Продукт</div>
<?php $this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
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
        	'buttons'=>array(
        			'update' => array(
        					'url'=>'Yii::app()->controller->createUrl("/admin/generator/edit/$data->id")',
        		),
        	),
        ),
    ),
)); ?>
<br class="clear">

<div>Подкатегории</div>
<?php $this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
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
        	'buttons'=>array(
        			'update' => array(
        					'url'=>'Yii::app()->controller->createUrl("/admin/generator/edit/$data->id")',
        			),
        	),
        ),
    ),
)); ?>