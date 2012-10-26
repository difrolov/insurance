$(document).ready(function(){
	$.post("http://localhost/insur/insurance/admin/Ajax/makeartpreview",{id:1},function(data){
		console.info(data)
	});
});