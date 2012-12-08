_news = {
	//включает или отключает статью
	updateNewsStatus:function(id,status){
		$.post(baseUrl+'/admin/modules/updatestatusnews',{id:id,status:status},function(data){

		});
	}

}