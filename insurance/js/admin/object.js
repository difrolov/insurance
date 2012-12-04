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
	}
}