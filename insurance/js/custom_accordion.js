// JavaScript Document
// обработать блок:
function handleHeight(elem,stat){
	var hg,at;
	if(stat=='none'){
		hg='show';
		at='shown';
	}else{
		hg='hide';
		at='hidden';
	}
	console.info('elem= '+elem+', stat= '+stat);
	$(elem).animate({height:hg},1000,function(){
					$(this).attr('data-stat',at);
				});
}
