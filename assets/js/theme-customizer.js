/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {
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
            $('.navbar-light .navbar-brand').css('color', newval);
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
            $('.menuIcon .bar').css('background-color', newval);
            $('#sponsorsList h3').css('color', newval);
        } );
    } );

    wp.customize( 'primary_color_setting', function( value ) {
        value.bind( function( newval ) {
            $('.btn-whtn').css('background-color', newval);
            $('.btn-whtn').css('border-color', newval);
        } );
    } );

    wp.customize( 'alert_heading_setting', function( value ) {
        value.bind( function( newval ) {
            $('.alert_section h5').text(newval);
        } );
    } );

    wp.customize( 'alert_text_setting', function( value ) {
        value.bind( function( newval ) {
            $('.alert_section p').text(newval);
        } );
    } );



} )( jQuery );
