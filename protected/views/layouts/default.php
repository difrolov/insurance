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
		setHTML::buildMenu($this); // главное меню

		setHTML::buildDropDownMenu();	// выпадающее меню	
															?>
	  </div>
	<?	
		setHTML::buildMainSubmenu($this);
	
		setHTML::buildBreadCrumbs();
		
		echo $content;?>
  	</div>
  </div>
	<? 	
		setHTML::buildFooterBlock($tp);	?>
</div>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/drop_down_menu.js"></script>