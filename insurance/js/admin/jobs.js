_jobs = {
	//включает или отключает статью
	updateJobsStatus:function(id,status){
		$.post(baseUrl+'/admin/modules/updatestatusjobs',{id:id,status:status},function(data){

		});
	},
}

