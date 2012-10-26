<?php

class AjaxController extends Controller
{
	function actionMakeArtPreview(){
		if(isset($_REQUEST['article_id'])){
			$model = new InsurArticleContent;
			echo $model->find(array('condition'=>"id=".$_REQUEST['article_id']))->content;
		}
		exit;
	}
}