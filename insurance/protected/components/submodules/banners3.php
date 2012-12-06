<div id="banners3">
<?	$arrBan3=setHTML::getBannersAsObjects('3');
	//var_dump("<h1>arrBan3:</h1><pre>",$arrBan3,"</pre>");
	foreach($arrBan3 as $i=>$data):?>	
    <div><a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($arrBan3[$i]['link']);?>"><img src="<?=Yii::app()->request->getBaseUrl(true).'/'.$arrBan3[$i]['src']?>"></a></div>
<?	endforeach;?>
</div>
