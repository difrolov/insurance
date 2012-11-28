<? if(isset($_GET['stop']))die("index by default"); $tp=false;?>

<!-- slide_marks -->
<?	if ($tp){?><h3>/slide_marks</h3><? }?>
		<!-- /slide_marks -->
		<!-- tblSlides -->
<?		if ($tp){?><h3>tblSlides</h3><? }?>
    	<div align="center" id="slides">
        	<div id="slide-first">
            	<div></div>
            	<div>
                	<div><a href="#">Добровольное мед. страхование</a></div>
                    <div>для корпоративных клиентов</div>
                </div>
            </div>
            <div id="slide-middle">
            	<div></div>
            	<div>
                	<div><a href="#">Финансовые риски</a></div>
                    <div>малому и среднему бизнесу</div>
                </div>
            </div>
            <div id="slide-last">
            	<div></div>
            	<div>
                	<div><a href="#">Страхование квартиры</a></div>
                    <div>Для физических лиц</div>
                </div>
            </div>
        </div>
        
<div id="content_from_left" align="left">
  <div id="why_open" class="txtLightBlue">Почему &laquo;Открытие&raquo;?</div>
  <!--<p>Сайт предназначен для:</p>-->
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
</div>


<div id="content_from_right"><img src="<?=Yii::app()->request->getBaseUrl(true)?>/images/pix/old_cars.gif" width="296" height="284">
</div>
<div id="bottom_insur">
	<div id="mod_insur_species">
	<h2 class="txtLightBlue">Виды страхования</h2>
	<div><img src="<?=Yii::app()->request->getBaseUrl(true)?>/images/modules/insurance_species/car.png" width="77" height="49">
    <a href="#" class="txtLightBlue">Автострахование</a></div>
    <div><img src="<?=Yii::app()->request->getBaseUrl(true)?>/images/modules/insurance_species/health.png" width="54" height="47">
    <a href="#" class="txtLightBlue">Здоровье</a></div>
    <div><img src="<?=Yii::app()->request->getBaseUrl(true)?>/images/modules/insurance_species/home.png" width="67" height="50">
    <a href="#" class="txtLightBlue">Имущество</a></div>
    <div><img src="<?=Yii::app()->request->getBaseUrl(true)?>/images/modules/insurance_species/travel.png" width="63" height="52">
    <a href="#" class="txtLightBlue">Путешествия</a></div>
</div>        
	<div align="left" id="last_news" style="position:relative;">
        <div class="clear">Новости</div>
        <!--<p class="txtLightBlue txtInpact floatLeft" id="textLastNew">Последняя новость</p>-->
        <div class="clear" style="margin-bottom:26px;">
        <span id="issue_date" style="margin-top:20px;">31.08.2012</span>
        <span class="floatRight txtLightBlue" id="all_news" style="border-bottom:dotted 1px; font-size:10.5px; margin-top:18px;"><a href="#" style="text-decoration:none;">все новости</a></span>
        </div>
        <p id="new_preview">
        <!--В рамках начала сотрудничества с информационным порталом, директор нашего главного департамента дала  развёрнутое интервью о перспективах развития коммерческой недвижимости в России, осветив общую ситуацию послекризисного 2009 года.-->
        мы делаем вам подарок мы делаем вам подарок мы делаем вам подарок мы делаем вам подарок мы делаем вам подарок мы делаем вам подарок мы делаем вам подарок</p>
    </div>        
</div>
<?	if ($tp){?><h3>/tblSlides</h3><? }?>
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
		
		?>
	
	<? 	} 
		if ($tp){?><h3>/last_seen</h3><? }?>
