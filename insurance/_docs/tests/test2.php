<?
$localdata=false;
if (!$post=$_POST) {
	$localdata=true;
	$post=array("Schema"=>"4ss",		
			"blocks"=>array(
				"1"=>"Новость|Текст :: Статеюшка такая!^<p>\n\tПринцип нарушен, что человек, попадающий в другую эпоху, другое время, все равно остается самим собой. Но мне кажется этот прием работает на то, чтобы доказать то, что мы обычно любим говорить, вот если бы я был бы тогда, я бы сделал...</p>\n|Новость",
				"2"=>"header:Подзаголовок такой подзаголовок!",
				"3"=>"Готовое решение 1",
				"4"=>"Готовое решение 1",
				"5"=>"Готовое решение 2",
				"footer"=>"Готовое решение 2|Текст",
				"activeBlockIdentifier"=>'1',
				"moduleClickedLocalIndex"=>'1'
			),
			"parent"=>"4",
			"alias"=>"myarticle",
			"title"=>"Про всякие дела",
			"keywords"=>"статья мессага",
			"description"=>"Описание будет позже. Обязательно!"
			);
}
	
$dText="Текст :: ";
$dTextArtId=$dText."article id: ";
foreach($post as $key=>$val){
	if ($key=="blocks"){ // если блоки с модулями
		foreach($val as $block => $data){ // перебрать каждый блок
			if ( strstr($data,$dText) // если в наборе модулей есть текст новой статьи
				 && !strstr($data,$dTextArtId)
			   ){ 
				$arrMods=explode("|",$data); // получить массив модулей
				for($i=0;$i<count($arrMods);$i++){
					// повторить условие поиска текста для текущего модуля:
					if ( strstr($arrMods[$i],$dText) // текст новой статьи
						 && !strstr($arrMods[$i],$dTextArtId) // но не id существующей статьи
					   ){
						$start=strpos($arrMods[$i],$dText)+strlen($dText);
						$finish=strpos($arrMods[$i],"^");
						$strlen=$finish-$start;
						$header=substr($arrMods[$i],$start,$strlen);
									  
						// echo "<hr>arrMods[$i]: " . $arrMods[$i] . "<br>Начало с: " . $start . "						<br>Длина: " . $strlen . "<hr>";
						$text=substr($arrMods[$i],$finish+1);
						//1. добавить новую статью в таблицу статей (ПОЛЯ ТАБЛИЦЫ)
						if ($localdata)
							echo "<div>
							<span style='color:red'>1. Добавляем в таблицу данные новой статьи:</div>
								<div style='border:solid 1px;'>$header</div>
								<br>
								<div style='border:solid 1px;'>$text</div>
									<span style='color:blue'>2. Заменяем запись в текстовом модуле на id новой (только что добавленной статьи) статьи:</span>
								</div>
								<div style='border:solid 1px;'>\$arrMods[$i]=$dTextArtId [id добавленной статьи]</div>
							</div>";							
					}
				}
			}
		}
	}else{
		if ($localdata)
			echo "<div>
				<div>$key: $val</div>
			</div>";
	}
}	
if (!$localdata){
	$jenc=json_encode($arr);				
	echo $jenc;
}
	//var_dump("<h1>jenc:</h1><pre>",$jenc,"</pre>");
?>