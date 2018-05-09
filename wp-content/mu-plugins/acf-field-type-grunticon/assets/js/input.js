(function($){


	function initialize_field( $el ) {
		$el.on('change', 'select', onSelectIcon);
	}

	function onSelectIcon(e){
		var select = $(e.currentTarget);
		var icon = select.val()
		var iconEl = select.closest('.acf-field-grunticon').find('.icon');

		iconEl.hide().removeClass().addClass('icon icon-' + icon).fadeIn();
	}


	if( typeof acf.add_action !== 'undefined' ) {

		/*
		*  ready append (ACF5)
		*
		*  These are 2 events which are fired during the page load
		*  ready = on page load similar to $(document).ready()
		*  append = on new DOM elements appended via repeater field
		*
		*  @type	event
		*  @date	20/07/13
		*
		*  @param	$el (jQuery selection) the jQuery element which contains the ACF fields
		*  @return	n/a
		*/


		function doGrunticon() {
		    var svgPath, pngPath, fallbackPath;

		    svgPath = SiteInfo.grunticonPath + 'icons.data.svg.css';
		    pngPath = SiteInfo.grunticonPath + 'icons.data.png.css';
		    fallbackPath = SiteInfo.grunticonPath + 'icons.fallback.css';


		    grunticon([svgPath, pngPath, fallbackPath], function() {
		      grunticon.svgLoadedCORSCallback();
		    });
		}

		acf.add_action('ready append', function( $el ){
			doGrunticon();

			// search $el for fields of type 'grunticon'
			acf.get_fields({ type : 'grunticon'}, $el).each(function(){

				initialize_field( $(this) );

			});

		});


	} else {


		/*
		*  acf/setup_fields (ACF4)
		*
		*  This event is triggered when ACF adds any new elements to the DOM.
		*
		*  @type	function
		*  @since	1.0.0
		*  @date	01/01/12
		*
		*  @param	event		e: an event object. This can be ignored
		*  @param	Element		postbox: An element which contains the new HTML
		*
		*  @return	n/a
		*/

		$(document).on('acf/setup_fields', function(e, postbox){

			$(postbox).find('.field[data-field_type="grunticon"]').each(function(){

				initialize_field( $(this) );

			});

		});


	}


})(jQuery);
