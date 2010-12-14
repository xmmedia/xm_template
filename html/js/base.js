// jQuery Extension: any fields it is added to will not allow most non numeric values
/*
jQuery.fn.numeric = function() {
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

    return this;
}

$('.numeric').numeric();
*/

// HTML5 autofocus plugin, Copyright (c) 2009, Mike Taylor, http://miketaylr.com, MIT licensed
(function($){ $.fn.autofocus=function(){return (this.first().autofocus!==true)?this.focus():this;};})(jQuery);
$("[autofocus]").autofocus();

$.fn.extend({
    /**
    * Checks all the elements in the jQuery object
    */
    check: function() {
        return this.each(function() { this.checked = true; });
    },
    /**
    * Unchecks all the elements in the jQuery object
    */
    uncheck: function() {
        return this.each(function() { this.checked = false; });
    },
    /**
    * Toggles the checked status of all the elements in the jQuery object
    */
    checkToggle: function() {
        return this.each(function() { this.checked != this.checked; });
    },
    /**
    * Returns if the check box is checked
    * Only works on the first element in the jQuery object
    */
    checked: function() {
        if (this.length > 1) {
            return this.get(0).attr('checked');
        } else if (this.length == 1) {
            return this.attr('checked');
        } else {
            return false;
        }
    },
    /**
    * Returns the tag name of the element
    * Useful for debugging
    */
    tagName: function() {
        return (this.length > 0 ? this.get(0).tagName : 'No Element Found');
	}
});

// defaults for the date picker; these are necessary so the date picker within cl4 work
// these are in addition to the ones found in cl4.js
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