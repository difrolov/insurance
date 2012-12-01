<style>
div#inner_left_menu {
	background:none; 
	box-shadow:none; 
	max-width: 955px;
	width:100%; 
}
div#inner_left_menu a{
	color:#666;
}
div.mainWrapper 
	> div > a,
blockquote div a{
	font-size:11px !important;
}
div.separator2{
	margin-top:10px !important;
	margin-bottom:-4px !important;
}
div.separator2,
div.separator2 > div{
	background:#666;
	height:10px;
	padding:0 !important;
	margin:0;
}
div.separator2 > div{
	width:50%;
	background:#06AEDD;
}
h4{
	font-size:15px;
	font-weight:400;
	margin-bottom:10px;
}
div.mainWrapper{
	margin-left:40px;
}
</style>
<div id="inner_left_menu">
<h2 class="txtLightBlue">Карта сайта</h2>
   <div class="separator2"><div>&nbsp;</div></div>     
<? 
function buildMap($array) {
	$a=count($array)-1;
	foreach($array as $key=>$val){
		$a--;
		if (isset($val['parent_id'])&&$val['parent_id']=='-1'):?>
	<h4><a href="<?=Yii::app()->request->getBaseUrl(true)?>/<?=$val['alias']?>"><?=$val['name']?></a></h4>
	<div class="mainWrapper">
	<?	endif;
		$items_data=Data::getObjectsRecursive( 
						false, // поля извлечения данных
	  		  	   		$val['id']
				   );
		setHTML::buildSubmenuLinks($items_data,$val['alias'],$section=array('section_id'=>$val['id']));?>
   </div>
   <? 	if($a>=0&&isset($val['children'])):?>
   <div class="separator2"><div>&nbsp;</div></div>     
<?		endif;
	}
}
buildMap($res);?>
</div>