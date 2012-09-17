<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - О компании';
$this->breadcrumbs=array(
	'О компании',
);
?>
<h1>О компании</h1>
<?	//var_dump("<h1>res:</h1><pre>",$res,"</pre>");?>
<table class="inner_layout" cellspacing="0">
  <tr>
    <td>
    	<ul>
        	<li><a href="#">История</a></li>
        	<li><a href="#">О корпорации</a></li>
        	<li><a href="#">Руководство</a></li>
        	<li><a href="#">Раскрытие информации</a></li>
        	<li><a href="#">Музей страхования</a></li>
        	<li><a href="#">Вакансии</a></li>
        	<li><a href="#">Новости компании</a></li>
        	<li><a href="#">Контакты</a></li>
        	<li><a href="#">Финансовые показатели</a></li>
      </ul>
      <h3>Новости</h3>
<?	for($i=0;$i<3;$i++)
		setHTML::showNews();?>      
    </td>
    <td><p><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/pix/3-family.jpg" width="144" height="91" align="left" />Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed 
      
      diam nonumy eirmod tempor invidunt ut labore et dolore magna 
      
      aliquyam erat, sed diam voluptua. At vero eos et accusam et 
      
      justo duo dolores et ea rebum. Stet clita kasd gubergren, no 
      
    sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
      <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/pix/museum.jpg" width="180" height="233" align="right" />
      <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed 

		diam nonumy eirmod tempor invidunt ut labore et dolore magna 

		aliquyam erat, sed diam voluptua. At vero eos et accusam et 

		justo duo dolores et ea rebum. Stet clita kasd gubergren, no 

		sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed 

		diam nonumy eirmod tempor invidunt ut labore et dolore magna 

		aliquyam erat, sed diam voluptua. At vero eos et accusam et 

		justo duo dolores et ea rebum. Stet clita kasd gubergren, no 

		sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
      <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed 

		diam nonumy eirmod tempor invidunt ut labore et dolore magna 

		aliquyam erat, sed diam voluptua. At vero eos et accusam et 

		justo duo dolores et ea rebum. Stet clita kasd gubergren, no 

		sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
      <p><a href="<?php echo Yii::app()->request->baseUrl; ?>/o_kompanii/kontakty">Контакты</a></p>
        

<?	setHTML::setButtonPrint();
	readySolutions::showReadySolution();?>
    </td>
  </tr>
</table>


