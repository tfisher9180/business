(function( $ ) {

	// init
	var siteNavContainer = $( '#site-navigation' );
	var siteNavMenu = $( '#primary-menu' );
	var siteNavParents = siteNavMenu.find( '.menu-item-has-children > a, .page_item_has_children > a' );

	// Toggle an overview menu item on mobile devices
	(function() {
		if ( ! siteNavMenu.length || ! siteNavParents.length ) {
			return;
		}

		// overview pages enabled in customizer
		if ( ! ( 'menus' in businessNavigation ) ) {
			return;
		}

		// function global scope
		var overview = false;
		var hrefs;

		// action
		$( window ).on( 'resize load', function() {
			if ( $( window ).width() < 992 ) {
				if ( ! overview ) {
					// create the item
					var overviewItem = $( '<li />', { 'class': 'menu-item overview-item' } )
						.append( $( '<a />', { text: businessNavigation.menus.overview } ) );

					// remove any existing items and append
					$( '.overview-item' ).remove();
					siteNavParents.siblings( 'ul' ).prepend( overviewItem );

					// map hrefs to new global array for use in "else" statement
					hrefs = siteNavParents.map(function() {
						return $( this ).attr( 'href' );
					}).get();

					// re-arrange hrefs for mobile accessibility
					siteNavParents.each(function() {
						$( this ).siblings( 'ul' ).find( '.overview-item > a' ).attr( 'href', $( this ).attr( 'href' ) );
						$( this ).attr( 'href', '#' );
					});

					// make this happen only once
					overview = true;
				}
			} else {
				if ( overview ) {
					// time to remove overview elements and put back the original hrefs
					$( '.overview-item' ).remove();
					siteNavParents.each(function( i ) {
						$( this ).attr( 'href', hrefs[i] );
					});

					// make this happen only once
					overview = false;
				}
			}
		});
	})();

})( jQuery );
