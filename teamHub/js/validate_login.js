$(function() {

	$('form').submit(function(evt) {
		var statusElement = $('#status');
		
		evt.preventDefault();

		var  loginId = $("#loginIdField").val();
		var password = $("#passwordField").val();
		
		if (loginId && password) {
			var values = "ajax&login_id="+loginId+"&password="+password;

			$.ajax({
				type: "POST",
				url: "inc/process_login.php",
				data: values
			}).done(function(msg){
				statusElement.slideUp(50);
		  		window.location = "index.php";

			}).fail(function(msg, msg2, msg3) {
			  		console.log(msg3);
			  		error('Incorrect ID or Password', statusElement);
			 }).always(function(data) {
			 	console.log(data);

			 	});
		} else {
			error('Please fill out both fields', statusElement);
		}
		
	});
});	

function error(msg, target) {
	target.css('display', 'none');
	target.text(msg);
	target.fadeIn(250);
}