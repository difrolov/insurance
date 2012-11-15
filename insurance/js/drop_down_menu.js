// JavaScript Document
$(function(){
  try{	
  	var tMenus=$('div#mainmenu >ul >li');
	$(tMenus).mouseenter(function(){
			// get alias
			var ofs=$(this).offset();
			var fl=$('div#fit_height').offset().left;
			document.title='left:'+ofs.left;
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
function getAlias(obj){
	var href=$(obj).find('a').attr('href').split("/");
	return href[href.length-1];
}