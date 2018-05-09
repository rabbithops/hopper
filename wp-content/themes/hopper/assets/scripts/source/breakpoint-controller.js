/*
BreakpointController
--------------------
Helper functions to simplify listening for events related to crossing
responsive breakpoints. By listening for document cross_breakpoint instead of
window resize, we can cut down on the amount of code running/dom thrashing and
improve performance!

Use Case
========
You have a hamburger nav on SMALL viewports that uses slideToggle to show and
hide the navigation but displays normally on LARGE viewports. It’s possible
that the user might be viewing the page on a desktop browser with the window
sized down if the user closes the nav and resizes the browser to a width that
SHOULD display the nav normally. slideToggle’s inline display:none overrides
the stylesheets media query that should be display:block (or something
similar).

To fix this, we listen for the cross breakpoint event and clear out any inline
styles whenever we change from one to another.

--: nav-controller.example.js :-----------------------------------------------

import { CROSS_BREAKPOINT, LARGE } from './breakpoint-controller'

function enableMobileFunctionality(){ //blah blah blah hamburgers }
function enableDesktopFunctionality(){ //blah blah blah mega nav }

$(document).on(CROSS_BREAKPOINT, onCrossBreakpoint);

function onCrossBreakpoint(e, breakpoint) {
	$('.navigation').attr('style', "");

	if (breakpoint >= LARGE) {
		enableDesktopFunctionality();
	} else {
		enableMobileFunctionality();
	}
}
*/
export const CROSS_BREAKPOINT = 'cross_breakpoint';

/*JS_BREAKPOINT_EXPORTS*/
export const XSMALL = 400;
export const SMALL = 600;
export const MEDIUM = 800;
export const LARGE = 1000;
export const NAVIGATION = 1000;
export const XLARGE = 1200;
/*END_JS_BREAKPOINT_EXPORTS*/

let $ = window.jQuery;

var win,
	currentBreakpoint = null,
	breakpoints = /*JS_BREAKPOINT_ARRAY*/
	[ XSMALL, SMALL, MEDIUM, LARGE, NAVIGATION, XLARGE ]
/*END_JS_BREAKPOINT_ARRAY*/;

function onDocumentReady() {
	win = $(window);
	win.on({
		'resize': checkWindow,
		'load': checkWindow
	});
	setTimeout(checkWindow, 0);
}

function checkWindow() {
	var w = win.width(),
		ret;

	for (var i = 0; i < breakpoints.length; i++) {
		var breakpoint = breakpoints[i];
		if (w >= breakpoint) {
			ret = breakpoint;
		} else {
			break;
		}
	}

	setBreakpoint(ret);
}

function setBreakpoint(breakpoint) {
	if (breakpoint !== currentBreakpoint) {
		$(document).trigger(CROSS_BREAKPOINT, [breakpoint]);
	}

	currentBreakpoint = breakpoint;
}

export function getBreakpoint(){
	return currentBreakpoint;
}

document.addEventListener('DOMContentLoaded', onDocumentReady);
