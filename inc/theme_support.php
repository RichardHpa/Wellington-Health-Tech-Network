<?php

function customThemeSupport(){
    add_theme_support( 'wp-block-styles' );
    // add_theme_support( 'title-tag' );

    add_theme_support('menus');
    register_nav_menu('header_navigation', 'This is the main navigation at the top of the page');
    register_nav_menu('footer_navigation', 'This is the secondary navigation in the footer section of the page');
    add_theme_support( 'custom-logo', array(
        'height'      => 150,
        'width'      => 150,
        'flex-width'  => true,
        'flex-height'  => true,
    ));
    add_theme_support( 'post-formats', array('audio', 'image', 'video' , 'link') );
    add_theme_support( 'post-thumbnails' );
}
add_action('init', 'customThemeSupport');

 ?>
