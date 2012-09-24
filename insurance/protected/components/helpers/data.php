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
}
?>