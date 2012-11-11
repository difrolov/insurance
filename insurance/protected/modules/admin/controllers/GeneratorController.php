<?php

class GeneratorController extends Controller
{
	public $layout = "application.modules.admin.views.layouts.admin";

	public function actionIndex(){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}

		$model = new InsurArticleContent;
		$sql = "SELECT o.`name`,o.`status`,o.`parent_id`,o.`alias`,m.id
				FROM insur_modules as m
				LEFT JOIN insur_insurance_object as o ON o.`id`=m.`object_id`
				WHERE o.`status`= 1";
		$model_modules = Yii::app()->db->createCommand($sql)->queryAll();
		$this->render('index',array('model'=>$model,'model_modules'=>$model_modules));
	}

	public function actionGetObject(){

		if(!Yii::app()->user->checkAccess('admin')){
	    	Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		if(isset($_GET['id'])){
			//достаём объект из базы
			$object = InsurInsuranceObject::model()->findByPk($_GET['id']);
			if(!$object){
				$this->redirect('index');
			}
						//таблица для отображения
			$model = new InsurInsuranceObject();

			$gridDataProvider['parent'] = $model->search('id='.$_GET['id']);
			$gridDataProvider['child'] = $model->search('parent_id='.$_GET['id']);
			$this->render('getobject',array(/* 'obj'=>$obj,'child_obj'=>$child_obj, */'gridDataProvider'=>$gridDataProvider));
		}
	}

	//
	public function actionUpdate(){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		if(isset($_GET['id'])){
			//Достаем контент страницы
			$content = InsurArticleContent::model()->findAll(array('condition'=>"object_id=".$_GET['id']));
			if(!$content){
				$this->redirect('index');
			}
			//таблица для отображения
			$model = new InsurArticleContent();
			$gridDataProvider = $model->search('object_id='.$_GET['id']);
			$this->render('update',array('gridDataProvider'=>$gridDataProvider));
		}
	}

	public function actionEdit(){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		die('Edit mode');
		
		if(isset($_GET['id'])){
		
		}
	}
	
	public function actionSave(){ // см. _docs\tests\test2.php
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		
		$localdata=false;
		
		// если в режиме тестирования, т.е., данные извлекаются НЕ из запроса:
		if (!$post=$_POST) {
			$localdata=true;
			$post=TestGenerator::$test_post;
		}
		// начало записи в текстовом модуле:	
		$dText="Текст :: "; // общее
		$artId="article id: "; // дописать подстроку для добавленной существующей статьи
		$dTextArtId=$dText.$artId; // вся подстрока для добавленной существующей статьи
		foreach($post as $key=>$val){
			if ($key=="blocks"){ // если блоки с модулями
				
				foreach($val as $block => $data){ // перебрать каждый блок
					$arrMods=explode("|",$data); // получить массив модулей
					if ( strstr($data,$dText) // если в наборе модулей есть начало для текстового блока
						 && !strstr($data,$dTextArtId) // и нет записи о добавл
					   ){ 
						for($i=0;$i<count($arrMods);$i++){
							// повторить условие поиска текста для текущего модуля:
							if ( strstr($arrMods[$i],$dText) // текст новой статьи
								 && !strstr($arrMods[$i],$dTextArtId) // но не id существующей статьи
							   ){
								$start=strpos($arrMods[$i],$dText)+strlen($dText);
								$finish=strpos($arrMods[$i],"^");
								$strlen=$finish-$start;
								$header=substr($arrMods[$i],$start,$strlen);
								$text=substr($arrMods[$i],$finish+1);
								//1. добавить новую статью в таблицу статей (ПОЛЯ ТАБЛИЦЫ)
								if ($localdata){
									$arrMods[$i]=TestGenerator::testCodeOutput1($artId);
								}else{
									// 1. сохранить статью как новую...
									/************************************
										Заголовок статьи: $header (см. выше)
										Текст статьи: $text (см. выше)
										
										ПРОЦЕДУРА СОХРАНЕНИЯ....
									
									************************************/

									// 2. получить id сохранённой статьи
									/************************************
									
										ПРОЦЕДУРА ПОЛУЧЕНИЯ id....
										на выходе получаем $article_id
									************************************/
									
									// заменяем контент текстового модуля:
									// вместо заголовка и текста подставляем:
									// "Текст :: article id: [id_статьи]";
									$arrMods[$i]=$dTextArtId.$article_id;
								}							
							}
						}
					}
					if (!strstr($data,"header:"))	
						$val[$block]=$arrMods; // обратно в строку
				}
			}else if ($localdata) TestGenerator::testCodeOutput2($key,$val);
			$post[$key]=$val;
		}	
		// модифицируем массив данных:
		$parent_id=$post['parent'];
		$name=$post['name'];
		$alias=$post['alias'];
		$title=$post['title'];
		$keywords=$post['keywords'];
		$description=$post['description'];
		// удаляем элементы массива, которые не должны быть записаны в insur_insurance_object.content  
		unset($post["blocks"]["activeBlockIdentifier"]);
		unset($post["blocks"]["moduleClickedLocalIndex"]);
		unset($post["parent"]);
		unset($post["name"]);
		unset($post["alias"]);
		unset($post["title"]);
		unset($post["keywords"]);
		unset($post["description"]);
		
		/************************************/

		// 3. Сохранить подраздел
		/************************************/
		
		/************************************
		
		ПРОЦЕДУРА СОХРАНЕНИЯ ПОДРАЗДЕЛА....

		insur_insurance_object.parent_id: $parent_id

		insur_insurance_object.name: $name

		insur_insurance_object.alias: $alias

		insur_insurance_object.title: $title

		insur_insurance_object.keywords: $keywords

		insur_insurance_object.description: $description";

		insur_insurance_object.content: serialize($post);
		
		************************************/
		
		
		if ($localdata){
			TestGenerator::testCodeOutput3($post);
		}else{
			$jenc=json_encode(array("result"=>"Подраздел создан!"));				
			echo $jenc;
		}
	}
}

