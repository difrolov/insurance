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
		$sql='
			SELECT ....';
			//return Yii::app()->db->createCommand($sql)->queryAll();
		return "<p>
		Это - тестовый абзац № 1:
		Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed 

		diam nonumy eirmod tempor invidunt ut labore et dolore magna 

		aliquyam erat, sed diam voluptua. At vero eos et accusam et 

		justo duo dolores et ea rebum. Stet clita kasd gubergren, no 

		sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
		
		<p>
		А это, это уже № 2:
		Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed 

		diam nonumy eirmod tempor invidunt ut labore et dolore magna 

		aliquyam erat, sed diam voluptua. At vero eos et accusam et 

		justo duo dolores et ea rebum. Stet clita kasd gubergren, no 

		sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
		
		<p>
		И последнее, но не в последнюю очередь -  № 3!:
		Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed 

		diam nonumy eirmod tempor invidunt ut labore et dolore magna 

		aliquyam erat, sed diam voluptua. At vero eos et accusam et 

		justo duo dolores et ea rebum. Stet clita kasd gubergren, no 

		sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
		<p>
		А вот нифига-то и не в последнюю! Натебе № 4!:
		Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed 

		diam nonumy eirmod tempor invidunt ut labore et dolore magna 

		aliquyam erat, sed diam voluptua. At vero eos et accusam et 

		justo duo dolores et ea rebum. Stet clita kasd gubergren, no 

		sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
		";
	}
}