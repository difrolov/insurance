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
	static function buildContactsAndSearchBlock(){?>
    		<div id="call_us" align="right">
          	<div align="center" id="all_phones">
              <div id="cmd_micro">
<?	$arrPyctosGo=array(
				'home'=>array('title'=>'На главную','href'=>'/','width'=>'18'),
				'map'=>array('title'=>'Карта сайта','href'=>'/site/map','width'=>'18'),
				'search'=>array('title'=>'Поиск','href'=>'/site/search','width'=>'18'),
			);
	foreach ($arrPyctosGo as $data=>$array):?>
                <div data-<?=$data?>="<?=$data?>" title="<?=$array['title']?>" onClick="location.href='<?=Yii::app()->request->getBaseUrl(true).$array['href']?>'">
           			<a href="<?=Yii::app()->request->getBaseUrl(true).$array['href']?>"><img style="opacity:0;" src="<?=Yii::app()->request->getBaseUrl(true);?>/images/spacer.png" width="<?=$array['width']?>" height="16"></a>
                </div>
<?	endforeach;?>
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
	static function buildDropDownMenu($submenu=false){
		$menuItems=self::getMainMenuItems($submenu);
		foreach($menuItems as $parent_id=>$parent_data){
			if (!in_array($parent_data['alias'],self::$arrAvoidSubmenu)) 
				self::buildDropDownSubMenu($parent_data['alias'],$parent_id,true);
		}
	}
/**
 * @package		HTML
 * @subpackage		menu
 *
 */
	static function buildDropDownSubMenu($parent_alias='',$parent_id=false,$top_level=false){
		static $insur_species='<div class="txtLightBlue txtMediumSmall">Виды страхования</div><hr style="opacity:0.5;">';
		$test=(isset($_GET['test']))? true:false; if ($test) echo "<h3>parent_id=$parent_id</h3>";?>
        <div<? if ($parent_alias) {?> id="ddMenu_<?=$parent_alias?>"<? }if($test){?> style="top:0;display:none;" class="testScroll"<? }?>>
	<?	if ($top_level) 
			echo $insur_species; 
		$subMenuItems=Data::getObjectsRecursive(false, // поля извлечения данных
								  		  		$parent_id);
		if ($parent_alias=="korporativnym_klientam") {?>
          <ul class="asTable">
			<li>
		<?	self::buildSubmenuLinks($subMenuItems,$parent_alias,true);?></li>
        <?	$corps=false;
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
			self::buildSubmenuLinks($subMenuItems,$parent_alias,true);?>
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
 * Построить левое статическое меню, идентичное по содержанию выпадающему
 * @package
 * @subpackage
 */
	static function buildLeftStaticMenu($section_id){
		$top_alias=Yii::app()->controller->getId();
		$top_id = Yii::app()->db->createCommand()->select('id')->from('insur_insurance_object')->where('alias="'.$top_alias.'"')->queryScalar();
		$items_data=Data::getObjectsRecursive( false, // поля извлечения данных
								  		  	   $top_id);
		self::buildSubmenuLinks($items_data,$top_alias,$section=array('section_id'=>$section_id));
	}
/**
 * @package		HTML
 * @subpackage		logo
 *
 */
	static function buildLogosBlock(){?>
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
	static function buildMainMenu(
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
	static function buildSubmenuLinks( $subMenuItems,
								$parent_alias,
								$topAlias=false // самое верхнее меню alias
							  ){
		static $prev_level='top'; // для управления цепочкой родительских алиасов
		
		static $curControllerLeftMenu; // для управления доступом к главному и левому меню
		
		if($topAlias){
			if( $topAlias===true // пришли из главного меню
				|| is_array($topAlias) // пришли из левого меню
			  ) {
				$topLevelAlias=$parent_alias;
				$curControllerLeftMenu=(is_array($topAlias))? $topAlias['section_id']:0;
			}else{
				$topLevelAlias=$topAlias;
			}
		}
		if (!isset($topLevelAlias)) $topLevelAlias=false;
		
		if (is_array($subMenuItems)){
			foreach($subMenuItems as $alias_value=>$link_text):
				if (is_array($link_text)){
					$level=(isset($link_text['level']))? $link_text['level']:0;
					if ($level>1){?><blockquote><? } // echo "<div class='testBlock'>prev_level(".gettype($prev_level).") = ".$prev_level."</div>";
					self::buildSubmenuLinks($link_text,&$parent_alias,&$topLevelAlias);
					if ($level>1) {?></blockquote><? }
				}elseif ($alias_value=="name"){
					$level=$subMenuItems['level'];
					// echo "<div class=''>current_level(".gettype($level).")= $level";
					// if(isset($topLevelAlias)) echo "<br><b>topLevelAlias:</b><br>$topLevelAlias";
					// else echo ", <h1 style='color:red'>NO topLevelAlias!</h1>";
					//echo "</div>"; //**********************************
						
					if ($level==1) {
						$parent_alias=$topLevelAlias;
						$link=$topLevelAlias."/".$subMenuItems['alias'];
					}elseif($level<$prev_level){ // данный подраздел находится выше предыдущего
						// будем вырезать промежуточные алиасы:
						$aDiff=$prev_level-$level;
						$parentAliases=explode("/",$parent_alias);
						while($aDiff){
							array_pop($parentAliases);
							$aDiff--;
						}
						$parent_alias=implode("/",$parentAliases);
					}
					if ( isset($subMenuItems['children']) // есть вложенные уровни
						 || $level>1	// вложенных нет, есть родительские
					   ){
						$link=$parent_alias.'/'.$subMenuItems['alias'];						
						if(isset($subMenuItems['children']))
							$parent_alias.='/'.$subMenuItems['alias'];
					}
					$prev_level=$level; // установим текущий уровень подраздела 
					ob_start(); 
						?><a href="<?=Yii::app()->request->baseUrl.'/'.$link;?>"><?=$link_text?></a><? 	$linkContent=ob_get_contents();
					ob_get_clean();
					if ($curControllerLeftMenu){
			?><div<?	// 
						if ($curControllerLeftMenu==$subMenuItems["id"]):
		
			?> class="active"<? 
		
						endif;?>><?	echo $linkContent;
		
			?></div><?	
		
					}else echo $linkContent;
				}
			endforeach;
		}
	}
/**
 * @package		HTML
 * @subpackage		menu
 * получить меню верхнего уровня
 */
	static function getMainMenuItems($parent_id_level=false){ 
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
	static function detectOldIE($version=array(6,7,8)){
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
 * Основной метод, создающий контент подраздела на основе поля insur_insurance_object.content (это то, что можно создавать в качестве подразделов сайта в Генераторе)
 * Получает данные от Data::getObjectByUrl() в виде объекта активной записи в insur_insurance_object (setPageData()::$section_data = Data::getObjectByUrl()->res)
 * @package		content
 * @subpackage		metadata
 * Загрузить макет подраздела, разместить в HTML
 */
	static function setPageData( $this_obj, 
						  $section_data, 
						  $asModule=false
						){	$test=false; // принудительно
		// HEADER
		// ***** NOTICE: ************************************************ 
		// Title для подразделов устанавливается в Data::getObjectByUrl()
		// непосредственно перед рендерингом страницы
		// **************************************************************
		// устанавливает description страницы:
		Yii::app()->clientScript->registerMetaTag($section_data->description, 'description');
		// устанавливает keywords страницы:
		Yii::app()->clientScript->registerMetaTag($section_data->keywords, 'keywords');
		// соорудить цепочку ссылок:
		$breadcrumbs=array();
		if ($section_data->parent_id>0)	{	
			// получить имя и алиас для размещения в цепочке:
			$parentName=InsurInsuranceObject::model()->find(array(
							'select'=>'name,alias',
							'condition'=>'id = '.$section_data->parent_id,
						)); 
			$top_name=Yii::app()->db->createCommand()->select('name')->from('insur_insurance_object')->where('alias="'.Yii::app()->controller->getId().'"')->queryScalar();				
						
			$this_obj->breadcrumbs=array(
				$top_name=>array('index'),
				$parentName->name=>array($parentName->alias),
				$section_data->name
			);
		}else 
			$this_obj->breadcrumbs=array(
				$section_data->name,
			);
		// прописывает первый заголовок на странице, сразу же под breadcrumbs.
		// если заголовок не установлен (нет в БД), подставляет название страницы:
		if (!$section_data->first_header)
			$section_data->first_header=$section_data->name;?>
	<div id="inner_left_menu">
	<?	// сгенерировать ссылки:
		self::buildLeftStaticMenu($section_data->id);?>
    </div>
    <?	// если тестируемся:
		if ($test) {
			// это он - заголовок :)
			echo "<h1>HEADER: ".$section_data->first_header."</h1>";
			echo "parent_id = ".$section_data->parent_id."<hr>";
			echo "title: ".$section_data->title."<hr>";
			echo "keywords: ".$section_data->keywords."<hr>";
			echo "description: ".$section_data->description."<hr>";
		}else { // загрузить макет?>
<style type="text/css">
/******** Для элементов всех макетов: ********/
div#inner_content{
	width:100%;
}
div#inner_content .clear{
	float: none;
	width: 100%;
}
div#inner_content 
	> div > div{
	padding: 10px;
	padding-left: 8px;
}

div#inner_content 
	> div > div .subsectHeader{
	font-size:16px;
	margin:0;
}
div#inner_content 
	> div > div .contentHeader{
	color:#06AEDD;
	font-size:16px;
	margin:0;
	margin-bottom:10px;
}
div#div1{ 
	float:left;
}

/******** Для индивидуальных макетов: ********/

div.schema100, 
	div.schema100> div{
	width:100%;
}

div.schema200 > div#div1,
div.schema200 > div#div2{
	width:50%;
}
	div.schema200 > div#div2{
		float:right;
	}

div.schema210 > div{
	width:50%;
}
	div.schema210 > div#div2,
	div.schema210 > div#div3{
		float:right;
	}

div.schema300 > div{
	float:left;
	width:33%;
}
	div.schema300 > div#div3{
		width:34%;
	}

div.schema3i0 > div{
	float:left;
	width:33%;
}
	div.schema3i0 > div#div1{
		 margin-right:-33%;
	}
	div.schema3i0 > div#div2,
	div.schema3i0 > div#div4{
		 margin-left:33%;
	}
	div.schema3i0 > div#div3{
		float:right;
		width:34%;
	}

