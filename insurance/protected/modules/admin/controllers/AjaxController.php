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
}