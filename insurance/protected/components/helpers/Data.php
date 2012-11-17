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
		if ($data === null&&$subsection) {
			throw new CHttpException(404, 'Not found');		
		}
		return $data;	
	}
	/*
	 *	@package		content
	 *	@subpackage		metadata
	 */
	function setPageData($this_obj, $section_data, $test=false){
		// генерирует и размещает title страницы:
		$this_obj->pageTitle=Yii::app()->name . ' - '.$section_data->title;
		// генерирует и размещает название страницы в цепочке breadcrumbs:
		$breadcrumbs=array();
		if ($section_data->parent_id>0)	{	
			$parentName=InsurInsuranceObject::model()->find(array(
							'select'=>'name',
							'condition'=>'id = '.$section_data->parent_id,
						)); 
			$this_obj->breadcrumbs=array(
				$parentName->name=>array('index'),
				$section_data->name
			);
		}else 
			$this_obj->breadcrumbs=array(
				$section_data->name,
			);
		// устанавливает description страницы:
		Yii::app()->clientScript->registerMetaTag($section_data->description, 'description');
		// прописывает первый заголовок на странице, сразу же под breadcrumbs.
		// если заголовок не установлен (нет в БД), подставляет название страницы:
		if (!$section_data->first_header)
			$section_data->first_header=$section_data->name;
		// это он - заголовок :)
		echo "<h1>".$section_data->first_header."</h1>";
		// если тестируемся:
		if ($test) {
			echo "parent_id = ".$section_data->parent_id."<hr>";
			echo "title: ".$section_data->title."<hr>";
			echo "keywords: ".$section_data->keywords."<hr>";
			echo "description: ".$section_data->description."<hr>";
		}
	}
}
?>