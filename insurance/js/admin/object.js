_object = {
	//включает или отключает статью
	updateContentStatus:function(id,status){
		$.post(baseUrl+'/admin/object/updatestatus',{id:id,status:status},function(data){

		});
	},
	updateObjectStatus:function(id,status){

		$.post(baseUrl+'/admin/object/updatestatus',{id:id,status:status},function(data){

		});
	}
}