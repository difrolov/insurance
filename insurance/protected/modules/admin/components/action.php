<?php
class action{
	public static function getJobs(){
		$model = new InsurJobs();
		$gridDataProvider = $model->search();
		return $gridDataProvider;
	}
}

?>