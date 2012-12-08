<?
/*
id
jobs_name
requirements
responsibility
terms
job
contact_name
creat_date
status

*/
$gridDataProvider = action::getJobs('status=1');
$arrJobs = $gridDataProvider->data;
?>
<style>
a.txtLightBlue{
	font-size:14.5px;
}
div.jDef{
	padding-top:0 !important;
	padding-left:0 !important;
}
dl{
	display:<?="none"?>;
}
dl *{
	font-size:13.5px;
}
dt {
	margin-top:22px;
}
dd{
	margin-left:15px;
}
dl p{
	margin:0;
	line-height:20px;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
  try{
	// uses /js/custom_accordion.js
	$('a.txtLightBlue').click( function (){
		var myDl=$(this).siblings('dl').eq(0);
		var stat=$(myDl).css('display');
		var dLs=$('dl');
		var dlIndex=$(dLs).index(myDl);
		$(dLs).each(	function(index, element) {
            var xIndex=$(dLs).index(element);
			if (xIndex!=dlIndex&&$(element).attr('data-stat')=='shown')
				handleHeight(element,'show');
        });
		handleHeight(myDl,stat);
		return false;
	});
  }catch(e){
	  alert(e.message);
  }
});
</script>
<h4 class="txtLightBlue">Наши вакансии</h4>
<p>Университет Страховая Компания &quot;Открытие страхование&quot; &#8212; один из лучших на рынке страхования. Мы готовим специалистов по продаже страховых услуг.</p>
<p>Если вы решили приобрести новую профессию, работа в нашей компании &#8212; Ваш правильный выбор! Уже с первых дней вы будете не только учиться, но и зарабатывать!</p>
<p>Да, зарабатывать с первого месяца получения новой профессии!</p>
<?
function replaceBall($str){
	return trim(str_replace("•","<p>",$str));
}
for ($i=0,$j=count($arrJobs);$i<$j;$i++){
		$job=$arrJobs[$i];?>
  <a name="job<?=$i?>"></a>
  <div class="jDef">
    	<a href="#job<?=$i?>" class="txtLightBlue"><?=$job['jobs_name']?></a>
	  <dl>
        <dt>Требования:</dt>
            <dd><?=replaceBall($job['requirements'])?></dd>

        <dt>Обязанности:</dt>
            <dd><?=replaceBall($job['responsibility'])?></dd>

        <dt>Условия:</dt>
            <dd><?=replaceBall($job['terms'])?></dd>

        <dt>Место работы:</dt>
            <dd><?=$job['job']?></dd>

        <dt>Контактное лицо:</dt>
            <dd><?=$job['contact_name']?></dd>
      </dl>
  </div>
<?	
}?>


