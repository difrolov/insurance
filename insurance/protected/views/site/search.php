<?	Data::includeXtraCss();
	$oldIE=setHTML::detectOldIE();
	
	//var_dump("<h1>true_words:</h1><pre>",$true_words,"</pre>");die();?>
<link href="<?=Yii::app()->request->getBaseUrl(true)?>/css/search.css" type="text/css" rel="stylesheet">
<div id="inner_left_menu"<? if ($oldIE){?> style="width:955px;"<? }?>>
<?	/*<h2 class="txtLightBlue">Поиск</h2>*/ ?>
<div id="innerPageContent">
<? 	$seeking=''; 
	if ($swords){
		$seeking=$swords;
		if (!$oldIE){?>
<script>
arrFoundWords=new Array(<?=$true_words?>);
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
				if (!newText||newText[newText.length-1].indexOf(".")==-1)
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
				if (!lowerElem||lowerElem.indexOf(lowerFound)!=-1){
					var arrElems=lowerElem.split(lowerFound);
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
<?		}
	}?>
<form method="post" style="margin-top:37px; width:100%;">
<? 	ob_start();?>
<input placeholder="поиск"  name="keywords" id="keywords" value="<?=$seeking?>">
<?	$inputField=ob_get_contents();
	ob_end_clean();?>
<?	ob_start();?>
<input id="seek_it" type="submit" value="Искать!">
<?	$inputButton=ob_get_contents();
	ob_end_clean();

	if($oldIE==8){?>
    <table cellspacing="0" cellpadding="0" width="940">
    	<tr>
        	<td width="80%"><?=$inputField?></td>
        	<td width="20%"><?=$inputButton?></td>
		</tr>
    </table>
<?	}else{
		echo $inputField;
		echo $inputButton;
	}?>
</form>
</div>
<? 	if ($swords){?>
<br>
<hr>
Поисковый запрос: <b><?=$swords?></b>
<hr>
<h2 class="txtLightBlue">Результат поиска<?
echo (is_array($res)&&count($res))? " (".count($res)."):":": ".$res;
?></h2>
<?	$ww=0; 
	foreach($res as $id=>$array) :
		$name=$array['name'];		
		$text=strip_tags($array['content']);
		$text=str_replace("&nbsp;"," ",$text); 
		$ww++;?>
<h3 id="content_header<?=$ww?>"></h3>
<?	if(!$oldIE){
		echo "<div style='background:lightyellow; top:0; height:100%; width:50%;' id='pname".$ww."'>".$name."</div>";?>
<script>
selectFound('pname','content_header',<?=$ww?>);
</script>
<?		echo "<div style='background:lightyellow; top:0; height:100%; width:50%;' id='ptext".$ww."'>".$text."</div>";?>    
		<div id="content<?=$ww?>"></div>
<script>
selectFound('ptext','content',<?=$ww?>);
</script>

<?	// <hr size="1" noshade color="#DDD">    
	}else{?>
		<div style="font-weight:700; margin-bottom:17px; margin-top:20px;"><?=$array['name']?></div>
        <div class="found_content"><?
			$arrText=explode(" ",$text);
			$arrTxt=array_slice($arrText,0,49);
			echo implode(" ",$arrTxt);
		?></div>
<?	}?>
<span class="txtLightBlue">Источники:</span> 
<?	if(empty($array['sections'])){?>
	<span style="background:#EEE">статья не опубликована ни в одном из разделов...</span>
<? 	}else{
		for ($i=0,$j=count($array['sections']);$i<$j;$i++){
			$row=$array['sections'][$i]; 
			if ($i) echo ",";?>
    &nbsp;
	<a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath((int)$row['id']);?>" style="text-decoration:underline;"><?=$row['name']?></a><?	
		}
	}?>
<?	endforeach;
}?>
</div>
<? 	// require_once Yii::getPathOfAlias('webroot').'/protected/components/submodules/banners3.php';
	if(!$seeking&&$oldIE){?>
<script>
$(	function(){
		var strDef='поиск';
		var keyCell=$('input#keywords');
		$(keyCell).val(strDef)
			.css('color','#999')
				.focus( function(){
						if ($(keyCell).val()==strDef)
							$(keyCell).val('');
						
					}).blur( function(){
							if ($(keyCell).val()=='')
							$(keyCell).val(strDef);
						});
	});
</script>
<? 	}