<div id="inner_left_menu" style="background:none; box-shadow:none; width:initial;">
<h2 class="txtLightBlue">Карта сайта</h2>
<? 
function buildMap($array) {
	foreach($array as $key=>$val){
		$items_data=Data::getObjectsRecursive( 
						false, // поля извлечения данных
	  		  	   		$val['id']
				   );
		setHTML::buildSubmenuLinks($items_data,$val['alias'],$section=array('section_id'=>$val['id']));
	}
}
buildMap($res);?>
</div>