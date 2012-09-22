<!-- tblSlides -->
<?		if ($tp){?><h3>tblSlides</h3><? }?>
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
	<?php
		if ($tp){?><h3>/tblSlides</h3><? }?>
		<!-- /tblSlides -->
			<div id="content_from_left" align="left">
			  <div class="txtHeader2 txtLightBlue bold">О компании</div>
			  <p>Сайт предназначен для:</p>
			  <ul class="insideDiv">
				<li>Повышения узнаваемости бренда Компании;</li>
				<li>Повышения имиджа ОАО «Открытие Страхования»;</li>
				<li>Создать образ высокопрофессиональной, надежной компании с успешным опытом работы на рынке.</li>
				<li>Повышения уровня лояльности и доверия клиентов.</li>
				<li>Привлечения новых клиентов (представители крупного, среднего и малого бизнеса, физические лица);</li>
				<li>Увеличения количества партнеров по бизнесу (мед.учреждения, автосервисы и пр.);</li>
			  </ul>
			</div>
			<div id="content_from_right" align="center">
			  <img src="<?=Yii::app()->request->baseUrl?>/images/pix/museum.jpg" width="180" height="233">
			  <div id="our_museum" class="txtHeader2">Наш музей</div>
			</div>
			<div class="clear"></div>
			<div id="news_block">
	<?	if ($tp){?><h3>last_articles</h3><? }?>
				<div align="left" id="last_articles">
				  <div>
					<div class="txtHeader2 txtLightBlue">последние статьи</div>
					<div id="last_articles_previews">
						<div class="floatLeft">
						  <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
	
				diam nonumy eirmod tempor invidunt ut labore et dolore magna
	
				aliquyam erat, sed diam voluptua. At vero eos et accusam et
	
				justo duo dolores et ea rebum. Stet clita kasd gubergren, no
	
				sea takimata sanctus est Lorem ipsum dolor sit amet.</p></div>
						<div class="floatRight"><p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
	
				diam nonumy eirmod tempor invidunt ut labore et dolore magna
	
				aliquyam erat, sed diam voluptua. At vero eos et accusam et
	
				justo duo dolores et ea rebum. Stet clita kasd gubergren, no
	
				sea takimata sanctus est Lorem ipsum dolor sit amet.</p></div>
					</div>
				  </div>
				</div>
	<?	if ($tp){?><h3>/last_articles</h3><? }?>
			  <div align="left" id="last_news">
					<div class="txtHeader3 txtLightBlue">новости</div>
				<p id="issue_date">31.08.2012</p>
				<p>В рамках начала сотрудничества с информационным порталом, директор нашего главного департамента дала  развёрнутое интервью о перспективах развития коммерческой недвижимости в России, осветив общую ситуацию послекризисного 2009 года.</p>
					<p id="all_news"><a href="#">все новости...</a></p>
			  </div>
			</div>
			<div class="clear"></div>
	<?	if ($tp){?><h3>last_seen</h3><? }?>
			<div id="last_seen">
				<span id="last_seen_header" class="txtHeader2 txtLightBlue">
					вы недавно смотрели
				</span>
				<table id="tblSlidesLastSeen" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td class="slidesPointer">
							<a href="#"><img src="<?=Yii::app()->request->baseUrl?>/images/pointer_left.png" width="9" height="18" border="0"></a>
						</td>
						<td width="100%" align="center">
	<?	$arrLastSeen=array( 'insur'=>'Страхование имущ-ва',
							'flats'=>'Страхование квартир',
							'family'=>'Готовое решение &quot;Семья&quot;',
							'autosuit'=>'Автоподбор физ. лица',
							'useful'=>'Полезная информация'
						  );
		$i=1;
		foreach($arrLastSeen as $alias=>$header):?>
				<div>
				  <a href="<? echo "site/";?>article=<?=$alias?>">
					<img border="0" src="<?=Yii::app()->request->baseUrl?>/images/pix/<?=$i?>-<?=$alias?>.jpg" width="146" height="92">
					<span><?=$header?></span>
				  </a>
				</div>
	<?		$i++;
		endforeach;?>
						</td>
						<td class="slidesPointer">
							<a href="#"><img src="<?=Yii::app()->request->baseUrl?>/images/pointer_right.png" width="9" height="18" border="0"></a>
						</td>
					</tr>
				</table>
			</div>
	<?	if ($tp){?><h3>/last_seen</h3><? }?>
