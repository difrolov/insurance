<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script>
$(function(){
  try{
	$('button#check').click( function(){
		Layout={
			1:'first',
			2:'second'
		}
		//var j=JSON.stringify(Layout);
		//alert(j);
		var Url=$('#content_save').attr('action');
		$.ajax ({
			type: "POST",
			url: Url,
			data: Layout,
			dataType: 'json',
			success: function (data) {
				for (var p in data){
					alert(p+':\n'+data[p]);
				}
				//alert("Data has been sent! The servers says: "+data.first+', '+data.second);
			},
			error: function (data) {
				//console.log("Не удалось отправить данные")
				alert("Не удалось отправить данные"); 
			}
		})
	});
  }catch(e){
	alert(e.message);
  }
});
/*try{
	var myStr="Hello|again|here|we|are";
	var myArr=myStr.split("|");
	alert(typeof myStr+':\n'+myStr+'\nmyArr is '+typeof(myArr));
}catch(e){
	alert(e.message);
}*/
</script>
</head>
<body>
<form style="margin:0;" name="content_save" id="content_save" method="post" action="http://localhost/insur/insurance/_docs/tests/test2.php">
<div id="sections_radios">
  <input type="radio" name="radio" id="radio" value="radio">
  first
  <input type="radio" name="radio" id="radio2" value="radio">
  second
  <input type="radio" name="radio" id="radio3" value="radio">
  third
  <input type="radio" name="radio" id="radio4" value="radio">
  fourth
</div>  
<p><button type="button" id="check">Send it!</button></p>
</form>
<table width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#FFFF66">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>