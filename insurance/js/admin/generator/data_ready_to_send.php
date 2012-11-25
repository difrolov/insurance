<?	if (isset($dwshow)){?><script><? }
ob_start();?>
$(function(){
  try{
	$('#alias').blur( function (){
		var alias=$(this).val();
		var checkAl=$('#check_alias_info');
		var txtColorWhite='#FFF';
		$(checkAl).fadeIn(200);
		if (alias){
			var re = /[^a-z]/g;
			if(re.test(alias)){
				$(checkAl).css({
							backgroundColor:'red',
							color:txtColorWhite
						}).html('Вы ввели недопустимые символы в поле для алиаса!');
			}else{
				// alert('Url: '+$('#seek_alias').val()+'\nData: '+alias);
				$.ajax ({
					type: "GET",
					url: $('#seek_alias').val(),
					data: "alias="+alias,
					success: function (data) {
						var alias_stat,bg;
						if (data=='allow'){
							alias_stat="свободен";
							bg='#060';
						}else{
							alias_stat="занят, укажите другой";
							bg='salmon';
						} //alert(data);
						$(checkAl).css({
							backgroundColor:bg,
							color:txtColorWhite
						});
						$(checkAl).html('&nbsp;алиас '+alias_stat+'&nbsp;');
					},
					error: function (alias_stat) {
						alert("Не проверить доступность указанного алиаса..."); 
					}
				})
			}
		} //		
	});
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
		}else{
			var aVal=$('#alias').val(); 
			var re = /[^a-z]/g;
			if(re.test(aVal)){
				errMess[errCount]='Вы ввели недопустимые символы в поле для алиаса подраздела!\nДопускаются ТОЛЬКО латинские буквы, цифры и знак подчёркивания.';
				reqS[errCount]='alias';
				errCount++;
			}
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
			// alert('action: '+$('#content_save').attr('action'));
			$.ajax ({
					type: "POST",
					url: $('#content_save').attr('action'),
					dataType: 'json',
					data: Layout,
					beforeSend: function() {
                   		$("div#veil").show();
						$("div#pls_wait").show();
  					},
					success: function (data) {
						alert("Подраздел добавлен!");
						location.href=data.result; 
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
