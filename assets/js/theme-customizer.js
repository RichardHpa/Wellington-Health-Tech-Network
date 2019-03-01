/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	// // Update the site title in real time...
	// wp.customize( 'blogname', function( value ) {
	// 	value.bind( function( newval ) {
	// 		$( '#site-title a' ).html( newval );
	// 	} );
	// } );
    //
	// //Update the site description in real time...
	// wp.customize( 'blogdescription', function( value ) {
	// 	value.bind( function( newval ) {
	// 		$( '.site-description' ).html( newval );
	// 	} );
	// } );
    //
	// //Update site title color in real time...
	// wp.customize( 'header_textcolor', function( value ) {
	// 	value.bind( function( newval ) {
	// 		$('#site-title a').css('color', newval );
	// 	} );
	// } );
    //
	// //Update site background color...
	// wp.customize( 'background_color', function( value ) {
	// 	value.bind( function( newval ) {
	// 		$('body').css('background-color', newval );
	// 	} );
	// } );
    //
	// //Update site link color in real time...
	// wp.customize( 'link_textcolor', function( value ) {
	// 	value.bind( function( newval ) {
	// 		$('a').css('color', newval );
	// 	} );
	// } );

    wp.customize( 'footer_color_setting', function( value ) {
    	value.bind( function( newval ) {
            $('footer').css('background-color', newval);
    	} );
    } );

    wp.customize( 'footer_text_setting', function( value ) {
        value.bind( function( newval ) {
            $('footer').css('color', newval);
        } );
    } );

    wp.customize( 'header_text_setting', function( value ) {
        value.bind( function( newval ) {
            $('.navbar-brand').css('color', newval);
            $('#headerNav li a').css('color', newval);
        } );
    } );

    wp.customize( 'header_color_setting', function( value ) {
        value.bind( function( newval ) {
            $('header#header').css('background-color', newval);
        } );
    } );

    wp.customize( 'home_text_setting', function( value ) {
        value.bind( function( newval ) {
            $('#homeBanner').text(newval);
        } );
    } );

    wp.customize( 'front_text_color_setting', function( value ) {
        value.bind( function( newval ) {
            $('#homeBanner').css('color', newval);
            $('#frontNav li a').css('color', newval);
            $('.textContent hr').css('border-color', newval);
        } );
    } );


} )( jQuery );
