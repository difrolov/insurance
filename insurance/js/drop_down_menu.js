// JavaScript Document
$(function(){
  try{
		if ($.browser.mozilla)
			$('div#mainmenu.sectionsAdminMenu ul:first-child').css({
					paddingLeft:0,
					paddingRight:0,
					paddingTop:0,
					paddingBottom:0
				});

  	var tMenus=$('div#mainmenu >ul >li');
	// проверить наличие подменю и определиться с видом курсора и отменой действия по клику
	$(tMenus).find('a').mouseenter( function(){
		var alias=getAlias(this,true);
		// document.title=alias;
		if ($('div#ddMenu_'+alias).find('a').size()>0){
			$(this).css('cursor','default');
			$(this).click( function(){
				return false;
			});
		}
	});
	$(tMenus).mouseenter(function(){
			// get alias
			var alias=getAlias(this);
			$('div#ddMenu_'+alias).css({
				display:'block'
			}).offset({
				left:$(this).offset().left,
				top:$(this).offset().top+$(this).outerHeight()-1
			});
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