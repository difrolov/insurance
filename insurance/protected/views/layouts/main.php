<?php /* @var $this Controller */
		// переменные на время тестирования:
		// режим отображения статических данных включается только при $test=1
if (isset($_GET['test'])) {
	if(	!$_GET['test']
		|| $_GET['test']=='0'
		|| strstr($_GET['test'],'-')
	  ) $_SESSION['test']=false;
	else $_SESSION['test']=$_GET['test'];			
}
if (isset($_SESSION['test'])) $test=$_SESSION['test'];
$tp=false;

if ($oldIE=setHTML::detectOldIE()||isset($_GET['iexp'])) { //die("OLD IE!")?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?	require_once dirname(__FILE__)."/old_ie.php";
}else{?><!DOCTYPE HTML>
<?	require_once dirname(__FILE__)."/default.php";
}
setHTML::veil();
	if (isset($_GET['tmpl'])){?>
<style>
.measure{
	position:fixed;  
	border:solid 1px orange; 
	cursor:move;  
	background:#000; 
	opacity:0.5; 
	z-index:1;
}
</style>
<script>
$( function(){
	
	var shwhd=$('#shwhd');
	var site=$('#shwhdsite');
	var mock=$('#mock');
	var bd=$('body >div:first-child');
	var measure=$('#measure');
	var measure2=$('#measure2');
	$(measure).draggable();
	$(measure2).draggable();
	$(bd).fadeOut('100');
	$(mock).hide();
	$(mock).draggable({
			revert: true
		}).css('cursor','move');
	
	$(shwhd).click( function(){
			$(mock).toggle();
		});
	$(site).click( function(){
			$(bd).toggle();
		});
});
</script>    
    <div title="Щёлкните для переключения видимости наложенного изображения с прототипом макета" id="shwhd" class="testBlock txtLightBlue" style="position:fixed; left:4px; top:4px; display:inline-block; cursor:pointer; z-index:1;">Макет</div>
    <div title="Щёлкните для переключения видимости сайта" id="shwhdsite" class="testBlock txtLightBlue" style="position:fixed; left:4px; top:49px; display:inline-block; cursor:pointer; z-index:1;">Сайт</div>
    <div class="measure" id="measure" style="width:45px; right:40px; top:0; bottom:0;">&nbsp;</div>
    <div class="measure" id="measure2" style="height:45px; left:0px; top:100px; right:0;">&nbsp;</div>
    <div title="Можно перемещать" id="mock" style="position:absolute; opacity:0.5; top:0; left:-8px; z-index:0;"><img src="<?=Yii::app()->request->getBaseUrl(true)?>/_docs/MOCK.gif" width="1280" height="1147"></div>
<? 	}?>

</body>
</html>