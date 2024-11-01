(function($) {
    'use strict';
    var loader = '#spt-loader';
    var page = '#page';
    var loaderTimer;
    var stopPropagation = false;
    
    $(function() {
        $( sptParams.ignored ).click( function() {
            stopPropagation = true;
        })
        
        $( window ).on( 'beforeunload', loaderFadeIn );
    });

    $( window ).load( loaderFadeOut );
    
    function loaderFadeIn() {
        if( stopPropagation ) {
            stopPropagation = false;
            return;
        }
        
        $( loader ).addClass( 'active' );
    } 
    
    function loaderFadeOut() {
        $( loader ).removeClass( 'active' );
    } 
})( jQuery );
