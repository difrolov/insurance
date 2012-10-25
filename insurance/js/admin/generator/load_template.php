<?	if (isset($dwshow)){?><script><? }
ob_start();?>
// JavaScript Document
//
function createLayout(){
  try{ 	
  	// получить количество блоков:
	var colsCountInit=colsCount=parseInt(Layout.Schema.substring(0,1));
	var tmplValue2=Layout.Schema.substring(1,2);
	var tmplValue3=Layout.Schema.substring(2);
	if (tmplValue2!='0') colsCount+=1;
	if (tmplValue3!='0') colsCount+=1;
	
	switch(colsCount){
		case 1:
			Layout.blocks={
				1:''
			};
		break;
		case 2:
			Layout.blocks={
				1:'',
				2:''
			};
		break
		case 3:
			switch(Layout.Schema){
				case '210':
					Layout.blocks={
						1:'',
						2:'header',
						3:''
					};
				break;
				case '300':
					Layout.blocks={
						1:'',
						2:'',
						3:''
					};
				break;
			}
		break;
		case 4:
			switch(Layout.Schema){
				case '3i0': case '3s0':
					Layout.blocks={
						1:'',
						2:'header',
						3:'',
						4:''
					};
				break;
				case '30s':
					Layout.blocks={
						1:'',
						2:'',
						3:'',
						footer:''
					};
				break;
				case '400':
					Layout.blocks={
						1:'',
						2:'',
						3:'',
						4:''
					};
				break;
			}
		break;
		case 5:
			switch(Layout.Schema){
				case '3ss':
					Layout.blocks={
						1:'',
						2:'header',
						3:'',
						4:'',
						footer:''
					};
				break;
			}
			switch(Layout.Schema){
				case '4i0':case '4s0':
					Layout.blocks={
						1:'',
						2:'header',
						3:'',
						4:'',
						5:''
					};
				break;
			}
			switch(Layout.Schema){
				case '40i':case '40s':
					Layout.blocks={
						1:'',
						2:'',
						3:'',
						4:'',
						footer:''
					};
				break;
			}
		break;
		case 6:
			Layout.blocks={
				1:'',
				2:'header',
				3:'',
				4:'',
				5:'',
				footer:''
			};
		break;
	}
	// 	построить схему блоков для визуализации:
	var tmplBlock='<div class="first" onClick="selectColumn(event,this);">';
	for (i=0;i<colsCount;i++){
		
		tmplBlock+='	<div';
		
		if (i==0) { // первая итерация:
			if (colsCountInit!=1) {
				tmplBlock+=' class="';
				var lClass=(colsCountInit==4)? 'column4':'left'+colsCountInit;				
				tmplBlock+=lClass+'"';
			}
			tmplBlock+=' data-block-type="left"';	
		
		}else{ // разобраться с остальными колонками:
			tmplBlock+=' class="';
			switch(i){
				
				case 1: // 2-й блок
					
					switch(Layout.Schema){ // назначаем первый класс:
						case '3i0':
							tmplBlock+='header3inside';
								break;
						case '4i0':
						case '4ii':
							tmplBlock+='hf4Inside';
								break;
						case '3s0':
						case '3ss':
							tmplBlock+='hf3Shared';
								break;
						case '4s0':
						case '4ss':
							tmplBlock+='hf4Shared';
								break;
						case '200':
						case '210':
							tmplBlock+='right2';
								break;
						case '300':
						case '30s':
							tmplBlock+='column3center';
								break;
						case '400':
						case '40s':
							tmplBlock+='column4';
								break;
						case '40i':
							tmplBlock+='column4last';
								break;
					}
					switch(Layout.Schema){	// добавляем второй класс:
						case '200':
						case '300':
						case '400':
						case '40i':
							tmplBlock+=' hFull';
								break;
						case '30s':
						case '40s':
							tmplBlock+=' hColMiddle';
								break;
					}
					
					tmplBlock+='"'; // дописываем закрывающую кавычку классов
					switch(Layout.Schema){ // добавить атрибут блока для идентификации CSS:
						case '210':
						case '3i0':
						case '3s0':
						case '3ss':
						case '4i0':
						case '4ii':
						case '4s0':
						case '4ss':
							tmplBlock+=' data-block-type="header"';
								break;
						case '300':
						case '400':
							tmplBlock+=' data-block-type="left"';
								break;
						case '200':
						case '40i':
						case '4ii':
						case '4ss':
							tmplBlock+=' data-block-type="right"';
								break;
					}
				
				break;
					
				case 2: // 3-й блок
					
					switch(Layout.Schema){ // назначаем первый класс:
						case '210':
							tmplBlock+='hColMiddleLong';
								break;
						case '300':
						case '3i0':
						case '30s':
						case '3s0':
							tmplBlock+='column3right';
								break;
						case '3ss':
							tmplBlock+='column3center';
								break;
						case '400':
						case '40i':
						case '40s':
						case '4ss':
							tmplBlock+='column4';
								break;
						case '4i0':
						case '4ii':
						case '4s0':
							tmplBlock+='column4last';
								break;
					}
					switch(Layout.Schema){ // добавляем второй класс:
						case '210':
							tmplBlock+=' right2';
								break;
						case '300':
						case '3i0':
						case '400':
						case '4i0':
						case '4ii':
							tmplBlock+=' hFull';
								break;
						case '30s':
						case '4s0':
						case '40s':
						case '40i':
							tmplBlock+=' hColMiddle';
								break;						
						case '3s0':
							tmplBlock+=' hColMiddleLong';
								break;						
						case '3ss':
						case '4ss':
							tmplBlock+=' hColShort';
								break;
					}
					
					tmplBlock+='"'; // дописываем закрывающую кавычку классов
					switch(Layout.Schema){ // добавляем атрибут для CSS:
						case '210':
						case '300':
						case '3i0':
						case '30s':
						case '3s0':
						case '4ii':
						case '4s0':
							tmplBlock+=' data-block-type="right"';
								break;
					}
				
				break;
				
				case 3: // 4-й блок
					
					switch(Layout.Schema){ // назначить первый класс:
						case '3i0':
						case '3s0':
							tmplBlock+='column3center';
								break;
						case '400':
						case '4i0':
						case '4s0':
						case '40i':
						case '4ii':
						case '4ss':
							tmplBlock+='column4';
								break;
						case '40s':
							tmplBlock+='column4last';
								break;
						case '30s':
							tmplBlock+=' hf3Shared';
								break;
						case '3ss':
							tmplBlock+=' column3right';
								break;
					}
					switch(Layout.Schema){ // добавить второй класс:
						case '40i':
						case '40s': 
							tmplBlock+=' hColMiddle';
								break;
						case '3s0': 
						case '3i0': 
						case '4i0': 
						case '4s0': 
							tmplBlock+=' hColMiddleLong';
								break;
						case '3ss':
						case '4ii':
						case '4ss':
							tmplBlock+=' hColShort';
								break;
						case '400':
							tmplBlock+=' hFull';
								break;
					}
					
					tmplBlock+='"'; // дописываем закрывающую кавычку классов
					switch(Layout.Schema){ // добавить атрибут для CSS:
						
						case '30s':
							tmplBlock+=' data-block-type="footer"';
								break;
						case '400':
						case '3ss':
							tmplBlock+=' data-block-type="right"';
								break;
					}
				
				break;
				
				case 4: // 5-й блок
					
					switch(Layout.Schema){ // назначить первый класс
						case '4i0':
						case '4ii':
						case '4ss':
						case '4s0':
							tmplBlock+='column4';
							break;
						case '4ss':
							tmplBlock+='column4last';
							break;
						case '40i':
							tmplBlock+='hf4Inside';
								break;
						case '40s':
							tmplBlock+='hf4Shared';
								break;
						case '3ss':
							tmplBlock+='hf3Shared';
								break;
					}
					switch(Layout.Schema){ // добавить второй класс
						case '4i0':
						case '4s0': 
							tmplBlock+=' hColMiddleLong';
								break;
						case '4ii':
						case '4ss':
							tmplBlock+=' hColShort';
							break;
						case '3ss':
							tmplBlock+=' hf3Shared';
								break;
					}

					tmplBlock+='"'; // дописываем закрывающую кавычку классов
					switch(Layout.Schema){ // добавить атрибут для CSS:
						case '3ss':
						case '40i':
						case '40s':
							tmplBlock+=' data-block-type="footer"';
								break;
						case '4ss':
							tmplBlock+=' data-block-type="right"';
								break;
					}
				
				break;
				
				case 5: // 6-й блок
				
					switch(Layout.Schema){ // назначаем первый класс: 
						case '4ss':
							tmplBlock+='hf4Shared';
								break;
						case '4ii':
							tmplBlock+='hf4Inside';
								break;
					}

					tmplBlock+='"'; // дописываем закрывающую кавычку классов
					switch(Layout.Schema){ // добавить атрибут для CSS:
						case '4ss':
						case '4ii':
							tmplBlock+=' data-block-type="footer"';
								break;
					}
				
				break;
			}
		}
		tmplBlock+=">&nbsp;</div>";
	}
	tmplBlock+="</div>";
	var goLoop=false;
	if (goLoop) // чиста для теста, если хотим вывести все возможные блоки
		document.getElementById('tmplPlace').innerHTML+='<div>'+Layout.Schema+'</div>'+tmplBlock;
	else
		document.getElementById('tmplPlace').innerHTML=tmplBlock;
	// прописать количество блоков макета в тестовом блоке:
	test_addBlocks();
	
  }catch(e){
	  alert(e.message);
  }
}
// загрузим макет по сформированному шаблону
function loadLayout(){ 
  try{	
	var topPos=$('#txtActions').offset().top;
	$("html, body").animate(
		{scrollTop:topPos},
		500,
		function(){stateLayoutIsLoaded()}
	);
	//
	createLayout();
	var headerBlock=$("div[data-block-type='header']")[0];
	if (headerBlock){
		var pWidth=$(headerBlock).width()-10;
		headerBlock.innerHTML='<div>Текст подзаголовка:</div><input type="text" style="width:'+pWidth+'px; padding:4px;" onblur="saveSubHeader(this.value);">'
	}
  }catch(e){
	  alert(e.message);
  }
}
<?	
$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
