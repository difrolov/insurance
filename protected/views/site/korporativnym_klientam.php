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
