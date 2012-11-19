<div class="mainmenu_button">

	<p>
<?php
	$this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'банер на главной',
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'small', // null, 'large', 'small' or 'mini'
	    'htmlOptions'=>array('onclick'=>'_banner.MainMenuButton($(this))','data-item'=>'banner_out'),
));
	$this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'банер на внутренних страницах',
			'type'=>'', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size'=>'small', // null, 'large', 'small' or 'mini'
			'htmlOptions'=>array('onclick'=>'_banner.MainMenuButton($(this))','data-item'=>'banner_in'),
	));

?>
	</p>
</div>
<div class="table_baner banner_out">
<br class="clear">

<?php $this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$out,
    'template'=>"{items}",
	'afterAjaxUpdate'=>'function(id, data) { alert(id);setInlineEdit(); }',
	'beforeAjaxUpdate'=>'function(id, data) { alert(id);setInlineEdit(); }',
    'columns'=>array(
       array('name'=>'id', 'header'=>'#','type'=>'html'),
        array('name'=>'name', 'header'=>'Наименование','type'=>'raw', 'value'=>'HelperAdmin::createInput($data->name,"name",$data->id,"_banner.update_field")'),
        array('name'=>'src', 'type'=>'raw',  'header'=>'Изображение', 'value'=>'HelperAdmin::selectBanner($data->src,$data->id)'),
        array('name'=>'link','type'=>'raw','header'=>'Ссылка', 'value'=>'HelperAdmin::createBannerlink($data->link,"name",$data->id)'),
    	array('name'=>'date_edit', 'header'=>'Дата изменения'),
/*         array(
            'class'=>'application.extensions.bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ), */
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
</div>

<div class="table_baner banner_in" style="display: none;">
<br class="clear">

<?php $this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$in,
    'template'=>"{items}",
	'afterAjaxUpdate'=>'function(id, data) { alert(id);setInlineEdit(); }',
	'beforeAjaxUpdate'=>'function(id, data) { alert(id);setInlineEdit(); }',
    'columns'=>array(
       array('name'=>'id', 'header'=>'#','type'=>'html'),
        array('name'=>'name', 'header'=>'Наименование','type'=>'raw', 'value'=>'HelperAdmin::createInput($data->name,"name",$data->id,"banner.update_field")'),
        array('name'=>'src', 'type'=>'raw',  'header'=>'Изображение', 'value'=>'HelperAdmin::selectBanner($data->src,$data->id)'),
        array('name'=>'link','type'=>'raw','header'=>'Ссылка', 'value'=>'HelperAdmin::createBannerlink($data->link,"name",$data->id)'),
    	array('name'=>'date_edit', 'header'=>'Дата изменения'),
/*         array(
            'class'=>'application.extensions.bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ), */
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
</div>

<input type="hidden" name="dialog" value="" data-toggle="modal" data-target="#myModal" id="dialog"/>
<?php $this->beginWidget('application.extensions.bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Выберите раздел</h4>
</div>

<div class="modal-body" id="<?="save_tmpl_block"?>">
<div class="modal-section">
    <?
		if (!$items=HelperAdmin::$arrMenuItems){
			//echo "<h1>No HelperAdmin::arrMenuItems</h1>";
			$items=HelperAdmin::menuItem();
		}
		HelperAdmin::makeArrayForSelect($items);
		$MainSections=HelperAdmin::$MainMenu;
		$SubSections=HelperAdmin::$SubMenu;
		foreach($MainSections as $section_id=>$section_name){?>

        <label>
          <span>
        	<input class="modal_select_radio" data-banner="" data-id="<?=$section_id?>" name="menu" id="menu_<?=$section_id?>" type="radio" value="<?=$section_id?>"><b><?=$section_name?></b>
          </span>
        </label>
		<?	if (isset($SubSections[$section_id])) {?>
        <div>
        	<blockquote>
		<?		foreach ($SubSections[$section_id] as $id => $page){?>
            	<label>
                  <span>
					<input class="modal_select_radio" data-banner="" data-id="<?=$id?>" name="menu" id="submenu_<?=$id?>" type="radio" value="<?=$id?>"><?=$page?>
                  </span>
                </label>
			<?	}?>
        	</blockquote>
        </div>
		<?	}?>
	<?	}?>
	</div>
</div>
<div class="modal-footer">
    <?php $this->widget('application.extensions.bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Сохранить',
        'url'=>'#',
    	'htmlOptions'=>array('data-dismiss'=>'modal',
    							'onclick'=>'_banner.update_field(
    													"link",
    													$(".modal_select_radio:checked").attr("data-id"),
    													$(".modal_select_radio:checked").attr("data-banner"))'),
    )); ?>
    <?php $this->widget('application.extensions.bootstrap.widgets.TbButton', array(
        'label'=>'Отмена',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
<?php $this->endWidget(); ?>
<?php $cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.jeditable.mini.js');
?>


