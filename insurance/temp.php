<!DOCTYPE HTML>
<html>
<head>
<title>My Web Application</title>
<meta charset="utf-8">
<meta name="language" content="ru">
<style>
html, body{
	height:100%;
}

div[footer]{
	border-top:solid 1px #CCCCCC;
}

div.column3center,
div.column3right,
div.header3inside,
div.left3{
	width:58px;
}
div.column4{
	width:41px;
}

div.column4last{
	width:42px;
}

div.column4,
div.column3center,
div.header3inside,
div.hf4Inside,
div[class*="left"]{
	border-right:solid 1px #CCC;
}

div.hColMiddle{
	height:151px;
}

div.hColShort{
	height:110px;
}

div[header]{
	border-bottom:solid 1px #CCCCCC;
}

div[header],
div[footer]{
	height:32px;
}

div.hFull,
div[left]{
	height:192px;
}

div.first{
	height:200px;
	border:solid 2px #CCCCCC;
	display:inline-block;
	margin-top:6px;
	margin-right:6px;
	width:200px;
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
	width:125px;
}

div.hf4Shared{
	width:142px;
}

div.hf4Inside,
div.left2{
	width:91px;
}

hr{ /* только для тестовой версии */
	border: none;
	border-bottom:solid 2px #CCC;
	clear:both;
	height:10px;
}

div[right], 
div.right2,
div.column4last,
div[footer]{
	float:right;
}

div.right2{
	width:92px;
}
</style>
<script>
arrSchema=new Array(  '100',  //0
					  '200', //1
					  '300', //2
					  '400', //3
					  '210', //4
					  '3i0', //5
					  '3s0', //6
					  '3ss', //7
					  '30s', //8
					  '4i0', //9
					  '4s0', //10
					  '4ii', //11
					  '4ss', //12
					  '40i', //13
					  '40s'	 //14
					);
function handleTmpl(tmplSchema){
  try{ //alert(tmplSchema);	
  	//var tmplSchema=arrSchema[tSchema];
  	// получить количество блоков:
	var colsCountInit=colsCount=parseInt(tmplSchema.substring(0,1));
	var tmplValue2=tmplSchema.substring(1,2);
	var tmplValue3=tmplSchema.substring(2);
	if (tmplValue2!='0') colsCount+=1;
	if (tmplValue3!='0') colsCount+=1;
	var tmplBlock='<div class="first">';
	for (i=0;i<colsCount;i++){
		if (i==0) { // назначить ширину первой колонке:
			switch(colsCountInit){ // первое значение схемы - колич. колонок 
				case 1:
					firstColWidth='200';
						break;
				case 2:
					firstColWidth='99';
						break;
				case 3:
					firstColWidth='66';
						break;
				case 4:
					firstColWidth='49';
						break;
			}
			tmplBlock+='<div class="borderRight fLeft hFull" style="width:'+firstColWidth+'px;">left</div>';	
		}else{ // разобраться с остальными колонками:
			if (i==1){
				var hWidth;
				switch(tmplValue2){ // первое значение схемы - колич. колонок 
					case '1':case 's':case 'i':
						if (tmplValue2=='i');
						else ;
							//hWidth=(tmplValue2=='s')? "100%";
						//firstColWidth='200';
							break;
					case 2:
						//firstColWidth='99';
							break;
					case 3:
						//firstColWidth='66';
							break;
					case 4:
						//firstColWidth='49';
							break;
				}
			}else if (i==2){
				switch(tmplValue3){ // первое значение схемы - колич. колонок 
					case 1:
						//firstColWidth='200';
							break;
					case 2:
						//firstColWidth='99';
							break;
					case 3:
						//firstColWidth='66';
							break;
					case 4:
						//firstColWidth='49';
							break;
				}
			}
			tmplBlock+='<div class="';
			tmplBlock+='fLeft hColMiddle';
			tmplBlock+='" style="';
			tmplBlock+='width:58';
			tmplBlock+='px;">Content comes here!</div>';
		}
	}
	tmplBlock+="</div>";
	//alert(tmplBlock);
	document.getElementById('tmplPlace').innerHTML=tmplBlock;
	//alert(tmplSchema+': '+colsCount+'\n[1]= '+tmplSchema.substring(1,2)+', [2]= '+tmplSchema.substring(2));
  }catch(e){
	  alert(e.message);
  }
}
</script>
</head>
<body>

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
<div class="fLeft">
    <h4>210</h4>
    <div class="first">
        <div class="left2" left>left</div>
        <div class="right2" header>header</div>
        <div class="hColMiddle right2" right>right</div>
    </div>
</div>
<hr>
<div class="fLeft">
    <h4>300</h4>
    <div class="first">
        <div class="left3" left>left</div>
        <div class="column3center hFull">center</div>
        <div class="hFull column3right" right>right</div>
    </div>
</div>
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
    <h4>30s</h4>
    <div class="first">
        <div class="left3" left>left</div>
        <div class="column3center hColMiddle">inside</div>
        <div class="column3right hColMiddle" right>right</div>
        <div class="hf3Shared" footer>footer</div>
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
<hr>

<div class="fLeft">
    <h4>400</h4>
    <div class="first">
        <div class="column4" left>left</div>
        <div class="column4 hFull">insideL</div>
        <div class="column4 hFull">insideR</div>
        <div class="column4 hFull" right>right</div>
    </div>
</div>
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
<input type="text" id="int" size="1" value="30s">
<a href="javascript:handleTmpl(document.getElementById('int').value);">check tmplSchema </a>
<div id="tmplPlace"></div>
</body>
</html>
