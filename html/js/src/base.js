// jQuery extensions
(function($) {
	// Will focus the field with the attribute autofocus if the browser does no support autofocus
	$.fn.autofocus = function() {
		return ( ! Modernizr.input.autofocus ? this.focus() : this);
	};
})(jQuery);

// don't cache ajax calls
$.ajaxSetup({ cache: false });

$(function() {
	$('[autofocus]').autofocus();
});