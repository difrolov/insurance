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
		<?php $this->widget('application.extensions.bootstrap.widgets.TbMenu', array(
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
		<?php
	HelperAdmin::menuItem();
		$items = array(
				array('label'=>'Главная', 'url'=>array('/site/index')),
				array('label'=>'О компании', 'url'=>array('/site/page', 'view'=>'about'), 'items'=>array(
						array('label'=>'История', 'url'=>'#'),
						array('label'=>'О корпорации', 'url'=>'#'),
						array('label'=>'Руководство', 'url'=>'#'),
						array('label'=>'Раскрытие информации', 'url'=>'#', 'items'=>array(
								array('label'=>'Документ', 'url'=>'#'),
						)),
						array('label'=>'Музей страхования', 'url'=>'#'),
						array('label'=>'Вакансии', 'url'=>'#', 'items'=>array(
								array('label'=>'Анкета для кондидата', 'url'=>'#'),
						)),
						array('label'=>'Новости компании', 'url'=>'#', 'items'=>array(
								array('label'=>'Новость', 'url'=>'#'),
						)),
						array('label'=>'Контакты', 'url'=>'#'),
						array('label'=>'финансовые показатели', 'url'=>'#'),
						array('label'=>'Новости Страхования', 'url'=>'#', 'items'=>array(
								array('label'=>'Новость', 'url'=>'#'),
								array('label'=>'Новость', 'url'=>'#'),
						)),
				)),
				array('label'=>'Каталог для корпоративных клиентов', 'url'=>array('/site/contact'), 'items'=>array(
						array('label'=>'Готовое решение 1', 'url'=>'#'),
						array('label'=>'Готовое решение 2', 'url'=>'#'),
						array('label'=>'Автострахование', 'url'=>'#'),
						array('label'=>'ДМС', 'url'=>'#', 'items'=>array(
							array('label'=>'Если произошел страховой случай', 'url'=>'#')
						)),
						array('label'=>'Полезная информация', 'url'=>'#'),
				)),
				array('label'=>'Каталог для малого и среднего бизнеса', 'url'=>array('/site/contact'), 'items'=>array(
						array('label'=>'Строительным компаниям', 'url'=>'#', 'items'=>array(
								array('label'=>'Страхование имущества', 'url'=>'#'),
								array('label'=>'Страхование опасных объектов', 'url'=>'#'),
								array('label'=>'Страхование строительно-монтажных работ', 'url'=>'#'),
								array('label'=>'ДМС', 'url'=>'#'),
								array('label'=>'НС', 'url'=>'#'),
								array('label'=>'ВЗР', 'url'=>'#'),
								array('label'=>'Страхование автопарка', 'url'=>'#'),
						)),
						array('label'=>'Производственные компании', 'url'=>'#'),
						array('label'=>'Компании перевозчики', 'url'=>'#'),
						array('label'=>'Фармоцевтические компании', 'url'=>'#'),
						array('label'=>'ДМС', 'url'=>'#'),
						array('label'=>'ВЗР', 'url'=>'#'),
						array('label'=>'Автострахование', 'url'=>'#', 'items'=>array(
								array('label'=>'Осаго', 'url'=>'#'),
								array('label'=>'Каско', 'url'=>'#'),
						)),
						array('label'=>'Полезная информация', 'url'=>'#'),
				)),
				array('label'=>'Каталог для физических лиц', 'url'=>array('/site/contact'), 'items'=>array(
						array('label'=>'Автовладельцы', 'url'=>'#', 'items'=>array(
								array('label'=>'ГО', 'url'=>'#'),
								array('label'=>'ВЗР', 'url'=>'#'),
								array('label'=>'НС', 'url'=>'#'),
								array('label'=>'ДМС', 'url'=>'#'),
								array('label'=>'Автострахование', 'url'=>'#'),
								array('label'=>'Страхование имущества', 'url'=>'#'),
						)),
						array('label'=>'Владельцы недвижимости', 'url'=>'#'),
						array('label'=>'Туристы', 'url'=>'#'),
						array('label'=>'Индивидуальный подбор решений', 'url'=>'#'),
						array('label'=>'Взр', 'url'=>'#'),
						array('label'=>'Страхование имущества', 'url'=>'#', 'items'=>array(
								array('label'=>'Квартиры', 'url'=>'#', 'items'=>array(
										array('label'=>'Калькулятор', 'url'=>'#'),
								)),
								array('label'=>'Загородные дома', 'url'=>'#'),
								array('label'=>'Дачи', 'url'=>'#'),
						)),
						array('label'=>'Полезная информация', 'url'=>'#'),
				)),
				array('label'=>'Партнерам', 'url'=>array('/site/contact'), 'items'=>array(
						array('label'=>'Банкам', 'url'=>'#'),
						array('label'=>'Брокерам', 'url'=>'#'),
						array('label'=>'Семья', 'url'=>'#'),
						array('label'=>'Меденцинским учреждениям', 'url'=>'#'),
						array('label'=>'Автосалонам', 'url'=>'#'),
				)),
				array('label'=>'Отправить заявку', 'url'=>'#'),
				array('label'=>'Задать вопрос', 'url'=>'#'),
				array('label'=>'Если произошел страховой случай', 'url'=>'#'),
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
