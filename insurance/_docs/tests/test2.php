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
				"5"=>"Готовое решение 2|Случайная статья",
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
$artId="article id: ";
$dTextArtId=$dText.$artId;
foreach($post as $key=>$val){
	if ($key=="blocks"){ // если блоки с модулями
		
		foreach($val as $block => $data){ // перебрать каждый блок
			$arrMods=explode("|",$data); // получить массив модулей
			if ( strstr($data,$dText) // если в наборе модулей есть текст новой статьи
				 && !strstr($data,$dTextArtId)
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
							$arrMods[$i]=$artId." [id добавленной статьи]";
							echo "<div>
							<span style='color:red'>1. Добавляем в таблицу данные новой статьи:</div>
								<div style='border:solid 1px;'>$header</div>
								<br>
								<div style='border:solid 1px;'>$text</div>
									<span style='color:blue'>2. Заменяем запись в текстовом модуле на id новой (только что добавленной) статьи:</span>
								</div>
								<div style='border:solid 1px;'>\$arrMods[$i]=".$arrMods[$i]."</div>
							</div>";
						}else{
							// сохраняем статью как новую...
						}							
					}
				}
			}
			if (!strstr($data,"header:"))	
				$val[$block]=$arrMods; // обратно в строку
		}
	}else{
		if ($localdata)
			echo "<div>
				<div>$key: $val</div>
			</div>";
	}
	$post[$key]=$val;
}	
unset($post["blocks"]["activeBlockIdentifier"]);
unset($post["blocks"]["moduleClickedLocalIndex"]);
$Layout=serialize($post);
if ($localdata){
	echo "<h4>Сериализованный массив:</h4>";	
	var_dump("<pre>",$post,"</pre>");
}else{
	$jenc=json_encode(array("result"=>"Подраздел создан!"));				
	echo $jenc;
}
	//var_dump("<h1>jenc:</h1><pre>",$jenc,"</pre>");
?>
<div id="res_root"></div>
    <script type="text/javascript">
      (function() {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.async = true;
        script.src = "https://goresponsa.com/widgets/509eb759021e9b02000006aa.js";
        var other = document.getElementsByTagName('script')[0];
        other.parentNode.insertBefore(script, other);
      })();
    </script>
    <noscript>Please enable JavaScript to view the Q&A powered by Responsa.</noscript>