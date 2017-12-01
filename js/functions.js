(function( $ ) {

  // Toggle
  (function() {
    var toggleBtns = $( '.toggle-btn' );

    if ( ! toggleBtns.length ) {
      return;
    }

    var toggleFn = function() {
      var content = $( this ).siblings( '.toggle-content' );
      var container = $( this ).closest( '.toggle-container' );

      content.slideToggle( 200 );
      container.toggleClass( 'toggled' );
      $( this ).add( content ).attr( 'aria-expanded', container.hasClass( 'toggled' ) );
    };

    toggleBtns.on( 'click', toggleFn );
  })();

})( jQuery );
