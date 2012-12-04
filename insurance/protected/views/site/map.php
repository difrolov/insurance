<?	Data::includeXtraCss();?>
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