_generator_modules= {
	//достаём аяксом модуль из базы
	getModule : function(module_id){
		$.post('/insur/insurance/admin/ajax/GetModule',{'id_module':module_id},function(data){
			console.info(data);
		});
	}
};