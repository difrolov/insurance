<!DOCTYPE HTML>
<html>
<head>
<title>My Web Application</title>
<meta charset="utf-8">
<meta name="language" content="ru">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script>

	<!-- blueprint CSS framework -->

<title>My Web Application - Generator</title>
	<link rel="stylesheet" type="text/css" href="/insur/insurance/css/admin/generator.css" />
<style>
html, body{
	height:100%;
}

div[footer]{
	border-top:dashed 2px #999;
}

div.column3center,
div.column3right,
div.header3inside,
div.left3{
	width:212px;/*58	+++*/
}
div.column4{
	width:156px;/*41	+++*/
}

div.column4last{
	width:156px;/*42	+++*/
}

div.column4,
div.column3center,
div.header3inside,
div.hf4Inside,
div[class*="left"]{
	border-right:dashed 2px #999;
}

div.hf4Inside[footer]{
	margin-right:2px; /*	иначе - непонятный косяк с нижним блоком псевдофутера	*/
}

div.column4[right]{
	border-right: none;
}

div.hColMiddle{
	height:350px;/*151	+++*/
}

div.hColShort{
	height:268px;/*110	+++*/
}

div[header]{
	border-bottom:dashed 2px #999;
}

div[header],
div[footer]{
	height:72px;/*32*/
}

div.hFull,
div[left]{
	height:432px;/*192*/
}

div.first{
	height:440px;/*200	+++*/
	border:dashed 2px #999;
	display:inline-block;
	margin-top:6px;
	margin-right:6px;
	width:664px; /*200*/
}

div.first div { /* ? */
	padding:4px;
}

div.fLeft, /* убрать в рабочей версии! */
div.column4,
div.column3center,
div.header3inside,
div[class*="left"],
div[header]{
	float:left;
}

h4{
	margin:4px 0;
}

h4:after{ /* только для тестовой версии */
	content:":";
}

div.hf3Shared{
	width:434px;/*125	+++*/
}

div.hf4Shared{
	width:490px;/*142	+++*/
}

div.hf4Inside,
div.left2{
	width:322px;/*91	+++*/
}

hr{ /* только для тестовой версии */
	border: none;
	border-bottom:solid 2px #CCC;
	clear:both;
	height:10px;/**/
}

div[right], 
div.right2,
div.column4last,
div[footer]{
	float:right;
}

div.right2{
	width:322px;/*92	+++*/
}
.invis{
	
}
</style>
<script>
function goTemplate(){
arrSchema=new Array(  '100',  //0
					  '200', //1
					  '210', //4
					  '300', //2
					  '3i0', //5
					  '3s0', //6
					  '3ss', //7
					  '30s', //8
					  '400', //3
					  '4i0', //9
					  '4s0', //10
					  '40i', //13
					  '40s', //14
					  '4ii', //11
					  '4ss' //12
					);
	for (a=0;a<arrSchema.length;a++) {
		//if (a<3) alert(arrSchema[a]);
		createTemplate(arrSchema[a],true);
	}
}
	
