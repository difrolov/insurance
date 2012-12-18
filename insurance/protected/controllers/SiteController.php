<?php
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
/**
 * Описание
 * @package
 * @subpackage
 */
	public function actionSendApplication(){
/*	var_dump("<h1>post:</h1><pre>",$_POST,"</pre>");
array(5) {
  ["name"]=>
  string(12) "Сержик"
  ["email"]=>
  string(16) "srgg67@gmail.com"
  ["phone"]=>
  string(12) "+79044428447"
  ["message"]=>
  string(40) "Мессага такая мессага"
  ["yt0"]=>
  string(19) "Отправить!"
}
*/		
		$email = Yii::app()->email;
		$email->to = Yii::app()->params['adminEmail'];
		$email->from = $_POST['email'];
		$email->subject = 'Заявка потенциального клиента';
		$email->message = $_POST['message']."
<hr>
<P>Данные заказчика:</P>
<P>Имя: $_POST[name]</P>
<P>Email:  $_POST[email]</P>
<P>Телефон: $_POST[phone]</P>
<P>Вид страхования: $_POST[insur_species]</P>";
		if (!$email->send())
			die("<div style='color:red;'>Ошибка отправки почты...</div>");
		else{?>
<script>
alert('Сообщение отправлено!\nМы свяжемся с вами в ближайшее время. Спасибо за обращение в нашу компанию!');
location.href='<?=Yii::app()->request->getBaseUrl(true)?>';
</script>        
	<?		//$this->redirect(Yii::app()->request->getBaseUrl(true));
		}
	}	
/**
 * Описание
 * @package
 * @subpackage
 */
	public function actionSendQuestion(){
		$email = Yii::app()->email;
		$email->to = Yii::app()->params['adminEmail'];
		$email->from = $_POST['email'];
		$email->subject = 'Вопрос потенциального клиента';
		$email->message = $_POST['message']."
\nДанные потенциального клиента:
\nимя: $_POST[name]
\nemail:  $_POST[email]";
		if (!$email->send())
			die("<div style='color:red;'>Ошибка отправки почты...</div>");
		else{?>
<script>
alert('Спасибо за ваш вопрос!\nМы постараемся ответить на него в ближайшее время.');
location.href='<?=Yii::app()->request->getBaseUrl(true)?>';
</script>        
	<?		//;
		}
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{	// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
/**
 * Описание
 * @package
 * @subpackage
 */
	public function actionDebug(){
		
		$this->render('debug',array());
	}
	/**
	  *
	  */
	public function actionMap()
	{	
		$res=Data::getObjectsRecursive();
		$this->render('map', array('res'=>$res));
	}
/**
 * Описание
 * @package
 * @subpackage
 */
	function actionSearch(){
		if ($_SERVER['REQUEST_METHOD']=="POST"){	
			require Yii::getPathOfAlias('webroot').'/protected/views/site/search/class.search.php';
			$fields_to_look = array('name','content');
			$table = 'insur_article_content';
			$key = 'id';
			$fields = array('name','content');
			$keywords = $post_words = $_POST['keywords'];
			$found = new search_engine();
			$found->set_table($table);
			$found->set_primarykey($key);
			$found->set_keyword($keywords);
			$found->set_fields($fields);
			$getStopWords=array();
			// id id:			
			$result = $found->set_result($fields_to_look);
			for($i=0,$j=count($result);$i<$j;$i++){
				$article_id=$result[$i];
				$query1="
	SELECT `id`, `name`
FROM insur_insurance_object WHERE 
    `content` LIKE '%:: article id: ".$article_id."%'";
				$sections_ids[$article_id]=Yii::app()->db->createCommand($query1)->queryAll();
				// 98 КАСКО
				// 35 Компании перевозчики
				$article_data = Yii::app()->db->createCommand()->select('name, content')->from('insur_article_content')->where('id=:id', array(':id'=>$article_id))->queryRow();
				$res[$article_id]=array(
						'name'=>$article_data['name'],
						'content'=>$article_data['content'],
						'sections'=>$sections_ids[$article_id]
					);
				$test=false;
				if ($test){
					echo "<blockquote style='padding:10px; margin:10px; border:solid 1px'>";
						echo "<div>id = ".$article_id."</div>"; 
						echo "<div>name = ".$res[$article_id]['name']."</div>"; 
						echo "<div>content here... </div>"; 
						if (empty($res[$article_id]['sections']))
							echo "<div class=''><pre>".$query1."</pre></div>";
						else var_dump("<pre>sections:",$res[$article_id]['sections'],"</pre>"); 
					echo "</blockquote>"; 
				}
			} 	
			/*
				[19]=>
				  array(3) {
					["name"]=>"Здоровье"
					["content"]=>
					string(2199) "
							TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT
							TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT
				"
					["sections"]=>
						array(2) {
						  [0]=>
						  array(2) {
							["id"]=>
							string(2) "87"
							["name"]=>
							string(84) "Страхование от несчастных случае в и болезней"
						  }
						  [1]=>
						  array(2) {
							["id"]=>
							string(3) "133"
							["name"]=>
							string(70) "Добровольное медицинское страхование"
						  }
						}
					  } */
			if ($i)
				$getStopWords=$found->getStopWords(false); // array
			else $res="данных не обнаружено...";
			
			$true_words=array_diff($found->keywords,$getStopWords);
			$true_words="'".implode("','",$true_words)."'";
		}else{
			$keywords=$true_words=$post_words=false;
			$res="Введите поисковый запрос...";
		}
		$this->render('search', array('res'=>$res,'swords'=>$post_words,'true_words'=>$true_words));
	}
	
	/**
	  *
	  */
	public function actionOtpravit_zajavku()
	{	$send_app="Контент страницы \"Отправить заявку\"";
		$this->render('otpravit_zajavku', array('res'=>$send_app));
	}
	/**
	  *
	  */
	public function actionZadat_vopros()
	{	$ask_us="Контент страницы \"Задать вопрос\"";
		$this->render('zadat_vopros', array('res'=>$ask_us));
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
}