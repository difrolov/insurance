<?php /* @var $this Controller */
		// переменные на время тестирования:
		// режим отображения статических данных включается только при $test=1
		if (isset($_GET['test'])) {
			if(	!$_GET['test']
			 	|| $_GET['test']=='0'
			 	|| strstr($_GET['test'],'-')
			  ) $_SESSION['test']=false;
			else $_SESSION['test']=$_GET['test'];			
		}
		if (isset($_SESSION['test'])) $test=$_SESSION['test'];
		if (isset($test)&&$test==2) {var_dump("<h1>this:</h1><pre>",$this,"</pre>");}

		if (isset($_GET['stop'])&&$_GET['stop']) die("test=stop");
		// test:
			$bg=(isset($_GET['bg']))?$_GET['bg'] : false;
			$bootstrap="static";
			$menu=(isset($_GET['menu']))?$_GET['menu'] : false;
			$submenu=(isset($_GET['submenu']))?$_GET['submenu'] : false;
			if (isset($tp)) {
				$tp=true;
			}else{
				$tp=false;
			}
			if($menu&&$menu!='main') $crumbs=true;
		
		?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta charset="utf-8">
<meta name="language" content="ru">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css">
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
<![endif]-->
</head>
<body>
<div align="center">
  <div class="container" id="page">
<?
	if ($tp){?><h3>fit_height</h3><? }?>
    <div id="fit_height">
      <div>
<?	if ($tp){?><h3>header</h3><? }?>
	    <div id="header">
<?		if ($tp){?><h3>header_top</h3><? }?>
          <div id="header_top">
            <div style="float:left;"><a href="http://www.open.ru"><span class="txtLightBlue">www.open</span>.ru</a></div>
            <div style="float:right;"><a href="map.php" class="txtLightBlue">карта сайта</a></div>
          </div>
<?		if ($tp){?><h3>/header_top</h3><? }?>
		  <div id="logo" align="left">
          	<a href="index.php"><img alt="Открытие Страхование" title="На главную" src="<?=Yii::app()->request->baseUrl?>/images/logos.gif" width="435" height="97" border="0"></a>
	      <?php //echo CHtml::encode(Yii::app()->name); ?>
          </div>
          <div id="call_us" align="right">
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
          </div>
		</div>
<?	if ($tp){?><h3>/header</h3><? }?>
    <!-- header -->
<?	if ($tp){?><h3>mainmenu</h3><? }?>
    <!-- mainmenu -->
	    <div id="mainmenu" align="left">

<?	
		function buildMenu(
						$this_object=false,
						$test=false, 
						$bg=false,
						$submenu=false,
						$arrMenu=false
                      ){
			if ($test==1){
		?>
        	<ul>
<?
				$menu=(isset($_GET['menu']))?$_GET['menu'] : false;
				$submenu=(isset($_GET['submenu']))?$_GET['submenu'] : false;
				if (!$arrMenu)
					$arrMenu=array(
								'main'=>'Главная',
								'company'=>'О компании',
								'corporative'=>'Корпоративным клиентам',
								'business'=>'Малому и среднему бизнесу',
								'personal'=>'Физическим лицам',
								'useful'=>'Полезная информация'
								);
					foreach($arrMenu as $alias=>$text):?>
							<li<?
						if( $menu==$alias
							||(!$menu && $alias=='main')
						   ):?> class="mainmenu_active"<?
						endif;?>><a href="static.php?menu=<? echo $alias;
						if ($bg):?>&bg=<? echo $bg; endif;
						if ($submenu):?>&submenu=<? echo $submenu; endif;?>"><?=$text?></a></li>
				<?php
					endforeach;?>
				</ul>
	<?		}else{
				$this_object->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>'Главная', 'url'=>array('/site/index')),
						array('label'=>'О компании', 'url'=>array('/site/o_kompanii')),
						array('label'=>'Корпоративным клиентам', 'url'=>array('/site/korporativnym_klientam')),
						array('label'=>'Малому и среднему бизнесу', 'url'=>array('/site/malomu_i_srednemu_biznesu')),
						array('label'=>'Физическим лицам', 'url'=>array('/site/fizicheskim_litzam')),
						array('label'=>'Партнёрам', 'url'=>array('/site/partneram')),
						//array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
						//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
					),
				));
			}	
		}
	if (isset($test)) buildMenu(false,$test,$bg);
	else buildMenu($this);?>
	</div>
<?	if ($tp){?><h3>/mainmenu</h3>
		<h3>main_submenu</h3><?
	}?>
    	<div id="main_submenu" align="right">
<?	if(isset($test)&&$test=='1'){?>        
        	<ul>
        <?    $arrSubMenu=array(
		  					'event'=>'Если произошёл страховой случай',
							'application'=>'Отправить заявку',
							'question'=>'Задать вопрос'
		  					);
	foreach($arrSubMenu as $alias=>$text):?>
    		<li<?
		if($submenu==$alias):?> class="submenu_active"<?
		endif;?>><a href="<?=$bootstrap?>.php?submenu=<? echo $alias;
		if ($bg):?>&bg=<? echo $bg; endif;
		if ($menu):?>&menu=<? echo $menu; endif;?>"><?=$text?></a></li>
<?php
	endforeach;?>
      	  </ul>
<?	}else{
		$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Если произошёл страховой случай', 'url'=>array('/site/esli-proizoshel-strahovoj-sluchay')),
				array('label'=>'Отправить заявку', 'url'=>array('/site/otpravit-zajavku')),
				array('label'=>'Задать вопрос', 'url'=>array('/site/zadat-vopros')),
			),
		));
	}?>          
       	</div>
