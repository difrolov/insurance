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
		$dx=array_shift($menuItems);
		foreach($menuItems as $key=>$alias){?>
        <div id="ddMenu_<?=$alias?>">
		<?	for($i=0,$j=rand(1,8);$i<$j;$i++):?>
		<a href="#"><? echo $alias.' '.$i; ?></a>	
		<?	endfor;?>
        </div> 
	<?	}?>
<script type="text/javascript">
// set ddMenu positions
try{	
	var mMenu=document.getElementById('mainmenu');
	var ddMenus=mMenu.getElementsByTagName('div');
	var ulMenus=document.getElementById('mainmenu').getElementsByTagName('li');
	for(i=0;i<ddMenus.length;i++){
		var li=ulMenus.item(i+1);
		var pos = jQuery(li).offset().left; 
		var ddM=ddMenus.item(i); 
		$(ddM).offset({left:pos+8}); 
	}
}catch(e){
	alert(e.message);
}
var manageDDMenu = function(e) {	
  try{
	// ВНИМАНИЕ! Важно: уровень вложенности элементов внутри блока с выпадающим меню.
	// устанавливается в начале метода (HTML) и в блоке для события mouseout
	var testBlock=document.getElementById("AfterMenu");
	var ULlist=mMenu.getElementsByTagName('ul').item(0).getElementsByTagName('li'); 
	var eventSource=e.srcElement; // event source
	var eventSourceTagName=eventSource.nodeName.toLowerCase(); // event source tag name
	var eventSourceParent=eventSource.parentNode; // event source parent
	var eventSourceParentParent=eventSourceParent.parentNode; // event source parent parent
	
	if ( // li in menu:
		 ( eventSourceTagName=='li'&&eventSourceParentParent==mMenu ) 
		 || // a inside li:
		 ( eventSourceTagName=='a'&&eventSourceParentParent.parentNode==mMenu ) 
		 || // drop-down menu:
		 ( eventSourceTagName=='div'&&eventSourceParent==mMenu&&eventSource.id.indexOf("ddMenu_")!=-1 )
	   ) {  
		// получить объект списка (ul) в меню:
		var UL=mMenu.getElementsByTagName('ul').item(0);
		// получить все пункты меню в виде набора объектов:
		var ULlist=UL.getElementsByTagName('li'); 
		// первое меню, без подменю:
		var firstLI=UL.getElementsByTagName('li').item(0);
		
		if (eventSourceTagName!='div') {
			if ( eventSource!=firstLI
			 	 && eventSourceParent!=firstLI
			   ) { //alert(eventSource.innerHTML+'\n'+firstLI.innerHTML);
				// получить объект текущего элемента li:
				var targetLI=(eventSourceTagName=='li')? eventSource:eventSourceParent;
				// получить индекс текущего пункта меню и на его основе - индекс объекта выпадающего меню:
				var LiIndex=$(ULlist).index(targetLI)-1;
				// получить объект выпадающего меню:
				var dropDownMenuDIV=ddMenus.item(LiIndex);
			}
		}else dropDownMenuDIV=eventSource;
		
		if(e.type=='mouseover') {
			if ( dropDownMenuDIV) dropDownMenuDIV.style.top='22px';
		}else if(e.type=='mouseout'){
			var relToElement=e.relatedTarget; // to Element
			if ( relToElement 
				 && dropDownMenuDIV
			   ) {
				if( relToElement.id.indexOf("ddMenu_")==-1
				    && relToElement.parentNode.id.indexOf("ddMenu_")==-1
					&& relToElement.parentNode.parentNode.id.indexOf("ddMenu_")==-1
				  )
				dropDownMenuDIV.style.top='-4000px';
			}
		}
	}			
  }catch(e){
	  alert(e.message);
  }
}
document.addEventListener('mouseover', manageDDMenu, false);
document.addEventListener('mouseout', manageDDMenu, false);
</script>    
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
		if (!self::$arrMenuWidget) { // если меню ещё не создавали. Иначе получит из статического массива, дабы не выполнять процедуру повторно для нижнего меню
			$arrMenu=self::getMenuItems();
			foreach($arrMenu as $title=>$alias) {
				$arr=array('label'=>$title, 'url'=>array('/'.$alias.'/'));
				if ($alias!='site/index')
					$arr['active']=Yii::app()->controller->getId() == $alias;
				self::$arrMenuWidget[]=$arr; 
			}
		}
		$this_object->widget( 'zii.widgets.CMenu',
							  array('items'=>self::$arrMenuWidget)
							);
	}
	/**
	  * @package		HTML
	  * @subpackage		menu
	  *
	  */
	function getMenuItems($menuItems=false){
		if(!$menuItems){
			$menuItems=array(
					'Главная'=>'site/index',
					'О компании'=>'o_kompanii',
					'Корпоративным клиентам'=>'korporativnym_klientam',
					'Малому и среднему бизнесу'=>'malomu_i_srednemu_biznesu',
					'Физическим лицам'=>'fizicheskim_litzam',
					'Партнёрам'=>'partneram',
				);
		}
		return $menuItems;
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