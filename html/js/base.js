// jQuery extensions
(function($) {
	// Any fields this is added to will not allow most non numeric values
	$.fn.numeric = function() {
		this.keypress(function(e) {
			var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
			if (e.ctrlKey || e.altKey // ctrl or alt key has been pressed
				|| (key >= 48 && key <= 57) // numbers
				|| key == 9 // tab
				|| key == 39 // right, also single quote
				|| key == 37 // left, also percent "%"
				|| key == 35 // end, also hash "#"
				|| key == 36 // home, also dollar symbol "$"
				|| key == 8 // backspace
				|| key == 46 // delete, also period "."
				|| key == 13 // enter
				|| key == 45 // dash "-"
				|| key == 43) { // plus "+"
					return true;
			}

			return false;
		});
	};

	// Will focus the field with the attribute autofocus if the browser does no support autofocus
	$.fn.autofocus = function() {
		return ( ! Modernizr.input.autofocus ? this.focus() : this);
	};

	// Checks all the elements in the jQuery object
	$.fn.check = function() {
		return this.each(function() {
			this.checked = true;
		});
	};

	// Unchecks all the elements in the jQuery object
	$.fn.uncheck = function() {
		return this.each(function() {
			this.checked = false;
		});
	};

	// Toggles the checked status of all the elements in the jQuery object
	$.fn.check_toggle = function() {
		return this.each(function() {
			this.checked = (this.checked ? false : true);
		});
	};

	// Returns if the check box is checked
	// Only works on the first element in the jQuery object
	$.fn.checked = function() {
		if (this.length > 1) {
			return this.get(0).is(':checked');
		} else if (this.length == 1) {
			return this.is(':checked');
		} else {
			return false;
		}
	};
})(jQuery);

// defaults for the date picker; these are necessary so the date picker within cl4 work
// these are in addition to the ones found in cl4.js
if (typeof $.datepicker !== 'undefined') {
	$.datepicker.setDefaults({
		showOn: 'both',
		buttonText: 'Click view calendar to pick date',
		showButtonPanel: true,
		changeMonth: true,
		changeYear: true,
		constrainInput: false,
		duration: 'fast',
		yearRange: 'c-5:c+5',
		appendText: '(YYYY-MM-DD)',
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
	$('.numeric').numeric();

	// sub nav
	$('.top_nav_wrapper').on('click', 'li.has_subnav > a', function(e) {
		e.preventDefault();
		e.stopPropagation();

		var $link = $(this),
			$sub_nav = $link.parent().find('.sub_nav'),
			link_offset,
			link_width;
		if ($sub_nav.css('visibility') !== 'hidden') {
			$sub_nav.css({ visibility: 'hidden' });
			$link.removeClass('clicked');
		} else {
			$('.top_nav_wrapper li.has_subnav > a.clicked').click();
			link_offset = $link.offset();
			link_width = $link.width();
			if ($sub_nav.hasClass('right')) {
				$sub_nav.css({ right: ($(window).width() - (link_offset.left + link_width + 39)), top : ($link.parent().innerHeight()), visibility: 'visible' });
			} else {
				$sub_nav.css({ left: (link_offset.left - 5), top : ($link.parent().innerHeight()), visibility: 'visible' });
			}
			if ($sub_nav.width() < link_width + 19) {
				$sub_nav.css('width', link_width + 19 + 'px');
			}
			$link.addClass('clicked');
			$sub_nav.bind('clickoutside', function() {
				$('.top_nav_wrapper li.has_subnav > a.clicked').click();
			});
		}
	});
});