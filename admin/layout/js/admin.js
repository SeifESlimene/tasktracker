$(document).ready(function() {
			
	$('.toggle-search').click(function() {
		$('.search-overlay').slideUp("5000")
	});
		
	$("[placeholder]").focus(function(){
		$(this).attr("data-text" , $(this).attr("placeholder"));
		$(this).attr("placeholder","").blur(function(){
			$(this).attr("placeholder" , $(this).attr("data-text"))
		});
	});

	$('#content.contact #pager .alert-success').delay(2000).fadeOut(1000);
			
}); 

