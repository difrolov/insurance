<style>
.save_and_print{
	background:url(<?=Yii::app()->request->getBaseUrl(true)?>/images/save_and_print.gif);
	height:22px;
	width:63px; 
}
.save_and_print div {
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
}
</style>
<div align="right">
	<div class="save_and_print" style="padding:0;">
		<div onClick="location.href=location.href+'?mode=save'" title="Перейти в режим сохранения и печати (по желанию) документа"><img src="<?=Yii::app()->request->getBaseUrl(true)?>/images/spacer.png"></div>
    	<div onClick="location.href=location.href+'?mode=print'" title="Распечатать документ"><img src="<?=Yii::app()->request->getBaseUrl(true)?>/images/spacer.png"></div>
	</div>
</div>