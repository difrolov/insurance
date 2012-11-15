<?
class setHTML{
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
		$menuItems=self::getMenuItems($submenu);
		foreach($menuItems as $parent_id=>$parent_data){
			if ($parent_data['alias']!='site/index') 
				self::buildDropDownSubMenu($parent_data['alias'],$parent_id);
		}
	}
/**
 * @package		HTML
 * @subpackage		menu
 *
 */
	function buildDropDownSubMenu($parent_alias='',$parent_id=false){?>
        <div<? if ($parent_alias) {?> id="ddMenu_<?=$parent_alias?>"<? }?>>
	<?	$subMenuItems=self::getSubMenuItems($parent_id);
		//var_dump("<h1>subMenuItems:</h1><pre>",$subMenuItems,"</pre>"); //die();
		if (!isset($subMenuItems)){
			$j=rand(1,8);
			for ($i=0;$i<$j;$i++) {
				$subMenuItems[$i]['text']="Текст меню ".$i;
				$subMenuItems[$i]['alias']="url_alias";
			}
		}	
		foreach($subMenuItems as $id=>$array):?>
		<a href="<?php echo Yii::app()->request->baseUrl.'/'.$parent_alias.'/'.$subMenuItems[$id]['alias']?>"><?
			echo $subMenuItems[$id]['text'];?></a>	
	<?	endforeach;?>
        </div> 
<?	}
/**
 * @package		HTML
 * @subpackage		footer
 *
 */
	function buildFooterBlock($tp=false){?>
			<div align="left" id="footer">
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
			$arrMenu=self::getMenuItems($submenu);
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
		<?	$menuItems=self::getMenuItems($submenu);
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
                    <a href="/insur/insurance/site/index"><?
    	if (isset($test_logo)){
			?><img src="../../../images/logo.gif" width="372" height="80"><? 
		}else{?><img alt="Открытие Страхование" title="На главную" src="<?=Yii::app()->request->getBaseUrl(true)?>/images/logo.gif" width="372" height="80" border="0"><? }?></a>
                </div>
<?	}
/**
 * @package		HTML
 * @subpackage		navigation
 *
 */
	function buildPointersNext($direction){?>
		<a href="#"><img src="<?=Yii::app()->request->baseUrl?>/images/pointer_<?=$direction?>.png" width="9" height="18" border="0">
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
 * получить меню верхнего уровня
 */
	function getMenuItems($parent_id_level=false){ 
		if (!$parent_id_level) $parent_id_level='-1';
		$model=InsurInsuranceObject::model()->findAll(
					array('select'=>'id, name, alias',
							'condition'=>'parent_id = '.$parent_id_level.' AND status = 1'
						));
		for($i=0,$j=count($model);$i<$j;$i++){
			$menuItems[$model[$i]->id]=array('text'=>$model[$i]->name,
											 'alias'=>$model[$i]->alias
											);
		}
		return $menuItems;
	}
/**
 * @package		HTML
 * @subpackage		menu
 * выпадающее меню, как для mainmenu, submenu
 */
	function getSubMenuItems($parent_id){ 
		$model=InsurInsuranceObject::model()->findAll(
					array('select'=>'id, name, alias',
							'condition'=>'parent_id = '.$parent_id.' AND status = 1'
						));
		$subMenuItems=array();
		for($i=0,$j=count($model);$i<$j;$i++){
			$subMenuItems[$model[$i]->name]=array(
									'text'=>$model[$i]->name,
									'alias'=>$model[$i]->alias
								);
		}
		return $subMenuItems;
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
}
?>