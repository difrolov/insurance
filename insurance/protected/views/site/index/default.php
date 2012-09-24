			<table width="100%" cellspacing="0" cellpadding="0" id="tblSlides">
			  <tr valign="top">
				<td class="slidesPointer"><?
		setHTML::buildPointersNext('left');
                ?></td>
				<td width="100%">
			<div align="left" id="slides">
			  <div>
	<? 	setHTML::buildReadySolutionsBlock('corporative');?>                
			  </div>
			  <div>
	<? 	setHTML::buildReadySolutionsBlock('smallBusiness');?>                
			  </div>
			  <div>
	<? 	setHTML::buildReadySolutionsBlock('privatePersons');?>                
			  </div>
			</div>
				</td>
				<td class="slidesPointer"><?
		setHTML::buildPointersNext('right');
                ?></td>
			  </tr>
			</table>
			<div id="content_from_left" align="left">
		<?	require_once dirname(__FILE__).'/html/content_from_left.php';?>		
			</div>
			<div id="content_from_right" align="center">
		<?	require_once dirname(__FILE__).'/html/content_from_right.php';?>		
			</div>
			<div class="clear"></div>
			<div id="news_block">
				<div align="left" id="last_articles">
				  <div>
					<div class="txtHeader2 txtLightBlue">последние статьи</div>
					<div id="last_articles_previews">
						<div class="floatLeft"><?
						echo $articles[0];
						  ?></div>
						<div class="floatRight"><?
						echo $articles[1];
						  ?></div>
					</div>
				  </div>
				</div>
			  <div align="left" id="last_news">
			  <? setHTML::buildLastNews();?>
              </div>
			</div>
			<div class="clear"></div>
