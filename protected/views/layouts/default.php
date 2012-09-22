<? require_once dirname(__FILE__).'/header.php';?>
<body>
<div align="center">
<!-- page -->
<? 	
	$tp=false;
	if ($tp){?><h3>page</h3><? }?>
  <div align="left" class="container" id="page">
	<!-- fit_height -->
	<?	if ($tp){?><h3>fit_height</h3><? }?>
    	<div id="fit_height">
    <!-- header -->
	<?	if ($tp){?><h3>header</h3><? }?>
	    <div id="header">
<?		if ($tp){?><h3>header_top</h3><? }?>
          <div id="header_top">
            <div style="float:left;"><a href="http://www.open.ru"><span class="txtLightBlue">www.open</span>.ru</a></div>
            <div style="float:right;"><a href="map.php" class="txtLightBlue">карта сайта</a></div>
          </div>
<?		if ($tp){?><h3>/header_top</h3><? }?>
		  <div id="logo" align="left">
          	<a href="<?=Yii::app()->request->baseUrl?>/site/index"><img alt="Открытие Страхование" title="На главную" src="<?=Yii::app()->request->baseUrl?>/images/logos.gif" width="435" height="97" border="0"></a>
	      <?php //echo CHtml::encode(Yii::app()->name); ?>
          </div>
          <div id="call_us" align="right">
          	<div align="center">
           	  <div id="free_line" class="txtLightBlue">8 800 200 71 00</div>
			  <div class="txtLightBlue">круглосуточно</div>
                <div align="center">+7 (495) 649-71-71</div>
              	<div id="search">
                	<form>
                		<input name="search" type="text">
                    	<input type="image" src="<?=Yii::app()->request->baseUrl?>/images/search_button.png">
                    </form>
                </div>
			</div>
          </div>
		</div>
			<?	if ($tp){?><h3>/header</h3><? }?>
    <!-- /header -->
    <!-- mainmenu -->
	<?	if ($tp){?><h3>mainmenu</h3><? }?>
	    <div id="mainmenu" align="left" style="position:relative;">
<?	setHTML::buildMenu($this); // главное меню
	if (!$oldIE) setHTML::buildDropDownMenu();	// выпадающее меню
?>
		</div>
        <!--<div id="AfterMenu">TEST</div>-->
			<?	if ($tp){?><h3>/mainmenu</h3><? }?>
    <!-- /mainmenu -->
    <!-- main_submenu -->
	<?	if ($tp){?><h3>main_submenu</h3><? }?>
    	<div id="main_submenu" align="right">
<?	$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Если произошёл страховой случай', 'url'=>array('/esli_proizoshel_strahovoj_sluchay/'), 'active' => Yii::app()->controller->getId() == 'esli_proizoshel_strahovoj_sluchay'),
				array('label'=>'Отправить заявку', 'url'=>array('/site/otpravit_zajavku')),
				array('label'=>'Задать вопрос', 'url'=>array('/site/zadat_vopros')),
			),
		));
	?>          
       	</div>
			<?	if ($tp){?><h3>/main_submenu</h3><? }?>
    <!-- /main_submenu -->
	<!-- breadcrumbs -->
	<?	if ($tp){?><h3>breadcrumbs</h3><? }?>
		<div id="breadcrumbs" align="left">
<?php
	if(isset($this->breadcrumbs)){?>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		));
	}elseif($test==1){
		echo "\n";?><a href="#">Главная</a> / <a href="#">Ссылка</a> / <a href="#">Ссылка</a>
<?	}?>
		</div>
			<?	if ($tp){?><h3>/breadcrumbs</h3><? }?>
	<!-- /breadcrumbs -->
	<?php echo $content;?>
  		</div>
	<? if ($tp){?><h3>/fit_height</h3><? }?>
	<!-- /fit_height -->
	<? 	if ($tp){?><h3>/page</h3><? }?>
  </div>
	<? 	if ($tp){?><h3>/page</h3><? }?>
<!-- /page -->
<!-- footer -->
<? 	if ($tp){?><h3>footer</h3><? }?>
  <div align="left" id="footer">
  	<!--bottom_menu-->
	<?	if ($tp){?><h3>bottom_menu</h3><? }?>
        <div align="left" id="bottom_menu">
	<?	setHTML::buildMenu($this); echo "\n"?>
        </div>
			<?	if ($tp){?><h3>/bottom_menu</h3><? }?>
  	<!--/bottom_menu-->
  	<!--footer_content-->
	<?	if ($tp){?><h3>footer_content</h3><? }?>
    	<div id="footer_content">
        	<div align="left" class="floatLeft">
            	<div style="display:inline-block">
                	<div>&copy; &quot;ОТКРЫТИЕ СТРАХОВАНИЕ&quot; 2012</div>
                    <div>Все права защищены.</div>
                    <div>Адрес: Москва, рядом с Кремлём.</div>
                </div>
                <div id="call_us_free" align="center">
                	<div>8 800 200 71 00</div>
					<div>круглосуточно</div>
				</div>
            </div>
            <div class="floatRight">&nbsp;</div>
        </div>
			<?	if ($tp){?><h3>/footer_content</h3><? }?>
  	<!--/footer_content-->
  </div>
	<?	if ($tp){?><h3>/footer</h3><? }?>
<!-- /footer -->
</div>
<?	if (!$oldIE) :?> 
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/drop_down_menu.js"></script>
<?	endif;?>
</body>
</html>
