<?	$url=$_GET['base_url']; 
if (isset($dwshow)){?><script><? }

ob_start();?>

$(document).ready(function() { 
	try{
		var sPlus=$("#main_submenu li")[2];
		var offLeft=$(sPlus).offset().left;
		// offLeft: желательно в дальнейшем: 
		// 1. перерасчитать отступ слева в %%
		// 2. добавить вызов функции при изменении размеров окна, чтобы смещалось за основным меню.
		var offRight=$(sPlus).offset().right;
		var goHeight=$(sPlus).css('line-height');
		var addSubsectionButton=document.createElement('li');
		document.getElementById('yw2').appendChild(addSubsectionButton);
		addSubsectionButton.className='active command';
		$(addSubsectionButton).html('<a href="<? echo $url;?>/admin/generator" class="command"><span>&nbsp;&nbsp;&nbsp;&nbsp;</span> Добавить подраздел</a>');
		$(addSubsectionButton).css({
			left: offLeft+'px', 
			position: 'absolute',
			top: '32px'
		});
	}catch(e){
		alert(e.message);
	}
})
<?	
$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
