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
					var lowerElem=textElem.toLowerCase();
					var lowerFound=this.toLowerCase();
					
					if (lowerElem.indexOf(lowerFound)!=-1){
						
						//var startPos=textElem.indexOf(lowerFound);
						//var gotElemToSelect=textElem.substr(startPos,startPos+this.length);
						var arrElems=lowerElem.split(lowerFound);
						
						//if (textElem.length>this.length) 
							//bunch=textElem.substr(this.length);
						// +++ ВЫДЕЛИТЬ НАЙДЕННОЕ СЛОВО
						if (arrElems[0]!=lowerElem){
							bunch=arrElems[0];
							bunch+='<span class="found">'+this+'</span>';
							if (arrElems[1])
								bunch+=arrElems[1];
						}else
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
<input placeholder="Введите поисковую строку" style="width:80%;"  name="keyword" value="<?=$seeking?>">
<input id="seek_it" type="submit" value="Искать!">
</form>
</div>
<? 	if ($swords){?>
<br>
<hr>
Поисковый запрос: <b><?=$swords?></b>
<hr>
<h2 class="txtLightBlue">Результат поиска (<?
echo (count($res))? count($res):'0';
?>):</h2>
<?	$ww=0;
	foreach($res as $name=>$text):
		
		$text=strip_tags($text);
		$text=str_replace("&nbsp;"," ",$text); 
		$ww++;
		echo "<div style='background:lightyellow; top:0; height:100%; width:50%;' id='pname".$ww."'>".$name."</div>";?>

<h3 id="content_header<?=$ww?>"></h3>
<script>
selectFound('pname','content_header',<?=$ww?>);
</script>
<?		echo "<div style='background:lightyellow; top:0; height:100%; width:50%;' id='ptext".$ww."'>".$text."</div>";?>    
<div id="content<?=$ww?>"></div>
Источники: <a href="#">источник 1</a>
<script>
selectFound('ptext','content',<?=$ww?>);
</script>    
<?	endforeach;
}?>
</div>