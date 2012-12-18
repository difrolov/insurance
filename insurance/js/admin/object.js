_object = {
	//включает или отключает статью
	updateContentStatus:function(id,status){
		$.post(baseUrl+'/admin/content/updatestatus',{id:id,status:status},function(data){

		});
	},
	updateObjectStatus:function(id,status){

		$.post(baseUrl+'/admin/object/updatestatus',{id:id,status:status},function(data){

		});
	},
	contentDelete:function(id){
		if (confirm("Сказать привет?")) {
			$.post(baseUrl+'/admin/content/delete',{id:id,status:status},function(data){

			});
		}
	},
	object_up:function(el){
		$.post(baseUrl+'/admin/object/priority',{'id':el.attr('data_id'),parent_id:el.attr('data_parentid'),'type':'up'},function(data){
			if(data.error){
				alert(data.error);
			}else{
				location.href=baseUrl+'/admin/object/PriorityObject/'+el.attr('data_id');
			}
		},"json");
	},
	object_down:function(el){
		$.post(baseUrl+'/admin/object/priority',{'id':el.attr('data_id'),parent_id:el.attr('data_parentid'),'type':'down'},function(data){
			if(data.error){
				alert(data.error);
			}else{
				location.href=baseUrl+'/admin/object/PriorityObject/'+el.attr('data_id');
			}
		},"json");
	}
}