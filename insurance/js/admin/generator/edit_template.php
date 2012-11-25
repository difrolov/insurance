<?	$aMods=$this->getAllModulesNames($model_modules);
	// см. $aMods в set_modules.php
	$testTmpl=true; // test mode
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
	if($testTmpl){?>
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
	} //alert(multicol);
	if (defineLayoutSchema(tPyctLast)){ // получить кнопку!
		if (Layout.Schema!='100'){
			$(tPyctFirst).trigger('click'); // клик по первой пиктограмме макета
			if (multicol&&tPyctSecond) // больше 2-х колонок и есть 3-й ряд (что бывает не всегда)
				$(tPyctSecond).trigger('click'); // клик по второй пиктограмме макета			
			$(tPyctLast).trigger('click'); // клик по последней пиктограмме макета
		}
		$(btn_loadLayout).trigger('click'); // клик по пиктограмме загрузки макета
		var tmplArea=$('div#tmplPlace >div:first-child >div'); // колонки макета
		$(tmplArea).filter(':first-child').trigger('click'); // клик по активной (первой) колонке
		var curMods=$('div#select_mod div[data-module-type]');
	<?	// пройтись по всем блокам и собрать их контент:
		foreach($SectionDataContent['blocks'] as $block_name=>$block){
			if( $block_name==2 // заголовок подраздела
			    && strstr($block,"header:") // не массив, а строка; есть метка заголовка
			  ){ 
				$headerText=substr($block,strpos($block,":")+1);?>
		$('div[data-block-type="header"] input[type="text"]').val('<?=$headerText?>');
		<?	}else{
				// пройтись по блоку и собрать его модули:
				for($i=0,$j=count($block);$i<$j;$i++){
					$blockContent=$block[$i]; // Новости, Готовое решение ...
					// получить ключ существующего модуля, чтобы далее эмулировать клик по нему и добавление в текущую колонку:
					if(in_array($blockContent,$aMods))
						$modIndex=array_search($blockContent,$aMods);
					elseif(strstr($blockContent,"Текст :: article id:"))
						$modIndex=count($aMods)-1;					
					if($modIndex){?>
	$(curMods).eq(<?=$modIndex?>).trigger('click');
	alert('exists: <?=$blockContent?>');
				<? }
				}
			}
		}?>	
		// $(tmplArea).each(  function (i){});
<?		if($testTmpl) :?>
		test_parseLayout();
<?		endif;?>
	}
<?	}?>
  }catch(e){
	  alert(e.message);
  }
});
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