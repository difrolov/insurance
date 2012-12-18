<style>
span.preNews{
	font-size:15px;
	text-align:justify;
}
</style><?
$gridDataProvider = action::getNews($params=false,$pager=false);
$arrNews = $gridDataProvider->data; 
for ($i=0,$j=count($arrNews);$i<$j;$i++){
	$news=$arrNews[$i];
	$date=$news['date_edit'];
	if ($i){
	?><br><br><?	
		echo setHTML::showCommonDate($date);
	}else{?>
    <div style="margin-top:-10px;"><?=setHTML::showCommonDate($date)?></div>
<?	}?>    
    <h2 class="subsectHeader News"><a href="<?=$_SERVER['REQUEST_URI'].'/?news_id='.$news['id'];?>" class="txtLightBlue"><?=$news['name']?></a></h2><? 
	$arrWords=explode(" ",$news['content']);
	$prevArray=array_slice($arrWords,0,49);
	$text=implode(" ",$prevArray);
	if ($text[strlen($text)-1]!=".")
		$text.="...";
	echo "<span class='preNews' style='text-align:justify !important;'>".nl2br($text)."</span>";
}?><br><br>
