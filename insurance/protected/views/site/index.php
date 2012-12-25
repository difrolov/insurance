<? 	//if ($oldIE=setHTML::detectOldIE()||isset($_GET['iexp'])) die("old!");
	
	if (isset($temp))
		setHTML::setPageData($this,$res,false);
	else{
		if(isset($_GET['stop']))die("index by default"); 
		$tp=false;
		$baseURL=Yii::app()->request->getBaseUrl(true)."/";
		// получить баннеры для слайд-шоу: 
		$arrBanOut=setHTML::getBannersAsObjects('outside');
		//if (empty($arrBanOut)) die('empty');
		if ($tp){?><h3>tblSlides</h3><? }
		if (!(isset($_GET['slides'])&&!$_GET['slides'])) {
			$arrSlides=array('first'=>'Для корпоративных клиентов',
						'middle'=>'Малому и среднему бизнесу',
						'last'=>'Для физических лиц'
					);
			$s=0;
			$oldIE=setHTML::detectOldIE();
			if ($oldIE||isset($_GET['iexp'])){?>
		  <div id="ieSlidesHolder">
			<table id="tblSlides" cellspacing="0" cellpadding="0"<? 
				if($oldIE!=8){?> width="970"<? }?>>
				<tr align="center">
		<?	}else{
				echo '<div align="center" id="slides">';
			}
			foreach($arrSlides as $subname=>$subheader): 
				// заплатки. А куда ж без них, если кривые ручки баннеры вставляют!
				$imgsrc=(isset($arrBanOut[$s]['src']))? $arrBanOut[$s]['src']:'';
				$slink=(isset($arrBanOut[$s]['link']))? $arrBanOut[$s]['link']:'';
				$bname=(isset($arrBanOut[$s]['name']))? $arrBanOut[$s]['name']:'название не обнаружено...';
				if($oldIE=setHTML::detectOldIE()||isset($_GET['iexp'])){?>
				<td nowrap id="sTd<?=$s?>">
					<div class="bigImage"><a href="<?=$baseURL?><? Data::buildAliasPath($slink);?>"><img src="<?=$baseURL.$imgsrc?>"></a></div>
					<div class="txtBlock">
						<div class="link"><a href="<?=$baseURL?><? Data::buildAliasPath($slink);?>"><?=$bname?></a></div>
						<div class="justText"><?=$subheader?></div>
					</div>
				</td>
			<?	}else{?>        
				<div id="slide-<?=$subname?>">
					<div class="slideImgWrapper"><a href="<?=$baseURL?><? Data::buildAliasPath($slink);?>"><img src="<?=$baseURL.$imgsrc?>"></a></div>
					<div class="slideImgSubscript">
						<div><a href="<?=$baseURL?><? Data::buildAliasPath($slink);?>"><?=$bname?></a></div>
						<div><?=$subheader?></div>
					</div>
				</div>
			 <?	}
				$s++;
			endforeach;
			if ($oldIE=setHTML::detectOldIE()||isset($_GET['iexp'])){?>
				<tr>
			</table>
		  </div>
		<?	}else{            
				echo '</div>';
			}
		}else{?>
	<link href="<?	
	require_once Yii::app()->request->getBaseUrl(true).'/css/slideshow.css';	
		?>" rel="stylesheet" type="text/css">
	<table id="tblSlides" cellspacing="0">
		<tr>
			<td style="width:29px; padding-left:6px;"><button class="prev">&lt;</button></td>
			<td align="center"><div id="gallery1" class="gallery">
					<ul>
		<?	foreach($arrBanOut as $i=>$value):?>
						<li style="position:relative;">
							<div class="linkArea">Чиста для ссылки понимаеш!</div>
						<img src="<?=$baseURL.$arrBanOut[$i]['src']?>" title="<?=$arrBanOut[$i]['src']?>"/></li>
		<?	endforeach;?>
					</ul>
				</div> </td>
			<td align="center">
				<div id="gallery2" class="gallery">
					<ul>
		<?	foreach($arrBanOut as $i=>$value):?>
						<li><img src="<?=$baseURL.$arrBanOut[$i]['src']?>" title="<?=$arrBanOut[$i]['src']?>"/></li>
		<?	endforeach;?>
					</ul>
				</div>                 
			</td>
			<td align="center"><div id="gallery3" class="gallery">
					<ul>
		<?	foreach($arrBanOut as $i=>$value):?>
						<li><img src="<?=$baseURL.$arrBanOut[$i]['src']?>" title="<?=$arrBanOut[$i]['src']?>"/></li>
		<?	endforeach;?>
					</ul>
				</div> </td>
			<td style="width:29px;"><button class="next">&gt;</button></td>
		</tr>
		<tr>
		  <td style="width:29px; padding-left:6px;">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td style="width:29px;">&nbsp;</td>
	  </tr>
	</table>
	<? 	// *************************************************************
		//source: http://www.xiper.net/collect/js-plugins/gallery/jcarousellite.html?>
	<script type="text/javascript" src="<?=$baseURL?>js/jcarousellite.js"></script>
	<script src="<?	
	require_once Yii::app()->request->getBaseUrl(true)?>/js/slideshow.js"></script>
	<?	} // **********************************************************
		ob_start();?>  
	  <div id="why_open" class="txtLightBlue">Почему &laquo;Открытие&raquo;?</div>
	  <ol class="insideDiv">
		<li>
			<p>Комплексные финансовые решения для наших клиентов.</p>
			<p>Страховая компания входит в состав Международной Финансовой Корпорации &laquo;Открытие&raquo;.</p></li>
		<li>
			<p>Высочайший уровень обслуживания.</p>
			<p>Компания награждена премией &laquo;Золотая саламандра&raquo; за отличный клиентский сервис.</p>
		
		</li>
		<li>
			<p>Надёжность. 20 лет на рынке страховых услуг.</p>
		</li>
		<li>
			<p>Только опытные и профессиональные сотрудники.<p>
			<p>Собственный центр профессиональной подготовки.</p>
			<p>Гибкие тарифы.</p>
		</li>
		<li>
			<p>Широкая агентская сеть.</p>
		</li>
		
		<li><p>Круглосуточная поддержка клиентов.</p></li>
	  </ol>
	<?	$leftOL=ob_get_contents();
		ob_end_clean();
	
		ob_start();?>
		<div id="content_from_right" class="imgBannerBorder">
	<?	
	require_once Yii::getPathOfAlias('webroot').'/protected/components/submodules/banners2.php';?>	
	</div>
	<?	$rightContent=ob_get_contents();
		ob_end_clean();
		
		if(!setHTML::detectOldIE()){?>
	<div id="content_from_left" align="left">
			<?=$leftOL?>
	</div>
		<?=$rightContent?>
	<?	}else{?>
	<table cellspacing="0" cellpadding="0"<? 
			if (setHTML::detectOldIE()==7){?> style="margin-top:20px;"
		<? 	}
		?>>
	  <tr>
		<td id="leftOL"<? 
			if (setHTML::detectOldIE()==7){?> style="padding-left:23px; width:642px;"
		<? 	}
		?>><?=$leftOL?></td>
		<td valign="top" id="rightBanner"><?=$rightContent?></td>
	  </tr>
	</table>
	<?	}
		
	require_once Yii::getPathOfAlias('webroot').'/protected/components/modules/species/default.php';
		if ($tp){?><h3>/tblSlides</h3><? }?>
			<!-- /tblSlides -->
				<!--<div id="content_from_right" align="center">
				  <img src="<?=Yii::app()->request->baseUrl?>/images/pix/museum.jpg" width="180" height="233">
				  <div id="our_museum" class="txtHeader2">Наш музей</div>
				</div>
				<div class="clear"></div>-->
				<div id="news_block">
		<?	if ($tp){?><h3>last_articles</h3><? }
			$last_arts=false;
			if ($last_arts){?>
					<!--<div align="left" id="last_articles">
					  <div>
						<div class="txtHeader2 txtLightBlue">последние статьи</div>
						<div id="last_articles_previews">
							<div class="floatLeft"><p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
		
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
					</div>-->
		<?	}
			if ($tp){?><h3>/last_articles</h3><? }?>
				  
				</div>
				<div class="clear"></div>
		<?	if ($tp){?><h3>last_seen</h3><? }
			// уже смотрели?
			$seen=false;
			if ($seen){?>
				<!--<div id="last_seen">
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
					  <a href="<? echo "site/";
						//if ($menu):echo "?menu=$menu"; endif;
						//if ($submenu):
							//$usign=($menu)? "&":"?";
							//echo $usign."submenu=$submenu";
						//endif;
						//echo (isset($usign)||$menu)? "&":"?"?>article=<?=$alias?>">
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
				</div>-->
		<?	}else{
				// ещё не смотрели :(
			} 
			if ($tp){?><h3>/last_seen</h3><? }
	}?>