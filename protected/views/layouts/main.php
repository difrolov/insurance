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
<?	// если главная, удалим отступы главного контейнера:
	if (!isset($this->breadcrumbs)||!$this->breadcrumbs):?>
<style>
div#content{
	padding:0;
}
</style>
<? 	endif;?>
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
          	<a href="<?=Yii::app()->request->baseUrl?>/site/index"><img alt="Открытие Страхование" title="На главную" src="<?=Yii::app()->request->baseUrl?>/images/logos.gif" width="435" height="97" border="0"></a>
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
				array('label'=>'Если произошёл страховой случай', 'url'=>array('/site/esli_proizoshel_strahovoj_sluchay')),
				array('label'=>'Отправить заявку', 'url'=>array('/site/otpravit_zajavku')),
				array('label'=>'Задать вопрос', 'url'=>array('/site/zadat_vopros')),
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
<?	}?>
		</div>
<?	if ($tp){?><h3>/breadcrumbs</h3><? }?>
	<!-- breadcrumbs -->
	<?php echo $content;
	
	if ($tp){?><h3>/fit_height</h3>
	<h3>footer</h3><?
	}?>
	<div align="left" id="footer">
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
