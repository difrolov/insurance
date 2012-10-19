banner = {
	//ajax обновление данных
	update_field:function(field,value,id){
		if(field!="" && value!=""){
			$.post('ajaxupdate',{field:field,val:value,id:id},function(data){
				if(field == "link"){
					 location.reload();
				}
			});
		}
	}
};