<?
$arrToReplace=array('save','print');
$str=$pureUrl='';
$rawUrl=$_SERVER['REQUEST_URI'];
$tUrl=array('save'=>$rawUrl,'print'=>$rawUrl);
for($i=0,$j=count($arrToReplace);$i<$j;$i++){
	$str="?mode=".$arrToReplace[$i];
	if (strstr($rawUrl,$str)){
		$pureUrl=str_replace($str,'',$rawUrl);
		break;
	}
}	
for($i=0,$j=count($arrToReplace);$i<$j;$i++)
	$tUrl[$arrToReplace[$i]]=$pureUrl."?mode=".$arrToReplace[$i];
$baseURL=Yii::app()->request->getBaseUrl(true);
?><style>
.save_and_print{
	background:url(<?=$baseURL?>/images/save_and_print.gif);
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
		<div onClick="location.href='<?=$tUrl['save']?>'" title="Перейти в режим сохранения и печати (по желанию) документа"><img src="<?=$baseURL?>/images/spacer.png"></div>
    	<div onClick="location.href='<?=$tUrl['print']?>'" title="Распечатать документ"><img src="<?=$baseURL?>/images/spacer.png"></div>
	</div>
</div>