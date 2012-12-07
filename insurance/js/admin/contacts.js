_contacts = {
	//включает или отключает статью
	updateContactsStatus:function(id,status){
		$.post(baseUrl+'/admin/modules/updatestatuscontacts',{id:id,status:status},function(data){

		});
	},
	address:function(val){
		$.post(baseUrl+'/admin/ajax/geocode',
				{'address':val},
				function(data){
					lat=data.lat[0];
					lng=data.lng[0];
					$("#InsurContacts_latitude").val(lat);
					$("#InsurContacts_longitude").val(lng);
		},"json");
	}
}