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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/bootstrap/bootstrap-responsive-yii.css" media="screen, projection" />
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/less.js" type="text/javascript"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?	if (Yii::app()->controller->getId()=='generator'){?>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/generator.css" />
<? 	}else{?>
<script>
$(document).ready(function() {
	try{
		var sPlus=$("#main_submenu li")[1];
  		if(sPlus.className.indexOf('active')!=-1) {
			var offLeft=$(sPlus).offset().left;
			var offRight=$(sPlus).offset().right;
			var goHeight=$(sPlus).css('line-height');
			var addSubsectionButton=document.createElement('li');
			document.getElementById('yw2').appendChild(addSubsectionButton);
			addSubsectionButton.className='active command';
			$(addSubsectionButton).html('<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/generator" class="command"><span>&nbsp;&nbsp;&nbsp;&nbsp;</span> Добавить подраздел</a>');
			$(addSubsectionButton).css({
		  		left: offLeft+'px', 
				position: 'absolute',
		  		top: '32px'
			});
		}
	}catch(e){
		alert(e.message);
	}
})
</script>
<?	}?>
</head>
<body>


	<div id="header">
		<div id="main_submenu">
		<?php $this->widget('application.extensions.bootstrap.widgets.TbMenu', array(
		    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		    'stacked'=>false, // whether this is a stacked menu
		    'items'=>array(
		        array('label'=>'Управление меню', 'url'=>'#', 'active'=>true),
		        array('label'=>'Управление разделами', 'url'=>'44', 'active'=>true),
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
	<div class="">
		<?php
		$items = HelperAdmin::menuItem();
		$this->widget('ext.efgmenu.EFgMenu',array(
				'bDev'=>true,
				'id'=>'horz1',
				'items'=>$items,
				'menubarOptions' => array(
						'direction'=>'horizontal',
						'width'=> 70,
				),
			));

		?>


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
