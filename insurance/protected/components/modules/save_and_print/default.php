<? 
$urlRoot=Yii::app()->request->getBaseUrl(true);
$urls=parseUrl(true,true); //var_dump("<h1>urls:</h1><pre>",$urls,"</pre>");die();
$baseURL=$urls['uris'];
$news_link='';
if (isset($urls['hashes']))
	$news_link=(array_key_exists('news_id',$urls['hashes']))? "&news_id=".$urls['hashes']['news_id']:'';
?>
<div id="banners3Wrapper">
	<div class="save_and_print">
		<div onClick="location.href='<?=$baseURL?>?mode=save<?=$news_link?>'" title="Перейти в режим сохранения и печати (по желанию) документа"><img src="<?=$urlRoot?>/images/button_save.gif" style="margin-top:4px;"></div>
    	<div style="margin-left:16px;" onClick="location.href='<?=$baseURL?>?mode=print<?=$news_link?>'" title="Распечатать документ"><img src="<?=$urlRoot?>/images/button_print.gif"></div>
	</div>
</div>