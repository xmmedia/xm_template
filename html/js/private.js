$(function() {
	// admin sub nav
	$('.top_nav_wrapper').on('click', 'li.has_subnav > a', function(e) {
		e.preventDefault();
		e.stopPropagation();

		var link = $(this),
			sub_nav = link.parent().find('.sub_nav'),
			link_offset,
			link_width;
		if (sub_nav.css('visibility') !== 'hidden') {
			sub_nav.css({ visibility: 'hidden' });
			link.removeClass('clicked');
		} else {
			$('.top_nav_wrapper li.has_subnav > a.clicked').click();
			link_offset = link.offset();
			link_width = link.width();
			if (sub_nav.hasClass('right')) {
				sub_nav.css({ right: ($(window).width() - (link_offset.left + link_width + 39)), top : (link.parent().innerHeight()), visibility: 'visible' });
			} else {
				sub_nav.css({ left: (link_offset.left - 5), top : (link.parent().innerHeight()), visibility: 'visible' });
			}
			if (sub_nav.width() < link_width + 19) {
				sub_nav.css('width', link_width + 19 + 'px');
			}
			link.addClass('clicked');

			// watch for clicks outside the sub nav element
			$('html').one('click', function(e) {
				// make sure the clicked element is not in the sub nav
				// and the sub nav element was not clicked
				if (sub_nav.has(e.target).length === 0 && ! sub_nav.is(e.target)) {
					$('.top_nav_wrapper li.has_subnav > a.clicked').click();
				}
			});
		}
	});
});