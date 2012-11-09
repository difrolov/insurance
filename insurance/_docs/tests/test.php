<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
<script>
try{
	var myStr="Hello|again|here|we|are";
	var myArr=myStr.split("|");
	alert(typeof myStr+':\n'+myStr+'\nmyArr is '+typeof(myArr));
}catch(e){
	alert(e.message);
}
</script>
</head>
<body>
</body>
</html>