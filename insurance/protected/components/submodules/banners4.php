<div id="banners4" style="margin:10px;">
<?	$arrBan4=setHTML::getBannersAsObjects('4');
	//var_dump("<h1>arrBan4:</h1><pre>",$arrBan4,"</pre>");?>
    <a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($arrBan4[0]['link']);?>"><img src="<?=Yii::app()->request->getBaseUrl(true).'/'.$arrBan4[0]['src']?>"></a>
</div>