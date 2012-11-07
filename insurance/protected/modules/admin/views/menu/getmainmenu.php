<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/editMenu.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/object.js"></script>

<div class="mainmenu_button">
	<p>
<?php
foreach($menu as $item){
	$this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>$item->name,
	    'type'=>'', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'small', // null, 'large', 'small' or 'mini'
	    'htmlOptions'=>array('onclick'=>'_editMenu.MainMenuButton($(this))','data-item'=>$item->id),
));
}
?>
	</p>
</div>
<br class="clear">
<div class=table_menu>
</div>



























