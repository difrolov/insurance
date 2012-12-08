<?	$arrBan3=setHTML::getBannersAsObjects('3');
	if (!empty($arrBan3)){?>
<div id="banners3">
<?		foreach($arrBan3 as $i=>$data):?>	
    <div><a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($arrBan3[$i]['link']);?>"><img src="<?=Yii::app()->request->getBaseUrl(true).'/'.$arrBan3[$i]['src']?>"></a></div>
<?		endforeach;?>
</div>
<? 	}?>
