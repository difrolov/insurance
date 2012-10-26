<HTML>
<HEAD>
<TITLE>My Web Application - Корпоративным клиентам</TITLE>
<META charset=utf-8>
<META name=language content=ru>
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 
<script src="js/admin/generator/switch_states.php"></script>
<script src="js/admin/generator/manage_template.php?base_url=/insur/insurance"></script>
<script src="js/admin/generator/handle_text_module.php?base_url=/insur/insurance&test=1"></script>
<script src="js/admin/generator/customize_page.js"></script>
<script src="js/admin/generator/data_ready_to_send.php?base_url=/insur/insurance&test=1"></script>
<script>

jQuery( function(){summarize(obj)});

var obj = {
    helloText: "Hello World!"
};
delete obj;
function summarize(obj,ins){
  try{
	for(var ob in obj){ 
		var toPlace=document.getElementById('obj_place');
		var currentObj=obj[ob];
		alert(typeof(currentObj));
		if (typeof(currentObj)=='object'){
			toPlace.innerHTML+='<div class="rd">is object: '+ob;
				summarize(currentObj,true);
			toPlace.innerHTML+='</div>';
		}else{ 
			var nclass=ins? 'rd2':'rd';
			toPlace.innerHTML+='<div><div class="'+nclass+'"><div>is not object: '+currentObj+'</div></div></div>';
		}
	}
  }catch(e){
	  alert(e.message);
  }
}
alert(obj);

</script>
<style>
.rd,.rd2 > div{
	display:inline-block;
	border:solid 1px #666;
}
.rd,.rd2,.rd2 > div {
	border-radius:6px;
	margin:0 6px 4px 0;
	padding:10px;
}
.rd2{
	margin-left:10px;
	padding:0;
}
.rd2 > div{
	background:#CCC;
	margin:0;
}
</style>
</HEAD>
<BODY>
<p><a href="#" id="schema">Schema</a></p>
<p><a href="#" id="header">Header</a></p>
<p><a href="#" id="footer">Footer</a></p>
<p>
	<a href="#" id="block1">Block1</a><br>
	<a href="#" id="block2">Block2</a><br>
	<a href="#" id="block3">Block3</a><br>
	<a href="#" id="block4">Block4</a><br>
</p>
<div id="array_place"></div>
<a href="#" id="summarize">Summarize!</a>
<br><br>
<div id="obj_place"></div>
</BODY>
</HTML>