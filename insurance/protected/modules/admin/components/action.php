<?php
class action{
	public static function getJobs($params=false){
		$model = new InsurJobs();
		$gridDataProvider = $model->search($params);
		return $gridDataProvider;
	}
}

?>