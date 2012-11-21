<?php
class GeneratorController extends Controller
{
	public $layout = "application.modules.admin.views.layouts.admin";
	protected $groot=NULL;
	static protected $section_root;
	
	function getGeneratorRoot(){
		if (!$this->groot)
			$this->groot=Yii::getPathOfAlias('webroot').'/protected/modules/admin/views/generator/';
	}
	/**
	 * @package
	 * Получить данные существующих модулей
	 */
	function getAllModules(){
		$model = new InsurArticleContent;
		$sql = "SELECT o.`name`,o.`status`,o.`parent_id`,o.`alias`,m.id
				FROM insur_modules as m
				LEFT JOIN insur_insurance_object as o ON o.`id`=m.`object_id`
				WHERE o.`status`= 1";
		$model_modules = Yii::app()->db->createCommand($sql)->queryAll();
		return array('model'=>$model,'model_modules'=>$model_modules);
	}
	/**
	 * @package
	 * 
	 */
	public function actionIndex(){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		$this->getGeneratorRoot();
		$arrModData=$this->getAllModules();
		$this->render('index',array('model'=>$arrModData['model'],'model_modules'=>$arrModData['model_modules']));
	}
	/**
	 * @package
	 * 
	 */
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
	/**
	 * @package
	 * Извлечь данные макета выбранного подраздела и разместить их в HTML
	 */
	public function actionEdit($section_id=false){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		if($section_id){
			$this->getGeneratorRoot();
			$data=InsurInsuranceObject::model()->findAll(
					array('select'=>'name, parent_id, alias, category_id, title, keywords, description, content',
							'condition'=>'id = '.$section_id.' AND status = 1'
						));
			$arrModData=$this->getAllModules();
			$this->render('index', array('data' => $data,'model'=>$arrModData['model'],'model_modules'=>$arrModData['model_modules']));
		}
	}
	
	public function actionSave(){ // см. _docs\tests\test2.php
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
			
		$localdata=false;
		if (isset($_GET['gtest']))
			$localdata=$_GET['gtest'];

		// если в режиме тестирования, т.е., данные извлекаются НЕ из запроса:
		if (!$post=$_POST) {
			$localdata=true;
			$post=TestGenerator::$test_post;
			var_dump("<h1>".__LINE__." \$post:</h1><pre>",$post,"</pre>");
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
						 && !strstr($data,$dTextArtId) // и нет записи о добавленной существующей статье (article id:)
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
								$drop_saving=false;
								if(!$drop_saving){
									// 1. сохранить статью как новую...
									/************************************
										Заголовок статьи: $header (см. выше)
										Текст статьи: $text (см. выше)
										
										ПРОЦЕДУРА СОХРАНЕНИЯ....
									
									************************************/
									$model_content = new InsurArticleContent;
									$model_content->content = $text;
									$model_content->name = $header;
									$model_content->status = 1;
									$model_content->created = date("Y-m-d H:i:s");
									$model_content->object_id = $post['parent'];
									$model_content->insur_coworkers_id = Yii::app()->user->id;
									
									/*var_dump("<h1>user:</h1><pre>",Yii::app()->user,"</pre>");
									echo "<div class=''>
										content= ".$model_content->content."<br>
										name= ".$model_content->name."<br>
										status= ".$model_content->status."<br>
										created= ".$model_content->created."<br>
										object_id= ".$model_content->object_id."<br>
										insur_coworkers_id= ".$model_content->insur_coworkers_id."<br>
									</div>";
									
									die();*/
									
									if(!$model_content->save()){
										var_dump("<h1>ERROR:</h1><pre>",$model_content->getErrors(),"</pre>");
										die();
									}
									/*if (!){
										$jenc=json_encode(array("result"=>mysql_error()));				
										echo $jenc;
										exit;
									}*/
									// 2. получить id сохранённой статьи
									/************************************
									
										ПРОЦЕДУРА ПОЛУЧЕНИЯ id....
										на выходе получаем $article_id
									************************************/
									$article_id = $model_content->id;
									
									// заменяем контент текстового модуля:
									// вместо заголовка и текста подставляем:
									// "Текст :: article id: [id_статьи]";
									$arrMods[$i]=$dTextArtId.$article_id;
								}
								if ($localdata) {
									echo "<div class=''>".__LINE__." article_id= ".$article_id." (".gettype($article_id).")<hr>
									\$arrMods[$i] = ".$arrMods[$i]."<hr>
									</div>";
								}
							}
						}
					}
					if (!strstr($data,"header:"))	
						$val[$block]=$arrMods; // обратно в строку
					
					if ($localdata){
						echo "<div>\$block = $block</div>arrMods:<br>";
						var_dump("<pre>",$arrMods,"</pre>");
					}
				}
			}else if ($localdata) TestGenerator::testCodeOutput2($key,$val);
			$post[$key]=$val;
			
			if ($localdata&&$key=="blocks"){
				echo "<div>\$post[$key]:</div>";
				var_dump("<pre>",$post[$key],"</pre>");
			}
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
		$model_obj = new InsurInsuranceObject;
		$model_obj->parent_id = $parent_id;
		$model_obj->name = $name;
		$model_obj->status = 1;
		$model_obj->alias = $alias;
		$model_obj->date_changes = date("Y-m-d H:i:s");
		$model_obj->keywords = $keywords;
		$model_obj->description = $description;
		$model_obj->content = serialize($post);
		$model_obj->save();
		$section_id=$model_obj->id;
		
		if ($localdata){
			TestGenerator::testCodeOutput3($post,$model_obj->content,__LINE__);
		}else{
			$show_content="RESULT :: ";
			if (isset($article_id))
				$show_content.="article_id: ".$article_id.", ";
			$show_content.="section_id: ".$section_id;
			self::getParents($section_id);
			//echo "<hr>all parents: ".self::$section_root;
			//die();	
			$jenc=json_encode(array("result"=>self::$section_root));				
			echo $jenc;
		}
	}
	function getParents($section_id,$child_id=false){
		$query="SELECT `parent_id` FROM insur_insurance_object
	WHERE `id` = $section_id";
		$arr_parent_id=Yii::app()->db->createCommand($query)->queryAll();
		/* 
			1) 	getParents(7)
				section_id = 7
				parent_id = 6
				child_id = false
		
			2)	getParents(6,7)
				section_id = 6
				parent_id = 2
				child_id = 7
				section_id = 6/7

			3)	getParents(2,6/7)
				section_id = 2
				parent_id = -1
				child_id = 6/7
				section_id = 2/6/7
			
			4)  getParents(-1,2/6/7)
				section_id = -1
				parent_id = 0
				child_id = 6/7
				section_id = -1/2/6/7
				return -1/2/6/7
		*/
		if (isset($arr_parent_id[0]))
			$parent_id=$arr_parent_id[0]['parent_id'];
		
		if ($child_id)
			$section_id.="/".$child_id;
		
		if (!isset($parent_id)||$parent_id<0){
			$arrRoots=explode("/",$section_id);
			$root=array();
			for($i=0,$j=count($arrRoots);$i<$j;$i++){
				$id=$arrRoots[$i];
				$query="SELECT `alias` FROM insur_insurance_object WHERE `id` = $id";
				$arr_alias=Yii::app()->db->createCommand($query)->queryAll();
				$root[]=$arr_alias[0]['alias'];
			}
			self::$section_root=implode("/",$root);
		}else{ // передать родительский id, текущий id
			self::getParents( (int)$parent_id, // 6
							  $section_id // 7
							);
		}
	}
}
//*********************************************************************************
// для тестирования:
class TestGenerator{

/*
Schema":"100","blocks":{"1":"Новость|Готовое решение 1"},"parent":"3","name":"Исторический","alias":"historical","title":"Про то, что было","keywords":"история хистори слухи сплетни","description":"страница о славных днях прошлого"}
*/
	