function createTemplate(tmplSchema,goLoop){
  try{ //alert(tmplSchema);	
  	// получить количество блоков:
	var colsCountInit=colsCount=parseInt(tmplSchema.substring(0,1));
	var tmplValue2=tmplSchema.substring(1,2);
	var tmplValue3=tmplSchema.substring(2);
	if (tmplValue2!='0') colsCount+=1;
	if (tmplValue3!='0') colsCount+=1;
	var tmplBlock='<div class="first">';
	for (i=0;i<colsCount;i++){
		tmplBlock+='	<div';
		if (i==0) { // первая итерация:
			if (colsCountInit!=1) {
				tmplBlock+=' class="';
				tmplBlock+=(colsCountInit==4)? 'column4':'left'+colsCountInit;
				tmplBlock+='"';
			}
			tmplBlock+=' left';	
		}else{ // разобраться с остальными колонками:
			tmplBlock+=' class="';
			switch(i){
				
				case 1: // 2-й блок
					
					switch(tmplSchema){ // назначаем первый класс:
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
					switch(tmplSchema){	// добавляем второй класс:
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
					switch(tmplSchema){ // добавить атрибут блока для идентификации CSS:
						case '210':
						case '3i0':
						case '3s0':
						case '3ss':
						case '4i0':
						case '4ii':
						case '4s0':
						case '4ss':
							tmplBlock+=' header';
								break;
						case '300':
						case '400':
							tmplBlock+=' left';
								break;
						case '200':
						case '40i':
						case '4ii':
						case '4ss':
							tmplBlock+=' right';
								break;
					}
				
				break;
					
				case 2: // 3-й блок
					
					switch(tmplSchema){ // назначаем первый класс:
						case '210':
							tmplBlock+='hColMiddle';
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
					switch(tmplSchema){ // добавляем второй класс:
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
						case '3s0':
						case '4s0':
						case '40s':
						case '40i':
							tmplBlock+=' hColMiddle';
								break;						
						case '3ss':
						case '4ss':
							tmplBlock+=' hColShort';
								break;
					}
					
					tmplBlock+='"'; // дописываем закрывающую кавычку классов
					switch(tmplSchema){ // добавляем атрибут для CSS:
						case '210':
						case '300':
						case '3i0':
						case '30s':
						case '3s0':
						case '4ii':
						case '4s0':
							tmplBlock+=' right';
								break;
					}
				
				break;
				
				case 3: // 4-й блок
					
					switch(tmplSchema){ // назначить первый класс:
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
					switch(tmplSchema){ // добавить второй класс:
						case '3i0': 
						case '3s0': 
						case '40i':
						case '40s': 
						case '4i0': 
						case '4s0': 
							tmplBlock+=' hColMiddle';
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
					switch(tmplSchema){ // добавить атрибут для CSS:
						
						case '30s':
							tmplBlock+=' footer';
								break;
						case '400':
						case '3ss':
							tmplBlock+=' right';
								break;
					}
				
				break;
				
				case 4: // 5-й блок
					
					switch(tmplSchema){ // назначить первый класс
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
					switch(tmplSchema){ // добавить второй класс
						case '4i0':
						case '4s0':
							tmplBlock+=' hColMiddle';
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
					switch(tmplSchema){ // добавить атрибут для CSS:
						case '3ss':
						case '40i':
						case '40s':
							tmplBlock+=' footer';
								break;
						case '4ss':
							tmplBlock+=' right';
								break;
					}
				
				break;
				
				case 5: // 6-й блок
				
					switch(tmplSchema){ // назначаем первый класс: 
						case '4ss':
							tmplBlock+='hf4Shared';
								break;
						case '4ii':
							tmplBlock+='hf4Inside';
								break;
					}

					tmplBlock+='"'; // дописываем закрывающую кавычку классов
					switch(tmplSchema){ // добавить атрибут для CSS:
						case '4ss':
						case '4ii':
							tmplBlock+=' footer';
								break;
					}
				
				break;
			}
		}
		tmplBlock+=">block</div>";
	}
	tmplBlock+="</div>";
	//alert(tmplBlock);
	if (goLoop)
		document.getElementById('tmplPlace').innerHTML+='<div>'+tmplSchema+'</div>'+tmplBlock;
	else
		document.getElementById('tmplPlace').innerHTML=tmplBlock;
	//alert(tmplSchema+': '+colsCount+'\n[1]= '+tmplSchema.substring(1,2)+', [2]= '+tmplSchema.substring(2));
  }catch(e){
	  alert(e.message);
  }
}
function goFade(){
  try{
	$('#go_fade').fadeIn(2000);
  }catch(e){
	  alert(e.message);
  }
}
</script>
</head>
<body>
<?	$tp=false;
	if ($tp){?>
<div class="fLeft">
    <h4>100</h4>
    <div class="first">
    	<div left>left</div>
    </div>
</div>
<hr>

<div class="fLeft">
    <h4>200</h4>
    <div class="first">
        <div class="left2" left>left</div>
        <div class="hFull right2" right>right</div>
    </div>
</div>
<hr>
<div class="fLeft">
    <h4>210</h4>
    <div class="first">
        <div class="left2" left>left</div>
        <div class="right2" header>header</div>
        <div class="hColMiddle right2" right>right</div>
    </div>
</div>
<div class="fLeft">
    <h4>300</h4>
    <div class="first">
        <div class="left3" left>left</div>
        <div class="column3center hFull">center</div>
        <div class="hFull column3right" right>right</div>
    </div>
</div>
<hr>
<div class="fLeft">
    <h4>3i0</h4>
    <div class="first">
        <div class="left3" left>left</div>
        <div class="header3inside" header>header</div>
        <div class="column3right hFull" right>right</div>
        <div class="column3center hColMiddle">inside</div>
    </div>
</div>
<div class="fLeft">
    <h4>3s0</h4>
    <div class="first">
        <div class="left3" left>left</div>
        <div class="hf3Shared" header>header</div>
        <div class="column3right hColMiddle" right>right</div>
        <div class="column3center hColMiddle">inside</div>
    </div>
</div>

<div class="fLeft">
    <h4>3ss</h4>
    <div class="first">
        <div class="left3" left>left</div>
        <div class="hf3Shared" header>header</div>
        <div class="column3center hColShort">inside</div>
        <div class="column3right hColShort" right>right</div>
        <div class="hf3Shared" footer>footer</div>
    </div>
</div>
<div class="fLeft">
    <h4>30s</h4>
    <div class="first">
        <div class="left3" left>left</div>
        <div class="column3center hColMiddle">inside</div>
        <div class="column3right hColMiddle" right>right</div>
        <div class="hf3Shared" footer>footer</div>
    </div>
</div>
<div class="fLeft">
    <h4>400</h4>
    <div class="first">
        <div class="column4" left>left</div>
        <div class="column4 hFull">insideL</div>
        <div class="column4 hFull">insideR</div>
        <div class="column4 hFull" right>right</div>
    </div>
</div>
<hr>

<div class="fLeft">
    <h4>4i0</h4>
    <div class="first">
        <div class="column4" left>left</div>
      	<div class="hf4Inside" header>header</div>
        <div class="column4last hFull" right>right</div>
      	<div class="column4 hColMiddle">insideL</div>
      	<div class="column4 hColMiddle">insideR</div>
    </div>
</div>
<div class="fLeft">
    <h4>4s0</h4>
    <div class="first">
        <div class="column4" left>left</div>
        <div class="hf4Shared" header>header</div>
        <div class="column4last hColMiddle" right>right</div>
        <div class="column4 hColMiddle">insideL</div>
        <div class="column4 hColMiddle">insideR</div>
    </div>
</div>
<div class="fLeft">
    <h4>40i</h4>
    <div class="first">
        <div class="column4" left>left</div>
        <div class="column4last hFull" right>right</div>
      	<div class="column4 hColMiddle">insideL</div>
      	<div class="column4 hColMiddle">insideR</div>
        <div class="hf4Inside" footer>footer</div>
    </div>
</div>
<div class="fLeft">
    <h4>40s</h4>
    <div class="first">
        <div class="column4" left>left</div>
        <div class="column4 hColMiddle">insideL</div>
        <div class="column4 hColMiddle">insideL</div>
        <div class="column4last hColMiddle">insideR</div>
        <div class="hf4Shared" footer>footer</div>
    </div>
</div>
<hr>
<div class="fLeft">
    <h4>4ii</h4>
    <div class="first">
        <div class="column4" left>left</div>
      	<div class="hf4Inside" header>header</div>
        <div class="hFull column4last" right>right</div>
      	<div class="column4 hColShort">insideL</div>
      	<div class="column4 hColShort">insideR</div>
        <div class="hf4Inside" footer>footer</div>
    </div>
</div>
<div class="fLeft">
    <h4>4ss</h4>
    <div class="first">
        <div class="column4" left>left</div>
        <div class="hf4Shared" header>header</div>
        <div class="column4 hColShort">insideL</div>
        <div class="column4 hColShort">insideL</div>
        <div class="column4last hColShort">insideR</div>
        <div class="hf4Shared" footer>footer</div>
    </div>
</div>
<?	}?>
<div id="go_fade" class="invis">Here is content to be faded!</div>
<a href="#" onClick="goFade(); return false;">Go fade!</a>
<hr>
<a href="javascript:goTemplate();">goTemplate</a>
<input type="text" id="int" size="1" value="30s">
<a href="javascript:createTemplate(document.getElementById('int').value);">check tmplSchema </a>
<div id="tmplPlace"></div>
</body>
</html>
