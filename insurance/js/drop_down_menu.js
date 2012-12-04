// JavaScript Document
$(function(){
  try{
  	var tMenus=$('div#mainmenu >ul >li');
	// проверить наличие подменю и определиться с видом курсора и отменой действия по клику
	$(tMenus).find('a').mouseenter( function(){
		var alias=getAlias(this,true);
		document.title=alias;
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
			var fl,tp,ofs=$(this).offset();

			if ($('div#fit_height').size()>0){
				//alert('fit_height');
				fl=$('div#fit_height').offset().left;
				tl=ofs.left-fl+'px';
				tp=$(this).outerHeight()-1+'px';
			}else{
				var sectionsAdminMenu=$('div.sectionsAdminMenu');
				if($(sectionsAdminMenu).find('ul')){
					fl=$(sectionsAdminMenu).offset().left;
					tl=$(this).offset().left+'px';

				}// console.info($(sectionsAdminMenu).html());
			}
			// document.title='left:'+ofs.left;
			$('div#ddMenu_'+alias).css({
				display:'block',
				left:tl,
				top:tp,
			});
			//alert($('div#ddMenu_'+alias).css('display','block'););
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