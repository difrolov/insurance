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
<?php
if ($oldIE=setHTML::detectOldIE()||isset($_GET['iexp'])){?>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/jquery-1.4.2.min.js"></script>
<?
}else{
?>
<script src="<?=$url?>/js/jquery-1.4.2.min.js"></script>
<?php
}
?>
<script>
testMode=false;
<?	if (isset($_GET['test'])):?>
testMode=true;
<? endif;?>
</script>
	<script src="<?=$url?>/js/admin/banner.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?
if (setHTML::detectOldIE()){?>
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/admin/ie.css" />
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->getBaseUrl(true)?>/js/drop_down_menu_ie.js"></script>
<?
}else{?>
<script type="text/javascript" src="<?=Yii::app()->request->getBaseUrl(true)?>/js/drop_down_menu.js"></script>
<? 
}
// если загрузили раздел добавления подраздела:
	// 1. приаттачим дополнительную таблицу стилей:
if (Yii::app()->controller->getId()=='generator'){?>
	<link rel="stylesheet" type="text/css" href="<?=$url?>/css/admin/generator.css" />
<?
	require_once Yii::getPathOfAlias('webroot')."/css/admin/generator2.php";
	if (!setHTML::detectOldIE()) {
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
<?	}?>    
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
	endif;?>
	<div id="mainmenu" class="sectionsAdminMenu">
<?		// главное меню:
		setHTML::buildMainMenu($this); // главное меню
		// выпадающее меню:
		setHTML::buildDropDownMenu();	// выпадающее меню	?>
	</div>
   	<div align="right" id="admin_main_submenu"<?
    if(setHTML::detectOldIE()){?> onclick="alert('Данный раздел разработан как программный модуль, вы не можете изменить его содержание самостоятельно.'); return false;"<? }?>>
	<?	setHTML::buildMainMenu($this,-2);?>
    </div>
	<?	if(!setHTML::detectOldIE()):
			$arrSecondMenu=setHTML::getMainMenuItems(-2);?>
<script>    
$( function(){	
	$('#admin_main_submenu ul li a').click( function(){
			alert('Данный раздел разработан как программный модуль, вы не можете изменить его содержание самостоятельно.'); return false;
		});<? /* ?>
	var getObjUrl='<?=Yii::app()->request->getBaseUrl(true)?>/admin/object/getobject/';
		<?	$sc=0;
			foreach($arrSecondMenu as $secMenuId=>$secMenuData){?>
	$('#admin_main_submenu ul li').eq(<?=$sc?>).click( function(){
			location.href=getObjUrl+'<?=$secMenuId?>';
			return false;
		});
		<?		$sc++;
			}*/?>
});
</script>
	<?	endif;
	$this->widget('ext.efgmenu.EFgMenu',array('bDev'=>true));

	if(Yii::app()->controller->getId()=='generator'){?>
	<div class="content_right">
	<?php echo $content; ?>
	</div>
<?	}else{?>
	<div class="content_banner">
	<?php echo $content; ?>
	</div>
<?	}?>
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
