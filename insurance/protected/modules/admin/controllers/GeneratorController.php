<?php
class GeneratorController extends Controller
{
	public $layout = "application.modules.admin.views.layouts.admin";
	static protected $section_root;
	static $modules_names;
	protected $groot=NULL; // see getGeneratorRoot()
	
	function getGeneratorRoot(){
		if (!$this->groot)
			$this->groot=Yii::getPathOfAlias('webroot').'/protected/modules/admin/views/generator/';
	}
	/**
	 * @package
	 * Получить данные существующих модулей
	 */
	function getAllModules(){
		// получить все текущие модули:
		$mpath=Yii::getPathOfAlias('webroot').'/protected/components/modules';
		require_once $mpath.'/mod_helper.php';
		return handleFiles($mpath);
	}
/**
 * @package
 * 
 */
	public function actionIndex(){ 
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		$model = new InsurInsuranceObject;

		$this->getGeneratorRoot();
		$modules=$this->getAllModules();
		$this->render('index',array('model'=>$model,'modules'=>$modules));
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
			$this->render('getobject',array('gridDataProvider'=>$gridDataProvider));
		}
	}
/**
 *	Сохранить изменённые данные макета
 *
 */
	public function actionUpdate($id){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		if (!$id){ 
			die('Ошибка!<p>Не получен id подраздела</p>.'); 
		}else{
			$this->actionSave($id);
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
			$model = new InsurInsuranceObject();
			$data = Yii::app()->db->createCommand()->select('id, name, parent_id, alias, category_id, title, keywords, description, content')->from('insur_insurance_object')->where('id=:id', array(':id'=>$section_id))->queryRow();
			$modules=$this->getAllModules();
			$this->render('index', array('data' => $data,'model'=>$model,'modules'=>$modules));
		}
	}
	
	public function actionSave($update_id=false){ // см. _docs\tests\test2.php
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
		foreach($post as $key=>$sectionDataArray){
			if ($key=="blocks"){ // если блоки с модулями
				// [blocks]=array(blocks[1],blocks[2],...)
				foreach($sectionDataArray as $blockName => $modulesInBlockString){ // перебрать каждый блок
				// [blocks][2] as [2] => новости|готовое решение|случайная статья
				//						 $modulesInBlockString
					$arrBlockModules=explode("|",$modulesInBlockString); // получить массив модулей
					// $arrBlockModules=array(новости, готовое решение, случайная статья)
					// если в наборе модулей (т.е., во ВСЕЙ СТРОКЕ) есть начало для текстового блока
					if (strstr($modulesInBlockString,$dText)){ 
						
						for($i=0;$i<count($arrBlockModules);$i++){
							
							// повторить условие поиска но ТЕПЕРЬ - НЕ для всей строки со всеми модулями, а для ТЕКУЩЕГО МОДУЛЯ текста для текущего модуля:
							if (strstr($arrBlockModules[$i],$dText) // текст новой статьи
								 && !strstr($arrBlockModules[$i],$dTextArtId) // но не id существующей статьи
							   ){
								
//		$jenc=json_encode(array("result"=>'We_GOT actionSave. LINE is '.__LINE__."\n\nText: ".$arrBlockModules[$i]));				
//		echo $jenc;	
//		exit;
								$start=strpos($arrBlockModules[$i],$dText)+strlen($dText);
								$finish=strpos($arrBlockModules[$i],"^");
								$strlen=$finish-$start;
								$header=substr($arrBlockModules[$i],$start,$strlen);
								$text=substr($arrBlockModules[$i],$finish+1);
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
									$model_content->created = date("Y-m-d H:i:s");
									$model_content->status = 1;
									$model_content->insur_coworkers_id = Yii::app()->user->id;
									$model_content->object_id = $post['parent'];
									$model_content->name = $header;
									$model_content->save();
									// 2. получить id сохранённой статьи
									/************************************
										ПРОЦЕДУРА ПОЛУЧЕНИЯ id....
										на выходе получаем $article_id
									************************************/
									$article_id = $model_content->id;
									// заменяем контент текстового модуля:
									// вместо заголовка и текста подставляем:
									// "Текст :: article id: [id_статьи]";
									$arrBlockModules[$i]=$dTextArtId.$article_id;
								}
							}
						}
					}
					if (!strstr($modulesInBlockString,"header:"))	
						$sectionDataArray[$blockName]=$arrBlockModules;
				}
				$post[$key]=$sectionDataArray;
			}else if ($localdata) TestGenerator::testCodeOutput2($key,$sectionDataArray);
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
		/************************************
		ПРОЦЕДУРА СОХРАНЕНИЯ ПОДРАЗДЕЛА 
		(insur_insurance_object)
		************************************/
		
//		$jenc=json_encode(array("result"=>'We_GOT actionSave. ERROR!!! LINE is '.__LINE__));				
//		echo $jenc;	
//		exit;
		
		// если в режиме предпросмотра со значением 'yes' - выставляем статус неопубликованного ДО явного указания юзера, что делать дальше:
		$status=(isset($_GET['preview'])&&$_GET['preview']=='yes')? 0:1;

		$date_changes= date("Y-m-d H:i:s");
		if($update_id){
			$section_id=$update_id;
			InsurInsuranceObject::model()->updateByPk($section_id, 
					array(	'parent_id'=>$parent_id,
							'name'=>$name,
							'status'=>$status,
							'alias'=>$alias,
							'date_changes'=>$date_changes,
							'title'=>$title,
							'keywords'=>$keywords,
							'description'=>$description,
							'content'=>serialize($post),
						 )
				);
		}else{
			$model_obj = new InsurInsuranceObject;
			$model_obj->parent_id = $parent_id;
			$model_obj->name = $name;
			$model_obj->status = $status;
			$model_obj->alias = $alias;
			$model_obj->date_changes = $date_changes;
			$model_obj->title = $title;
			$model_obj->keywords = $keywords;
			$model_obj->description = $description;
			$model_obj->content = serialize($post);
			$model_obj->save();
			$section_id=$model_obj->id;
		}
		$direct_to=self::$section_root;
		if (!$status)
			$direct_to.="?mode=preview";
		if ($localdata){
			TestGenerator::testCodeOutput3($post,serialize($post),__LINE__);
		}else{
			self::getParents($section_id); // get URL path
			$jenc=json_encode(array("result"=>Yii::app()->request->getBaseUrl(true)."/".$direct_to));				
			echo $jenc;
		}
	}
/**
 * Проверить доступность алиаса
 * @package
 * @subpackage
 */
	function actionAliasCheck(){
		echo ($alias = Yii::app()->db->createCommand()->select('id')->from('insur_insurance_object')->where('alias="'.$_GET['alias'].'"')->queryScalar()) ?
			'taken' : 'allow';		
	}
/**
 * 
 * @package
 * @subpackage
 */
	function getParents($section_id,$child_id=false){
		$query="SELECT `parent_id` FROM insur_insurance_object
	WHERE `id` = $section_id";
		$arr_parent_id=Yii::app()->db->createCommand($query)->queryAll();
		/* 	1) 	getParents(7)
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
	
	function testCodeOutput2($key,$sectionDataArray){
		echo "<div><div>".__LINE__." $key: $sectionDataArray</div></div>";
	}
	
	function testCodeOutput3($post,$seral_post,$line){
		echo "<h4>".$line." testCodeOutput3(\$post): Исходный массив:</h4>";	
		var_dump("<pre>",$post,"</pre>");
		echo "<hr><h4>".$line." testCodeOutput3(\$post): Сериализованный массив:</h4>";	
		var_dump("<pre>",$seral_post,"</pre>");
	}
}