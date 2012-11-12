<?	if (isset($dwshow)){?><script><? }
ob_start();?>
$(function(){
  try{
	$('button#save_page').click( function (){
		var radioChecked=$('div#sections_radios input[type="radio"]:checked');
		var errMess=new Array();
		var reqS=new Array();
		var errCount=0;
		var errPlace=false;
		if (!$(radioChecked).size()){
			errMess[errCount]='Вы не отметили родительский раздел для создаваемого подраздела (если вы не хотите указывать его сейчас, отметьте радиокнопку "'+$('#no_parent').text()+'").';
			errPlace=$('#pick_out_section');
			errCount++;
		}
		if (!$('#name').val()){
			errMess[errCount]='Вы не указали название подраздела.';
			if (!errPlace) 
				errPlace=$('#name');
			reqS[errCount]='name';
			errCount++;
		}
		if (!$('#alias').val()){
			errMess[errCount]='Вы не указали алиас создаваемого подраздела.';
			if (!errPlace) 
				errPlace=$('#alias');
			reqS[errCount]='alias';
			errCount++;
		}
		if (!$('#title').val()){
			errMess[errCount]='Вы не указали заголовок страницы.';
			if (!errPlace) 
				errPlace=$('#title');
			reqS[errCount]='title';
			errCount++;
		}
		
		if (errCount>0){ 
			var aMess='';
			for(i=0;i<errCount;i++){
				if (i) aMess+="\n";
				aMess+="* "+errMess[i];
				if (reqS[i]) {
					$('#'+reqS[i]).css('background-color','#FF6');
				}
			}
			alert(aMess);
			$('body').animate({scrollTop:$(errPlace).offset().top+'px'},500);
			return false;
		}else{
			Layout.parent=$(radioChecked[0]).val();
			Layout.name=$('#name').val();
			Layout.alias=$('#alias').val();
			Layout.title=$('#title').val();
			Layout.keywords=$('#keywords').val();
			Layout.description=$('#description').val();
			alert('action: '+$('#content_save').attr('action')+'\nJSON:\n'+JSON.stringify(Layout)+'\n\n*Проверить радиокнопки\n*Забрать данные из и Layout отослать на ACTION формы с JSON!');
			$.ajax ({
					type: "POST",
					url: $('#content_save').attr('action'),
					dataType: 'json',
					data: Layout,
					success: function (data) {
						alert(data.result); 
					},
					error: function () {
						alert("Не удалось отправить данные"); 
					}
				})
		}
	});
  }catch(e){
	  alert(e.message);
  }
});
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
