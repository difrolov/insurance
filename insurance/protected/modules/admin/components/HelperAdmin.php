<?php
	class HelperAdmin
	{
		static $arrMenuItems;
		static $MainMenu;
		static $SubMenu;
/**
  * Получить массивы для списков: основные разделы, подразделы
  * @package content
  * @subpackage HTML
  */
		function makeArrayForSelect($items,$level=false){
			for ($i=0,$j=count($items);$i<$j;$i++) {
				$aURL=explode("/",$items[$i]['url'][0]);
				$section_id=array_pop($aURL);
				if ($level)
					self::$SubMenu[$level][$section_id]=$items[$i]['label'];
				else{
					self::$MainMenu[$section_id]=$items[$i]['label'];
				}
				if (isset($items[$i]['items']))
					self::makeArrayForSelect($items[$i]['items'],$section_id);
			}
		}
/**
 *
 *
 *	Получить список всех статей
 */		
		function getAllArticlesList(){
			return Yii::app()->db->createCommand("SELECT * FROM insur_article_content WHERE `status` > 0 ")->queryAll();
		}
		// отличный метод, который пока не используется, т.к. выяснилось, что нужен не он, а другой...
		function getAllSections($art_level='child'){
			$sql='
			SELECT id,
				   name,
				   `status`,';
			if ($art_level===false)
				$sql.=' 
    if (parent_id<0,null,
        (SELECT name FROM insur_insurance_object  
        WHERE id = i2.parent_id)
    ) AS parent 
    FROM insur_insurance_object as i2
ORDER BY name,parent'; 
			else
				$sql.='parent_id'.($art_level=='main')? 
			' 
    FROM insur_insurance_object 
WHERE parent_id < 0
ORDER BY parent_id DESC':
			',
    (   SELECT name FROM insur_insurance_object  
        WHERE id = i2.parent_id
    ) AS parent_name 
    FROM insur_insurance_object as i2
WHERE parent_id >= 0
ORDER BY name, parent_name';
			return Yii::app()->db->createCommand($sql)->queryAll();
		}

		//получить многоуровневое меню из базы
		public static function menuItem($system = false){
			$sql = 'SELECT DISTINCT `main`.`name` AS first_n
				     , `second`.`name` AS second_n
				     , `main`.`id` AS first_id
				     , `second`.`id` AS second_id
				     , `main`.`parent_id` AS first_pid
				     , `second`.`parent_id` AS second_pid
				     , `main`.`alias` AS first_al
				     , `second`.`alias` AS second_al
				FROM
				  insur_insurance_object AS main
				LEFT JOIN insur_insurance_object AS `second`
				ON `second`.`parent_id` = `main`.`id`
				WHERE
				  `main`.`parent_id` = -1';
				$res = Yii::app()->db->createCommand($sql)->queryAll();
				$main = array();
				if(!$system){
					foreach ($res as $key=>$val){
					//первый уровень
						if(!in_array($val['first_n'],$main)){
							$main[] = $val['first_n'];
							$first_url[$val['first_n']]['url'][] = 'object/getobject/'.$val['first_id'];
						}
						//второй уровень
						if(in_array($val['first_n'],$res[$key]) ){
							$temp[]=array('label'=>$val['first_n'],'url'=>array('object/getobject/'.$val['first_id']),'items'=>array(($res[$key]['second_n']?array('label'=>$res[$key]['second_n'],'url'=>array('object/getobject/'.$val['second_id'])):null)));
							$sec[$val['first_n']]['items'][]=($res[$key]['second_n']?array('label'=>$res[$key]['second_n'],'url'=>array('object/getobject/'.$val['second_id'])):null);
						}
					}
					foreach ($sec as $k=>$v){
						foreach ($v as $k_s=>$sub){
							$items[]=array('label'=>$k,'url'=>$first_url[$k]['url'],$k_s=> (count($sub)>1?$sub:null));
						}
					}
					self::$arrMenuItems=$items;
					return self::$arrMenuItems;
				}else{
					foreach ($res as $key=>$val){
						//первый уровень
						if(!in_array($val['first_n'],$main)){
							$main[] = $val['first_n'];
							$first_url[$val['first_n']]['url'][] = '#';
							$first_link[$val['first_n']]['linkOptions']=array('onclick'=>'console.info(1); return false;');
						}
						//второй уровень
						if(in_array($val['first_n'],$res[$key]) ){
							$temp[]=array('label'=>$val['first_n'],'url'=>'#','linkOptions'=>array('onclick'=>'console.info(1); return false;'),'items'=>array(($res[$key]['second_n']?array('label'=>$res[$key]['second_n'],'url'=>'#','linkOptions'=>array('onclick'=>'console.info(3); return false;')):null)));
							$sec[$val['first_n']]['items'][]=($res[$key]['second_n']?array('label'=>$res[$key]['second_n'],'url'=>'#','linkOptions'=>array('onclick'=>'console.info(2); return false;')):null);
						}
					}
					foreach ($sec as $k=>$v){
						foreach ($v as $k_s=>$sub){
							$items[]=array('label'=>$k,'url'=>$first_url[$k]['url'],'linkOptions'=>$first_link[$k]['linkOptions'],$k_s=> (count($sub)>1?$sub:null));
						}
					}
					return $items;
				}
		}

		//получаем строку и преобзуем ее в ссылку
		public static function createUrl($href,$text){
			return '<a href="'.$href.'">'.$text.'</a>';
		}
		//получаем строку и преобзуем ее в input
		public static function createInput($val,$field_name,$id,$js_function_name){
			return '<input type="text" value="'.$val.'" name="banner" onchange="'.$js_function_name.'(\''.$field_name.'\',$(this).val(),'.$id.')" />';
		}
		//получаем селект для картинки
		//парсим директорию с баннерами
		public static function selectBanner($sel_img,$id){
			$path = Yii::getPathOfAlias('webroot') . '/upload/img/banner';
			if (is_dir($path)){
				$dir = opendir($path);
			}
			else{
				return false;
			}
			while ($file = readdir($dir)){
				if ($file != "." && $file != ".." && (stristr($file,'.jpg') || stristr($file,'.png') || stristr($file,'.gif'))){
					$str[] = $file;
				}
			}
			$sel="";
			if(count($str) > 0){
				$sel .= '<img class="banner" id="banner_'.$id.'" alt="" src="/insur/insurance/'.$sel_img.'">'.
						'<br/><br/><select name="banner"'.
						'onchange="banner.update_field(\'src\',\'upload/img/banner/\'+$(this).val(),'.$id.')">';
				foreach($str as $val){
					$sel .='<option onmouseover="$(\'#banner_'.$id.'\').attr(\'src\',\'/insur/insurance/upload/img/banner/'.$val.'\')"'.
							'value="'.$val.'" '.($val==substr($sel_img,18)?"selected":"").'>'.
							'/upload/img/banner'.$val.'</option>';
				}
				$sel .='</select>';
				return $sel;
			}
		}
		//выводим селект
		public static function createBannerlink($val,$field_name,$id){
			return '<a data-toggle="modal" href="#" data-target="#myModal"'.
			'onclick="$(\'.modal_select_radio\').attr(\'data-banner\','.$id.')">'.$val.'</a>';
		}

		public static function dateToRender($fromDate)
		{
			if ($fromDate == null) return null;
			// var_dump($fromDate); die();
			$date = explode('-',$fromDate);
			return $date[2].'.'.$date[1].'.'.$date[0];
		}

		public static function dateToTextMonth($fromDate)
		{
			if ($fromDate == null) return null;
			$date = explode('-',$fromDate);
			if ($date[1][0] == '0')
			{
				$date[1] = $date[1][1];
			}
			$months = array('Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь');
			$m = (int)$date[1];

			return $date[2].' '.$months[$m-1].' '.$date[0];
		}

		public static function dateToMySql($fromDate)
		{
			$date = explode('.',$fromDate);
			return $date[2].'-'.$date[1].'-'.$date[0];
		}

		/*
		1 - новые презентации
		2 - новые отчеты
		3 - новые документы
		4 - поиск пользователя
		5 - справочники редактирование
		6 - справочники загрузка
		7 - сервис выбрать документы
		8 - сервис выбрать отчеты
		9 - сервис юрл оф. сайта
		10 - подписка на документы
		11 - рекламный банер
		12 - письмо информация
		13 - настройки рассылки
		14 - журнал действий
		15 - статистика
		16 - административные тексты
		17 - страница о сайте
		18 - страница условия использования
		19 - страница платные услуги
		20 - администратор
		21 - добавить модератора
		22 - отображать других модераторов
		23 - настройка регулярных писем
		24 - настройки почты сайта
		25 - резервное копирование
		26 - поиск материала
		*/
		public static function checkAccessAdmin($actionId, $access = array())
		{
			if (Yii::app()->user->role == 'administrator' || Yii::app()->user->role == 'moderator')
			{
				if (count($access) == 0)
					$access = Yii::app()->user->info;
				$access = explode(',',$access);
				return in_array($actionId, $access);
				// self::$systemLogoutAdmin = true;
			}
			Yii::app()->request->redirect(Yii::app()->createUrl('admin/default/logout'));
		}

		public static function getUserIp()
		{
			if (!empty($_SERVER['HTTP_CLIENT_IP']))
			{
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			{
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else
			{
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			return $ip;
		}

		////////////////////////////////////////////////////////////
		// Функция создающая уменьшенную копию фотографии $big,
		// которая помещается в файл $small
		// Уменьшенная копия имеет ширину и высоту равную
		// $width и $height пикселам, соответственно. Это максимально
		// возможные значения. Они будут пересчитаны чтобы сохранить
		// пропорции масштабируемого изображения.
		public static function resizeimg($big, $small, $width, $height)
		{
			/* var_dump($big);
			var_dump($small);
			die();
			 */
			// Имя файла с масштабируемым изображением
			$big = $big;
			// Имя файла с уменьшенной копией.
			$small = $small;
			// определим коэффициент сжатия изображения, которое будем генерить
			$ratio = $width / $height;
			// получим размеры исходного изображения
			$size_img = getimagesize($big);
			list($width_src, $height_src) = getimagesize($big);
			// Если размеры меньше, то масштабирования не нужно
			if (($width_src<$width) && ($height_src<$height))
			{
			  copy($big, $small);
			  return true;
			}
			// получим коэффициент сжатия исходного изображения
			$src_ratio=$width_src/$height_src;

			// Здесь вычисляем размеры уменьшенной копии, чтобы при
			// масштабировании сохранились пропорции исходного изображения
			if ($ratio<$src_ratio)
			{
			  $height = $width/$src_ratio;
			}
			else
			{
			  $width = $height*$src_ratio;
			}
			// создадим пустое изображение по заданным размерам

			$dest_img = imagecreatetruecolor($width, $height);
			$white = imagecolorallocate($dest_img, 255, 255, 255);
			if ($size_img[2]==2)  $src_img = imagecreatefromjpeg($big);
			else if ($size_img[2]==1) $src_img = imagecreatefromgif($big);
			else if ($size_img[2]==3) $src_img = imagecreatefrompng($big);

			// масштабируем изображение     функцией imagecopyresampled()
			// $dest_img - уменьшенная копия
			// $src_img - исходной изображение
			// $width - ширина уменьшенной копии
			// $height - высота уменьшенной копии
			// $size_img[0] - ширина исходного изображения
			// $size_img[1] - высота исходного изображения
			imagecopyresampled($dest_img,
							   $src_img,
							   0,
							   0,
							   0,
							   0,
							   $width,
							   $height,
							   $width_src,
							   $height_src);
			// сохраняем уменьшенную копию в файл
			unlink($small);
			if ($size_img[2]==2)  imagejpeg($dest_img, $small);
			else if ($size_img[2]==1) imagegif($dest_img, $small);
			else if ($size_img[2]==3) imagepng($dest_img, $small);
			// чистим память от созданных изображений
			imagedestroy($dest_img);
			imagedestroy($src_img);
			return true;
		}

		public static function getBanner()
		{
			return false;
		}

		public static function getIndicator($public,$public_enter,$modered)
		{
			if($public == 1) return 'Опубликовано';
			elseif($public_enter == 0 && $modered == 2) return 'Не опубликовано';
			elseif($public == 0 && $modered == 2) return 'Не опубликовано, проверяется модератором';
			elseif($modered == 0) return '<span style="color: #e31111">Опубликование запрещено модератором</span>';
			return '';
		}

		public static function number_ending($number, $ending0, $ending1, $ending2)
		{
			$num100 = $number % 100;
			$num10 = $number % 10;
			if ($num100 >= 5 && $num100 <= 20) {
				return $ending0;
			} else if ($num10 == 0) {
				return $ending0;
			} else if ($num10 == 1) {
				return $ending1;
			} else if ($num10 >= 2 && $num10 <= 4) {
				return $ending2;
			} else if ($num10 >= 5 && $num10 <= 9) {
				return $ending0;
			} else {
				return $ending2;
			}
		}

		public static function addZero($string, $maxLen = 9)
		{
			if (strlen($string) >= $maxLen)
				return $string;

			while(strlen($string) != $maxLen)
				$string = '0'.$string;

			return $string;
		}

		public static function testCharset($string, $fontSize = 12)
		{
			$result = '<style>td,th{padding:5px 30px;font-size:12px;}th{font-style:italic}</style>';
			$result .= '<table><tr>';
			$result .= '<th>Исходная</th>';
			$result .= '<th>Результирующая</th>';
			$result .= '<th>iconv()</th>';
			$result .= '<th>mb_convert_encoding(with $from)</th>';
			$result .= '<th>mb_convert_encoding(without $from)</th>';
			$result .= '</tr>';
			$num = 0;
			$encoding = array(
				'UTF-8',
				'utf-8',
				'UTF8',
				'utf8',
				'ASCII',
				'Windows-1251',
				'Windows-1252',
				'ISO-8859-15',
				'ISO-8859-1',
				'ISO-8859-6',
				'CP1256',
				'cp1256',
				'CP1251',
				'cp1251',
				'CP1252',
				'cp1252',
			);
			foreach ($encoding as $from)
			{
				foreach ($encoding as $to)
				{
					$style = ($num % 2 == 0) ? ' style="background: #F3F3F3;"' : ' style="background: #FAFAFA;"';
					$result .=
						'<tr'.$style.'>
							<td>'.$from.'</td>
							<td>'.$to.'</td>
							<td>'.iconv($from, $to, $string).'</td>
							<td>'.@mb_convert_encoding($string, $to, $from).'</td>
							<td>'.@mb_convert_encoding($string, $to).'</td>
						</tr>';
					$num++;
				}
			}
			return $result.'</table>';
		}

		public static function countForumMessageModer()
		{
			$dsn = 'mysql:host=localhost;dbname=hobyhgim_forumspace';
			$connection = new CDbConnection($dsn, 'hobyhgim_andreyb','zKLsU8xOhwrnJy');
			$connection->charset='utf8';
			$connection->active = true;

			$sql = 'SELECT COUNT(p.id) as count_message FROM mivf_posts as p WHERE p.modered = 2';
			$result = $connection->createCommand($sql)->query();
			$count = $result->read();
			return $count['count_message'];
		}

		public static function getActionsId()
		{
			return array(
				1  => 'Новые презентации',
				2  => 'Новые отчеты',
				3  => 'Новые документы',
				4  => 'Поиск пользователя',
				5  => 'Справочники редактирование',
				6  => 'Справочники загрузка',
				7  => 'Сервис выбрать документы',
				8  => 'Сервис выбрать отчеты',
				9  => 'Сервис юрл оф. сайта',
				10 => 'Подписка на документы',
				11 => 'Рекламный банер',
				12 => 'Письмо информация',
				13 => 'Настройки рассылки',
				14 => 'Журнал действий',
				15 => 'Статистика',
				16 => 'Административные тексты',
				17 => 'Страница о сайте',
				18 => 'Страница условия использования',
				19 => 'Страница платные услуги',
				20 => 'Администратор',
				21 => 'Добавить модератора',
				22 => 'Отображать других модераторов',
				23 => 'Настройка регулярных писем',
				24 => 'Настройки почты сайта',
				25 => 'Резервное копирование',
				26 => 'Поиск материала',
				27 => 'Новые сообщения на форуме',
			);
		}
  	}
