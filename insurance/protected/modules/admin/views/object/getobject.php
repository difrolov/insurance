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
        array(
            'class'=>'application.extensions.bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
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
        array(
            'class'=>'application.extensions.bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
    ),
)); ?>