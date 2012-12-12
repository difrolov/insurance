<style>
div#cmd_micro{
	background-image: url(<?=Yii::app()->request->getBaseUrl(true)?>/images/spacer.png) !important;
}
table.tblMainMenu tr td.active{
	background-image:url(<?=Yii::app()->request->getBaseUrl(true)?>/images/ie/tab_bg.gif) !important;
}
table.tblMainMenu 
	tr td.active 
		div{
	background:url(<?=Yii::app()->request->getBaseUrl(true)?>/images/ie/tab_bg_right.gif) !important;
}
div#bottom_menu 
	table.tblMainMenu tr td.active{
	background-image:url(<?=Yii::app()->request->getBaseUrl(true)?>/images/ie/tab_bg_grey.gif) !important;
}
div#bottom_menu 
	table.tblMainMenu 
	tr td.active 
		div{
	background:url(<?=Yii::app()->request->getBaseUrl(true)?>/images/ie/tab_bg_right_grey.gif) !important;
}
#shadowLeft{
	background-image:url(<?=Yii::app()->request->getBaseUrl(true)?>/images/ie/body_shadow_left.png) !important;
}
#shadowRight{
	background-image:url(<?=Yii::app()->request->getBaseUrl(true)?>/images/ie/body_shadow_right.png) !important;
}
</style>
<? require_once dirname(__FILE__).'/header.php'; // for fun, yeah...?>
<body>
<? // in default.php: <div align="left" class="container" id="page">?>
    <div id="fit_height">
<table id="main_content" cellspacing="0">
  <tr>
    <td id="shadowLeft" rowspan="4" valign="top">&nbsp;</td>
    <td valign="top" width="1020" height="128" bgcolor="#FFFFFF">
        <table class="noPadding" id="hat" cellspacing="0">
          <tr>
            <td style="padding-left:21px;">
            <div style="position:relative;">
                <div id="main_submenu" align="right"><?
            		setHTML::buildMainMenu($this,-2);
                ?></div>
            </div>
	<?  setHTML::buildLogosBlock();?></td>
            <td style="padding-right:25px;">
	<?	setHTML::buildContactsAndSearchBlock();?>
            </td>
          </tr>
        </table>
		
        
    </td>
    <td id="shadowRight" rowspan="4" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td id="menuPlace">
    	<div id="mainmenu" align="left" style="position:relative;">
<?	setHTML::buildMainMenu($this); // главное меню?>
		</div>
<?	setHTML::buildDropDownMenu();?>
</td>
  </tr>
  <tr>
    <td><?
    	echo $content;
	?></td>
  </tr>
  <tr>
    <td><?
    setHTML::buildFooterBlock($tp);
	?></td>
  </tr>
</table>
	</div>
<? //</div>?>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/drop_down_menu_ie.js"></script>