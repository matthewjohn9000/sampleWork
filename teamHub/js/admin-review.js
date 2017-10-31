
window.addEventListener('load', function() {
	init_page();
});

function init_page() {

	var commentBoxes = $(".comment-box");
	var toolBox = $("section .tools");
	var form = $("#comments-form");
	var submitButton = form.find("input[type='submit']");
	var optionButton = null;

	// Order Matters
	setupSubmitOption();
	setupCommentBoxes();

	function setupSubmitOption() {
		var option = $("<div class=\"option\" aria-hidden='true'>");
		optionButton = $("<a href='#' class='submit'>"+submitButton.attr('value')+"</a>")

		option.append(optionButton);

		toolBox.prepend(option);

		optionButton.click(function() {
			if (optionButton.hasClass('reveal')) {
				form.submit();
			} else {
				return false;
			}
		});

		submitButton.css({
			display: 'none'
		});

	}

	function setupCommentBoxes() {
		commentBoxes.keyup(function(event) {
			if ($.trim($(this).val()) != "") {
				if(!optionButton.hasClass('reveal')) { 
					optionButton.addClass('reveal');
				};
			} else {
				optionButton.removeClass('reveal');
			}
		});
	}
}

