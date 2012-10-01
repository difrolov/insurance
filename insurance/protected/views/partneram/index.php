<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

Data::setPageData($this,$res,true);?>
<h1>Партнёрам</h1>
<table class="inner_layout" cellspacing="0">
  <tr>
    <td>
    <div><h3 class="noTopMargin">Подменю (?)</h3>
      <p>Какое-то подменю. А что же в нём должно быть? Кто угадает &#8212; получит приз!
      </p>
      <p>Кто не угадает будет... лучше тебе этого не знать!</p>
    </div>
    
      <h3>Новости</h3>
<?	for($i=0;$i<3;$i++)
		setHTML::showNews();?>      
    </td>
    <td>
    <h3 class="noTopMargin">Заголовок (?)</h3>
    <p>Тоже непонятно &#8212; почему в разделе "<a href="o_kompanii/" class="blue">О компании</a>" нет заголовка, а здесь есть? При том, что макет страницы тот же самый. 
</p>
    <p>Ответьте, уважаемый доктор! </p>
    <p><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/pix/3-family.jpg" width="144" height="91" hspace="8" align="left" />Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed 
      
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
        

<?	setHTML::setButtonPrint();
	readyProduct::showReadySolution();?>
    </td>
  </tr>
</table>
