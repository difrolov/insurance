<?	Data::includeXtraCss();?>
<link href="<?=Yii::app()->request->getBaseUrl(true)?>/css/search.css" type="text/css" rel="stylesheet"><div id="inner_left_menu">
<h2 class="txtLightBlue">Поиск</h2>
<div>
<? 	$seeking=''; 
	if ($swords){
		$seeking=$swords;
		$aWords=explode(" ",$swords); 
		$arrFoundWords="'".implode("','",$aWords)."'";
		//echo "<div>arrFoundWords = $arrFoundWords</div>";?>
<script>
arrFoundWords=new Array(<?=$arrFoundWords?>);
textWordsLimit=60;
function selectFound(content,block_name,rowIndex,keepText){
	<?	$loop=true;
		if($loop){?>
	try{
		var b=0, bunch='', newText='', newTextCnt=0, checkDot, indexBack=0, lastWord='';
		var html=$('#'+content+rowIndex);
		var arrTextWords=$(html).text().split(" "); // text words array
		var jsArrText=$(arrTextWords).toArray();
		// ЦИКЛ слов текста; ДЕЛАТЬ:
		$(arrTextWords).each( function(indexText, textElem) {
			if (newTextCnt==textWordsLimit) {
				if (newText[newText.length-1].indexOf(".")==-1)
					newText+=' ...';
				return false; 
			}
			$.trim(textElem);
			// текущее слово
				// ЦИКЛ найденных слов 
				$(arrFoundWords).each( function(indexFound){
					// ЕСЛИ текущее слово ТЕКСТА совпадает с текущим словом из НАЙДЕННЫХ
					if (textElem.toLowerCase().indexOf(this.toLowerCase())!=-1){
						// +++ ВЫДЕЛИТЬ НАЙДЕННОЕ СЛОВО
						bunch=' <span class="found">'+this+'</span> ';
						//console.info('bunch = '+bunch+'\ntextElem = '+textElem+'\nthis = '+this);
						// ЕСЛИ первое совпадение в тексте
						if (b==0) {	
							// ЦИКЛ текущего фрагмента (т.е., набор перебранных к данному моменту слов):
							for(c=0;c<indexText;c++) {
																	
								indexBack=indexText-c-1;
								if (jsArrText[indexBack])
									checkDot=jsArrText[indexBack].indexOf(".");
									// предыдущее слово не содержит точку
								if (checkDot==-1) {
									// ЕСЛИ первая итерация текущего (внутреннего) цикла
									if (c==0) {
										// +++увеличить конечный фрагмент на выделенное слово
										newText=lastWord=bunch;
									}
									// +++ ПРИСОЕДИНИТЬ к конечному фрагменту ПРЕДЫДУЩЕЕ СЛОВО
									newText=jsArrText[indexBack]+' '+newText;
								}
							// КОНЕЦ ЦИКЛА текущего фрагмента
							}
						}
						b++; 
					}
					// КОНЕЦ ЦИКЛА найденных слов
				});
				// +++ ПРИСОЕДИНИТЬ к конечному фрагменту следующее слово
				if (bunch=='') { 
					newText+=' '+textElem;
				}
				else if (lastWord!=bunch) {
						newText+=' '+bunch;
				}
				newTextCnt++;
				bunch='';
		// ПОКА ВЕЛИЧИНА ИТЕРАТОРА НЕ БОЛЕЕ <допустимой длины конечного фрагмента> (см. условие в начале цикла)
		});
	<?	}?>		
		$('#'+block_name+rowIndex).html(newText);
		if(!keepText)
			$(html).remove();
	}catch(e){
		alert(e.message);
	}
}
</script>
<?	}?>
<form method="post">
Введите поисковую строку: <input style="width:50%;"  name="keyword" value="<?=$seeking?>">
<input type=submit value="Submit">
</form>
</div>
<? 	if ($swords){
		function handleResults(&$text,$word){
			$fPos=0;
			$fw=mb_strtolower($word,'UTF-8');
			if ($fPos=stripos($text,$fw)){
				$nTextStart=substr($text,$fPos);
				$colorStr=str_replace($fw,"<span class='found'>".$fw."</span>",$text);
				echo "<div class=''>(fPos: $fPos)".$colorStr."</div>";
				echo "<hr><div class=''>".substr($colorStr,$fPos-50)."</div>";
				//echo ("<h1>stps: ".($fPos-1)."</h1>");
				/*$arrStart=explode(" ",$nTextStart); // массив слов после совпадения
				echo "<br>nTextStart=<span class='txtRed'>$nTextStart</span><br>";
				// опи санную
				$tWord=$arrStart[0]; // искомое слово
				$textBefore=stristr($text,$tWord,TRUE);
				echo "<br>textBefore= $textBefore<br><br>tWord= $tWord<br>";
				$acnt=count($arrStart);
				if ($acnt>4) $acnt=(4+2);
				$textAfter=$arrStart[1];		
				$st=2;
				while ($st<$acnt){
					$textAfter.=" ".$arrStart[$st]; // несколько слов после
					$st++;
				}
				$str_to_show_raw=$textBefore.$textAfter; 
				$str_to_show=$textBefore." <span class='found'>$tWord</span> ". $textAfter." ... ";
				$text=stristr($text,$str_to_show_raw,TRUE);
				echo $str_to_show;*/
				//echo "<br>$textBefore <span class='found'>$tWord</span> textAfter= $textAfter<br>";
				//echo "<h2>RESULT IS ABOVE!</h2>";
			}
		}
		function handleResults2(&$text,$word){
			$arrWords=explode(" ",$text);
			echo "<blockquoute class='txtLightBlue'> ".$text."</blockquoute>";
			for($t=0,$ct=count($arrWords);$t<$ct;$t++){
				$wplus=0;
				
				if (stripos($arrWords[$t],mb_strtolower($word,'UTF-8'))){
					$wfound=$arrWords[$t]; // word that was found
					// обнаж
					echo ('<hr><h2>found</h2><DIV class="found">'.$wfound."</div>t= $t<hr>");
					$str_init='';
					$key_start=$t; // word number
					$wplus=1;
					while($t){
						$str_init=$arrWords[$t-$wplus]." ".$str_init;
						//echo "<div class='txtRed'>= ".$str_init."</div>";
						if ($wplus>2) {
							$str_init.=" <span class='found'>".$wfound."</span>";
							break;
						}
						$wplus++;
					}
					$wplus+=3;
					$tt=$t;
					while($wplus){
						$tt++;
						$str_init.=" ".$arrWords[$tt];
						$wplus--;
					}
					echo "<hr>".$str_init."<hr>";				
				}else{
					
				}
			}
				if (!$wplus) echo "<div class='txtRed'> NOT FOUND? </div>"; 
		}?>
<br>
<hr>
Поисковая строка: <?=$swords?>
<hr>
<h2 class="txtLightBlue">Результат поиска:</h2>
<table class="tblResults" width="100%" cellspacing="0" cellpadding="10">
  <tr id="trHeaders" class="txtLightBlue bold">
    <td>Раздел</td>
    <td>Текст (выборка)</td>
  </tr>
<?	$ww=0;
	foreach($res as $name=>$text):
		$text=strip_tags($text);
		$text=str_replace("&nbsp;"," ",$text); 
		$ww++;?>
  <tr>
    <td id="conetent_header<?=$ww?>"><?
	echo "<div style='background:lightyellow; top:0; height:100%; width:50%;' id='pname".$ww."'>".$name."</div>";?>
<script>
selectFound('pname','conetent_header',<?=$ww?>,'keep');
</script>    
    </td>
    <td id="content<?=$ww?>"><?
	echo "<div style='background:lightyellow; top:0; height:100%; width:50%;' id='ptext".$ww."'>".$text."</div>";?>
<script>
selectFound('ptext','content',<?=$ww?>);
</script>    
    </td>
  </tr>

<?	endforeach;?>
</table>
<?	}?>
</div>