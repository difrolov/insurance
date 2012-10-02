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
</head>
<body>
<h4>30s</h4>
<div class="first">
    <div class="borderRight fLeft hFull" style="width:58px;">left</div>
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
</body>
</html>
