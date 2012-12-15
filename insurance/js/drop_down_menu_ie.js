// JavaScript Document
$(function(){
  try{  // alert('ie!');
		var tMenus=$('div#mainmenu >table td');
		var mLayers=$('div[id^="ddMenu_"]');
		$(mLayers).css({
			borderBottom:'solid 3px #CCC',
			borderRight:'solid 4px #DCDCDC'
		});
		$('*',mLayers).css({
			display:'block',
			textAlign:'left'
		});
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
		$(tMenus).mouseenter( function(){
			var alias=getAlias(this);
			$('div#ddMenu_'+alias).css({
				display:'block'
			}).offset({
				left:$(this).offset().left,
				top:$(this).offset().top+$(this).outerHeight()
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
			});/**/
  }catch(e){
	alert(e.message);
  }
});
function getAlias(obj,self){
	var tLink=(self)? obj:$(obj).find('a');
	var href=$(tLink).attr('href').split("/");
	return href[href.length-1];
}