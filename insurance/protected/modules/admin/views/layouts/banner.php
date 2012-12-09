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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/print.css" media="print" />
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
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/admin/drop_down_menu.css" media="screen, projection" />
<script>
testMode=false;
<?	if (isset($_GET['test'])):?>
testMode=true;
<? endif;?>
</script>
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
// если любой другой раздел, приаттачить скрипт генерации доп. кнопки:?>
	<script src="<?=$url?>/js/admin/add_button.php?base_url=<?=$url?>"></script>
<?
}?>
<script src="<?=$url?>/js/wait_for.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->getBaseUrl(true)?>/js/drop_down_menu.js"></script>
</head>
<body>
	<div id="header">
		<div id="main_submenu">
	<?php	$this->widget('application.extensions.bootstrap.widgets.TbMenu', array(
		    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		    'stacked'=>false, // whether this is a stacked menu
		    'items'=>array(
		       array('label'=>'Файловый менеджер', 'url'=>Yii::app()->createUrl('admin/default/browser')),
		        array('label'=>'Управление разделами', 'url'=>Yii::app()->createUrl('admin/object/getobject/44')),
		        array('label'=>'Управление баннерами', 'url'=>Yii::app()->createUrl('admin/banner/getbanner')),
		    	array('label'=>'Управление статьями', 'url'=>Yii::app()->createUrl('admin/content/getcontent')),
		    	array('label'=>'Управление вакансиями', 'url'=>Yii::app()->createUrl('admin/modules/getjobs')),
		    	array('label'=>'Управление контактами', 'url'=>Yii::app()->createUrl('admin/modules/getcontacts')),
		    	array('label'=>'Управление новостями', 'url'=>Yii::app()->createUrl('admin/modules/getnews')),
		    	array('label'=>'Выход', 'url'=>Yii::app()->createUrl('user/logout')),
		    ),
		)); ?>
	</div>
	<!-- mainmenu -->
	</div>
	<!-- header -->

<div class="container" id="page">
<?php
	HelperAdmin::menuItem();
	$breadcrumbs=$this->breadcrumbs;
	if(isset($breadcrumbs[1])):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		));
	endif;
	//var_dump("<h1>breadcrumbs:</h1><pre>",$breadcrumbs,"</pre>");
	if (Yii::app()->controller->getId()!='generator') : ?>
	<div id="mainmenu" class="sectionsAdminMenu">
<?		// главное меню:
		setHTML::buildMainMenu($this); // главное меню
		// выпадающее меню:
		setHTML::buildDropDownMenu();	// выпадающее меню	?>
	</div>
<?	else:
		$this->widget('ext.efgmenu.EFgMenu',array('bDev'=>true));
	endif;?>
	<div class="content_banner">
	<?php echo $content; ?>
	</div>

	<div class="clear"></div>

	<!-- <div id="footer">

	</div >--><!-- footer -->

</div><!-- page -->
<script type="text/javascript">
	var baseUrl="<?php echo Yii::app()->baseUrl; ?>";
</script>
<?	setHTML::veil();?>
</body>
</html>
