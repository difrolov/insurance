<table width="100%" cellspacing="0" cellpadding="0" id="tblSlides">
	<tr valign="top">
		<td class="slidesPointer"><?
		setHTML::buildPointersNext('left');
                ?></td>
		<td width="100%">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr id="slides">
                <td><? 	
		setHTML::buildReadySolutionsBlock('corporative');?></td>
                <td><? 	
		setHTML::buildReadySolutionsBlock('smallBusiness');?></td>
                <td><? 	
		setHTML::buildReadySolutionsBlock('privatePersons');?></td>
              </tr>
            </table>
		</td>
		<td class="slidesPointer"><?
		setHTML::buildPointersNext('right');
                ?></td>
  </tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td><? require_once dirname(__FILE__).'/html/content_from_left.php';
	?>
      <table width="100%" cellspacing="0" cellpadding="0">
  		<tr>
    	  <td><?=$articles[0]?></td>
          <td><?=$articles[1]?></td>
        </tr>
      </table>
    </td>
    <td>
	<? require_once dirname(__FILE__).'/html/content_from_right.php';
    	setHTML::buildLastNews();?>
    </td>
  </tr>
</table>
