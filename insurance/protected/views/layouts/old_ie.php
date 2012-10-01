<? require_once dirname(__FILE__).'/header.php'; // for fun, yeah...?>
<body>
<table id="main_content" cellspacing="0">
  <tr>
    <td id="shadowLeft" rowspan="4" valign="top">&nbsp;</td>
    <td width="918" height="190" valign="top">
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
    <td id="shadowRight" rowspan="4" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td class="noPadding" height="30">
    	<div id="mainmenu" align="left" style="position:relative;">
<?	setHTML::buildMainMenu($this); // главное меню?>
		</div>
<?	setHTML::buildMainSubmenu($this); ?>        
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
