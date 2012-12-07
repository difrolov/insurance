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
<P>имя: $_POST[name]</P>
<P>email:  $_POST[email]</P>
<P>телефон: $_POST[phone]</P>";
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
	<?		//$this->redirect(Yii::app()->request->getBaseUrl(true));
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
			require_once Yii::getPathOfAlias('webroot').'/protected/views/site/search/class.search.php';
			
			$config = array('localhost','root','','insur_db');
			$table = 'insur_article_content';
			$key = 'id';
			$fields = array('name','content');
			
			$keyword = $_POST['keyword'];
			
			$found = new search_engine($config);
			$found->set_table($table);
			$found->set_primarykey($key);
			$found->set_keyword($keyword);
			$found->set_fields($fields);			
			$result = $found->set_result();
			$resultStr=implode(",",$result);
			$results=0;
			if ($resultStr&&$results=Yii::app()->db->createCommand("
	SELECT `id`, `name`, `content`
FROM insur_article_content
WHERE id IN ( $resultStr )")->queryAll()){
				for($i=0,$j=count($results);$i<$j;$i++){
					$row=$results[$i];
					foreach ($row as $field=>$content) {
						//$arrCont=explode(" ",$row['content']);
						//$trim=array_slice($arrCont,0,40);
						//$res[$row['name']]=implode(" ",$trim);
						$res[$row['name']]=$row['content'];
					}
				}
			}else $res="Данных не обнаружено...";
		}else{
			$keyword=false;
			$res="Введите поисковый запрос...";
		}
		$this->render('search', array('res'=>$res,'swords'=>$keyword));
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