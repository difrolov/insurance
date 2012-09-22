<? require_once dirname(__FILE__).'/header.php';?>
<body>
<div align="center">
<!-- page -->
<?	if ($tp){?><h3>page</h3><? }?>
  <div align="left" class="container" id="page">
	<!-- fit_height -->
	<?	if ($tp){?><h3>fit_height</h3><? }?>
    	<div id="fit_height">
    <!-- header -->
	<?	if ($tp){?><h3>header</h3><? }?>
	    <div id="header">
	<?	if ($tp){?><h3>header_top</h3><? }
        
		setHTML::buildHeaderRoof();
		  
		if ($tp){?><h3>/header_top</h3><? }
		
		setHTML::buildLogosBlock();
		setHTML::buildContactsAndSearchBlock();?>      
		</div>
	<?	if ($tp){?><h3>/header</h3><? }?>
    <!-- /header -->
    <!-- mainmenu -->
	<?	if ($tp){?><h3>mainmenu</h3><? }?>
	    <div id="mainmenu" align="left" style="position:relative;">
	<?	setHTML::buildMenu($this); // главное меню
		setHTML::buildDropDownMenu();	// выпадающее меню	?>
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
<? 	if ($tp){?><h3>footer</h3><? }
  	
	setHTML::buildFooterBlock($tp);
	
	if ($tp){?><h3>/footer</h3><? }?>
<!-- /footer -->
</div>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/drop_down_menu.js"></script>
</body>
</html>