div.schema3s0 > div{
	float:left;
	width:33%;
}
	div.schema3s0 > div#div1{
		margin-right:-33%;
	}
	div.schema3s0 > div#div2{
		margin-left:33%;
		width:67%;
	}
	div.schema3s0 > div#div3{
		margin-left:33%;
	}
	div.schema3s0 > div#div4{
		width:34%;
	}
	
div.schema3ss > div{
	float:left;
	width:33%;
}
	div.schema3ss > div#div1{
		margin-right:-33%;
	}
	
	div.schema3ss > div#div2,
	div.schema3ss > div#div5{
		width:67%;
	}
	
	div.schema3ss > div#div4{
		width:34%;
	}
	div.schema3ss > div#div2,
	div.schema3ss > div#div3,
	div.schema3ss > div#div5{
		margin-left:33%;
	}
	
div.schema30s > div{
	float:left;
	width:33%;
}
	div.schema30s > div#div1{
		margin-right:-33%;
	}
	div.schema30s > div#div2,
	div.schema30s > div#div4{
		margin-left:33%;
	}
	div.schema30s > div#div3{
		width:34%;
	}
	div.schema30s > div#div4{
		width:67%;
	}
	
</style>        
		<?	$tmpl=unserialize($section_data->content);
			//var_dump("<h1>tmpl:</h1><pre>",$tmpl,"</pre>");?>
    <div id="inner_content" class="schema<?=$tmpl['Schema']?>">
		<?	// определиться с типом генерации контента - либо как специально разработанный модуль, либо как стандартный раздел, созданный Генератором:
			if ( $asModule // если передан массив alias'ов, контент страниц которых должен выводиться как специально разработанный модуль
				 && is_array($asModule)
				 && in_array($section_data['alias'],$asModule)
			   ){?><div id="innerXtraModule"><?
			   require_once Yii::getPathOfAlias('webroot').'/protected/views/'.Yii::app()->controller->getId().'/' . $section_data['alias'] . '.php';?></div><?
			}else{	
				$bloxCnt=$colCount=(int)$tmpl['Schema'][0];
				$bloxHeaderType=$tmpl['Schema'][1];
				$bloxFooterType=$tmpl['Schema'][2];
				if ($bloxHeaderType!='0')
					$bloxCnt++;
				if ($bloxFooterType!='0')
					$bloxCnt++;
				/*
				 * См. схему построения макетов в файле:
				 * /_docs/схема.xslx!Макет для создания разделов
				 */
				//***	FOR TEST:	***//
				$testColors=array('whitesmoke','mistyrose','lemonchiffon','honeydew','lightcyan','lavender');
				$showLoremIpsum=false;
				//***	/FOR TEST:	***//
				// получить все модули:
				require_once Yii::getPathOfAlias('webroot').'/protected/modules/admin/controllers/GeneratorController.php';
				$raw_modules=generatorController::getAllModules();
				$modules=Data::simplifyModules($raw_modules,true);
				if(!isset($modules)){
					// $modules[$i]=>
					// 		'module'=>'news'
					// 		'name'=>'Новости'
					//		'description'=>'Модуль новостей компании'
					//		'created'=>'nov. 2012'
					//		'author'=>'srgg6701'
					$modules=array(
							'news'=>'Новость',
							'ready_solution1'=>'Готовое решение 1',
							'ready_solution2'=>'Готовое решение 2',
						);
				}
				$i=1;
				if (isset($tmpl['blocks'])) {
					foreach ($tmpl['blocks'] as $block_name=>$blockModules){
					 // массив: блоки макета as имя блока => массив модулей (строка): 
					 	// 	$block_name:
						//	[1] => 
						//
						//	$blockModules:	
							// 	[0] Новость
							// 	[1] Текст :: article id: 13
							// 	[2] Готовое решение 1
							// 	[3] Текст :: article id: 93
							// 	[4] Готовое решение 2 
						
					 	// 	$block_name:
						// [2] => 

						//	$blockModules:	
							//	[0] Новость |
							//	[1] Готовое решение 2
							//	[2] Готовое решение 2
							//	[3] Текст :: article id: 94
							//	[4] Текст :: article id: 95 	?>
				<div id="div<?=$i?>">
                	<div<? // echo ' style="background:'.$testColors[$i].';"'?>>
            	<? 	if($block_name==2&&$bloxHeaderType!='0'){ 
						echo(is_array($blockModules))? 
							"<span style='color:red'>Ошибка: неправильный тип данных для заголовка (массив вместо строки)...</span>"
							:
						 	"<h2 class=\"subsectHeader\">".substr($blockModules,strpos($blockModules,":")+1)."</h2>";
					}else{
						$artIdSbstr="Текст :: article id:";
						// собрать контент текущего блока:
					  $for=true;
					  if ($for) { // перебрать все модули в МАКЕТЕ:
						for($b=0,$c=count($blockModules);$b<$c;$b++){
							$moduleContent=$blockModules[$b];
							// Новость
							// Готовое решение 2
							// ...
							// если статья:
							if(strstr($moduleContent,$artIdSbstr)){ 
								$article_id=(int)substr($moduleContent,strlen($artIdSbstr));
								$article_data = Yii::app()->db->createCommand()->select('*')->from('insur_article_content')->where('id=:id', array(':id'=>$article_id))->queryRow(); 
								if ($article_data['name']){?>
		<h3 class="contentHeader"><?=$article_data['name']?></h3>
							<?	}	echo $article_data['content'];
							}else{ // НЕ статья?>
		<h3 class="contentHeader"><?=$moduleContent?></h3>
        					<?	if ($mod_folder=array_search($moduleContent,$modules)){
									$module_path=Yii::getPathOfAlias('webroot').'/protected/components/modules/'.$mod_folder.'/default.php';
									require $module_path;	
								}elseif($moduleContent) echo "<div style='color:red'>МОДУЛЬ index $b НЕ НАЙДЕН!</div>";
							}
							echo "<div class='clear'>&nbsp;</div>";
						}
					  }else{ // в псевдотестовом режиме
						  if (isset($blockModules)) {
							  echo "<div class=''>block= ".$blockModules."</div>";
						  	  var_dump("<h1>block:</h1><pre>",$blockModules,"</pre>");
						  }else echo "<div class=''>skip</div>";
					  }
						if ($showLoremIpsum){ // заглушка
						?><hr>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed 

		diam nonumy eirmod tempor invidunt ut labore et dolore magna 

		aliquyam erat, sed diam voluptua. At vero eos et accusam et 

		justo duo dolores et ea rebum. Stet clita kasd gubergren, no 

		sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
				<?		}
					}?>
                	</div>
                </div>	
					<?	$i++;
                    }
                }else{?>
            <h4>Раздел находится в стадии наполнения. Пожалуйста, подождите!</h4>
			<? 	}
			}?>
        <div class="clear">&nbsp;</div><?
   			
		if (isset($_GET['mode'])&&$_GET['mode']=='preview'){ ?>
    <div align="left" id="manage_new_section" style="background:#666; border-radius:6px; box-shadow: 3px 1px 20px 1px #999; color:#FFF; cursor:move; display:<?="none"?>; left:200px; padding:10px; top:200px; position:fixed; width:180px;">
    	Подраздел загружен в режиме предпросмотра. Выберите дальнейшее действие:
        <div style="background:#06AEDD; border-radius:3px; margin-top:10px; padding:6px;">
        	<ul>
        	  <li><a href="#" id="save_as_is">Сохранить </a></li>
        	  <li><a href="<?=Yii::app()->request->getBaseUrl(true)?>/admin/generator/edit/<?=$section_data->id?>">Изменить</a></li>
        	  <li class="txtRed"><a href="#" id="ask_to_delete">Удалить</a></li>
        	  <li><a href="<?=Yii::app()->request->getBaseUrl(true)?>/admin/generator">Добавить подраздел</a></li>
      	  </ul>
       	</div>
    </div>
<script>
$( function(){
  try{
	$('a#ask_to_delete').css('color','#F00').click( function (){
			if (confirm('Вы уверены, что хотите удалить этот раздел?\nмногие погибнут...'))
				location.href='<?=Yii::app()->request->getBaseUrl(true)?>/admin/object/delete/<?=$section_data->id?>';
			return false;		
		});
	$('a#save_as_is').click( function (){ manageVeil('start','Сохранение данных...');
		$.ajax({
			type:"GET",
			url: '<?=Yii::app()->request->getBaseUrl(true)?>/admin/generator/store/',
			data: "section_id=<?=$section_data->id?>",
			beforeSend: function() {
				manageVeil('start','Сохранение данных...');
			},
			success: function (data) {
				manageVeil(false);
				alert("Данные сохранены!"+'\n'+data);
				},
			error: function (data) {
				manageVeil(false);
				alert("Не удалось отправить данные.\nОтвет: "+data);
			},
		});
		return false;
	});
	var mprev=$('#manage_new_section');
	$(mprev).find('ul').css('padding-left','18px');
	$(mprev).find('a[id!="ask_to_delete"], li[class!="txtRed"]').css('color','#FFF');
	$(mprev).find('a').css('margin-left','-6px');	
	var leftOff=$(mprev).parent().offset().left;
	var wdt=$(mprev).width();
	var goLeft=leftOff-wdt-45;
	console.info('leftOff = '+typeof(leftOff)+', wdt = '+typeof(wdt)+', summ = '+goLeft);
	$(mprev).css({
			left:goLeft+'px',
		}).fadeTo(2500,0.9)
			.draggable()
				.hover( 
				function (){
					$(this).css('opacity',1)
				},
				function (){
					$(this).css('opacity',0.9)
				});
  }catch(e){
		alert(e.message);
  }
});
</script>    
	<?	}?>
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
/**
 * Вуаль
 * @package
 * @subpackage
 */
	static public function veil(){?>
<div id="veil" style="background:#000; position:fixed; top:0; right:0; bottom:0; left:0; opacity:0.8; display:<?="none"?>;">
</div>
<div align="center" id="pls_wait" style="position:fixed; top:40%; bottom:50%;  opacity:1;z-index:2; width:100%; display:<?="none"?>;">
	<div id="processing" style="background: #FF9; line-height:26px; padding:30px 60px; border-radius:8px; display: inline-block; box-shadow:#000;">Создание подраздела... <br />Пожалуйста, подождите...</div>
</div>
<?	}
}
?>