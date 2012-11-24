<?
class setHTML{
	protected static $arrAvoidSubmenu=array('site/index');
	static $arrMenuWidget;
	static $arrMenuWidgetSecond;
	
/**
 * @package HTML
 * @subpackage navigation
 *
 */
	function buildBreadCrumbs(){?>
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
<?	}
/**
 * @package HTML
 * @subpackage product
 */
	function buildCatalogue($consumer_type=false){
	// получить тип субъекта:
	$current_controller=Yii::app()->controller->getId();
	// получить все решения для данного типа субъекта:
	$solutions=readyProduct::getAllSolutionsNames($current_controller);
	if (!$solutions){
		$scount=10;
	}else{
		$scount=count($solutions);
	}
	// получить все программы для данного типа субъекта:
	$programs=readyProduct::getAllProgramsNames($current_controller);
	if (!$programs){
		$pcount=10;
	}else{
		$pcount=count($programs);
	}?>
<table class="inner_layout" cellspacing="0">
  <tr>
    <th>Готовые решения</th>
    <th>Программы</th>
  </tr>
  <tr>
    <td id="cellSolutions">
<?	foreach($solutions as $solution)
		self::showReadySolutionBlock($solution);?>      
	</td>
    <td id="cellPrograms">
<?	//var_dump("<h1>programs:</h1><pre>",$programs,"</pre>");
	for ($i=0,$j=count($programs);$i<$j;$i+=2){?>
	  <div>
		<? readyProduct::showProgram($programs[$i]);?>
      </div>
	<?	if(($i+1)<$j){?>
	  <div>
		<? readyProduct::showProgram($programs[$i+1]);?>
      </div>
<?		}
	}?>      
	</td>
  </tr>
</table>
<?	}
/**
 * @package		HTML
 * @subpackage		contacts
 *
 */
	function buildContactsAndSearchBlock(){?>
    		<div id="call_us" align="right">
          	<div align="center" id="all_phones">
              <div id="cmd_micro">
              	<div data-home="home" title="На главную" onClick="location.href='<?=Yii::app()->request->getBaseUrl(true);?>/'">&nbsp;</div>
                <div data-map="map" title="Карта сайта" onClick="location.href='<?=Yii::app()->request->getBaseUrl(true);?>/map.php"><a href="<?=Yii::app()->request->getBaseUrl(true);?>/map.php'">&nbsp;</a></div>
                <div data-search="search" title="Поиск" onClick="location.href='<?=Yii::app()->request->getBaseUrl(true);?>/search.php'">&nbsp;</div>
              </div>
           	  <div id="free_line" class="txtLightBlue">8 800 200 71 00</div>
			  <div id="free_line_always" class="txtLightBlue">круглосуточно</div>
                <div id="free_line_local" align="center">+7 495 649 71 71</div>
			</div>
          </div>
<? 	}
/**
 * @package		HTML
 * @subpackage		menu
 *
 */
	function buildDropDownMenu($submenu=false){
		$menuItems=self::getMainMenuItems($submenu);
		foreach($menuItems as $parent_id=>$parent_data){
			if (!in_array($parent_data['alias'],self::$arrAvoidSubmenu)) 
				self::buildDropDownSubMenu($parent_data['alias'],$parent_id);
		}
	}
/**
 * @package		HTML
 * @subpackage		menu
 *
 */
	function buildDropDownSubMenu($parent_alias='',$parent_id=false){
		$test=(isset($_GET['test']))? true:false; if ($test) echo "<h3>parent_id=$parent_id</h3>";?>
        
        <div<? if ($parent_alias) {?> id="ddMenu_<?=$parent_alias?>"<? }if($test){?> style="top:0;display:none;" class="testScroll"<? }?>>
	<?	$subMenuItems=Data::getObjectsRecursive(false, // поля извлечения данных
								  		  		$parent_id);
		if ($parent_alias=="korporativnym_klientam") {?>
          <ul class="asTable">
			<li>
            	<div class="txtLightBlue txtMediumSmall">Виды страхования</div>
			<? self::buildSubmenuLinks($subMenuItems,$parent_alias);?></li>
        <?	$corps=true;
			if ($corps){
				$arrCorps=array(
						'building'=>'Строительные компании',
						'trucking'=>'Транспортные компании',
						'entertainment'=>'Организация развлекательных и спортивных мероприятий',
						);?>
            <li style="width:20px;">&nbsp;</li>
        	<li>
        		<div class="txtLightBlue txtMediumSmall">Корпоративным клиентам</div>
                <div class="txtGrey">
            <?	foreach($arrCorps as $alias=>$text):?>
            		<a href="<?=Yii::app()->request->baseUrl.'/'.$parent_alias.'/'.$alias?>"><?=$text?></a>
            <?	endforeach;?>    
            	</div>
            </li>
		<?	}?>
          </ul>
	<?	}else
			//echo "<div class='testBlock'>"; var_dump("<pre>",$subMenuItems,"</pre>");
			self::buildSubmenuLinks($subMenuItems,$parent_alias,true); //echo "</div>";?>
        </div> 
<?	}
/**
 * @package		HTML
 * @subpackage		footer
 *
 */
	function buildFooterBlock($tp=false){?>
			<div align="left" id="footer">
            <hr noshade size="1" style="margin-bottom:0; margin-left:-20px; margin-right:-20px;">
            <hr noshade size="1" style="margin:-4px -20px -8px -20px;">
  	<!--bottom_menu-->
	<?	if ($tp){?><h3>bottom_menu</h3><? }?>
        <div align="left" id="bottom_menu">
	<?	setHTML::buildMainMenu($this); echo "\n"?>
        </div>
			<?	if ($tp){?><h3>/bottom_menu</h3><? }?>
  	<!--/bottom_menu-->
  	<!--footer_content-->
	<?	if ($tp){?><h3>footer_content</h3><? }?>
    	<div id="footer_content">
                <div id="footer_inside_left">
                	<div><a href="<?=Yii::app()->request->getBaseUrl(true)?>">www.open.ru</a></div>
					<div class="tiny_info">Финансовая корпорация &quot;Открытие&quot;</div>
				</div>
            	
                <div id="footer_inside_center">
                	<div id="fcompany">&copy; &quot;ОТКРЫТИЕ СТРАХОВАНИЕ&quot; 2012</div>
                    <div id="faddress">Адрес: 23007, Москва, ул. 4-я Магистральная, д. 11, стр. 2</div>
                    <div id="fcopy" class="tiny_info">&copy; &quot;Открытие страхование&quot; 2012</div>
                </div>
            	
                <div id="footer_inside_right">
            		<div align="right">8 800 200 71 00</div>
					<div class="tiny_info" id="overnight_calling" align="right">круглосуточно</div>
            
		</div>
        	
        </div>
			<?	if ($tp){?><h3>/footer_content</h3><? }?>
  	<!--/footer_content-->
  </div>
<?	}
/**
 * @package		HTML
 * @subpackage		logo
 *
 */
	function buildLastArticles(){
		ob_start();?>
		<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
	
				diam nonumy eirmod tempor invidunt ut labore et dolore magna
	
				aliquyam erat, sed diam voluptua. At vero eos et accusam et
	
				justo duo dolores et ea rebum. Stet clita kasd gubergren, no
	
				sea takimata sanctus est Lorem ipsum dolor sit amet.</p>        
<?		$articles[]=ob_get_contents();
		ob_end_clean();
		ob_start();?>
		<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
	
				diam nonumy eirmod tempor invidunt ut labore et dolore magna
	
				aliquyam erat, sed diam voluptua. At vero eos et accusam et
	
				justo duo dolores et ea rebum. Stet clita kasd gubergren, no
	
				sea takimata sanctus est Lorem ipsum dolor sit amet.</p>        
<?		$articles[]=ob_get_contents();
		ob_end_clean();
		return $articles;
	}
/**
 * @package		HTML
 * @subpackage		data
 *
 */
	function buildLastNews(){?>
					<div class="txtHeader3 txtLightBlue">новости</div>
					<p id="issue_date">31.08.2012</p>
					<p>В рамках начала сотрудничества с информационным порталом, директор нашего главного департамента дала  развёрнутое интервью о перспективах развития коммерческой недвижимости в России, осветив общую ситуацию послекризисного 2009 года.</p>
					<p id="all_news"><a href="#">все новости...</a></p>
<?	}
/**
 * @package		HTML
 * @subpackage		logo
 *
 */
	function buildLogosBlock(){?>
				<div id="logo" align="left">
                    <a href="<?=Yii::app()->request->getBaseUrl(true)?>"><?
    	if (isset($test_logo)){
			?><img src="../../../images/logo.gif" width="372" height="80"><? 
		}else{?><img alt="Открытие Страхование" title="На главную" src="<?=Yii::app()->request->getBaseUrl(true)?>/images/logo.gif" width="372" height="80" border="0"><? }?></a>
                </div>
<?	}
/**
 * @package		HTML
 * @subpackage		menu
 * построить меню верхнего уровня
 */
	function buildMainMenu(
					$this_object,
					$submenu=false
				  ){
		$mainPageAlias='site/index';
		$currentController=Yii::app()->controller->getId();
		$menuWidget=($submenu)? self::$arrMenuWidgetSecond:self::$arrMenuWidget;
		if (!$menuWidget) { // если меню ещё не создавали. Иначе получит из статического массива, дабы не выполнять процедуру повторно для нижнего меню
			$newborn_menu=true; 
			$arrMenu=self::getMainMenuItems($submenu);
			foreach($arrMenu as $parent_id=>$parent_data) {
				$text=$parent_data['text'];
				$alias=$parent_data['alias'];
				$arr=array('label'=>$text, 'url'=>array('/'.$alias.'/'));
				if ($alias!=$mainPageAlias)
					$arr['active']= $currentController == $alias;
				$menuWidget[]=$arr; 
			}
			if ($submenu)
				self::$arrMenuWidgetSecond=$menuWidget;
			else
				self::$arrMenuWidget=$menuWidget;
		}
		// старый IE
		if (self::detectOldIE()){ //
			$URL=explode("/",$_SERVER['REQUEST_URI']);
			$nURL=array_reverse($URL);
			if ($nURL[1]=='index')
				$urlAlias='/'.$nURL[2].'/'.$nURL[1].'/';
			else $urlAlias='/'.$nURL[1].'/';?>
        <ul<? //id=yw0?>>
		<?	$menuItems=self::getMainMenuItems($submenu);
			$dx=array_shift($menuItems);
			foreach($menuItems as $parent_id=>$parentData){
				$alias=$parentData['alias'];
				$text=$parentData['text'];?>
			<li<? if ($urlAlias==$alias):?> class="active"<? endif;?>><a href="<?php echo Yii::app()->request->baseUrl.$alias; ?>"><?
					echo $text;?></a>
			<?	if ( $alias!='/'.$mainPageAlias.'/'
			         && isset($newborn_menu)
				   ) self::buildDropDownSubMenu($parentData['alias'],$parent_id);?>
            </li>	
		<?	}?>
        </ul>
	<?	}else $this_object->widget( 'zii.widgets.CMenu',
							  array('items'=>$menuWidget)
							);
	}
/**
 * @package		HTML
 * @subpackage		navigation
 *
 */
	function buildPointersNext($direction){?>
		<a href="#"><img src="<?=Yii::app()->request->baseUrl?>/images/pointer_<?=$direction?>.png" width="9" height="18" border="0"></a>
<?	}
/**
 * @package		HTML
 * @subpackage		logo
 *
 */
	function buildReadySolutionsBlock($consumer_type){
		switch($consumer_type){
			case "corporative":
				$img="for_companies";
				$ready_target="производственных компаний";
				$all_ready_target="корпоративных клиентов";
			break;
			case "smallBusiness":
				$img="for_business";
				$ready_target="малого и среднего бизнеса";
				$all_ready_target="малого и среднего бизнеса";
			break;
			case "privatePersons":
				$img="for_persons";
				$ready_target="клиентов банка &quot;Открытие&quot;";
				$all_ready_target="физических лиц";
			break;			
		}?>
				<div class="solution_content"><?
    	if (isset($test_logo)){
			?><img src="../../../images/ready_solutions/for_business.jpg" width="248" height="143"><? 
		}else{?><img src="<?=Yii::app()->request->getBaseUrl(true)?>/images/ready_solutions/<?=$img?>.jpg" width="252" height="143"><? }?>
					<div>готовые решения для
						<span><?=$ready_target?></span>
					</div>
				</div>
				<div class="solutions_all">Все решения для<br><?
					echo $all_ready_target;
					?></div>
<?	}
/**
 *
 *
 */
	function buildSearchForm(){?>
              	<div id="search">
                	<form>
                		<input name="search" type="text">
                    	<input type="image" src="<?=Yii::app()->request->baseUrl?>/images/search_button.png">
                    </form>
                </div>
<?	}
/**
 * @package		HTML
 * @subpackage		menu
 * построить контент подменю
 */
	function buildSubmenuLinks( $subMenuItems,
								$parent_alias,
								$topAlias=false // самое верхнее меню alias
							  ){
		if($topAlias){
			$topLevelAlias=($topAlias===true)? $parent_alias:$topAlias;
		}
		if (!isset($topLevelAlias)) $topLevelAlias=false;
		
		if (is_array($subMenuItems)){
			foreach($subMenuItems as $alias_value=>$link_text):
				if (is_array($link_text)){
					$level=(isset($link_text['level']))? $link_text['level']:0;
					if ($level>1){?><blockquote><? }
					self::buildSubmenuLinks($link_text,&$parent_alias,&$topLevelAlias);
					if ($level>1) {?></blockquote><? }
				}elseif ($alias_value=="name"){
					/*echo "<div class=''>parent_alias= ".$parent_alias;
					if(isset($topLevelAlias)) echo ", topLevelAlias= $topLevelAlias";
					else echo ", <h1 style='color:red'>NO topLevelAlias!</h1>";
					echo "</div>";*/
						?><a href="<?=Yii::app()->request->baseUrl.'/';
						$level=$subMenuItems['level'];
						if ($level==1) {
							$parent_alias=$topLevelAlias;
							$link=$topLevelAlias."/".$subMenuItems['alias'];
						}
						if (isset($subMenuItems['children'])||$level>1){
							$link=$parent_alias.'/'.$subMenuItems['alias'];						
							if(isset($subMenuItems['children']))
								$parent_alias.='/'.$subMenuItems['alias'];
						}
					echo $link;?>"><?=$link_text?></a><?	
				}
			endforeach;
		}
	}
/**
 * @package		HTML
 * @subpackage		menu
 * получить меню верхнего уровня
 */
	function getMainMenuItems($parent_id_level=false){ 
		if (!$parent_id_level) $parent_id_level='-1';
		$data=Yii::app()->db->createCommand("SELECT `id`, `name`, `alias` FROM insur_insurance_object WHERE `parent_id` = ".$parent_id_level.' AND status = 1 ORDER BY id')->queryAll(); 
		for($i=0,$j=count($data);$i<$j;$i++){
			$menuItems[$data[$i]['id']]=array('text'=>$data[$i]['name'],
											 'alias'=>$data[$i]['alias']
											);
		}
		return $menuItems;
	}
/**
 * @package		interface
 * @subpackage		browser
 *
 */
	function detectOldIE($version=array(6,7,8)){
		$usAg=$_SERVER['HTTP_USER_AGENT'];
		for($i=0,$j=count($version);$i<$j;$i++)
			if ( stristr($usAg,'MSIE '.$version[$i].'.')) {
				$old_versions[]=$version[$i];
			}
		return (isset($old_versions))? true:false;	
	}
/**
 * @package		interface
 * @subpackage		buttons
 *
 */
	function setButtonPrint(){?>
    <button onClick="window.print();">Печать страницы</button>
<?	}
/**
 * Получает данные от Data::getObjectByUrl() в виде объекта активной записи в insur_insurance_object (setPageData()::$section_data = Data::getObjectByUrl()->res)
 * @package		content
 * @subpackage		metadata
 * Загрузить макет подраздела, разместить данные и выдать в HTML
 */
	function setPageData( $this_obj, 
						  $section_data, 
						  $test=false
						){
		// генерирует и размещает title страницы:
		$this_obj->pageTitle=Yii::app()->name . ' - '.$section_data->title;
		// генерирует и размещает название страницы в цепочке breadcrumbs:
		$breadcrumbs=array();
		if ($section_data->parent_id>0)	{	
			$parentName=InsurInsuranceObject::model()->find(array(
							'select'=>'name',
							'condition'=>'id = '.$section_data->parent_id,
						)); 
			$this_obj->breadcrumbs=array(
				$parentName->name=>array('index'),
				$section_data->name
			);
		}else 
			$this_obj->breadcrumbs=array(
				$section_data->name,
			);
		// устанавливает description страницы:
		Yii::app()->clientScript->registerMetaTag($section_data->description, 'description');
		// прописывает первый заголовок на странице, сразу же под breadcrumbs.
		// если заголовок не установлен (нет в БД), подставляет название страницы:
		if (!$section_data->first_header)
			$section_data->first_header=$section_data->name;
	$arrItems=array( 'О компании',  
					 'О корпорации',  
					 'Руководство',  
					 'Раскрытие информации',  
					 'Клиенты компании',  
					 'Партнеры компании', 
					 'Новости компании',  
					 'Вакансии',  
					 'Контакты');
	$items_data=Yii::app()->db->createCommand("
	SELECT id, name,  `status` , 
		IF( parent_id <0, 
			(	SELECT alias
				FROM insur_insurance_object
				WHERE id = i2.id
			), 
			(	SELECT alias
				FROM insur_insurance_object
				WHERE id = i2.parent_id
			) 
		) AS parent, alias
		FROM insur_insurance_object AS i2
		WHERE name
		IN (  '".implode("','",$arrItems)."'
			)")->queryAll();?>
	<div id="inner_left_menu">
	<?	$cnt=0;		
		for($i=0,$j=count($arrItems);$i<$j;$i++){?>
        <div<?
			
			if ( isset($_GET['alias'])
				 && $items_data[$cnt]['alias']
				 && $arrItems[$i]==$items_data[$cnt]['name']
			   ) : 	if ($_GET['alias']==$items_data[$cnt]['alias']):
						?> class="active"<? 
					endif;
			endif;?>><?		
			
			if ($arrItems[$i]==$items_data[$cnt]['name']){?>
            	<a href="<?=Yii::app()->request->getBaseUrl(true)?>/<?
                echo $items_data[$cnt]['parent'];
				if ($items_data[$cnt]['parent']!=$items_data[$cnt]['alias']){
					?>/<? echo $items_data[$cnt]['alias'];
				}?>"><?=$items_data[$cnt]['name']?></a>
	<?		}else{
				echo $arrItems[$i];
				$cnt--;
			}
			$cnt++;?>
        </div>
	<?	}?>
    		
    </div>
    <?	// если тестируемся:
		if ($test) {
			// это он - заголовок :)
			echo "<h1>HEADER: ".$section_data->first_header."</h1>";
			echo "parent_id = ".$section_data->parent_id."<hr>";
			echo "title: ".$section_data->title."<hr>";
			echo "keywords: ".$section_data->keywords."<hr>";
			echo "description: ".$section_data->description."<hr>";
		}
		else { // загрузить макет
			$tmpl=unserialize($section_data->content);?>
    <div id="inner_content" class="<?=$tmpl['Schema']?>">
		<?	$bloxCnt=$colCount=(int)$tmpl['Schema'][0];
			$bloxHeaderType=$tmpl['Schema'][1];
			$bloxFooterType=$tmpl['Schema'][2];
			$bWidths=array();
			$bWidths[0]=100/$colCount;
			
			if ($bloxHeaderType!='0')
				$bloxCnt++;
			if ($bloxFooterType!='0')
				$bloxCnt++;
			
			
			//echo "<div class=''>bloxCnt = ".$bloxCnt.", bloxHeaderType = $bloxHeaderType, bloxFooterType = $bloxFooterType</div>";
			
			/*
			 * См. схему построения макетов в файле:
			 * /_docs/схема.xslx!Макет для создания разделов
			 */
			if( ( $bloxHeaderType=='0' 	// нет подзаголовка
				  || ( $bloxHeaderType=='i' // есть, но только внутренний
				  	   && $colCount==3		// 3 колонки, что значит - ширина распределяется поровну
					 )
				) && $bloxFooterType=='0'	// нет псевдофутера
			  ){ // тупо делим 100% на количество колонок
				// 100, 200, 300, 400
				$cWidth=$bWidths[0];	// echo "<div class=''>= NO ARRAY</div>";
				unset($bWidths); // больше не нужен
			}else{	
				if ($colCount==3){
					// ширина 2-й, 3-й, 4-й колонок по умолчанию:
					$bWidths[1]=$bWidths[2]=$bWidths[3]=100/3; // ~33%
					// если заголовок внутренний, изменить ширину 2-й:
					if ($bloxHeaderType=='s'){ 
						$bWidths[1]*=2; // ~66%
						if($bloxFooterType=='s')
							$bWidths[4]=$bWidths[1]; // ~66%
					}
					else // изменить ширину 4-й:
						$bWidths[3]*=2; // ~66%
				}elseif($colCount==4){
					$bWidths[1]=$bWidths[2]=$bWidths[3]=25; // by default
					if ($bloxHeaderType=='i') // 4i
						$bWidths[1]=50;
					else{
						if($bloxHeaderType=='s') // 4s
							$bWidths[1]=75;
						elseif($bloxHeaderType=='0') {//40i, 40s
							if ($bloxFooterType=='i') 
								$bWidths[3]=50;
							elseif($bloxFooterType=='s') 
								$bWidths[3]=75;
						}
					}
					if ($bloxHeaderType!='0') {
						$bWidths[4]=25;
						if ($bloxFooterType=='i')
							$bWidths[5]=50;
						elseif ($bloxFooterType=='s')
							$bWidths[5]=75;
					}
				}
				
			} echo "<div class=''>colCount= ".$colCount.", bloxHeaderType= $bloxHeaderType, bloxFooterType= $bloxFooterType</div>"; var_dump("<h1>bWidths:</h1><pre>",$bWidths,"</pre>");	die();
			for ($i=0;$i<$bloxCnt;$i++){?>
				<div class="float<? // установить обтекание:
				echo ( $i==2
				   	   && $bloxHeaderType=='s'  
				   	 ) ? // сразу за внутренним заголовком
					"Right":"Left";
				?>" style=" <?		
                // если есть заголовок, добавить отступ слева, равный ширине левой колонки
				if( ( $bloxHeaderType!='0'
				  	  && $i==1 // это он, заголовок!
					) ||
					( $bloxFooterType!='0'
				  	  && $i==($bloxCnt-1) // это псевдофутер!
					)
				  ){?> margin-left:<?=$offsetLeft?>%;<? 
				  	$bWidths[$i]-=$bWidths[0]; // уменьшить ширину, чтобы нивелировать margin слева 
				  } 
				  ?>width:<?
				if(isset($cWidth)){ // все колонки одинаковые по ширине
					echo $cWidth;
					$offsetLeft=$cWidth;
				}else{ 
					echo $bWidths[$i];
					$offsetLeft=$bWidths[0];
				}?>%;">
                	<div class="testBlock">
                    	inner block block # <?=$i+1?>
                	</div>
                </div>	
		<?	}

			
			var_dump("<h1>tmpl:</h1><pre>",$tmpl,"</pre>");?>
   </div>     
	<?	}
	}
/**
 * @package		content
 * @subpackage		news
 *
 */
	function showNews($src=false,$content=false){
		if (!$content) {
			$content="Итак, здесь у нас превью новости. Новость такая новость.
			<p>А в последствии, между прочим, новости будут гороздо новостней, чем сейчас.</p>";
		}?>
	<div class="company_news"><img align="left" name="placeholder" src="<?=$src?>" width="48" height="64" alt="" style="background-color: #99FFCC" /><?=$content?>
    	<div align="right"><?='<a href="#">'?>Подробности<?='&gt;&gt;&gt;</a>'?></div>
    </div>
    <br>
<?	}
/**
 * @package		content
 * @subpackage		product
 *
 */
	function showReadySolutionBlock($params=NULL){
		if (!$params['name']) {
			$solution_name="Готовое решение (наименование)";
		}else $solution_name=$params['name'];
		if (!$params['id']) {
			$link="#";
		}else{ 
			$link=Yii::app()->request->baseUrl."/".Yii::app()->controller->getId()."/Gotovoye_reshenije/".$params['id'];
		}?>
	<div class="ready_solution_preview">
    	<div><img align="left" name="placeholder" src="<?=$params['icon_src']?>" width="64" height="64" alt="" style="background-color: #ededed" />
		</div>
		<div><?='<a href="'.$link.'">'.$solution_name.'</a>'?></div>
    </div>
    <div class="clear">&nbsp;</div>
<?	}
}
?>