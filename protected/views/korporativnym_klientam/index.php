<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Корпоративным клиентам';
$this->breadcrumbs=array(
	'Корпоративным клиентам',
);
?>
<h1>Каталог для корпоративных клиентов</h1>
<?	setHTML::buildCatalogue(false,false,'corporative');?>
