<?php /* @var $this Controller */ 
	$url=Yii::app()->request->getBaseUrl(true);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/admin/style.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/admin/main.css" />
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/form.css" />
	<link rel="stylesheet/less" type="text/css" href="<?=$url?>/css/styles.less">
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/admin/bootstrap/bootstrap-responsive.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/admin/bootstrap/bootstrap-responsive.min.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/admin/bootstrap/bootstrap.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/admin/bootstrap/bootstrap.min.css" media="screen, projection" />
<?	if (isset($_GET['test'])):?>    
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/test.css" media="screen, projection" />
<?	endif;?>    
	<script src="<?=$url?>/js/admin/banner.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?
// если загрузили раздел добавления подраздела:
	// 1. приаттачим дополнительную таблицу стилей:
if (Yii::app()->controller->getId()=='generator'){?>
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/admin/generator.css" />
<?	
	require_once Yii::getPathOfAlias('webroot')."/css/admin/generator2.php";
	// 2. приаттачим скрипты для генерации и обратобки макета:    ?>
	<script src="<?=$url?>/js/admin/generator/prepare_data.php"></script>
	<script src="<?=$url?>/js/admin/generator/load_template.php?base_url=<?
	echo $url;
	if (isset($_GET['test'])){?>&test=1<? }?>"></script>
    <script src="<?=$url?>/js/admin/generator/switch_states.php"></script>
    <script src="<?=$url?>/js/admin/generator/manage_template.php?base_url=<?
	echo $url;
	if (isset($_GET['test'])){?>&test=1<? }?>"></script>
    <script src="<?=$url?>/js/admin/generator/handle_text_module.php?base_url=<?
	echo $url;
	if (isset($_GET['test'])){?>&test=1<? }?>"></script>
    <script src="<?=$url?>/js/admin/generator/customize_page.js"></script>
    <script src="<?=$url?>/js/admin/generator/data_ready_to_send.php?base_url=<?
	echo $url;
	if (isset($_GET['test'])){?>&test=1<? }?>"></script>
<?
}else{
// если любой другой раздел, приаттачи скрип генерации доп. кнопки:?>
	<script src="<?=$url?>/js/admin/add_button.php?base_url=<?=$url?>"></script>
<?
}?>
</head>
<body>
	<div id="header">
		<div id="main_submenu">
		<?php $this->widget('application.extensions.bootstrap.widgets.TbMenu', array(
		    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		    'stacked'=>false, // whether this is a stacked menu
		    'items'=>array(
		        array('label'=>'Управление меню', 'url'=>Yii::app()->createUrl('admin/menu/getmainmenu'), 'active'=>true),
		    	array('label'=>'Файловый менеджер', 'url'=>Yii::app()->createUrl('admin/default/browser')),
		        array('label'=>'Управление разделами', 'url'=>Yii::app()->createUrl('admin/object/getobject/44'), 'active'=>true),
		        array('label'=>'Управление баннерами', 'url'=>Yii::app()->createUrl('admin/banner/getbanner')),
		    ),
		)); ?>
	</div>
	<!-- mainmenu -->
	</div>
	<!-- header -->

<div class="container" id="page">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	<div class="">
		<?php

		HelperAdmin::menuItem();
		$items=HelperAdmin::$arrMenuItems;
		$this->widget('ext.efgmenu.EFgMenu',array(
				'bDev'=>true,
				'id'=>'horz1',
				'items'=>$items,
				'menubarOptions' => array(
						'direction'=>'horizontal',
						'width'=> 70,
				),
			));?>


	</div>
	<div class="content_right">
	<?php echo $content; ?>
	</div>

	<div class="clear"></div>

	<!-- <div id="footer">

	</div >--><!-- footer -->

</div><!-- page -->

</body>
</html>
