(function( $ ) {

  // Toggle
  (function() {
    var toggleBtns = $( '.toggle-btn' );

    if ( ! toggleBtns.length ) {
      return;
    }

    var toggleFn = function() {
      var content = $( this ).siblings( '.toggle-content' );

      content.slideToggle( 200 );
      $( this ).parent().toggleClass( 'toggled' );
      $( this ).add( content ).attr( 'aria-expanded', $( this ).hasClass( 'toggled' ) );
    };

    toggleBtns.on( 'click', toggleFn );
  })();

})( jQuery );
