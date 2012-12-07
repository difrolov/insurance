<?
$arrBan2=setHTML::getBannersAsObjects('inside');
$bsrc=(isset($arrBan2[0]['src']))? $arrBan2[0]['src']:'';
$blink=(isset($arrBan2[0]['link']))? $arrBan2[0]['link']:'';
?><a href="<?=$baseURL?><? Data::buildAliasPath($blink);?>"><img src="<?=$baseURL.$bsrc?>" id="company_museum"></a>
