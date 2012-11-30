<?	$aMods=$this->getAllModulesNames($model_modules); 
	// см. $aMods в set_modules.php
	$testTmpl=false; // test mode
	//**************************************************
	$Shema=false;
	if(isset($data)){
		$Name=$data['name'];
		$ParentId=$data['parent_id'];
		$Alias=$data['alias'];
		$Title=$data['title'];
		$Keywords=$data['keywords'];
		$Description=$data['description'];
		// get Template data:
		$SectionDataContent=unserialize($data['content']);
		// получить текущую схему макета:
		$Shema=$SectionDataContent['Schema'];
	} // данные подраздела (array, имена полей таблицы)	
	if($testTmpl||isset($_GET['dump'])){?>
    	<div id="SectionDataContent" align="left" style="position:fixed; top:40; right:0;">
		<?	ob_start();
			var_dump("<pre>",$SectionDataContent,"</pre>"); 
			$lInfo=ob_get_contents();
			ob_get_clean();
			$info=str_replace("=>\n","=>",$lInfo);
			echo $info;//die();?>
        </div>
<?	}?>
<script>
$(function(){
  try{ $('#SectionDataContent').draggable();	
<?	if ($testTmpl) {
		//**********************************
		if(!$Shema){
			$getSchema=(isset($_GET['Schema']))? $_GET['Schema']:'100';
			$section_data=array( 'content'=>
									array('Schema'=>$getSchema)
							   );
		}
		//**********************************
  	}
	if ($Shema) {?>
	Layout.Schema='<?=$Shema?>';
  	// распарсить схему макета посимвольно:
	var arrLayoutSchema=parseLayoutSchema();
	// получить объект пиктограммы для текущего макета:
	// div# :
	// tmplColSet // 
	// chHeaders //
	// psFooter // 
	//*************************************************
	// СМ. схему ВСЕХ макетов в _docs\сайт.xlsx
	//*************************************************
	
	// отобразить все ряды выбора опций макета: колонки, подзаголовок, футер:
	var tmplColSet, 	// ряд пиктограмм для колич. колонок
		chHeaders,		// ряд пиктограмм для подзаголовка
		psFooter,		// ряд пиктограмм для псевдофутера
		tPyctFirst,		// активная пиктограмма для первого ряда
		tPyctSecond,	// активная пиктограмма для второго ряда
		tPyctLast,		// активная пиктограмма для третьего ряда
		hIndex,			// индекс активной пиктограммы для идентификации типа подзаголовка
		fIndex,			// индекс активной пиктограммы для 3/4-х колоночного макета, определяющей вид псевдофутера
		multicol=false;	// индикатор макета с колич. колонок больше 2-х.
	
	tmplColSet=$('div#tmplColSet > div'); // строка Колонки
	chHeaders=$('div#chHeaders > div'); // строка Подзаголовок
	psFooter=$('div#psFooter > div'); // строка Псевдофутер
	
	switch(Layout.Schema){
		
		case "100":
		  tPyctLast=$(tmplColSet)[0]; // строка Колонки / первая пиктограмма
		break;
		
		case "200":case "210":
		  tPyctFirst=$(tmplColSet)[1];
		  hIndex=(Layout.Schema=='200')? 0:1;
		  tPyctLast=$(chHeaders)[hIndex];
		break;
		
		default: // определить кнопки активного макета для эмуляции клика
			multicol=Layout.Schema.substr(0,1); // колич.колонок (1-е значение схемы)
			var multicolHeader=Layout.Schema.substr(1,1); // наличие подзаголовка (второе значение схемы)
			var multicolFooter=Layout.Schema.substr(2); // наличие псевдофутера (третье значение схемы)
			
			switch(multicol){
				
				case "3": // 3 колонки
					tPyctFirst=$(tmplColSet)[2];
					
					switch(multicolHeader){ // тип подзаголовка
						case "0": case "s": // 300, 30s : // 3s0, 3ss
						  hIndex=(multicolHeader=="0")? 0:2;
						  tPyctSecond=$(chHeaders)[hIndex]; // первая пиктограмма в ряду для типа подзаголовка						
						  tPyctLast=definePyctIndex(multicolFooter,psFooter,"0","s",0,1);
						break;
						
						case "i": // 3i0
						  tPyctLast=$(chHeaders)[1]; // вторая (она же - последняя) пиктограмма в ряду для типа подзаголовка
						break;
					}
				break;
				
				case "4": // 4 колонки
					tPyctFirst=$(tmplColSet)[3];
					
					switch(multicolHeader){						
						case "0": // 400, 40i, 40s
							tPyctSecond=$(chHeaders)[0]; // первая пиктограмма в ряду для типа подзаголовка
							
							switch(multicolFooter){						
								case "0": // 400
					  				fIndex=0;
								break;
								case "i": // 40i
									fIndex=1;
								break;
								case "s": // 40s
									fIndex=2;
								break;
							}
						break;
						
						case "i":case "s":
							hIndex=(multicolHeader=='i')? 1:2;
							tPyctSecond=$(chHeaders)[hIndex]; // вторая пиктограмма в ряду для типа подзаголовка
							var fIndex=(multicolFooter=="0")? 0:1; // индекс третьей пиктограммы
							
						break;
					}
					tPyctLast=$(psFooter)[fIndex];
			}
	} 
	if (defineLayoutSchema(tPyctLast)){ // получить кнопку!
		if (Layout.Schema!='100'){
			$(tPyctFirst).trigger('click'); // клик по первой пиктограмме макета
			if (multicol&&tPyctSecond) // больше 2-х колонок и есть 3-й ряд (что бывает не всегда)
				$(tPyctSecond).trigger('click'); // клик по второй пиктограмме макета			
			$(tPyctLast).trigger('click'); // клик по последней пиктограмме макета
		}
		$('div#tmplPlace').css('display','block');
		loadLayout(true);		
	}
<?	}?>
  }catch(e){
	  alert(e.message);
  }
});
<?	
if ($SectionDataContent['blocks']){?>
/**
 * Загрузить и обработать модули
 */
function loadModulesEditMode(){
	var tmplColumns=$('div#tmplPlace >div:first-child > div'); // колонки макета
	var curModsOrangeButton=$('div#select_mod div[data-module-type]'); // кнопки модулей
<?	// пройтись по всем блокам и собрать их контент:
	$colCnt=0; // индекс колонки
	foreach($SectionDataContent['blocks'] as $block_name=>$block){
		if( $block_name==2 // 2-й блок, может содержать заголовок
			&& $Shema[1]!='0' // ...заголовок есть в соответствии со схемой макета
		  ) {	// заголовок подраздела  
			if (is_array($block)){ // внештатная ситуация: ?>
	$('#testBlockInfoBottom').show().html('$block is ARRAY!<br>LINE: <?=__LINE__?>');
		<?		$headerText="!!!ARRAY!!!";
			}elseif(strstr($block,"header:")) { // не массив, а строка; есть метка заголовка
				$headerText=substr($block,strpos($block,":")+1);
			}?>
	$('div[data-block-type="header"] input[type="text"]').val('<?=$headerText?>');
	Layout.blocks[2]='<?=$block?>';
	<?	}else{ // НЕ заголовок?>
	var colActive=$(tmplColumns).eq(<?=$colCnt?>);
	$(colActive).trigger('click'); // эмулировать клик по активной колонке
		<?	$artPreString="Текст :: article id:"; // if an article
			for($i=0,	$blockModulesCount=count($block);
				$i<$blockModulesCount; 	$i++){ // пройтись по блоку и собрать его модули?>
	// вывод информации в консоль в тестовом режиме
	// если test_mode='alert' также выводит alert
	consoleOutput('blockModulesCount=<?=$blockModulesCount?>, i=<?=$i?>');
			<?
				// конец условий
				$moduleContent=$block[$i]; // Новости, Готовое решение ...
				$modIndex=false;
				$modText=false;
				// получить ключ существующего модуля, чтобы далее эмулировать клик по нему и добавление в текущую колонку:
				if(in_array($moduleContent,$aMods)){
					$modIndex=array_search($moduleContent,$aMods);
				}elseif(strstr($moduleContent,$artPreString)) { // если статья
					$modIndex=count($aMods); 
					$art_id=substr($moduleContent,strlen($artPreString));
					// получить заголовок статьи:
					$art_header = Yii::app()->db->createCommand()->select('name')->from('insur_article_content')->where('id="'.$art_id.'"')->queryScalar();
					$modText=true;	// флаг обработки текстового модуля
				}
				if($modIndex!==false){?>
	$(curModsOrangeButton).eq(<?=$modIndex?>).trigger('click'); // добавить модуль в активную колонку
				<?	if($modText){ // если таки текстовый модуль, обработаем его ПОСЛЕ (!!!) эмуляции клика по кнопке (т.е., фактического добавления его в колонку)?>
	var arrPreData=setTxtReadyContent(<?=$art_id?>);
	preHeader=arrPreData['art'];
	var txtModule=$(colActive).find('div.innerModule').eq(<?=$i?>); // текстовый модуль
	setTxtReadyContentStyle(txtModule,arrPreData['bgClass']); // назначить параметры форматирования модулю 
	var txtModuleInner=$(txtModule).find('div[data-module-type="Текст"]'); // блок с заголовком статьи
	// установить заголовок текстового модуля:
	setTxtReadyContentHeader(txtModuleInner,preHeader);
	// инсталлируем ссылку - заголовок статьи
	setTxtReadyContentHeaderLink(txtModuleInner,<?=$art_id?>,"<?=$art_header?>",'get');
			<?		}/*else{?>
				<?	}*/
			 	}
				$moduleContents[]=$moduleContent;
			}?>
	Layout.blocks[<?=$block_name?>]='<?=implode("|",$moduleContents);?>';
	<?	}
		unset($moduleContents);
		$colCnt++;
	}?>	
$(tmplColumns).last().removeAttr('style').removeAttr('data-column_stat');
<?		if($testTmpl) :?>
test_parseLayout();
<?		endif;?>
	$('#pick_out_section').fadeIn(2000);
}
<?
}?>
// получить индекс активной пиктограммы
function definePyctIndex( multicolType,	// multicolFooter
						  rowName,		// psFooter		
						  firstSymbol,	// 0 
						  secondSymbol,	// s
						  firstIndex,	// 0
						  secondIndex	// 1
						){ 
	if (multicolType==firstSymbol) 
		Index=firstIndex; // первая пиктограмма в ряду для типа псевдофутера
	else if (multicolType==secondSymbol)
		Index=secondIndex; // вторая пиктограмма в ряду для типа псевдофутера
	return $(rowName)[Index];
}
</script>	