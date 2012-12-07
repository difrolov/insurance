<?php
class action{
	public static function getJobs($params=false,$pager=false){
		$model = new InsurJobs();
		$gridDataProvider = $model->search($params,$pager);
		return $gridDataProvider;
	}
	public static function getContacts($params=false,$pager=false){
		$model = new InsurContacts();
		$gridDataProvider = $model->search($params,$pager);
		return $gridDataProvider;
	}
}

?>