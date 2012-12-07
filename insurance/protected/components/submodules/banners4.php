<div id="banners4" class="imgBannerBorder">
<?	$arrBan4=setHTML::getBannersAsObjects('4');
	$blink=(isset($arrBan4[0]['link']))? $arrBan4[0]['link']:'';
	$bsrc=(isset($arrBan4[0]['src']))? $arrBan4[0]['src']:'';
	//var_dump("<h1>arrBan4:</h1><pre>",$arrBan4,"</pre>");?>
    <a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($blink);?>"><img src="<?=Yii::app()->request->getBaseUrl(true).'/'.$bsrc?>"></a>
</div>