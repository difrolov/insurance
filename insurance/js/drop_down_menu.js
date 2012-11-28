// JavaScript Document
$(function(){
  try{	
  	var tMenus=$('div#mainmenu >ul >li');
	// проверить наличие подменю и определиться с видом курсора и отменой действия по клику
	$(tMenus).find('a').mouseenter( function(){
		var alias=getAlias(this,true);
		if ($('div#ddMenu_'+alias).find('a').size()>0){
			$(this).css('cursor','default');
			$(this).click( function(){
				return false;
			});
		}
	});
	$(tMenus).mouseenter(function(){
			// get alias
			var ofs=$(this).offset();
			var fl=$('div#fit_height').offset().left;
			// document.title='left:'+ofs.left;
			var alias=getAlias(this);
			$('div#ddMenu_'+alias).css({
				display:'block',
				left:ofs.left-fl+'px',
				top:$(this).outerHeight()-1+'px'
			});//alert($('div#ddMenu_'+alias).css('display','block'););
		});
		$(tMenus).mouseleave(function(){
				var alias=getAlias(this);
				$('div#ddMenu_'+alias).css({
					display:'none'
				});
			});
		var tDivMenus=$('div[id^="ddMenu_"]');
		$(tDivMenus).mouseenter(function(){
				$(this).css('display','block');
			});
		$(tDivMenus).mouseleave(function(){
				$(this).css('display','none');
			});
		
  }catch(e){
	alert(e.message);
  }
});
function getAlias(obj,self){
	var tLink=(self)? obj:$(obj).find('a');
	var href=$(tLink).attr('href').split("/");
	return href[href.length-1];
}