<?	if ($tp){?><h3>/main_submenu</h3><?
	}

	if ($tp){?><h3>breadcrumbs</h3><? }?>
		<div id="breadcrumbs" align="left">
<?php
	if(isset($this->breadcrumbs)){?>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		));
	}elseif($test==1){
		echo "\n";?><a href="#">Главная</a> / <a href="#">Ссылка</a> / <a href="#">Ссылка</a>
		</div>
<?	}
	if ($tp){?><h3>/breadcrumbs</h3><? }?>
	<!-- breadcrumbs -->
	<?php
	
	// режим тестирования и загружена "Главная" стрю:
	if(isset($test)&&$test==1){
		if(isset($crumbs)) {
			if ($tp){?><h3>slide_marks</h3><? }?>
			<div align="left" id="slide_marks">
			<?	for($i=0;$i<8;$i++):?>
				<div>&nbsp;</div>
		<?		endfor;?>
			</div>
	<?		if ($tp){?><h3>/slide_marks</h3><? }?>
			<!-- slide_marks -->
	<?	
			if ($tp){?><h3>tblSlides</h3><? }?>
				<table width="100%" cellspacing="0" cellpadding="0" id="tblSlides">
				  <tr valign="top">
					<td class="slidesPointer"><a href="#"><img src="<?=Yii::app()->request->baseUrl?>/images/pointer_left.png" width="9" height="18" border="0"></a></td>
					<td width="100%">
				<div align="left" id="slides">
				  <div>
					<div class="solution_content">
						<img src="<?=Yii::app()->request->baseUrl?>/images/ready_solutions/for_companies.jpg" width="252" height="143">
						<div>готовые решения для
							<span>производственных компаний</span>
						</div>
					</div>
						<div class="solutions_all">Все решения для<br>
						корпоративных клиентов</div>
				  </div>
				  <div>
					<div class="solution_content">
						<img src="<?=Yii::app()->request->baseUrl?>/images/ready_solutions/for_business.jpg" width="248" height="143">
						<div>готовые решения для
							<span>малого и среднего бизнеса</span>
						</div>
					</div>
						<div class="solutions_all">Все решения для<br>
						малого и среднего бизнеса</div>
				  </div>
				  <div>
					<div class="solution_content">
						<img src="<?=Yii::app()->request->baseUrl?>/images/ready_solutions/for_persons.jpg" width="249" height="143">
						<div>готовые решения для
							<span>клиентов банка открытие</span>
						</div>
					</div>
						<div class="solutions_all">Все решения для<br>
						физических лиц</div>
					</div>
				</div>
					</td>
					<td class="slidesPointer"><a href="#"><img src="<?=Yii::app()->request->baseUrl?>/images/pointer_right.png" width="9" height="18" border="0"></a></td>
				  </tr>
				</table>
		<?php
			if ($tp){?><h3>/tblSlides</h3>
			<h3>content</h3><?
			}
			if (!$test) echo $content;  ?>
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
		<?	if ($tp){?><h3>/content</h3><? }?>
				<div class="clear"></div>
				<div id="news_block">
		<?	if ($tp){?><h3>last_articles</h3><? }?>
					<div align="left" id="last_articles">
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
					  <a href="<? echo $bootstrap.".php";
						if ($menu):echo "?menu=$menu"; endif;
						if ($submenu):
							$usign=($menu)? "&":"?";
							echo $usign."submenu=$submenu";
						endif;
						echo (isset($usign)||$menu)? "&":"?"?>article=<?=$alias?>">
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
		  </div>
		</div>
<?		}else{?>
		Стр: 	
	<?	}
	}
	
	else echo $content;
	
	if ($tp){?><h3>/fit_height</h3>
	<h3>footer</h3><?
	}?>
	<div id="footer">
<?	if ($tp){?><h3>bottom_menu</h3><? }?>
        <div align="left" id="bottom_menu">
	<?	if (isset($test)) buildMenu(false,$test,$bg,$submenu);
		else buildMenu($this);?>
        </div>
<?	if ($tp){?>
		<h3>/bottom_menu</h3>
        <h3>footer_content</h3>
<? 	}?>
    	<div id="footer_content">
        	<div align="left" class="floatLeft">
            	<div style="display:inline-block">
                	<div>&copy; &quot;ОТКРЫТИЕ СТРАХОВАНИЕ&quot; 2012</div>
                    <div>Все права защищены.</div>
                    <div>Адрес: Москва, рядом с Кремлём.</div>
                </div>
                <div id="call_us_free" align="center">
                	<div>8 800 200 71 00</div>
					<div>круглосуточно</div>
				</div>
            </div>
            <div class="floatRight">&nbsp;</div>
        </div>
<?	if ($tp){?><h3>/footer_content</h3><? }?>
	</div>
    <!-- footer -->
<?	if ($tp){?><h3>/footer</h3><? }?><br>
  </div><!-- page -->
</div>
</body>
</html>
