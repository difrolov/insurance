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
		$model=new Users;
		$this->performAjaxValidation($model);
		if (isset($_POST['Users'])){
			// Аутентифицируем пользователя по имени и паролю
			$identity=new UserIdentity($_POST['Users']['login'],$_POST['Users']['password']);
			if($identity->authenticate()){
				Yii::app()->user->login($identity);
				var_dump(Yii::app()->user->group);
				$this->redirect('index');
			}else{
				echo $identity->errorMessage;
			}
			// Выходим
			Yii::app()->user->logout();
		}
		$this->render('login',array('model'=>$model));
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