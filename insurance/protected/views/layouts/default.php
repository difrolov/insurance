<? 	require_once dirname(__FILE__).'/header.php';
$mode=(isset($_GET['mode']))? $_GET['mode']:false; ?>
<body>
<?	if (isset($_GET['debug'])) require_once Yii::getPathOfAlias('webroot').'/protected/components/helpers/debug.php';
// если пытались подать на печать:
if ($mode=='save'||$mode=='print'){?>
<style>
div#content{
	display:inline-block;
	max-width:800px;
}
div#inner_content{
	margin:0 30px;
}
div#page{
	display: inline-block;
	width:initial;
}
</style>
<?	require_once Yii::getPathOfAlias('webroot').'/protected/views/layouts/save_and_print.php';

}else{ // не пытались?>
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
		// see views/[page_alias]
		echo $content;?>
        <div class="clear"></div>


<?	if(Yii::app()->controller->getId()!='site'){?>
  	<div id="bottomBannersWrapper">
<?					// подключить блок баннеров №3:
		require_once Yii::getPathOfAlias('webroot').'/protected/components/submodules/banners3.php';?>
	</div>
<?	}?>


  	</div>
  </div>
<?	setHTML::buildFooterBlock($tp);	?>
</div>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/drop_down_menu.js"></script><?
}
// </body> - в main.php