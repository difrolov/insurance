<? 	require_once dirname(__FILE__).'/header.php';
$mode=(isset($_GET['mode']))? $_GET['mode']:false; ?>
<body>
<?	if (isset($_GET['debug'])) require_once Yii::getPathOfAlias('webroot').'/protected/components/helpers/debug.php';
// если пытались подать на печать:
if ($mode=='save'||$mode=='print'){	?>
<link href="<?=Yii::app()->request->getBaseUrl(true)?>/css/print_blank.css" rel="stylesheet" type="text/css">
<?	
	require_once Yii::getPathOfAlias('webroot').'/protected/views/layouts/save_and_print.php';

}else{ // не пытались?>
<div align="center">
  <div align="left" class="container" id="page">
    <div id="fit_height"<? 
	if(isset($_GET['test_bg'])) :?> style="background:url(<?=Yii::app()->request->getBaseUrl(true)?>/_docs/sources/BODY.gif) -20px 0 no-repeat;"<? 
	endif;?>>
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
<?	
	if(Yii::app()->controller->getId()!='site'):?>
<? 	if (isset($_GET['b3'])):?>
  	<div class="bottomBannersWrapper">
    <?	for($i=0;$i<3;$i++):?>
    	<div class="external">
        	<div class="middle">
            	<div class="internal">
           	    <a href="#">
                	<img src="<?=Yii::app()->request->getBaseUrl(true)?>/images/spacer.png">
                </a>
                </div>
            </div>
        </div>
	</div>
<?		endfor;
	endif;
	// подключить блок баннеров №3:
	if (!isset($_GET['b3'])) require_once Yii::getPathOfAlias('webroot').'/protected/components/submodules/banners3.php';?>
<?	endif;	?>
  	</div>
  </div>
<?	setHTML::buildFooterBlock($tp);	?>
</div>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/drop_down_menu.js"></script><?
}
// </body> - в main.php