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
			$results=Yii::app()->db->createCommand("
	SELECT `id`, `name`, `content`
FROM insur_article_content
WHERE id IN ( $resultStr )")->queryAll();
			for($i=0,$j=count($results);$i<$j;$i++){
				$row=$results[$i];
				foreach ($row as $field=>$content)
					$res[$row['name']]=$row['content'];
			}
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