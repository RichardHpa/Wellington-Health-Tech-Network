<?php

function whtn_colours_customize_register( $wp_customize ) {

    $wp_customize->add_section('whtn_colours_section', array(
        'title'      => 'Colours',
        'description' => 'Colours settings for the theme.',
        'priority'   => 100,
    ));

    $wp_customize->add_setting('whtn_header_text_setting', array(
        'default'   => '#ffffff',
        'priority'  => 10,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
	    'whtn_header_text_section',
    	array(
    		'label'      => __( 'Header Color', 'whtn' ),
    		'section'    => 'whtn_colours_section',
    		'settings'   => 'whtn_header_text_setting',
    	) )
    );

    $wp_customize->add_setting('whtn_primary_text_setting', array(
        'default'   => '#ffffff',
        'priority'  => 10,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'whtn_primary_text_section',
        array(
            'label'      => __( 'Primary Text Colour', 'whtn' ),
            'section'    => 'whtn_colours_section',
            'settings'   => 'whtn_primary_text_setting',
        ) )
    );

}

add_action( 'customize_register', 'whtn_colours_customize_register' );


function whtn_customizer_style_output(){
    ?>
        <style>
            .navbar-brand,
            .navbar-brand:hover{
                color: <?php echo get_theme_mod('whtn_header_text_setting', '#ffffff'); ?>;
            }

            p{
                color: <?php echo get_theme_mod('whtn_primary_text_setting', '#ffffff'); ?>;
            }
        </style>
    <?php
}
add_action('wp_head', 'whtn_customizer_style_output');
