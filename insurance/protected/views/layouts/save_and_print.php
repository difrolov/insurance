<div align="center" style="clear:both; width:100% !important; min-height:100%;">
  <div style=" <?php if (!setHTML::detectOldIE()){?>padding-top:60px;<? }?>;" class="container" id="page">
<?	echo $content;?>
  </div>
</div>
<script>
$( function(){
<?	if ($mode=='print'):?>
		window.print();
<?	endif;?>		
	});
</script>
