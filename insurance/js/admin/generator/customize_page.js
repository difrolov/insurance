// JavaScript Document
$(document).ready(function() {
  try{
	$('#save_tmpl_block').click(
		function(){
			var srcEl=(event.target)? event.target:event.srcElement;
				if ( srcEl.tagName.toLowerCase()=="input"
					 && srcEl.type=="radio"
				   ){
					$('label span').removeAttr('class');
					$('label span b').css('color','');
					$(srcEl.parentNode).attr('class','selLabel');
					$(srcEl.parentNode).find('b').css('color','#FFF');
				}
		});
	$('#pick_out_section').click(
		function(){
			$('#save_tmpl_block').fadeToggle(1500);
		}
	);
	$('#wclose').click(
			function(){
				$(this.parentNode.parentNode).fadeOut(1000);
		});
  }catch(e){
	  alert(e.message);
  }
});