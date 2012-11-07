_editMenu = {
	//выводит таблицу с меню
	MainMenuButton : function(e){
		$('div.mainmenu_button .btn-small').siblings().removeClass('btn-primary');
		e.addClass('btn-primary');
		$.post('/insur/insurance/admin/ajax/adminmenuedit',{id:e.attr('data-item')},function(data){
			str="";
			if(data == null){
				str += "нет дочерних элементов";
			}else{
				str += '<table class="items table table-striped table-bordered table-condensed">';
				str += '<thead><tr><th>Наименование</th>'+
						'<th>Статус</th>'+
						'<th>ССылка</th>'+
						'<th>Родитель</th>'+
						'<th>Дата изменения</th>'+
						'<th></th>'+
						'</tr></thead>';
				for (i in data){
					str += '<tr>'+
								'<td id="field_name_'+data[i].id+'">'+data[i].name+'</td>'+
								'<td id="field_status_'+data[i].id+'">'+(data[i].status==1?"активен":"удалено")+'</td>'+
								'<td id="field_alias_'+data[i].id+'"><a href="'+data[i].alias+'">'+data[i].alias+'</a></td>'+
								'<td id="field_parent_'+data[i].id+'">'+data[i].parent_id+'</td>'+
								'<td id="field_'+data[i].id+'">'+data[i].date_changes+'</td>'+
								'<td id="field_'+data[i].id+'"><a class="update" onclick="_editMenu.updateFieldMenu('+data[i].id+')" href="#"  data-original-title="Редактировать"><i class="icon-pencil"></i></a>'+
								'&nbsp<a class="delete" onclick="_editMenu.deleteMenu('+data[i].id+')" href="#"  data-original-title="Удалить"><i class="icon-trash"></i></a></td>'+
							'</tr>';
				};
				str += '</table>';
			}
			$(".table_menu").html(str);
		},"json");
	},
	//делает поля в таблице редактируемыми
	updateFieldMenu : function(id){
		name = $("#field_name_"+id);
		alias = $("#field_alias_"+id);
		//наименование меню
		name.html("<input type='text' id='name_menu_"+id+"' value='"+name.text()+"' onchange='_editMenu.updateMenuName("+id+")'>");
		//ссылка
		name.html("<a href='"+data[i].alias+"'>"+data[i].alias+"</a>");
	},
	updateMenuName : function(id_name){
		console.info($("#name_menu_"+id_name).val());
	}
};