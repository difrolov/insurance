<?
class Data {

/**
 * Построить цепочку алиасов к конкретно взятой странице
 * @package
 * @subpackage
 */
	static public function buildAliasPath($start_point,$parent_alias=false){
		if (!$parent_alias) { // первая итерация (начало извлечения алиасов)
			if (!$start_point || gettype($start_point)=='string') { 
				$field='alias';
				$alias_path=$start_point;
			}else{
				$field='id';
				$alias_path=self::getAliasById($start_point);
			}
			$condition=$start_point; // alias || id
		}else{ // продолжение извлечения алиасов
			$field="alias";
			$condition=$parent_alias;
			$alias_path=$start_point."/".$parent_alias;
		}	
		if( $get_parent_alias = Yii::app()->db->createCommand()->select('
       ( SELECT alias 
          FROM insur_insurance_object
         WHERE id = t.parent_id
       ) AS parent_alias')->from('insur_insurance_object AS t')->where($field." = '$condition' LIMIT 1")->queryScalar()){
		   self::buildAliasPath(&$alias_path,$get_parent_alias);
		}else{ 
			if ($alias_path){
				echo implode("/",array_reverse(explode("/",$alias_path)));
			}else 
				return false;
		}
	}
/**
 * Описание
 * @package
 * @subpackage
 */
	public static function getAliasById($id){
		return Yii::app()->db->createCommand()->select('alias')->from('insur_insurance_object')->where("id = ".$id)->queryScalar(); 
	}
/**
  * @package		content
  * @subpackage		navigation
  * Загружает контент раздела/подраздела из БД по полученному алиасу
  * Требует установки правил в UrlManager!
  */
	static function getDataByAlias( $default_alias, // главный раздел. То, что в БД с parent_id -1/-2
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
	static function getObjectByUrl($obj,$subsection){
		if($subsection!='site'){
			$Uri=explode("/",$_SERVER['REQUEST_URI']);
			$hash=array_pop($Uri);
			if (strstr($hash,"?")) 
				$hash=substr($hash,0,strpos($hash,"?"));
				// o_kompanii/istorija/historical/?mode=preview
			if($hash!=$subsection) $subsection=$hash;
		}
		$data=Data::getDataByAlias(Yii::app()->controller->getId(),$subsection); 
		$obj->pageTitle=$data->title;
		$_SESSION['SUBSECTION_DATA_ARRAY']=array('alias'=>$data->alias); // метка для элементов, специфичных для подразделов, созданных генератором
		$obj->render('index', array('res' => $data));
	}

/**
 * Получить структурированный массив всех разделов и подразделов
 * @package
 * @subpackage
 */
	static function getObjectsRecursive( $fields=false, // поля извлечения данных
								  $parent_id=false, // id родительского (под)раздела
								  $level=0,	// иерархический уровень текущего подраздела
								  &$result=false // результат; при вхождении в рекурсию передаётся по ссылке
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
		$fields=preg_replace('/\b(\s|\,)parent_id\b/',",t1.parent_id",$fields);
		//if (strstr($fields,"parent_id")
		$query="SELECT ".$fields.", "; // запятая нужна, т.к. в \$fields отсутствует; не добавлять туда, поскольку это вызовет ошибку далее, при конвертации в массив в цикле!
		$query.="
    (   SELECT COUNT(*) AS cnt FROM insur_insurance_object
      WHERE parent_id = t1.id
		AND `status` = 1
    ) AS children";
		
		if ((int)$parent_id>=0) {
			$fields.=",priority";
			$query.=", `priority`";
		}
		$query.=" FROM insur_insurance_object as t1 ";
		if ($parent_id>=0)
			$query.="
    LEFT JOIN order_by_menu AS p ON p.id_object = id ";
		
		$query.=" 
   WHERE t1.parent_id = ".$parent_id." AND `status` = 1
ORDER BY ";
		
		$query.=($parent_id>=0)? "p.priority":"id";
		
		$query.=" ASC";
		
		$res=Yii::app()->db->createCommand($query)->queryAll();
		$fields=preg_replace('/\bt1.parent_id\b/',"parent_id",$fields);
		$arrFields=explode(",",$fields); // поля с табличными данными 
		// присвоить данные полученным объектам:
		for($i=0,$j=count($res);$i<$j;$i++){
			$section_data=$res[$i]; // текущая запись из БД
			for($y=0,$x=count($arrFields);$y<$x;$y++)
				$arrRes[$arrFields[$y]]=$section_data[$arrFields[$y]];
			$arrRes['level']=$level; // добавляем в массив данных сведения об иерархическом уровне текущего подраздела (может пригодиться при назначении HTML-атрибутов и т.п.)
			$result[$section_data['id']]=$arrRes; // сохраняем данные таблицы для подраздела в массиве
			if((int)$section_data['children']){ // если есть дочерние подразделы, делаем рекурсивный вызов метода
				for($k=0,$m=$section_data['children'];$k<$m;$k++){
					self::getObjectsRecursive($fields,(int)$section_data['id'],$level,$result);
				}
			}
			if (isset($xtra_id)
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
/**
 * Описание
 * @package
 * @subpackage
 */
	public static function getSiteDefaultExceptions(){
		return array('search');
	}		
/**
 * Подключить дополнительную таблицу стилей
 * @package
 * @subpackage
 */
	function includeXtraCss($file_path=false){
		if (!$file_path) $file_path='xtra_modules.css';
		echo '<link href="'.Yii::app()->request->getBaseUrl(true).'/css/'.$file_path.'" rel="stylesheet" type="text/css">';	
	}
/**
 * Подключить дополнительный клиентский скрипт
 * @package
 * @subpackage
 */
	function includeXtraJS($file_path=false){
		echo '<script src="'.Yii::app()->request->getBaseUrl(true).'/js/'.$file_path.'"></script>';	
	}

/**
 * Модифицирует массив модулей, приводя его к виду "folder_name"=>"Название модуля"
 * @package
 * @subpackage
 */
	public static function simplifyModules($modules,$mod=NULL){
		$i=0;
		foreach($modules as $key_mod=>$val_mod){
			$key=($mod)? $modules[$key_mod]['module']:$i++;
			$aMods[$key]=$modules[$key_mod]['name'];
		}
		return $aMods;
	}
}
/**
 * Обрабатывает набор исключений для страниц, а именно - те, которые были созданы НЕ генератором
 * @package
 * @subpackage
 */
class Views{
	private $ViewsType;
	// не объявлять как static, иначе не сработает array_walk_recursive()!
	private $ViewsArray=array(
					'esli_proizoshel_strahovoj_sluchay'=>false, 
					'fizicheskim_litzam'=>false,
					'korporativnym_klientam'=>false,
					'malomu_i_srednemu_biznesu'=>false,
					'o_kompanii'=>array('vakansiji','kontakty','news'),
					'partneram'=>false,
				);
	private $ViewsIds=array();
/**
 * Получить массив специфических разделов, - НЕ созданных Генератором
 * @package
 * @subpackage
 */
	public function __construct($flat_list=false){
		if ($flat_list){
			$array=$this->ViewsArray;
			array_walk_recursive($array,array($this,'getViewsIds'));
			$this->ViewsType='ViewsIds';
		}else
			$this->ViewsType='ViewsArray';
	}
/**
 * Возвращает:
 *	либо true как подтверждение принадлежности текущего раздела к массиву исключений Views (если получен id раздела) - для изменения данных в Генераторе
 *  либо алиас в качестве исключения текущего раздела - для проверки в составе родительского раздела и определении способа загрузки контента
 *	либо false, если раздел не найден среди исключений 
 * @package
 * @subpackage
 */
	public function checkView( $section_data, // $section_data->alias/id
							   $controller=false,
							   $flat_list=false
							 ){ 
		$spViews=$this->getViews($flat_list); //
		if ($controller) // фактически означает, что передавали алиас 
			$spViews=$spViews[$controller];// получить массив исключений для текущего контроллера (т.е., - основного раздела (главного меню))
		if (is_array($spViews)){ 
			// передавали id:
			if ($flat_list){ // проверить, есть ли раздел среди исключений:
				if (array_key_exists((int)$section_data,$spViews))
					return true;
			}elseif(in_array($section_data,$spViews)) // есть в массиве контроллера
			 	return array($section_data);
		}else
			return false;
	}
/**
 * Получить массив специфических разделов одного из типов (иерархический/плоский)
 * @package
 * @subpackage
 */
	public function getViews(){
		return $this->{$this->ViewsType};
	}
/**
 * Трансформирует массив Views, делая его "плоским", т.е., оставляет только id и alias, без иерархии.
 * @package
 * @subpackage
 */
	private function getViewsIds($item,$key){
		if( $id = Yii::app()->db->createCommand()->select('id')->from('insur_insurance_object')->where('alias="'.$item.'"')->queryScalar() )
			$this->ViewsIds[$id]=$item;
	}
	function tst(){echo "tst";}
}

/**	ВНЕ КЛАССА ПРЕДНАМЕРЕННО, т.к. некоторые модули не могут получить к нему доступ.
* Возвращает распарсенный, начиная с "?" URL, в виде массива
* @package
* @subpackage
*/
function getUrlHashAsArray($rawUrl=false){
	if (!$rawUrl) 
		$rawUrl=$_SERVER['REQUEST_URI'];
	if (strstr($rawUrl,"?")){
		$arrUrls=explode("?",$rawUrl);
		$hash=array_pop($arrUrls);
		$arrHash=explode("&",$hash);
		$urls=array();
		for($i=0,$j=count($arrHash);$i<$j;$i++){
			$urlParams=explode("=",$arrHash[$i]);
			for($u=0,$r=count($urlParams);$u<$r;$u++){
				$next=$u+1;
				if ($u%2==0&&$next<$r)
					$urls[$urlParams[$u]]=$urlParams[$u+1];
			}
		}
		return $urls;			
	}else
		return false;	
}
/**
 * Распарсить URL по "/"
 * @package
 * @subpackage
 */
function parseUrl($make_string=false,$get_hash=false){
	$arrUrl=explode("/",$_SERVER['REQUEST_URI']);
	//var_dump("<h1>arrUrl:</h1><pre>",$arrUrl,"</pre>");die($_SERVER['HTTP_HOST']);
	//echo "<div class=''>last_piece= ".$last_piece."</div>";
	$hash=$last_piece=false;
	if (($pos=strpos($last_piece,"?"))!==false){
		$last_piece=array_pop($arrUrl);
		//echo "<div class=''>pos= ".$pos."</div>";
		$hash=substr($last_piece,0);
		//echo "<div class=''>hash= ".$hash."</div>";
		array_push($arrUrl,substr($last_piece,0,$pos));
	}
	if ($arrUrl[0]=='') 
		unset($arrUrl[0]);
	array_unshift($arrUrl,'http:/',$_SERVER['HTTP_HOST']);
	if ($make_string)
		$arrUrl=implode("/",$arrUrl); //var_dump("<h1>arrUrl:</h1><pre>",$arrUrl,"</pre>");
	if($get_hash&&$hash){ 
		//echo "<div class=''>value: 1, hash: ".$hash."</div>";
		$urls=getUrlHashAsArray($hash);
		$arr=array('uris'=>$arrUrl,'hashes'=>$urls);
		//var_dump("<h1>arr:</h1><pre>",$arr,"</pre>");
		return array('uris'=>$arrUrl,'hashes'=>$urls);
	}else
		return array('uris'=>$arrUrl);
}
?>