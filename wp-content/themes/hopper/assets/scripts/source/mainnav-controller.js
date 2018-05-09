import { CROSS_BREAKPOINT, NAVIGATION } from './breakpoint-controller'

var header,
	mainNav,
	mainMenu, mainMenuToggleButton, subMenus,
	subMenuToggles;

function onDocumentReady() {
	header 				 = $('.site-header');
	mainNav              = $('#main-nav');
	mainMenu             = $('#main-menu');
	mainMenuToggleButton = $('#main-menu-toggle');
	subMenus 	         = $('.sub-menu');
	subMenuToggles       = $('.sub-menu-toggle');

	if (Modernizr.touchevents) {
		mainNav.addClass('main-nav-has-touch');
		mainMenu.addClass('main-menu-has-touch');
	} else {
		mainNav.addClass('main-nav-no-touch');
		mainMenu.addClass('main-menu-no-touch');
	}

	mainNavInit();

	$(document).on(CROSS_BREAKPOINT, mainNavInit);

	mainMenuToggleButton.on('click', function(event) {
		event.preventDefault();
		mainMenuToggle();
	});

	subMenuToggles.on('click', function(event) {
		event.preventDefault();
		subMenuToggle(this);
	});

}

/**
 * Initialize main nav depending on viewport width
 */
function mainNavInit(e, breakpoint) {

	if (breakpoint >= NAVIGATION) {
		mainNavInitLarge();
	} else {
		mainNavInitSmall();
	}
}

/**
 * Initialize main nav for small viewports
 */
function mainNavInitSmall() {
	subMenus.hide().attr('aria-hidden', true);
	mainMenu
		.hide()
		.removeClass('active')
		.attr('aria-hidden', true);
		header.removeClass('main-menu-open').attr('aria-hidden', true);
		subMenus.hide().attr('aria-hidden', true);
		mainMenuToggleButton.attr('aria-expanded', 'false');
}

/**
 * Initialize main nav for large viewports
 */
function mainNavInitLarge() {
	subMenus.hide().attr('aria-hidden', true);
	mainMenu
		.show()
		.css('display', 'flex')
		.addClass('active')
		.attr('aria-hidden', false);
	subMenuToggles.removeClass('active');
	header.removeClass('main-menu-open').attr('aria-hidden', true);
	mainMenuToggleButton.attr('aria-expanded', 'true');
}

/**
 * Toggle main menu
 */
function mainMenuToggle() {
	if (header.hasClass('main-menu-open')) {
		mainMenu.hide();
		mainMenu.removeClass('active');
		header.removeClass('main-menu-open').attr('aria-hidden', true);
		subMenus.hide().attr('aria-hidden', true);
		mainMenuToggleButton.attr('aria-expanded', 'false');
	} else {
		mainMenu.show();
		mainMenu.addClass('active');
		header.addClass('main-menu-open').attr('aria-hidden', false);
		mainMenuToggleButton.attr('aria-expanded', 'true');
	}
}


/**
 * Toggle submenus
 */
function subMenuToggle(el) {

	var toggle       = $(el),
		thisSubMenu  = toggle.closest('.menu-item').find('.sub-menu').first();

	if (toggle.hasClass('active')) {
		thisSubMenu.hide().removeClass('active').attr('aria-hidden', true);
		toggle.removeClass('active').attr('aria-expanded', false);
	} else {
		toggle.addClass('active').attr('aria-expanded', true);
		thisSubMenu.show().addClass('active').attr('aria-hidden', false);
	}

}

$(onDocumentReady);
