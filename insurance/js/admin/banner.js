_banner = {
	//ajax обновление данных
	update_field:function(field,value,id){
		if(field!="" && value!=""){
			$.post('ajaxupdate',{field:field,val:value,id:id},function(data){
				if(field == "link"){
					 location.reload();
				}
			});
		}
	},
	MainMenuButton: function(el){
		if(el.hasClass("btn-primary")){
			return false;
		}else{
			$(".btn-menu").removeClass("btn-primary");
			el.addClass("btn-primary");
			$(".table_baner").hide();
			$("."+el.attr('data-item')).show();
		}

	},
	statusButton: function(ban,val,id){
		$.post('ajaxupdatestatus',{ban:ban,val:val,id:id},function(data){

			if(data.success == 1){
				location.reload();
			}
		},"json");
	}

};
