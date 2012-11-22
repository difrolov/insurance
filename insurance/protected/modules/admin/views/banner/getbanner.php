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
<div class="out_baner_img">
<?php
foreach ($out_query as $key=>$value){
?>
	<img class="banner" id="banner_<?=$out_query[$key]['id']?>" alt="<?=$out_query[$key]['name']?>" src="<?=Yii::app()->homeUrl.$out_query[$key]['src']?>">
<?php
}
?>


</div>
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
    	array('name'=>'status','header'=>'Статус','type'=>'html',
    			'value'=>'HelperAdmin::createStatusBaner($data->status)')
    ),
)); ?>
<?php
	$this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Отключить',
	    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'size'=>'small', // null, 'large', 'small' or 'mini'
	    'htmlOptions'=>array('onclick'=>'_banner.statusButton("out")')
));
	$this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Добавить',
			'type'=>'', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size'=>'small', // null, 'large', 'small' or 'mini'
			'htmlOptions'=>array('onclick'=>'_banner.MainMenuButton($(this))','data-item'=>'banner_in'),
	));

?>
</div>

<div class="table_baner banner_in" style="display: none;">
<br class="clear">
<div class="in_baner_img">
<?php
foreach ($in_query as $key=>$value){
?>
	<img class="banner" id="banner_<?=$in_query[$key]['id']?>" alt="<?=$in_query[$key]['name']?>" src="<?=Yii::app()->homeUrl.$in_query[$key]['src']?>">
<?php
}
?>
</div>
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


