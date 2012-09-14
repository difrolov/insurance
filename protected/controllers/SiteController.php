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
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
	/**
	  *
	  */
	public function actionO_kompanii()
	{	//обращаемся к модели и получаем данные таблицы:
		/*$about=Genre::model()->findAll( array('select'=>'name',
								     	'condition'=>' name <> "" '
									  ), //условие запроса
								     array('order'=>' id DESC '
								   )
								 );*/
		$about="Контент страницы \"О компании\"";
		$this->render('o_kompanii', array('res'=>$about));
	}
	/**
	  *
	  */
	public function actionKorporativnym_klientam()
	{	$corporative="Контент страницы \"Корпоративным клиентам\"";
		$this->render('korporativnym_klientam', array('res'=>$corporative));
	}
	/**
	  *
	  */
	public function actionMalomu_i_srednemu_biznesu()
	{	$smallBusiness="Контент страницы \"Малому и среднему бизнесу\"";
		$this->render('malomu_i_srednemu_biznesu', array('res'=>$smallBusiness));
	}
	/**
	  *
	  */
	public function actionFizicheskim_litzam()
	{	$privatePersons="Контент страницы \"Физическим лицам\"";
		$this->render('fizicheskim_litzam', array('res'=>$privatePersons));
	}
	/**
	  *
	  */
	public function actionPartneram()
	{	$partners="Контент страницы \"Партнёрам\"";
		$this->render('partneram', array('res'=>$partners));
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