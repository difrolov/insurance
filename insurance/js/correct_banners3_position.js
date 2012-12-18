// JavaScript Document
$( function(){
		var bodyHeight=$(window).height();
		var banners3block=$('div.bottomBannersWrapper');
		var topOffsetBannersWrapper=$(banners3block).offset().top;
		var topOffsetFooter=$('div#footer').offset().top;
		var diff=topOffsetFooter-topOffsetBannersWrapper-$(banners3block).outerHeight();
		$(banners3block).prev('div.clear').height(diff);
});