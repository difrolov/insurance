<?php
class action{
	public static function getJobs($params=false,$pager=false){
		$model = new InsurJobs();
		$gridDataProvider = $model->search($params,$pager);
		return $gridDataProvider;
	}
}

?>