<?
class Data {
/**
  * @package		content
  * @subpackage		navigation
  * Загружает контент раздела/подраздела из БД по полученному алиасу
  * Требует установки правил в UrlManager!
  */
	function getDataByAlias( $default_alias, // главный раздел. То, что в БД с parent_id -1/-2
							 $alias=false // alias подраздела
						   ){ 
		if (!$alias) {
			$alias=$default_alias;	
			$subsection=true;
		}
		$data = InsurInsuranceObject::model()->findByAttributes(array('alias' => $alias));
		if ($data === null) {
			throw new CHttpException(404, 'Not found');		
		} 
		return $data;	
	}
/**
 * Анализирует URL, забирает данные из БД и передаёт их в макет, откуда они извлекаются методом setHTML::setPageData(), который формирует и рамещает на странице конечное представление данных.
 * @package
 * @subpackage
 */
	function getObjectByUrl($obj,$subsection){
		if($subsection!='site'){
			$Uri=explode("/",$_SERVER['REQUEST_URI']);
			$hash=array_pop($Uri);
			if($hash!=$subsection) $subsection=$hash;
		}
		$data=Data::getDataByAlias(Yii::app()->controller->getId(),$subsection);
    	$obj->render('index', array('res' => $data));
	}
	
/**
 * Получить структурированный массив всех разделов и подразделов
 * @package
 * @subpackage
 */
	function getObjectsRecursive( $fields=false, // поля извлечения данных
								  $parent_id=false, // id родительского (под)раздела
								  $level=0,	// иерархический уровень текущего подраздела
								  $result=false // результат; при вхождении в рекурсию передаётся по ссылке
								){
		if(!$fields) { // набор полей извлечения данных по умолчанию
			$fields='id,name,parent_id,alias'; //echo "<div class='txtLightBlue'>GO FIELDS! : ".$fields."</div>";
		}elseif(!$result){ // если с дуру передали пустую строку, извлечь все поля таблицы:
			if (!str_replace(" ",'',$fields)){
				$qFields="DESC insur_insurance_object";
				$desc=Yii::app()->db->createCommand($qFields)->queryAll();
				for($i=0,$j=count($desc);$i<$j;$i++){
					if ($i) $fields.=',';
					$fields.=$desc[$i]['Field'];
				} 
			} // echo "<div class='txtRed'>GO FIELDS AGAIN! : ".$fields."</div>";
		}
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
		$arrFields=explode(",",$fields); // поля с табличными данными
		// присвоить данные полученным объектам:
		for($i=0,$j=count($res);$i<$j;$i++){
			$section_data=$res[$i]; // текущая запись из БД
			for($y=1,$x=count($arrFields);$y<$x;$y++) // начиная с "name", т.к. 'id' является ключом массива
				$arrRes[$arrFields[$y]]=$section_data[$arrFields[$y]];
			$arrRes['level']=$level; // добавляем в массив данных сведения об иерархическом уровне текущего подраздела (может пригодиться при назначении HTML-атрибутов и т.п.)
			$result[$section_data['id']]=$arrRes; // сохраняем данные таблицы для подраздела в массиве
			if((int)$section_data['children']){ // если есть дочерние подразделы, делаем рекурсивный вызов метода
				if($parent_id==-2) echo "<h1 style='color:red'>children : ".$section_data['children']."</h1><hr>";
				for($k=0,$m=$section_data['children'];$k<$m;$k++){
					self::getObjectsRecursive($fields,(int)$section_data['id'],$level,&$result);
				}
			}
			if ( isset($xtra_id)
				 && $xtra_id>=0 // исключить разделы самого верхнего уровня (-1, -2)
			   ) { // если получили id родительского (под)раздела 
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