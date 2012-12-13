<br class="clear">
<div>Приоритет меню</div>
<br class="clear">
<table class="items table table-striped table-bordered table-condensed">
<thead>
<th>Наименование</th>
<th>Действия</th>
</thead>
<tbody>
<?php
	$i=1;
	foreach ($gridDataProvider as $key=>$value){

?>
		<tr class="<?=($i%2==0?'odd':'even')?>">
		<td><?=$value['name']?></td>
		<td>
			<span data_id="<?=$value['id']?>" data_parentid="<?=$value['parent_id']?>"
				style="background-image:url('<?=Yii::app()->homeUrl?>/images/glyphicons-halflings.png'); width:16px; height:16px;display:block;background-position:-287px -95px;cursor:pointer"
				 onclick="_object.object_up($(this));return false"></span><br>
			<span data_id="<?=$value['id']?>" data_parentid="<?=$value['parent_id']?>"
				style="background-image:url('<?=Yii::app()->homeUrl?>/images/glyphicons-halflings.png'); width:16px; height:16px;display:block;background-position:-310px -95px;cursor:pointer"
				 onclick="_object.object_down($(this));return false"></span>
		</td>
		</tr>
<?php
$i++;
	}
?>
</tbody>
</table>



<?php $cs = Yii::app()->getClientScript();
/* $cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.jeditable.mini.js'); */
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/admin/toogle-button.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/admin/object.js');
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
