(function( $ ) {

	var siteNavContainer = $( '#site-navigation' );
	var siteNavMenu = $( '#primary-menu' );
	var siteNavParents = siteNavMenu.find( '.menu-item-has-children > a, .page_item_has_children > a' );

	(function() {
		if ( ! siteNavMenu.length || ! siteNavParents.length ) {
			return;
		}

		if ( ! ( 'menus' in businessNavigation ) ) {
			return;
		}

		var overviewItem = $( '<li />', { 'class': 'menu-item overview-item' } )
			.append( $( '<a />' ) );


		$( window ).on( 'resize load', function() {
			if ( $( window ).width() < 992 ) {
				siteNavMenu.find( '.overview-item' ).remove();
				siteNavParents.each(function( key, value ) {
					$( this ).siblings( 'ul' ).prepend( overviewItem );
				});
			} else {
				siteNavMenu.find( '.overview-item' ).remove();
			}
		});
	})();

})( jQuery );