// JavaScript Document
$(document).ready(function() {
  try{
	$('#save_tmpl_block input[type="radio"]').click(
		function(){
			$('label span').removeAttr('class');
			$('label span b').css('color','');
			$(this).parent().attr('class','selLabel').find('b').css('color','#FFF');
		});
	$('#pick_out_section').click(
		function(){
			var lnk=this;
			$('#save_tmpl_block').fadeToggle(50,
					function(){
						$('body').animate({scrollTop:$(lnk).offset().top},500);
				})
		});
	$('#wclose').click(
			function(){
				$(this).parent().parent().fadeOut(1000);
		});
  }catch(e){
	  alert(e.message);
  }
});
