<?
class setHTML{
	/**
	  * @package		HTML
	  * @subpackage		product
	  *
	  */
	function buildCatalogue( $programs=false,	// программы
							 $consumer_type=false
						   ){
	// получить все решения для данного типа субъекта:
	$solutions=readySolutions::getAllSolutionsNames(Yii::app()->controller->getId());
	if (!$solutions){
		$scount=10;
	}else{
		$scount=count($solutions);
	}
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
    <td id="cellProgramms">
<?	for($i=0;$i<$pcount;$i+=2){?>
	  <div>
		<? readySolutions::showProgram();?>
      </div>
	  <div>
		<? readySolutions::showProgram();?>
      </div>
<?	}?>      
	</td>
  </tr>
</table>
<?	}
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
	function setPageContent( $this_obj,
							 $current_page,
							 $main_header,
							 $title=false
							 ){?>
		<h1><?=$main_header?></h1>
		<?	
		if (isset($_GET['solution'])) {
			$this_obj->breadcrumbs=array(
			$current_page=>array('index'), // page in this view
						'Готовое решение' // define it as an array above to make link
			); 
			require_once dirname(__FILE__)."/../../modules/ready_solution/index.php";
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
			$link=Yii::app()->request->baseUrl."/".Yii::app()->controller->getId()."/?solution=".$params['id'];
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