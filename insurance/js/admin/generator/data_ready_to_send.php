<?	if (isset($dwshow)){?><script><? }
ob_start();?>
$(function(){
  try{
	var blockRadios=$('div#sections_radios > div > blockquote');
	$('input#product_type_1').click( function(){
			$(blockRadios).show();
		});
	$('input#product_type_2').click( function(){
		$('input[type="radio"]',blockRadios).attr('checked',false);
		$(blockRadios).hide();
	});

	$('#alias').blur( function (){
		var alias=$(this).val();
		var checkAl=$('#check_alias_info');
		var checking_result=$(checkAl).find('div#checking_result');
		var new_alias=false;
		if (!document.getElementById('old_alias')
			|| $('input#old_alias').val()!=alias
		   ) {
			new_alias=true;
			$(checkAl).fadeIn(200);
		}
		if (alias){
			var mss=false;
			if (mss=checkAliasValid(alias)){
				$(checkAl).attr('class','alarm');
				$(checking_result).html(mss);
			}else{
				// alert('Url: '+$('#seek_alias').val()+'\nData: '+alias);
				if (new_alias){
					$.ajax ({
						type: "GET",
						url: $('#seek_alias').val(),
						data: "alias="+alias,
						success: function (data) {
							var alias_stat,classNm;
							if (data=='allow'){
								alias_stat="свободен";
								classNm='safe';
							}else{
								alias_stat="занят, укажите другой";
								classNm='warning';
							} //alert(data);
							$(checkAl).attr('class',classNm);
							$(checking_result).html('&nbsp;алиас '+alias_stat+'&nbsp;');
						},
						error: function (alias_stat) {
							alert("Не проверить доступность указанного алиаса..."); 
						}
					})
				}
			}
		} //		
	});
	$('button#save_page').click( function (){
			sendTmplData();
		});
	$('button#preview_page').click( function (){
			sendTmplData(true,$(this).val());
		});
  }catch(e){
	  alert(e.message);
  }
});
function sendTmplData(preview,preview_stat){
		var radioChecked=$('div#sections_radios input[type="radio"]:checked');
		var radioChecked2=$('div#product_type input[type="radio"]:checked');
		var errMess=new Array();
		var reqS=new Array();
		var errCount=0;
		var errPlace=false;
		if (!$(radioChecked).size()){
			errMess[errCount]='Вы не отметили родительский раздел для создаваемого подраздела (если вы не хотите указывать его сейчас, отметьте радиокнопку "'+$('#no_parent').text()+'").';
			errPlace=$('#pick_out_section');
			errCount++;
		}
		if(!$(radioChecked2).size()){
			errMess[errCount]='Вы не отметили категорию создаваемого подраздела (если вы не хотите указывать её, отметьте радиокнопку "'+$('#no_category').text()+'").';
			if (!errPlace) 
				errPlace=$('#product_type');
			reqS[errCount]='product_type';
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
			var mss=false;
			if (mss=checkAliasValid($('#alias').val())){
				errMess[errCount]=mss;
				reqS[errCount]='alias';
				errCount++;
			}else if($('#check_alias_info').attr('class')=='warning'){
				errMess[errCount]='Указанный вами алиас занят, укажите другой.';
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
					console.info('reqS[i] = '+reqS[i]);
				}
			}
			alert(aMess);
			$('body').animate({scrollTop:$(errPlace).offset().top+'px'},500);
			return false;
		}else{
			
			Layout.parent=$(radioChecked[0]).val();
			Layout.product_type=$(radioChecked2[0]).val();
			Layout.name=$('#name').val();
			Layout.alias=$('#alias').val();
			Layout.title=$('#title').val();
			Layout.keywords=$('#keywords').val();
			Layout.description=$('#description').val();
			
			if (Layout.Schema="default"){ 
				Layout.Schema="100";
				Layout.blocks={
					1: "Текст :: "+Layout.name+"^"+CKEDITOR.instances['InsurArticleContent[content]'].getData()
				};
			}
			var sendToUrl=$('#content_save').attr('action');
			if (preview) 
				sendToUrl+='?preview='+preview_stat;
			
			if ($('input#section_id').val()) {
				sendToUrl+=(preview)? '&':'?';
				sendToUrl+='section_id='+$('input#section_id').val();
			}
			var t=false;
			if (t)
				console.info('Schema: '+Layout.Schema+'\nText: '+Layout.blocks['1']+'\nname: '+Layout.name+'\nalias: '+Layout.alias+'\ntitle: '+Layout.title+'\nkeywords: '+Layout.keywords+'\ndescription: '+Layout.description+'\nparent: '+Layout.parent+'\nsendToUrl='+sendToUrl+'\nproduct_type: '+Layout.product_type);
			else
				$.ajax ({
					type: "POST",
					url: sendToUrl,
					dataType: 'json',
					data: Layout,
					beforeSend: function() {
						var text=($('input#old_alias').val())?
							'Сохранение данных...':'Создание подраздела...';
                   		manageVeil('start',text);
  					},
					success: function (data) {
						//alert("Подраздел добавлен!");
						if (data.result.indexOf('We_GOT')!=-1)
							alert(data.result);
						else
							location.href=data.result; 
					},
					error: function (data) {
						manageVeil(false);
						alert("Не удалось отправить данные.\nОтвет: "+data.result);
					}
				})
		}
}
function checkAliasValid(aVal){
	var re = /[^\w_]/g;
	if(re.test(aVal)){
		return 'Вы ввели недопустимые символы в поле для алиаса подраздела!\nДопускаются ТОЛЬКО латинские буквы, цифры и знак подчёркивания.';
	}else
		return false;
}
<? 	$myscript=ob_get_contents();
ob_get_clean();
echo $myscript;
if (isset($dwshow)){?></script><? }?>
