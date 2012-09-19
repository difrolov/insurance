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
		<div id="ddMenu_<?=$alias?>"><a href="#"><?=$alias?></a></div> 	
	<?	}?>
<script type="text/javascript">
menuBundle=false;
// set ddMenu positions
try{	
	var mMenu=document.getElementById('mainmenu');
	var ddMenus=mMenu.getElementsByTagName('div');
	var ulMenus=document.getElementById('mainmenu').getElementsByTagName('li');
	for(i=0;i<ddMenus.length;i++){
		var li=ulMenus.item(i+1);
		var pos = jQuery(li).offset().left; 
		//alert(li.innerHTML+'\n'+pos);
		var ddM=ddMenus.item(i); 
		$(ddM).offset({left:pos+8}); 
	}
}catch(e){
	alert(e.message);
}
var manageDDMenu = function(e) {	
  try{

	var testBlock=document.getElementById("AfterMenu");
	testBlock.innerHTML='type: '+e.type;
	if (e.type=='mouseover') { 
		
		if ( e.srcElement.nodeName.toLowerCase() == 'li'
			 && e.srcElement.parentNode.parentNode == mMenu
		   ) {  
			var activeLI=e.srcElement;
			var i=0;
			
			menuBundle=new Array();
			//testBlock.innerHTML='menuBundle typeof(0): '+typeof(menuBundle);
			for(obj in activeLI.childNodes){
				//document.getElementById("AfterMenu").innerHTML+='<hr>type: '+typeof(obj);
				menuBundle[i]=obj;
				i++;
			}
			// получить телущий элемент li:
			var ULlist=mMenu.getElementsByTagName('ul').item(0).getElementsByTagName('li'); 
			var ddMenuIndex=$(ULlist).index(activeLI)-1; // текущий индекс для элемента вып.меню
			var currentDDMenu=ddMenus.item(ddMenuIndex); // элемент вып.меню
			//alert(typeof(activeLI.childNodes));
			menuBundle[i]=currentDDMenu;
			for(obj in currentDDMenu.childNodes){
				++i;
				//document.getElementById("AfterMenu").innerHTML+='<hr>type: '+typeof(obj);
				menuBundle[i]=obj;
			}
			currentDDMenu.style.top='-30px';
			/*for(i=0;i<menuBundle.length;i++){
				testBlock.innerHTML+='<hr>type: '+typeof(menuBundle[i]);
				if (typeof(menuBundle[i]=="string"))
					testBlock.innerHTML+=menuBundle[i]+'<hr>';
				else if (typeof(menuBundle[i]=="object"))
					testBlock.innerHTML+=menuBundle[i].innerHMTL+'<hr>';
			}*/
			//menuBundle=childs.push(currentDDMenu); // добавить объект подменю
			//var ddChilds=currentDDMenu.childNodes; // дочерние элементы вып.меню
			//menuBundle=allElems.concat(ddChilds); // добавить в массив дочерние элементы вып.меню
			//var str=childs.join("\n");
			//alert(childs.length);
			//for(i=0;i<childs.length;i++)
				//document.getElementById("AfterMenu").innerHTML+='<hr>'+childs[i].innerHTML;
				//'tag: '+currentDDMenu.tagName+', nodes= '+currentDDMenu.childNodes.length+'<hr>'+currentDDMenu.innerHTML;
				//+=allElems[i].innerHTML;
				//
				//ddMenus.item(ddMenuIndex).style.display='block';
				//var topPos;
				//ddMenus.item(ddMenuIndex).style.top='124px';
			/*else if (e.type=='mouseout') {
				if ( activeLI.nodeName.toLowerCase() == 'div'
					 && activeLI.id.indexOf('ddMenu_')!=-1
				   ) { 
				   showSubmenu='submenu works';  
				   
					//alert(childs.length);
				}else{
					document.title=activeLI.nodeName+', '+activeLI.id;
				}
				
				if (!showSubmenu){
					topPos='-400';
					ddMenus.item(ddMenuIndex).style.top=topPos+'px';
				}
			}*/
		}
		if( menuBundle
		    //&& e.srcElement!=activeLI
		  ){
			  
			testBlock.innerHTML='OVER: '+e.srcElement.nodeName+'<hr><br><br>';
			var belongToBundle=false;
			for(i=0;i<menuBundle.length;i++){
				testBlock.innerHTML+='<br>Source item('+i+'): <br>'+e.srcElement.innerHTML;
				testBlock.innerHTML+='<br>BUNDLE ITEM('+i+'): <br>'+menuBundle[i].innerHTML+'<hr>';
				if (e.srcElement==menuBundle[i]) {
					belongToBundle=true;
					alert(belongToBundle);
					break;
				}
			}
			if (!belongToBundle)
				currentDDMenu.style.top='-90px';
		}
	}
			//testBlock.innerHTML+='beyond menuBundle: '+e.srcElement.nodeName;
			
	if(e.type=='mouseout'){
		var relToElement=e.relatedTarget ;
		testBlock.innerHTML='OUT: '+relToElement.innerHTML;
	}
  }catch(e){
	  alert(e.message);
  }
}
document.addEventListener('mouseover', manageDDMenu, false);
//document.addEventListener('mouseout', manageDDMenu, false);
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