<? require_once dirname(__FILE__).'/header.php';?>
<body>
<div align="center">
  <div align="left" class="container" id="page">
    <div id="fit_height">
	  <div id="header">
	<?	
		setHTML::buildHeaderRoof();

		setHTML::buildLogosBlock();

		setHTML::buildContactsAndSearchBlock();
															?>      
	  </div>
	  <div id="mainmenu" align="left" style="position:relative;">
	<?	
		setHTML::buildMainMenu($this); // главное меню

		setHTML::buildDropDownMenu();	// выпадающее меню	
															?>
	  </div>
		<div id="main_submenu" align="right">
	<?	setHTML::buildMainMenu($this,-2);
		setHTML::buildDropDownMenu();?>
		</div>
	<?	setHTML::buildBreadCrumbs();
		
		echo $content;?>
  	</div>
  </div>
	<?	setHTML::buildFooterBlock($tp);	?>
</div>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/drop_down_menu.js"></script>