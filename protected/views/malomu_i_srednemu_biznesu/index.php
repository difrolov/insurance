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
<?	//var_dump("<h1>res:</h1><pre>",$res,"</pre>");?>
<table class="inner_layout" cellspacing="0">
  <tr>
    <th>Готовые решения</th>
    <th>Программы</th>
  </tr>
  <tr>
    <td>
<?	for($i=0;$i<10;$i++)
		setHTML::showReadySolution();?>      
	</td>
    <td>
	</td>
  </tr>
</table>
