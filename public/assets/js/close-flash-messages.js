$(document).ready(function(){
	$('button.close').click(function(e){
		e.preventDefault();
		// $(this).attr('data-dismiss')
		var dataDismiss = $(this).data('dismiss');

		// '.'+dataDismiss devient '.alert'
		$(this).closest('.'+dataDismiss).remove();
	});
});

