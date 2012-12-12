<?php

class AjaxController extends Controller
{

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
			$regions = InsurRegion::model()->findAll($criteria);

			$resStr = '';
			foreach ($regions as $region) {
				$resStr .= $region->name."\n";
			}

		}
		if(isset($_POST['data']) && $_POST['data']=='contact'){
			$regions = InsurContacts::model()->findAll(array('select'=>'region','order'=>'region'));

			$res = array();
			foreach ($regions as $region) {
				$res []= $region->region;
			}
			$resStr = json_encode($res);
		}
		echo $resStr;
	}
}