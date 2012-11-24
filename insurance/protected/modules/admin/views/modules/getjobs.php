<h3>Вакансии</h3>
<?php $this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$gridDataProvider,
    'template'=>"{items}{pager}",
	'enablePagination' => true,
	'afterAjaxUpdate'=>'function(id, data) { alert(id);setInlineEdit(); }',
	'beforeAjaxUpdate'=>'function(id, data) { alert(id);setInlineEdit(); }',
    'columns'=>array(
       array('name'=>'id', 'header'=>'#','type'=>'html'),
        array('name'=>'jobs_name', 'header'=>'Наименование вакансии'),
        array('name'=>'contact_name','header'=>'Контактное лицо',),
    	array('name'=>'creat_date', 'header'=>'Дата создания'),
    	array('name'=>'status','header'=>'Статус','type'=>'html',
    			'value'=>'HelperAdmin::createStatusBaner($data->status)'),
    	array(
    			'class'=>'application.extensions.bootstrap.widgets.TbButtonColumn',
    			'htmlOptions'=>array('style'=>'width: 50px'),
    			'buttons'=>array(
    					'update' => array(
    							'url'=>'Yii::app()->controller->createUrl("/admin/modules/jobs/id/$data->id")',
    					),
    			),
    ),
   )
)); ?>
<br class="clear">
<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>"Добавить Вакансию",
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'small', // null, 'large', 'small' or 'mini'
	    'url'=> Yii::app()->controller->createUrl("/admin/modules/jobs")
)); ?>