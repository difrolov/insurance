<?php

class AjaxController extends Controller
{
	function actionMakeArtPreview(){
		if(isset($_REQUEST['article_id'])){
			$art_data=Yii::app()->db->createCommand("SELECT `name`, `content` FROM insur_article_content WHERE `id` = ".$_REQUEST['article_id'])->queryAll();
			echo $art_data[0]['name']."^".$art_data[0]['content'];
		}
		exit;
	}
	function actionAdminMenuEdit(){
		if(isset($_POST['id'])){
			$model = InsurInsuranceObject::model()->findAll(array('condition'=>'parent_id = '.$_POST['id']));
			$parent = InsurInsuranceObject::model()->findAll(array('condition'=>'parent_id = -1'));
			for	($i=0; $i<count($parent); $i++){
				$arr_par[$parent[$i]->id] = $parent[$i]->name;
			}
			if(count($model)>0){
				for	($i=0; $i<count($model); $i++){
					$arr[$i]['name'] = $model[$i]->name;
					$arr[$i]['id'] = $model[$i]->id;
					$arr[$i]['status'] = $model[$i]->status;
					$arr[$i]['alias'] = $model[$i]->alias;
					$arr[$i]['date_changes'] = $model[$i]->date_changes;
					$arr[$i]['parent_id'] = $arr_par[$model[$i]->parent_id];
				}
				echo json_encode($arr);
			}
		}
	}
	//достаем из базы модули для генератора страниц
	public function actionGetModule(){
		if(isset($_POST['id_module'])){
			$sql = "SELECT o.`name`,o.`status`,o.`parent_id`,o.`alias`
					FROM insur_modules as m
					LEFT JOIN insur_insurance_object as o ON o.`id`=m.`object_id`
					WHERE m.id=".$_POST['id_module'];
			$res = Yii::app()->db->createCommand($sql)->queryAll();
			var_dump($res);exit;
			if(count($module)>0){

			}
		}
	}
	public function actionGeocode(){
		if(isset($_POST['address'])){
			$xml = simplexml_load_file('http://maps.google.com/maps/api/geocode/xml?address='.$_POST['address'].'&sensor=false');
			// Если геокодировать удалось, то записываем в БД
			$status = $xml->status;
			//echo $xml;
			if ($status == 'OK') {
				$lat = $xml->result->geometry->location->lat;
				$lng = $xml->result->geometry->location->lng;
				echo json_encode(array('lat'=>$lat,'lng'=>$lng));
			} else {
				echo "<h4 style='color:#678;'>Geolocation Error!</h4>";
			}
		}
	}
	public function actionAutoCompleteRegion() {

		if (isset($_GET['q'])) {

			$criteria = new CDbCriteria;
			$criteria->condition = 'name LIKE :name';
			$criteria->params = array(':name'=>$_GET['q'].'%');
			$region = InsurRegion::model()->findAll($criteria);

			$resStr = '';
			foreach ($region as $region) {
				$resStr .= $region->name."\n";
			}
			echo $resStr;
		}
	}
}