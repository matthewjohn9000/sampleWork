
window.addEventListener('load', function() {
	init_collapse_all();
});

function init_collapse_all() {
	// UI
	var collapse_all = $(".collapse-all");
	var expand_all = $(".expand-all");
	
	console.log('s');
	
	ativateCollapsablesToggles(collapse_all, expand_all);

}

function ativateCollapsablesToggles(collapse_all, expand_all) {
		
	collapse_all.click(function() {
		var section = $(this).parentsUntil('section').parent();
		var panel = section.find('.panel-collapse.collapse.in').collapse('toggle');
	});

	expand_all.click(function() {
		var section = $(this).parentsUntil('section').parent();
		var panel = section.find('.panel-collapse.collapse:not(.in)').collapse('toggle');
	});
}
