<? require_once dirname(__FILE__).'/header.php';?>
<body>
<table id="main_content" cellspacing="0">
  <tr>
    <td height="190" colspan="2" valign="top">
	<?	setHTML::buildHeaderRoof();?>    	
        <table class="noPadding" id="hat" cellspacing="0">
          <tr>
            <td>
	<?  setHTML::buildLogosBlock();?></td>
            <td width="184">
	<?	setHTML::buildContactsAndSearchBlock();?>
            </td>
          </tr>
        </table>
		
        
    </td>
  </tr>
  <tr>
    <td class="noPadding" height="30" colspan="2">
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
    <td colspan="2"><?
    setHTML::buildFooterBlock($tp);
	?></td>
  </tr>
</table>
</body>
</html>
