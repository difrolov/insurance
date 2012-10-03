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
div.borderTop{
	border-top:solid 1px #CCCCCC;
}
div.borderRight{
	border-right:solid 1px #CCCCCC;
}
div.borderBottom{
	border-bottom:solid 1px #CCCCCC;
}
div.borderLeft{
	border-left:solid 1px #CCCCCC;
}
div.hFull{
	background:#FFFF00;
	height:192px;
}
div.hHeader,
div.hFooter{
	height:32px;
}
div.hColMiddle{
	height:151px;
}
div.hColShort{
	height:110px;
}
div.first{
	height:200px;
	border:solid 2px #CCCCCC;
	display:inline-block;
	margin-top:6px;
	margin-right:6px;
	width:200px;
}
div.first div {
	padding:4px;
}
div.fLeft{
	float:left;
}
div.fRight{
	float:right;
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
		}else{
			if (i==1){
			}else if (i==2){
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
<h4>30s</h4>
<div class="first">
    <div class="borderRight fLeft hFull" style="width:'+firstColWidth+'px;">left</div>
    <div class="fLeft hColMiddle" style="width:58px;">inside</div>
    <div class="borderLeft fLeft hColMiddle" style="width:58px;">right</div>
    <div class="borderTop fRight hFooter" style="width:125px;">footer</div>
</div>
<h4>4ss</h4>
<div class="first">
    <div class="borderRight fLeft hFull" style="width:58px;">left</div>
  <div class="borderBottom fRight hHeader" style="width:125px;">header</div>
  <div class="fLeft hColShort" style="width:58px;">inside</div>
  <div class="borderLeft fLeft hColShort" style="width:58px;">right</div>
    <div class="borderTop fRight hFooter" style="width:125px;">footer</div>
</div>
<hr>
<input type="text" id="int" size="1" value="30s">
<a href="javascript:handleTmpl(document.getElementById('int').value);">check tmplSchema </a>
<div id="tmplPlace"></div>
</body>
</html>
