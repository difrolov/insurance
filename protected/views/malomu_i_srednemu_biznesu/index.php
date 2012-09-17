<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Малому и среднему бизнесу';
$this->breadcrumbs=array(
	'Малому и среднему бизнесу',
);
?>
<h1>Малому и среднему бизнесу</h1>
<?	setHTML::buildCatalogue(false,false,'smallBusiness');?>
