// jQuery Extension: any fields it is added to will not allow most non numeric values
jQuery.fn.numeric=function(){this.keypress(function(e){var key=e.charCode?e.charCode:e.keyCode?e.keyCode:0;if(e.ctrlKey||e.altKey||(key>=48&&key<=57)||key==9||key==39||key==37||key==35||key==36||key==8||key==46||key==13||key==45||key==43){return true;} return false;});return this;}
$('.numeric').numeric();

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