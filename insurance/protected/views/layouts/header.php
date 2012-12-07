<html>
<head>
<title><?=$this->pageTitle?></title>
<meta charset="utf-8">
<meta name="language" content="ru">
<link href="<?=Yii::app()->request->baseUrl?>/css/style.css" rel="stylesheet" type="text/css">

<?	// если загружаем подраздел, созданный генератором:
	if(isset($_SESSION['SUBSECTION_DATA_ARRAY'])) :?>
<link href="<?=Yii::app()->request->baseUrl?>/css/section_template.css" rel="stylesheet" type="text/css">
<?		unset($_SESSION['SUBSECTION_DATA_ARRAY']);
	endif;?>

<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
<![endif]-->
<?	// если главная, удалим отступы главного контейнера:
	if (!isset($this->breadcrumbs)||!$this->breadcrumbs){?>
<style>
div#content{
	padding:0;
}
<? if (isset($_GET['border'])){?>
div {
	border:solid 1px #0000FF;
}
table {
	border:solid 1px #FF0000;
}
<? }?>
</style>
<? 	}
// include jQuery, jQuery UI
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl."/js/jquery-1.7.2.min.js", CClientScript::POS_HEAD);
?>
<!-- script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/jquery-1.7.2.min.js"></script -->
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/custom_accordion.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/wait_for.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/bootstrap.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/debug.js"></script>
<script type="text/javascript">
var baseUrl="<?php echo Yii::app()->baseUrl; ?>";
</script>
</head>