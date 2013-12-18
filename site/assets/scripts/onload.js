
var doc = $(document);
doc.ready(function () {

	// DOM
	var win = $(window);
	var body = $('body');
	var responsiveMenu = body.find('.submenu .hide-over-break');



	// Page scrolling links
	$('a.scroll').click(function (event) {
		event.preventDefault();

		var link = $(this);
		var target = $(link.attr('data-target'));
		if (!target) {
			target = $(link.attr('href'));
		}

		$('html, body').animate({
			scrollTop: target.offset().top
		}, 600);

	});



	// Mark scrolled document
	var treatScroll = function () {
		if (doc.scrollTop() < 1) {
			body.removeClass('scrolled');
		} else {
			body.addClass('scrolled');
		}
	};
	doc.scroll(function (event) {
		treatScroll();
	});
	doc.ready(function (event) {
		treatScroll();
	});
	treatScroll();



	// Responsive menu
	if (responsiveMenu.length) {
		var responsiveMenuLists = responsiveMenu.find('ul');

		// Close on document load
		responsiveMenuLists.addClass('closed');

		// Add closing buttons
		responsiveMenuLists.prepend('<li><a href="" class="close">Close</a></li>');

		// Bind opening
		responsiveMenu.on('click', '.closed a', function (event) {
			event.preventDefault();
			$(this).parents('ul').removeClass('closed');
		});

		// Bind closing
		responsiveMenu.on('click', '.close', function (event) {
			event.preventDefault();
			$(this).parents('ul').addClass('closed');
		});

	}


}, false);
