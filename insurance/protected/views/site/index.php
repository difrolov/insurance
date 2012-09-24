<?	
$articles=setHTML::buildLastArticles();
$tp=false; ?>
		<div align="left" id="slide_marks">
<?	for($i=0;$i<8;$i++):?>
			<div>&nbsp;</div>
<?	endfor;?>
		</div>
<?
if ($oldIE=setHTML::detectOldIE()) {
	require_once dirname(__FILE__).'/index/old_ie.php';
}else{
	require_once dirname(__FILE__).'/index/default.php';
}
require_once dirname(__FILE__).'/index/html/last_seen.php';?>
