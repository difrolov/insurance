<? require_once dirname(__FILE__).'/header.php';?>
<body>
<div align="center">
  <div align="left" class="container" id="page">
    <div id="fit_height"<? if(isset($_GET['test_bg'])){?> style="background:url(<?=Yii::app()->request->getBaseUrl(true)?>/_docs/sources/BODY.gif) -20px 0 no-repeat;"<? }?>>
	  <div id="header">
	<?	// Data::getObjectsRecursive();
		// /components/helpers
		setHTML::buildLogosBlock();

		setHTML::buildContactsAndSearchBlock();
															?>      
	  </div>
	  <div id="mainmenu" align="left" style="position:relative;">
	<?	// главное меню:
		setHTML::buildMainMenu($this); // главное меню
		// выпадающее меню:
		setHTML::buildDropDownMenu();	// выпадающее меню	
															?>
	  </div>
    <?	/**/?> 
		<div id="main_submenu" align="right" style="position:relative;">
	<?	setHTML::buildMainMenu($this,-2);
	
		setHTML::buildDropDownMenu(-2);
												?>
		</div>
	<?	
		setHTML::buildBreadCrumbs();
		
		echo $content;?>
  	</div>
  </div>
	<?	setHTML::buildFooterBlock($tp);	?>
</div>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/drop_down_menu.js"></script><?
// </body> - в main.php