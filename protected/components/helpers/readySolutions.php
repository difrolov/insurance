<?
class readySolutions{
	/**
	  * @package		content
	  * @subpackage		solution
	  *
	  */
	function getAllSolutionsNames($consumer_type=false){
		if (!$consumer_type) 
			$consumer_type=Yii::app()->controller->getId(); // current controller
		// получить все готовые решения для выбранного типа субъекта
		$arrSolutions=array( 
						array('id'=>1,'name'=>'ГО','icon_src'=>false),
						array('id'=>3,'name'=>'ВЗР','icon_src'=>false),
						array('id'=>4,'name'=>'НС','icon_src'=>false),
						array('id'=>11,'name'=>'ДМС','icon_src'=>false),
						array('id'=>13,'name'=>'Автострахование','icon_src'=>false),
						array('id'=>19,'name'=>'Страх. имущ-ва','icon_src'=>false)
						);
		return $arrSolutions;
	}
	/**
	  * @package		content
	  * @subpackage		program
	  *
	  */
	function showProgram(){?>
	<div>
    	Контент программы страхования
    </div>		
<?	}
	/**
	  * @package		content
	  * @subpackage		solution
	  *
	  */
	function showReadySolution(){?>
	<div class="ready_solution">
    	Контент готового решения
    </div>		
<?	}
}
?>