// jQuery extensions
(function($) {
	// Will focus the field with the attribute autofocus if the browser does no support autofocus
	$.fn.autofocus = function() {
		return ( ! Modernizr.input.autofocus ? this.focus() : this);
	};
})(jQuery);

// defaults for the date picker; these are necessary so the date picker within xm work
// these are in addition to the ones found in xm.js
if (typeof $.datepicker !== 'undefined') {
	$.datepicker.setDefaults({
		showOn: 'focus',
		showButtonPanel: true,
		changeMonth: true,
		changeYear: true,
		constrainInput: false,
		duration: 'fast',
		yearRange: 'c-5:c+5',
		onClose: function(dateText, inst) {
			// focuses the input when the date dialog closes
			this.focus();
		}
	});
}

// don't cache ajax calls
$.ajaxSetup({ cache: false });

$(function() {
	$('[autofocus]').autofocus();
});