<?	Data::includeXtraCss();?>
<div id="inner_left_menu">
<h2 class="txtLightBlue">Поиск</h2>
<div>
<? 	$seeking='';
	if ($swords){
		$seeking=$swords;
		$allWords=explode(" ",$swords);
	}?>
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

<?	$aWords=explode(" ",$swords); $ww=0;
	
	//echo "result = ".mb_strtolower("Обнаж",'UTF-8');
	foreach($res as $name=>$text):
		$text=strip_tags($text); ?>
  <tr>
    <td>&nbsp;</td>
    <td><?=$name?></td>
    <td><?
			//$arrT=explode(" ",$text);
	for($i=0,$j=count($aWords);$i<$j;$i++){
		/*for($t=0,$ct=count($arrT);$t<$ct;$t++){
			if (stripos($arrT[$t],mb_strtolower($aWords[$i],'UTF-8')))
				echo ('<hr>found: '.$arrT[$t].", key = ".key($arrT).", t= $t<hr>");
		}*/
		//handleResults($text,$aWords[$i]); 
		//$st=strtolower($text);
		//$new_text=str_replace(strtolower($aWords[$i]),"<span style='color:red'>".$aWords[$i]."</span>",$st);
		//if (in_array($aWords[$i],$arrT)){
			//echo "<h1> in array : ".$aWords[$i]."</h1>";
			/*for($a=0,$b=count($arrT);$a<$b;$a++){
				if (stripos($arrT[$a],mb_strtolower($aWords[$i],'UTF-8')))
					echo "<h5 class=''>".$arrT[$a]."</h5>";
				//$lc2=stristr($aWords[$i]);
				//echo "<div class=''>".$arrT[$a]."</div>";
				//if (strstr($lc1,$lc2)){
					
					//
				//}
			}*/
//		$ptext=implode(" ",$arrT);
//		$new_text=stristr($text,$aWords[$i]);
//		$prelen=strlen($pre_text);
//		$post_text=substr($text,$prelen);
//		$new_text=$pre_text;
		//$aWords[$i],"<h1 class='found'>".$aWords[$i]."</h1>",$text);?>
<?	}$ww++;
	echo "<div id='ptext".$ww."'>".$text."</div>";?>
<script>
try{
var html=$('#ptext<?=$ww?>');
var fstr='<?=$aWords[0]?>';
var pStart=$(html).text().toLowerCase().indexOf(fstr);
var pFinish=pStart+fstr.length;
//var sbstr=html.substring(pStart,pStart+fstr.length),
//alert(sbstr);
var stRow=$(html).text().substring(pStart-10,pStart);
//$(html).text().substr(pStart)+'<h1>'+fstr+'</h1>'+$(html).text().substr(pFinish);

var arrWords=$(html).text().split(" ");
var s='';
$(arrWords).each(function(index, element) {
    //$(html).text()+=' '+element;
	if (element.toLowerCase().indexOf(fstr.toLowerCase())!=-1)
		element='<span class="found">'+element+'</span>';
	console.info('\n\n******** found! : '+element+'\n\n');
	s+=' '+element;
	console.info(s);
});
$(html).html(s);


//console.info('pStart = '+pStart+', pFinish = '+pFinish+'\nstRow = '+stRow);

//var newText = $('#ptext<?=$ww?>').html().replace(/<?=$aWords[0]?>/, "<H1><?=$aWords[0]?></H1>")
//$('#ptext<?=$ww?>').html(newText);
//alert();
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