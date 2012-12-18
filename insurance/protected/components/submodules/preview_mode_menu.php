    <div align="left" id="manage_new_section" style="background:#666; border-radius:6px; box-shadow: 3px 1px 20px 1px #999; color:#FFF;<?
	if(setHTML::detectOldIE()===NULL){?> cursor:move;<? }?> display:<?="none"?>; left:200px; padding:10px; top:200px; position:fixed; width:180px;">
    	Подраздел загружен в режиме предпросмотра. Выберите дальнейшее действие:
        <div style="background:#06AEDD; border-radius:3px; margin-top:10px; padding:6px;">
        	<ul id="prevManage">
        	  <li><a href="#" id="save_as_is">Сохранить </a></li>
        	  <li><a href="<?=Yii::app()->request->getBaseUrl(true)?>/admin/generator/edit/<?=$section_data->id?>">Изменить</a></li>
        	  <li class="txtRed"><a href="#" id="ask_to_delete">Удалить</a></li>
        	  <li><a href="<?=Yii::app()->request->getBaseUrl(true)?>/admin/generator">Добавить подраздел</a></li>
      	  </ul>
       	</div>
    </div>
<script>
$( function(){
  try{
<?	if(setHTML::detectOldIE()):?>
	$('ul#prevManage li').css('display','block');
<?	endif;?>
	
	$('a#ask_to_delete').css('color','#F00').click( function (){
			var Url='<?=Yii::app()->request->getBaseUrl(true)?>/admin/object/remove';
			if (confirm('Вы уверены, что хотите удалить этот раздел?\nмногие погибнут...')){
				$.ajax({
					type:"GET",
					url: Url,
					data: "section_id=<?=$section_data->id?>",
					beforeSend: function() {
						manageVeil('start','Удаление данных...');
					},
					success: function (data) {
							alert(data);
							location.href=Url;
						},
					error: function (data) {
						manageVeil(false);
						alert(data);
					},
				});
			}
			return false;
		});
	$('a#save_as_is').click( function (){
		manageVeil('start','Сохранение данных...');
		$.ajax({
			type:"GET",
			url: '<?=Yii::app()->request->getBaseUrl(true)?>/admin/generator/store/',
			data: "section_id=<?=$section_data->id?>",
			beforeSend: function() {
				manageVeil('start','Сохранение данных...');
			},
			success: function (data) {
					manageVeil(false);
					alert("Данные сохранены!"+'\n'+data);
					$('#manage_new_section').hide();
					var goUrl=location.href.substring(0,location.href.indexOf('?mode='));
					location.href=goUrl;
				},
			error: function (data) {
				manageVeil(false);
				alert("Не удалось отправить данные.\nОтвет: "+data);
			},
		});
		return false;
	});
	var mprev=$('#manage_new_section');
	$(mprev).find('ul').css('padding-left','18px');
	$(mprev).find('a[id!="ask_to_delete"], li[class!="txtRed"]').css('color','#FFF');
	$(mprev).find('a').css('margin-left','-6px');
	var leftOff=$(mprev).parent().offset().left;
	var wdt=$(mprev).width();
	var goLeft=leftOff-wdt-45;
	console.info('leftOff = '+typeof(leftOff)+', wdt = '+typeof(wdt)+', summ = '+goLeft);
	$(mprev).css({
			left:goLeft+'px',
		}).fadeTo(1500,0.9).hover(
				function (){
					$(this).css('opacity',1)
				},
				function (){
					$(this).css('opacity',0.9)
				});
	
<?	if(!setHTML::detectOldIE()):?>
	$(mprev).draggable();
<?	endif;?>
  }catch(e){
		alert(e.message);
  }
});
</script>
