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
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/less.js" type="text/javascript"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>



	<div id="header">
		<div id="main_submenu">
		<?php $this->widget('bootstrap.widgets.TbMenu', array(
		    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		    'stacked'=>false, // whether this is a stacked menu
		    'items'=>array(
		        array('label'=>'Home', 'url'=>'#', 'active'=>true),
		        array('label'=>'Profile', 'url'=>'#'),
		        array('label'=>'Messages', 'url'=>'#'),
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
	<div class="menu_left">
		<?php /* $this->widget('bootstrap.widgets.TbMenu', array(
			    'type'=>'list', // '', 'tabs', 'pills' (or 'list')
			    'stacked'=>true, // whether this is a stacked menu
			    'items'=>array(
			        array('label'=>'Home', 'url'=>'#', 'active'=>true),
			        array('label'=>'Profile', 'url'=>'#'),
			        array('label'=>'Messages', 'url'=>'#'),
			    ),
		)); */

		$items = array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Products', 'url'=>'#', 'items'=>array(
						array('label'=>'Web', 'url'=>'#', 'items'=>array(
								array('label'=>'NLSClientScript', 'url'=>array('/site/page', 'view'=>'nlsclientscript')),
								array('label'=>'EFgMenu', 'url'=>array('/site/page', 'view'=>'efgmenu')),
								array('label'=>'XCruder', 'url'=>'#')
						)),
						array('label'=>'Desktop', 'url'=>'#', 'items'=>array(
								array('label'=>'BatchReplacePro', 'url'=>'#'),
								array('label'=>'DeformerPro', 'url'=>'#')
						))
				))
		);
		$this->widget('ext.efgmenu.EFgMenu',array(
				'bDev'=>true,
				'id'=>'vert1',
				'items'=>$items,
				'menubarOptions' => array(
						'direction'=>'vertical'
				)
		));

		?>


	</div>
	<div class="content_right">
	<?php echo $content; ?>
	</div>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
