<html>
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta charset="utf-8">
<meta name="language" content="ru">
<link href="<?=Yii::app()->request->baseUrl?>/css/style.css" rel="stylesheet" type="text/css">
<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
<![endif]-->
<?	// если главная, удалим отступы главного контейнера:
	if (!isset($this->breadcrumbs)||!$this->breadcrumbs){?>
<style>
div#content{
	padding:0;
}
</style>
<? 	}
// include jQuery, jQuery UI	?>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/jquery-ui-1.8.23.custom.min.js"></script>
</head>