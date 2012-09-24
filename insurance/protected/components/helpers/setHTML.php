<?
class setHTML{
	static $arrMenuWidget;
	/**
	  * @package		HTML
	  * @subpackage		product
	  *
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
	  * @subpackage		menu
	  *
	  */
	function buildDropDownMenu(){
		$menuItems=self::getMenuItems();
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
		<a href="<?php echo Yii::app()->request->baseUrl.'/'.$subMenuItems[$id]['alias']?>"><?
			echo $subMenuItems[$id]['text'];?></a>	
	<?	endforeach;?>
        </div> 
<?	}
	/**
	  * @package		HTML
	  * @subpackage		menu
	  *
	  */
	function buildMenu(
					$this_object,
					$arrMenu=false,
					$submenu=false
				  ){
		$mainPageAlias='site/index';
		$currentController=Yii::app()->controller->getId();
		if (!self::$arrMenuWidget) { // если меню ещё не создавали. Иначе получит из статического массива, дабы не выполнять процедуру повторно для нижнего меню
			$newborn_menu=true;
			$arrMenu=self::getMenuItems();
			foreach($arrMenu as $parent_id=>$parent_data) {
				$text=$parent_data['text'];
				$alias=$parent_data['alias'];
				$arr=array('label'=>$text, 'url'=>array('/'.$alias.'/'));
				if ($alias!=$mainPageAlias)
					$arr['active']= $currentController == $alias;
				self::$arrMenuWidget[]=$arr; 
			}
		}
		if (self::detectOldIE()){ //
			$URL=explode("/",$_SERVER['REQUEST_URI']);
			$nURL=array_reverse($URL);
			if ($nURL[1]=='index')
				$urlAlias='/'.$nURL[2].'/'.$nURL[1].'/';
			else $urlAlias='/'.$nURL[1].'/';?>
        <ul<? //id=yw0?>>
		<?	$menuItems=self::getMenuItems();
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
							  array('items'=>self::$arrMenuWidget)
							);
	}
	/**
	  * @package		HTML
	  * @subpackage		menu
	  *
	  */
	function getMenuItems($menuItems=false){
		$model=InsurInsuranceObject::model()->findAll(
					array('select'=>'id, name, alias',
							'condition'=>'parent_id = -1 AND status = 1'
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
	  *
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
	function detectOldIE(){
		$usAg=$_SERVER['HTTP_USER_AGENT'];
		if ( stristr($usAg,'MSIE 6.0') 
			 || stristr($usAg, 'MSIE 7.0')
			 || stristr($usAg, 'MSIE 8.0')
		   ) return true;	
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
    	<div align="right"><a href="#">Подробности &gt;&gt;&gt;</a></div>
    </div>
    <br>
<?	}
	/**
	  * @package		content
	  * @subpackage		product
	  *
	  */
	function setPageContent( $this_obj,
							 $current_page,
							 $main_header,
							 $title=false
							 ){?>
		<h1><?=$main_header?></h1>
	<?	$url=explode("/",$_SERVER['REQUEST_URI']);
		if ( /*isset($_GET['solution'])
			 || isset($_GET['program'])*/
			 in_array('Gotovoye_reshenije',$url)
			 || in_array('Programa',$url)
		   ) {
			
			if (in_array('Gotovoye_reshenije',$url)) {
				$crumb_chain_text="Готовое решение";
				$file="readySolution";
			}else{
				$crumb_chain_text="Программа";
				$file="readyProgram";
			}
			$product_id=array_pop($url);
			$this_obj->breadcrumbs=array(
			$current_page=>array('index'),$crumb_chain_text); 
			require_once dirname(__FILE__)."/../../modules/readyProduct/".$file.".php";
		}else{ 
			if (!$title) $title=$current_page;
			$this_obj->pageTitle=Yii::app()->name . ' - '.$title;
			$this_obj->breadcrumbs=array(
				$current_page,
			); 
			self::buildCatalogue();
		}
	}
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
		<div><a href="<?=$link?>"><?=$solution_name?></a></div>
    </div>
    <div class="clear">&nbsp;</div>
<?	}
}
?>