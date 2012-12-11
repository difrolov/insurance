<style>
html,body{
	background:#666;
}
div#all_phones{
	text-align:right !important;
}
div#cmd_micro{
	background-image: url(images/spacer.png) !important;
	padding-right:10px;
	text-align:right;
	white-space:nowrap;
}
#cmd_micro img{
	border:none;
	margin:0 2px;
}
div#content_from_left{
	margin-left:35px !important;
}
div#content_from_left,
div#content_from_right{
	display:inline !important;
}
div#content_from_left ol{
	margin-left: 10px !important;
	padding-left:10px;
}
div#content_from_left ol li{
	list-style-type: decimal;
	margin-bottom:14px;
	margin-left: 10px !important;
	padding-left:0 !important;
}
div#content_from_left 
	ol 
		li 
			p{
	margin-top:14px;
	margin-bottom:8px;
}
div#content_from_right{
	margin-left:16px;
}
/*div#content_from_left{ background:#FFFF66;}
div#content_from_right{ background:#FF99CC;}*/


#fhr1{
	border-bottom:solid 1px #666;
	border-top:solid 1px #666;
	height:3px;
	margin-bottom:16px;
	margin-top:0 !important; 
	margin-left:-40px;
	margin-right:-40px;/*width:1060px;*/
	
}
hr#fhr2{
	margin:-10px -10px !important;
}
table {
	background:#FFF;
}
table.tblMainMenu{
	/*margin-top:-10px;*/
}
table.tblMainMenu a{
	color: #06AEDD;
	display: inline;
	font-size: 16px;
	letter-spacing: -1px;
}
table.tblMainMenu td.active a{
	color: #FFF;
}
table.tblMainSubMenu a{
	color: white;
	font-size: 14px;
	letter-spacing: -1px;
}
table.tblMainMenu,
table.tblMainSubMenu{
	background:#06AEDD;
	white-space:nowrap;
}
table.tblMainSubMenu tr td{
	height:27px;
	padding:0 15px;
	white-space:nowrap;
}
table.tblMainMenu tr td.active{
	background:#EDEEF0;
	background-image:url(<?=Yii::app()->request->getBaseUrl(true)?>/images/ie/tab_bg.gif);
}
table.tblMainMenu 
	tr td.active 
		div{
	background:url(<?=Yii::app()->request->getBaseUrl(true)?>/images/ie/tab_bg_right.gif);
	background-repeat:no-repeat;
	background-position:top right;
	line-height:31px;
}
table.tblMainSubMenu tr td:first-child{
	width:100%;
}
table.tblMainMenu tr{
	background:#EDEEF0 !important;
}
table.tblMainMenu td{
	height:31px;
	text-align:center;
}
table#main_content,
table#hat{
	width:100%;
}
table.tblMainMenu td{
	border-right:solid 1px #CCC;
}
table#tblSlides{
	background:none;
	margin:10px 20px;
}
table#tblSlides td{
	padding-left:12px;
	text-align:center;
	width:296px;
}
table#tblSlides td div{
	overflow: hidden;
}
table#tblSlides td img{
	border:none;
	height:203px;
	width:296px;
}
table#tblSlides 
	td div.txtBlock{
	border: solid 7px #EDEEF0;
	border-left-color:#06AEDD;
	margin: 14px 0;
	padding:10px;
	padding-bottom:0;
}
table#tblSlides 
	td div.txtBlock
		div.link{
	text-align:left;
}
table#tblSlides 
	td div.txtBlock
		div.justText{
	text-align:right;
	font-size:0.8em;
	letter-spacing: -1px;
}
table#tblSlides 
	td div.txtBlock
		div.link a{
	color: #06AEDD;
	font-size:1.0em;
	letter-spacing: -1px;
}
div#bottom_menu 
	table.tblMainMenu
		td{
	background:#FFF;
}

div#bottom_menu 
	table.tblMainMenu tr td.active{
	background:#EDEEF0;
	background-image:url(<?=Yii::app()->request->getBaseUrl(true)?>/images/ie/tab_bg_grey.gif);
}
div#bottom_menu 
	table.tblMainMenu 
	tr td.active 
		div{
	background:url(<?=Yii::app()->request->getBaseUrl(true)?>/images/ie/tab_bg_right_grey.gif);
	background-repeat:no-repeat;
	background-position:top right;
	/*line-height:31px;*/
}
div#bottom_menu 
	table.tblMainMenu 
	tr td
		a{
	font-size:13px !important;
	letter-spacing:normal !important;
}
div#bottom_menu 
	table.tblMainMenu 
	tr td.active 
		a{
	color:#FFF;
}

div#footer_content{
	margin-top:20px;
}

div#main_menu ul > li{
	padding:4px;
}
div#mainmenu, div#main_submenu{
}
td#menuPlace{
 	height:30px;
 	padding-left:20px; 
	padding-right:20px;
}
#shadowLeft,
#shadowRight{
	background-color:#666;
}
#shadowLeft{
	background-image:url(<?=Yii::app()->request->getBaseUrl(true)?>/images/ie/body_shadow_left.png);
	background-position:right;
	background-repeat: repeat-y;
}
#shadowRight{
	background-image:url(<?=Yii::app()->request->getBaseUrl(true)?>/images/ie/body_shadow_right.png);
	background-position:left;
	background-repeat: repeat-y;
}
div#slides{
	margin-left:0 !important;
	margin-right:0 !important;
	margin-top:10px !important;
}
ul li{
	display:inline;
}
div[id^="ddMenu"]{
	display:none;
}
div#call_us 
	div.txtLightBlue{
	text-align:right;
}
div#free_line_always.txtLightBlue{
	letter-spacing:normal;
	margin-right:2px;
}
/* news */
.modSpNews{
	width:296px;
}
table#innerSp td a{
	display:block;
}
</style>
<? require_once dirname(__FILE__).'/header.php'; // for fun, yeah...?>
<body>
<table id="main_content" cellspacing="0">
  <tr>
    <td id="shadowLeft" rowspan="4" valign="top">&nbsp;</td>
    <td valign="top" width="1020" height="128" bgcolor="#FFFFFF">
        <table class="noPadding" id="hat" cellspacing="0">
          <tr>
            <td style="padding-left:21px;">
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
<?	setHTML::buildDropDownMenu(); ?>
		<div id="main_submenu" align="right" style="position:relative;"><?
	setHTML::buildMainMenu($this,-2);
        ?></div>        
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
