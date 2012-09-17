<?
class readySolutions{
	/**
	  * @package		content
	  * @subpackage		program
	  *
	  */
	function getAllProgramsNames($consumer_type=false){
		if (!$consumer_type) 
			$consumer_type=Yii::app()->controller->getId(); // current controller
		// получить все готовые решения для выбранного типа субъекта
		$arrPrograms=array( 
						  array('id'=>1,'name'=>'Автострахование','icon_src'=>false),
						  array('id'=>2,'name'=>'Добровольное медицинское страхование','icon_src'=>false),
						  array('id'=>3,'name'=>'Страхование имущества','icon_src'=>false),
						  array('id'=>4,'name'=>'Страхование от несчастных случаев','icon_src'=>false),
						  array('id'=>5,'name'=>'Страхование ответственности','icon_src'=>false),
						  array('id'=>6,'name'=>'Страхование грузов','icon_src'=>false),
						  array('id'=>7,'name'=>'Страхование строительно-монтажных работ','icon_src'=>false),
						  array('id'=>8,'name'=>'Страхование в строительстве','icon_src'=>false),
						  array('id'=>9,'name'=>'Страховые продукты для клиентов банка','icon_src'=>false),
						  array('id'=>10,'name'=>'Страхование от потери работы','icon_src'=>false),
						  array('id'=>11,'name'=>'Туристическое страхование','icon_src'=>false)
						);
		return $arrPrograms;
	}
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
	function showProgram($params=false){?>
	<div>
    	id программы: <?=$params['id']?>
        <hr>
    	Название программы: <?=$params['name']
   		//var_dump("<h1>params:</h1><pre>",$params,"</pre>");?>
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