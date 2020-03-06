$(document).ready(function() {
	$("#limpar-form").click(function() {
		$("#test > .form-group")
			.find("input")
			.val("");
	});

	$(".login-form").submit(function(event) {		
		if(!$(this).find("input").prop('required')){
			event.preventDefault();
			location.reload();
		}
	});

	$(".register-form").submit(function(event) {		
		if(!$(this).find("input").prop('required')){
			event.preventDefault();
			location.reload();
		}
	});
});