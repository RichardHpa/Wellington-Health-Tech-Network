<?php

flush_rewrite_rules( false );

/*
    Adding Style and Script files into the theme
*/
function customThemeEnqueues(){
    wp_enqueue_script('jquery');
    // // Bootstrap
    // wp_enqueue_style('bootstrapStyle', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.1.0', 'all');
    // wp_enqueue_script('bootstrapScript', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '4.1.0', true);
    // // Owl Carousel
    // wp_enqueue_style('owlStyle', get_template_directory_uri() . '/assets/owl/owl.carousel.min.css', array(), '2.3.4', 'all');
    // // wp_enqueue_style('owlThemeStyle', get_template_directory_uri() . '/assets/owl/owl.theme.default.min.css', array(), '2.3.4', 'all');
    // wp_enqueue_script('owlScript', get_template_directory_uri() . '/assets/owl/owl.carousel.min.js', array(), '2.3.4', true);
    // // styles
    // wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css', array(), '4.7.0', 'all' );
    // wp_enqueue_style('glyph-font', get_template_directory_uri() . '/assets/glyphter-font/css/Glyphter.css', array(), '4.7.0', 'all' );
    // wp_enqueue_style('customStyle', get_template_directory_uri() . '/assets/css/sass.css', array(), '1.0.0', 'all');
    // // scripts
    // wp_enqueue_script('customScript', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0.0', true);

    wp_enqueue_style('masterStyle', get_template_directory_uri() . '/assets/css/style.css', array(), '0.0.1', 'all');

    wp_enqueue_script('customScript', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0.0', true);

}
add_action('wp_enqueue_scripts', 'customThemeEnqueues');
