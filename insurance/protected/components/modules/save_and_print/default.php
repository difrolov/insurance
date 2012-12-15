<? 
$urlRoot=Yii::app()->request->getBaseUrl(true);
$urls=parseUrl(true,true); //var_dump("<h1>urls:</h1><pre>",$urls,"</pre>");die();
$baseURL=$urls['uris'];
$news_link='';
if (isset($urls['hashes']))
	$news_link=(array_key_exists('news_id',$urls['hashes']))? "&news_id=".$urls['hashes']['news_id']:'';
?><style>
.save_and_print{
	/*background:url(<?=$urlRoot?>/images/save_and_print.gif);*/
	display:block !important;
	/*height:22px;
	width:63px; */
}
/*.save_and_print div {
	cursor:pointer;
	display:inline-block;
	margin:0;
}
.save_and_print div img{
	height:22px;
}
.save_and_print >div:firs-child img {
	margin-right:14px;
	width:17px; 
}
.save_and_print >div:last-child img {
	width:32px; 
}*/
</style>
<div id="banners3Wrapper">
	<div class="save_and_print" style="padding:0;">
		<div onClick="location.href='<?=$baseURL?>?mode=save<?=$news_link?>'" title="Перейти в режим сохранения и печати (по желанию) документа"><img src="<?=$urlRoot?>/images/button_save.gif"></div>
    	<div style="margin-left:16px;" onClick="location.href='<?=$baseURL?>?mode=print<?=$news_link?>'" title="Распечатать документ"><img src="<?=$urlRoot?>/images/button_print.gif"></div>
	</div>
</div>