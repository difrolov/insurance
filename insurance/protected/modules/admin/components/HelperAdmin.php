<?php
	class HelperAdmin
	{
		//получить многоуровневое меню из базы
		public static function menuItem(){
			$sql = 'SELECT DISTINCT `main`.`name` AS first_n
				     , `second`.`name` AS second_n
				     , `third`.`name` AS third_n
				     , `last`.`name` AS last_n
				     , `main`.`id` AS first_id
				     , `second`.`id` AS second_id
				     , `third`.`id` AS third_id
				     , `last`.`id` AS last_id
				     , `main`.`parent_id` AS first_pid
				     , `second`.`parent_id` AS second_pid
				     , `third`.`parent_id` AS third_pid
				     , `last`.`parent_id` AS last_pid
				     , `main`.`alias` AS first_al
				     , `second`.`alias` AS second_al
				     , `third`.`alias` AS third_al
				     , `last`.`alias` AS last_al
				FROM
				  insur_insurance_object AS main
				LEFT JOIN insur_insurance_object AS `second`
				ON `second`.`parent_id` = `main`.`id`
				LEFT JOIN insur_insurance_object AS `third`
				ON `third`.`parent_id` = `second`.`id`
				LEFT JOIN insur_insurance_object AS `last`
				ON `last`.`parent_id` = `third`.`id`
				WHERE
				  `main`.`parent_id` = -1';
				$res = Yii::app()->db->createCommand($sql)->queryAll();
				$main = array();
				foreach ($res as $key=>$val){
				//первый уровень
					if(!in_array($val['first_n'],$main)){
						$main[] = $val['first_n'];
					}
					//второй уровень
					if(in_array($val['first_n'],$res[$key]) && $res[$key]['second_n'] != null){
						$sec[$key][$val['first_n']]=$res[$key]['second_n'];
					}
					//третий уровень
					if(in_array($val['second_n'],$res[$key]) && $res[$key]['third_n'] != null){
						$third[$key][$val['second_n']]=$res[$key]['third_n'];
					}
					//Четвёртый уровень
					if(in_array($val['third_n'],$res[$key]) && $res[$key]['last_n'] != null){
						$last[$key][$val['third_n']]=$res[$key]['last_n'];
					}
				}



			print_r($last);

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
