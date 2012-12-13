// JavaScript Document
$( function(){
		var bodyHeight=$(window).height();
		var tblHeight=$('table#main_content').height();
		if (bodyHeight>tblHeight){
			var diff=bodyHeight-tblHeight;
			var innerDivHeight=$('div#inner_left_menu').height();
			$('div#inner_left_menu').height(innerDivHeight+diff);
		}
		//
		if (!$('div#innerPageContent div.floatLeft div#inner_left_menu').size()) {
			$('div#inner_left_menu').css('padding-left','35px');
			$('div#innerPageContent').css('margin-left','0');
			//console.info('Empty!');
		}
		$('body > div').css({
				marginBottom:'-20px',
				backgroundColor:'yellow'
				
			});
	});