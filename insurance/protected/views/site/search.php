<?	Data::includeXtraCss();?>
<div id="inner_left_menu">
<h2 class="txtLightBlue">Поиск</h2>
<div>
<? 	$seeking='';
	if ($swords){
		$seeking=$swords;
		$aWords=explode(" ",$swords); 
		$arrFoundWords="'".implode("','",$aWords)."'";?>
<script>
arrFoundWords=new Array(<?=$arrFoundWords?>);
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
<style>
.found{
	background:#FF0;
}
</style>
<br>
<hr>
Поисковая строка: <?=$swords?>
<hr>
<h2 class="txtLightBlue" style="margin:-4px 0 18px 25px">Результат поиска:</h2>
<div>
<table width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

<?	$ww=0;
	
	foreach($res as $name=>$text):
		$text=strip_tags($text); 
		$ww++;?>
  <tr>
    <td>&nbsp;</td>
    <td><?=$name?></td>
    <td><div id="content<?=$ww?>"></div><hr><?
	echo "<div style='background:lightyellow; top:0; height:100%; width:50%;' id='ptext".$ww."'>".$text."</div><hr>$arrFoundWords";?>
<script>
try{
	var bunch='',newText='',wCount,pStart,pFinish,arrTextWords;
	var html=$('#ptext<?=$ww?>');
	arrTextWords=$(html).text().split(" "); // text words array
	// пройтись по всему масиву слов текста, найти и выделить совпадения
	$(arrTextWords).each(function(index, textElem) {
		// каждое найденное слово:
		$(arrFoundWords).each( function(index2,word){
			pStart=$(html).text().toLowerCase().indexOf(word);
			pFinish=pStart+word.length;
			// если совпало со словом из распарсенного текста:
			if (textElem.toLowerCase().indexOf(word.toLowerCase())!=-1){
				// выделить:
				bunch=' <span class="found">'+textElem+'</span> ';
				
				// добвить текст слева и справа
				var b=0;
				for (i=10;i;i--){ // по 4 слова
					b++;
					if (index>=b&&i<7){ // если слева уже не менее 4-х слов:
						// проверить на совпадение с другими найденными словами:
						$(arrTextWords).each( function(bindex,bword){
							if(bword==arrTextWords[index-b]) return false;
						});
						bunch=arrTextWords[index-b]+' '+bunch;
						console.info('\n\nindex= '+index+', b= '+b+', предыдущее слово: '+arrTextWords[index-b]+'\n\n');
					}
					if ($(arrTextWords).size()>=index+b){
						$(arrTextWords).each( function(bindex,bword){
							if(bword==arrTextWords[index+b]) return false;
						});
						bunch+=' '+arrTextWords[index+b];
						console.info('\n\nindex= '+index+', b= '+b+', следующее слово: '+arrTextWords[index+b]+'\n\n');
					}
				}
				console.info('\n\nfound! bunch: '+bunch+'\n\n');
				newText+=' ...'+bunch+'... ';
			}
		});
	});
	console.info('\nnewText = '+newText+'\n');
	$('#content<?=$ww?>').html(newText+"<hr>");
}catch(e){
	alert(e.message);
}
</script>    
    </td>
  </tr>

<?	endforeach;?>
</table>
</div>
<?	}?>
</div>