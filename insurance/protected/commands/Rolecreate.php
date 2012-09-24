<?php
class RolecreateComand extends  CConsoleCommand
{
	public function run($args){
		$auth=Yii::app()->authManager;

		//сбрасываем все существующие правила
		$auth->createOperation('create','создание записи');
		$auth->createOperation('read','просмотр записи');
		$auth->createOperation('update','редактирование записи');
		$auth->createOperation('delete','удаление записи');

		$role=$auth->createRole('reader');
		$role->addChild('readPost');

		$role=$auth->createRole('author');
		$role->addChild('reader');
		$role->addChild('createPost');
		$role->addChild('updateOwnPost');

		$role=$auth->createRole('editor');
		$role->addChild('reader');
		$role->addChild('updatePost');

		$role=$auth->createRole('admin');
		$role->addChild('editor');
		$role->addChild('author');
		$role->addChild('deletePost');

		$auth->assign('reader','readerA');
		$auth->assign('author','authorB');
		$auth->assign('editor','editorC');
		$auth->assign('admin','adminD');

		//сохраняем роли и операции
		$auth->save();

		$this->render('install');
	}
}