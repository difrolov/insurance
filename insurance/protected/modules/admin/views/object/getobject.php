<?php $this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$gridDataProvider,
    'template'=>"{items}",
    'columns'=>array(
       array('name'=>'id', 'header'=>'#'),
        array('name'=>'name', 'header'=>'Наименование'),
        /* array('name'=>'status', 'header'=>'Видимость'), */
        array('name'=>'alias', 'header'=>'Алиас'),
    	array('name'=>'date_changes', 'header'=>'Дата изменения'),
        array(
            'class'=>'application.extensions.bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
    ),
)); ?>