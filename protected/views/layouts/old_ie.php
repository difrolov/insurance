<? require_once dirname(__FILE__).'/header.php';?>
<body>
<table id="main_content" cellspacing="0">
  <tr>
    <td height="190" colspan="2" valign="top">
    	<div id="header_top">
            <div style="float:left;"><a href="http://www.open.ru"><span class="txtLightBlue">www.open</span>.ru</a></div>
            <div style="float:right;"><a href="map.php" class="txtLightBlue">карта сайта</a></div>
        </div>
        <table class="noPadding" id="hat" cellspacing="0">
          <tr>
            <td><div id="logo" align="left">
                    <a href="/insur/insurance/site/index"><img alt="Открытие Страхование" title="На главную" src="/insur/insurance/images/logos.gif" width="435" height="97" border="0"></a>
                </div></td>
            <td width="184"><div id="call_us" align="right">
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
          </div></td>
          </tr>
        </table>
		
        
    </td>
  </tr>
  <tr>
    <td class="noPadding" height="30" colspan="2" bgcolor="#FFFFCC">
    	<div id="mainmenu" align="left" style="position:relative;">
<?	setHTML::buildMenu($this); // главное меню?>
		</div>
</td>
  </tr>
  <tr>
    <td width="680" bgcolor="#99FFFF">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</body>
</html>
