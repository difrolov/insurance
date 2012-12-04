<?php

class UserController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
*/
	public function actionLogin()
	{
		$model=new InsurCoworkers();
		$this->performAjaxValidation($model);
		if (isset($_POST['InsurCoworkers'])){
			// Аутентифицируем пользователя по имени и паролю
			$identity=new UserIdentity($_POST['InsurCoworkers']['login'],$_POST['InsurCoworkers']['password']);
			if($identity->authenticate()){
				Yii::app()->user->login($identity);
				/* если мы пришли из админки, то отправляем обратно */
				if(isset($_GET['admin'])){
					$this->redirect(Yii::app()->homeUrl.'admin');
				}
			}else{
				echo $identity->errorMessage;
			}
			// Выходим
		}
		$this->render('login',array('model'=>$model));
	}
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}