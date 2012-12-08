<h3>Контакты</h3>
<?php $this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$gridDataProvider,
    'template'=>"{items}{pager}",
	'enablePagination' => true,
	'columns'=>array(
       array('name'=>'id', 'header'=>'#','type'=>'html'),
        array('name'=>'baranch_name', 'header'=>'Название региона'),
        array('name'=>'address','header'=>'Адрес'),
		array('name'=>'phone','header'=>'Телефон'),
    	array('name'=>'create_date', 'header'=>'Дата создания'),
    	 array('name'=>'status','header'=>'Статус','type'=>'html',
        		'value'=>'HelperAdmin::createStatusContent($data->status,$data->id)'),
    	array(
    			'class'=>'application.extensions.bootstrap.widgets.TbButtonColumn',
    			'htmlOptions'=>array('style'=>'width: 50px'),
    			'template'=>'{update}{delete}',
    			'buttons'=>array(
    					'update' => array(
    							'url'=>'Yii::app()->controller->createUrl("/admin/modules/contacts/id/$data->id")',
    					),
    					'delete' => array(
    							'url'=>'Yii::app()->createUrl("admin/modules/deletecontacts/", array("id"=>$data[\'id\']))'
    					),
    			),
    ),
   )
)); ?>
<br class="clear">
<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>"Добавить Контакт",
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'small', // null, 'large', 'small' or 'mini'
	    'url'=> Yii::app()->controller->createUrl("/admin/modules/contacts")
)); ?>
<?php $cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/admin/toogle-button.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/admin/contacts.js');
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
			_contacts.updateContactsStatus(id,val);
		});
		$('.toggle').bind('click',function(){
			id = $(this).parent().parent().attr('class');
			if($(this).children().hasClass('active')){
				val=1;
			}else{
				val=0;
			}
			_contacts.updateContactsStatus(id,val);
		});
})
</script>