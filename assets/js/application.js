/**
 * Line Graphs Generator
 */

$(document).ready(function() {
	// toggle sidebar
	$('[data-toggle=offcanvas]').click(function() {
		$('.row-offcanvas').toggleClass('active');
	});
	// color picker
	$('#graphTitleColour').colorpicker();
	$('#graphBgColour').colorpicker();
	// spinner
	$('#back_round').TouchSpin({
		min: 0,
		max: 100,
		step: 1
	});
});
