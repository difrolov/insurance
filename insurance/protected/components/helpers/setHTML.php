<?
class setHTML{
	protected static $arrAvoidSubmenu=array('site/index');
	protected static $childrenWrapperTag;
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
	<?	$subMenuItems=self::getSubMenuItems($parent_id,NULL);
		if($test) { echo "parent_alias=$parent_alias"; var_dump("<h4>".__LINE__.": subMenuItems:</h4><pre>",$subMenuItems,"</pre>");}
		if (!isset($subMenuItems)){
			$j=rand(1,8);
			for ($i=0;$i<$j;$i++) {
				$subMenuItems[$i]['text']="Текст меню ".$i;
				$subMenuItems[$i]['alias']="url_alias";
			}
		}
		ob_start();
		self::buildSubmenuLinks($subMenuItems,$parent_alias);
		$linksHTML=ob_get_contents();
		ob_end_clean();
		if ($parent_alias=="korporativnym_klientam") {?>
          <ul class="asTable">
			<li>
            	<div class="txtLightBlue txtMediumSmall">Виды страхования</div>
				<?=$linksHTML?></li>
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
			echo $linksHTML;?>
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
								$top_parent,
								$next_parent=false
							  ){
		if (is_array($subMenuItems)){
			foreach($subMenuItems as $alias_value=>$link_text):
				if (is_array($link_text)){
					self::buildSubmenuLinks($link_text,$top_parent,$alias_value);
				}elseif ( $alias_value!="parent_alias"
						  && $alias_value!="id"
						  && $alias_value!="alias"
						){
				  	if ($next_parent) { // предыдущий уровень внутри главного меню
					  ?><blockquote><? // сформировать отступ
					}?><a href="<?=Yii::app()->request->baseUrl.'/'.$top_parent;
					if ($next_parent) echo '/'.$subMenuItems['parent_alias'];
					echo '/'.$alias_value;?>"><?=$link_text?></a><?	
				  if ($next_parent) {?></blockquote><? }
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
 * @package		HTML
 * @subpackage		menu
 * выпадающее меню, как для mainmenu, submenu
 */
	function getSubMenuItems( 
							  	  $parent_id, // нужен для формирования запроса к БД
							  	  $parent=false,
							  	  $subMenuItems=false
								){ 
		$submenus=self::getSubmenu($parent_id);
		if (isset($_GET['test'])) {
			if ($parent===NULL) 
				echo "<h4 style='color:red;font-weight:100;'>Parent id is <b>$parent_id</b></h4>";
			
			else echo "<h4 style='color:brown;font-weight:100;'>Parent id is <b>$parent_id</b><br>parent key is <b>$parent</b></h4>";
		}
		//var_dump("<h1>submenus:</h1><pre>",$submenus,"</pre>");
		$i=0;
		foreach($submenus as $submenu_data_array){
			//echo "<div>\$submenu_data_array id = <b>".$submenu_data_array['id']."</b></div>";
			//if (!$parent){
			$submenu_alias=$submenu_data_array['alias'];
			$submenu_id=$submenu_data_array['id'];
			$submenu_name=$submenu_data_array['name'];
			
				//$submenus[$i]['MY']='MYDATA';
			//}
			if ((int)$submenu_data_array['child_count']){
				$subMenuItems[$submenu_alias]=array('id'=>$submenu_id, 'name'=>$submenu_name);
				//$subMenuItems[$submenu_alias]['children']=array();
				//var_dump("<h4>submenu_data_array:</h4><pre>",$submenu_data_array,"</pre>");
				/*
				array(4) {
				  ["id"]=>
				  string(1) "3"
				  ["name"]=>
				  string(14) "История"
				  ["alias"]=>
				  string(8) "istorija"
				  ["child_count"]=>
				  string(1) "2"
				}*/
				//$subMenuItems[$submenu_data_array['id']]=$submenu_data_array['id']; 
				//$submenus['myID']='myid';
				//$subMenuItems[$submenu_data_array['id']]=array('parent_alias'=>$submenu_data_array['alias']);
			  	if (isset($_GET['test'])) echo "<div class='testBlock'>Has children<br>";
				self::getSubMenuItems( // для передачи запросу id раздела
									   // в качестве родительского:
									   $submenu_data_array['id'],  
									   $submenu_data_array['alias'], // parent alias
									   &$subMenuItems[$submenu_data_array['alias']]
									 );			
			  if (isset($_GET['test'])) echo "</div>";
			}else{
				// parent_id 		= 	$submenu_data_array['id']
				// parent 			=	$submenu_data_array['alias']
				// subMenuItems 	=	&$subMenuItems[$submenu_data_array['alias']]
				if ($parent){ // alias
						// 		  $parent=["istorija"]["istorija"]
					//$subMenuItems[$parent]="ELSE ID : ".$submenu_data_array['id'];
					$subMenuItems['children'][$submenu_data_array['alias']]=array(
													'id'=>$submenu_data_array['id'],
													'name'=>$submenu_data_array['name']
											);
					
					//echo "<div>i=$i, id=".$submenu_data_array['id'].", name=".$submenu_data_array['name']."</div>";						//$subMenuItems[$parent_id]['children'][$submenu_data_array['alias']]=$submenu_data_array['name'];  
				}
			}
			$i++;
		}	
		
		return $subMenuItems; 
	}
/**
  *
  */	
	function getSubmenu($parent_id){
		$query="SELECT id, name, alias, (
					SELECT COUNT(*) FROM insur_insurance_object
					WHERE parent_id = t.id
				) as child_count
			FROM insur_insurance_object AS t
			WHERE parent_id = ".$parent_id." AND `status` = 1";
		if (isset($_GET['qtest'])) echo "<pre style='color:green'>".__LINE__."<BR>".$query."</pre>";
		return Yii::app()->db->createCommand($query)->queryAll();
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
 * Определить теги-wrapper'ы для элементов верхнего уровня
 * Определить метод-построитель HTML верхнего уровня
 * Определить поля извлечения данных для построителя HTML верхнего уровня
 * Определить теги-wrapper'ы для элементов вложенных уровней
 * @package
 * @subpackage
 */
	function takeInputs(){
		// атрибуты тега <input>, общие для пунктов всех уровней
		$arrInput=array(  'name'=>'menu',
						  'id'=>'submenu_:id',
						  'type'=>'radio',
						  'value'=>':id'
						 );
		return 
			array( 	// элементы первого уровня:
					'tags'=>array(
								array('label'),
								array('span'),
								array('unclosed:input',$arrInput),
								array('b')
							),
					// имя метода-построителя HTML первого уровня и используемые им поля:
				  	'topBuilder'=>array( 'name'=>'buildSectionChoice',
									   	 'fields'=>array('alias','text') 
									   ),
					// индикатор отображения блока со всеми дочерними элементами РЯДОМ с родительским блоком элементов 1-го уровня:
					'nextAsSibling'=>true,
					// теги и их атрибуты для всех элементов ниже основного уровня: 
				  	'children'=>array(// (в порядке вложенности - от внешних ко внутренним):
									array('div'), 
									array('blockquote'),
									array('label'),
									array('span'),
									array('unclosed:input',$arrInput)
								)
				);
	}
/**
 * Построить текст элемента
 * @package
 * @subpackage
 */
	function buildSectionChoice($params,$fields){
		echo $params[$fields[1]];
	}
/**
 * Описать структуру всех разделов и подразделов
 * @package
 * @subpackage
 * $function -- указать имя метода, возвращающего:
 	теги для п.п. верхнего уровня
		
 */
	function walkThroughSections($function=false) {
		if (!$function) $function='takeInputs';
		// получить все параметры для элементов как верхнего уровня, так и вложенных:
		$params=self::$function();
		// назначить теги/атрибуты для элементов самого верхнего уровня:
		// by default:
		if(!$params['tags']) $params['tags']=array(
												array('div')
											  ); 
		if(!$params['children']) 
			$params['children']=array( // назначенные теги и их атрибуты для дочерних элементов 
									// (в порядке вложенности - от внешних ко внутренним):
									array('div',
											array('class'=>'unknown', 
													'style'=>'padding:6px; color: green !important;'
												)
										 ), 
									array('label'),
									array('span',
											array('class'=>'unknown', 
											  'style'=>'padding:6px; color: brown;'
											 )
										 ));
		
		$menuItems=self::getMainMenuItems(); // получить главное меню
		//var_dump("<h1>menuItems:</h1><pre>",$menuItems,"</pre>");
		self::$childrenWrapperTag=array('blockquote');
		foreach($menuItems as $parent_id=>$parent_data){ // id=>text, alias
			// построить HTML для самого верхнего уровня:
			// открыть тег для верхнего уровня:
			foreach($params['tags'] as $i=>$tParams)
				self::genPartHTML($tParams,$parent_id); 
			// построить HTML после открытия тега:
			self::$params['topBuilder']['name']($parent_data,$params['topBuilder']['fields']);	
			// если выбрали отобразить элементы следующего уровня как соседние - закрыть тег верхнего уровня:
			if($params['nextAsSibling']) 
				foreach($params['tags'] as $i=>$tParams)
					self::genPartHTML($tParams); 
			// если нет в списке разделов БЕЗ подменю - сгенерировать все вложенные уровни:
			if (!in_array($parent_data['alias'],self::$arrAvoidSubmenu)) {
				// получить ВСЕ вложенные уровни для текущего верхнего уровня:
				$subMenuItems=self::getSubMenuItems($parent_id,NULL);
				self::buildSections( 
						// все вложенные подразделы через рекурсию:
						$subMenuItems, 
						// alias текущего раздела, передаваемый дочернему:
						$parent_data['alias'],
						// означает отсутствие родительского раздела: 
						true, 
						// назначенные теги и их атрибуты для дочерних элементов:
						$params['children']
					   );
			}
			// если НЕ выбирали отображение элементов следующего уровня как соседние - закрыть тег верхнего уровня сейчас:
			if(!$params['nextAsSibling'])
				foreach($params['tags'] as $i=>$tParams)
					self::genPartHTML($tParams);
		}
	}
/**
 * Проходит по всем подразделам, оборачивая их контент HTML-тегами
 * @package
 * @subpackage
 */
	function buildSections( $subMenuItems,
							$top_parent,
							$next_parent=false,
							$arrTagsAndParams // теги и их атрибуты 
						  ){
		if (is_array($subMenuItems)){	// var_dump("<h2 style='color:green'>subMenuItems:</h2><pre>",$subMenuItems,"</pre>");
			foreach($subMenuItems as $alias_value=>$text) {
				//if (is_array($text)){
					$id=(isset($text['id']))? $text['id']:true;
					//echo "<h1>ID ".$text['id']."</h1>";
					//echo "<h1>".$subMenuItems[$alias_value]."</h1>";
					//var_dump("<h3 style='color:red'>text:</h3><pre>",$text,"</pre>");
				//}
				if (isset($text['children'])&&is_array($text['children'])){
					//echo "<h4>children:</h4>";
					//var_dump("<pre>",$text['children'],"</pre>");
					self::genPartHTML(self::$childrenWrapperTag,$id);
				}
				if (is_array($text)){
					//echo "<div style='background:lightyellow; padding:10px; border:solid 1px blue; margin-bottom:20px; border-bottom:solid 4px blue'>START HTML recurse<br>";
					//var_dump("<h1>text:</h1><pre>",$text,"</pre>");
					self::buildSections( $text,
										 $top_parent,
										 $alias_value,
										 $arrTagsAndParams
									   );
					//echo "<br>STOP HTML</div>";
				}elseif ( $alias_value!="parent_alias"
						  && $alias_value!="id"
						  && $alias_value!="alias"
						){
					
					//echo "<div style='background:lightskyblue; border:solid 1px orange; margin-bottom:20px; padding:10px; border-bottom:solid 4px orange'>START HTML no array<br>";
					//echo "<h4>alias_value=$alias_value<br>top_parent=$top_parent<br>next_parent=$next_parent</h4>";
					//if (isset($subMenuItems['children'])&&is_array($subMenuItems['children'])) echo "<div>HAS CHILDREN</div>";
					//var_dump("<h1>subMenuItems:</h1><pre>",$subMenuItems,"</pre>");
					//var_dump("<h1>arrTagsAndParams:</h1><pre>",$arrTagsAndParams,"</pre>");
					// предыдущий уровень внутри главного меню
					
					$no_children=(isset($subMenuItems['children'])&&is_array($subMenuItems['children']))? false:true;
					
					//echo "<h4>NO children? : ".$no_children."</h4>";
					
					
					if ($no_children){
						//echo " * NO CHILDREN! * ";
						foreach($arrTagsAndParams as $i=> $params)
							if($i) self::genPartHTML($params,true);
					}
					else {
						//echo " HAS CHILDREN! ";
						self::genPartHTML($arrTagsAndParams[4],true);
					}
					echo $text;
					
					if(!$no_children) self::genPartHTML($arrTagsAndParams[4]);

					else
						foreach($arrTagsAndParams as $i=> $params)
							if($i) self::genPartHTML($params); 
					//echo "<br>STOP HTML</div>";
				}
				if (isset($text['children'])&&is_array($text['children']))
					self::genPartHTML(self::$childrenWrapperTag);
			}
		}
	}
/**
 * Обвёртывает текст тегами с заданными атрибутами
 * @package
 * @subpackage
 */
	function genPartHTML($tag,$stat=false){
		if($stat){
			if (strstr($tag[0],"unclosed:")){
				$tag[0]=substr($tag[0],9);
			} 
			echo "<".$tag[0];
				if (isset($tag[1]))
					foreach($tag[1] as $attr => $params){
						$data='';
						if(strstr($params,':')){
							$arp=explode(':',$params);
							$params=$arp[0];
							if ($stat!==true)
								$data=$stat; // обычно - id объекта в таблице 
						}	
						echo " ".$attr.'="'.$params.$data.'"';
					}
			echo ">";
		}elseif(!strpos($tag[0],"unclosed:"))
			echo "</".$tag[0].">";
	}
	
	function getObjectsRecursive( $fields=false, // поля извлечения данных
								  $parent_id=false, // id родительского (под)раздела
								  $level=0	// иерархический уровень текущего подраздела
								){
		static $result=array(); // инициализировать массив выходных данных
		if(!$fields) // набор полей извлечения данных по умолчанию
			$fields='id,name,parent_id,alias';
		if (!$parent_id) {
			$level=0;
			$parent_id='-1';
		}else{ 
			$level++;
			$xtra_id=$parent_id; // для идентификации id родительского подраздела при рекурсивном вызове
		}
		$query="SELECT ".$fields.", "; // запятая нужна, т.к. в \$fields отсутствует; не добавлять туда, поскольку это вызовет ошибку далее, при конвертации в массив в цикле!
		$query.="
    (   SELECT COUNT(*) AS cnt FROM insur_insurance_object
      WHERE parent_id = t1.id 
		AND `status` = 1
    ) AS children 
FROM insur_insurance_object as t1
WHERE parent_id = ".$parent_id." and `status` = 1
order by id ASC";
		$res=Yii::app()->db->createCommand($query)->queryAll();
		// Главная
		// О компании
		// ...
			// Новости
			// О корпорации
			// ...
		for($i=0,$j=count($res);$i<$j;$i++){
			$section_data=$res[$i];
			$arrFields=explode(",",$fields); // поля с табличными данными
			for($y=1,$x=count($arrFields);$y<$x;$y++) // начиная с "name", т.к. 'id' является ключом массива
				$arrRes[$arrFields[$y]]=$section_data[$arrFields[$y]];
			$arrRes['level']=$level; // добавляем в массив данных сведения об иерархическом уровне текущего подраздела (может пригодиться при назначении HTML-атрибутов и т.п.)
			$result[$section_data['id']]=$arrRes; // сохраняем данные таблицы для подраздела в массиве
			if((int)$section_data['children']>0){ // если есть дочерние подразделы, делаем рекурсивный вызов метода
				for($k=0,$m=$section_data['children'];$k<$m;$k++){
					self::getObjectsRecursive($fields,(int)$section_data['id'],$level);
				}
			}
			if (isset($xtra_id)) {
				// скопировать данные текущего подраздела в массив родительского подраздела 
				$result[$xtra_id]['children'][$section_data['id']]=$result[$section_data['id']];
				// удалить исходные данные текущего подраздела, т.к. копия уже размещена в родительском:
				unset($result[$section_data['id']]);
			}
		}
		return $result;
	}
}
?>