	public static $test_post=array(
							"Schema" => "100",
							"blocks"=>array("1" => "Новость|Готовое решение 1|Текст :: Про голых чувагов!^<p>\n\tЗа введение запрета на обнаженку в Сан-Франциско проголосовали 6 из 11 членов наблюдательного совета. А это значит, что больше не будет никаких раздеваний на площадях, улицах, в метро и автобусах одного из главных туристических центров мира.</p>\n"),
							"parent" => "3",
							"name" => "Исторический",
							"alias" => "historical",
							"title" => "Про то, что было",
							"keywords" => "история хистори слухи сплетни",
							"description" => "страница о славных днях прошлого"

					/*"Schema"=>"4ss",		
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
					"description"=>"Описание будет позже. Обязательно!"*/
					);
	
	function testCodeOutput1($artId,$header,$text){
		echo "<div>
		<span style='color:red'>1. Добавляем в таблицу данные новой статьи:</div>
			<div style='border:solid 1px; background:lightskyblue; padding:10px;'>".$header."</div>
			<br>
			<div style='border:solid 1px; background:lightyellow; padding:10px;'>".$text."</div>
				<span style='color:blue'>2. Заменяем запись в текстовом модуле на id новой (только что добавленной) статьи:</span>
			</div>
			<div style='border:solid 1px;'>id добавленной статьи: ".$artId."</div>
		</div>";
	}
	
	function testCodeOutput2($key,$val){
		echo "<div><div>".__LINE__." $key: $val</div></div>";
	}
	
	function testCodeOutput3($post,$seral_post,$line){
		echo "<h4>".$line." testCodeOutput3(\$post): Исходный массив:</h4>";	
		var_dump("<pre>",$post,"</pre>");
		echo "<hr><h4>".$line." testCodeOutput3(\$post): Сериализованный массив:</h4>";	
		var_dump("<pre>",$seral_post,"</pre>");
	}
}