//*********************************************************************************
// для тестирования:
class TestGenerator{
	public $test_post=array("Schema"=>"4ss",		
					"blocks"=>array(
						"1"=>"Новость|Текст :: Статеюшка такая!^<p>\n\tПринцип нарушен, что человек, попадающий в другую эпоху, другое время, все равно остается самим собой. Но мне кажется этот прием работает на то, чтобы доказать то, что мы обычно любим говорить, вот если бы я был бы тогда, я бы сделал...</p>\n|Новость",
						"2"=>"header:Подзаголовок такой подзаголовок!",
						"3"=>"Готовое решение 1",
						"4"=>"Готовое решение 1",
						"5"=>"Готовое решение 2|Случайная статья",
						"footer"=>"Готовое решение 2|Текст",
						"activeBlockIdentifier"=>'1',
						"moduleClickedLocalIndex"=>'1'
					),
					"parent"=>"4",
					"name"=>"Экстремальное страхование",
					"alias"=>"myarticle",
					"title"=>"Про всякие дела",
					"keywords"=>"статья мессага",
					"description"=>"Описание будет позже. Обязательно!"
					);
	function testCodeOutput1($artId){
		return $artId." [id добавленной статьи]";
									echo "<div>
									<span style='color:red'>1. Добавляем в таблицу данные новой статьи:</div>
										<div style='border:solid 1px;'>$header</div>
										<br>
										<div style='border:solid 1px;'>$text</div>
											<span style='color:blue'>2. Заменяем запись в текстовом модуле на id новой (только что добавленной) статьи:</span>
										</div>
										<div style='border:solid 1px;'>\$arrMods[$i]=".$arrMods[$i]."</div>
									</div>";
	}
	function testCodeOutput2($key,$val){
		echo "<div><div>$key: $val</div></div>";
	}
	function testCodeOutput3($post){
		echo "<h4>Сериализованный массив:</h4>";	
		var_dump("<pre>",$post,"</pre>");
	}
}