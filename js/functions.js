(function( $ ) {

  // Toggle
  (function() {
    var toggleBtns = $( '.toggle-btn' );

    if ( ! toggleBtns.length ) {
      return;
    }

    // toggle fn
    var toggleFn = function( e ) {
      e ? e.stopPropagation() : '';

      if ( $( '.toggle-btn.toggled' ).length ) {
        var _this = $( '.toggle-btn.toggled' );
      } else {
        var _this = $( this );
      }

      var toggleTarget    = _this.data( 'target' );
      var content         = $( toggleTarget );

      if ( ! content.length ) {
        return;
      }

      var toggleType      = _this.data( 'toggle' );
      var toggleOverlay   = _this.data( 'overlay' ) || false;
      var toggleAware     = _this.data( 'aware' ) || false; // aware of outside clicks
      var toggleContent   = _this.add( content );

      toggleType == 'jquery-slide' ? content.slideToggle( 200 ) : '';
      toggleType == 'toggle' ? content.toggle() : '';

      toggleContent.toggleClass( 'toggled' );
      toggleContent.attr( 'aria-expanded', toggleContent.hasClass( 'toggled' ) );

      toggleOverlay ? $( 'body' ).toggleClass( 'toggle-overlay' ) : '';
      toggleOverlay && toggleAware ? $( 'body' ).toggleClass( 'toggle-aware' ) : '';
    };

    // action
    toggleBtns.on( 'click', toggleFn );

    // action aware
    $( document ).on( 'click', '.toggle-aware', function( e ) {
      if ( ! $( e.target ).closest( '.toggled' ).length && ! $( e.target ).is( $( '.toggle-btn.close' ) ) ) {
        toggleFn();
      }
    });
  })();

})( jQuery );
