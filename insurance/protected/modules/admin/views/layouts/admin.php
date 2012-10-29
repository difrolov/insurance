<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/style.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet/less" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.less">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/bootstrap/bootstrap-responsive.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/bootstrap/bootstrap-responsive.min.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/bootstrap/bootstrap.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/bootstrap/bootstrap.min.css" media="screen, projection" />
<?	if (isset($_GET['test'])):?>    
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/test.css" media="screen, projection" />
<?	endif;?>    
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/banner.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?
// если загрузили раздел добавления подраздела:
	// 1. приаттачим дополнительную таблицу стилей:
if (Yii::app()->controller->getId()=='generator'){?>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/generator.css" />
<?	// 2. приаттачим скрипты для генерации и обратобки макета:    ?>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/generator/prepare_data.php"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/generator/load_template.php?base_url=<?
	echo Yii::app()->request->baseUrl;
	if (isset($_GET['test'])){?>&test=1<? }?>"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/generator/switch_states.php"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/generator/manage_template.php?base_url=<?
	echo Yii::app()->request->baseUrl;
	if (isset($_GET['test'])){?>&test=1<? }?>"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/generator/handle_text_module.php?base_url=<?
	echo Yii::app()->request->baseUrl;
	if (isset($_GET['test'])){?>&test=1<? }?>"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/generator/customize_page.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/generator/data_ready_to_send.php?base_url=<?
	echo Yii::app()->request->baseUrl;
	if (isset($_GET['test'])){?>&test=1<? }?>"></script>	<?

}else{
// если любой другой раздел, приаттачи скрип генерации доп. кнопки:?>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/add_button.php?base_url=<?=Yii::app()->request->baseUrl?>"></script>
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
		        array('label'=>'Управление меню', 'url'=>'#', 'active'=>true),
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
