<?php
class AjaxController extends Controller
{
	function __construct(){
		if ( isset($_GET['do'])
			 && $_GET['do']=='preview'
		   )
		if ($article_id=$_GET['article_id']) {
			echo $this->makeArtPreview($article_id);
			exit;
		}
	}

	function makeArtPreview($article_id){
		if(!is_null($article_id)){
			$model = InsurArticleContent::model()->find(array('condition'=>"id=".$article_id));
		}
		return $model->content;
	}
}