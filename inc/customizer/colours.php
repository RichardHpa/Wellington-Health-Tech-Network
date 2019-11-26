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

    $wp_customize->add_setting('whtn_front_text_setting', array(
        'default'   => '#ffffff',
        'priority'  => 10,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'whtn_front_text_section',
        array(
            'label'      => __( 'Front Text Colour', 'whtn' ),
            'section'    => 'whtn_colours_section',
            'settings'   => 'whtn_front_text_setting',
        ) )
    );

    $wp_customize->add_setting('whtn_header_background_setting', array(
        'default'   => '#3EA86F',
        'priority'  => 10,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'whtn_header_background_section',
        array(
            'label'      => __( 'Header Background Colour', 'whtn' ),
            'section'    => 'whtn_colours_section',
            'settings'   => 'whtn_header_background_setting',
        ) )
    );

    $wp_customize->add_setting('whtn_footer_background_setting', array(
        'default'   => '#3EA86F',
        'priority'  => 10,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'whtn_footer_background_section',
        array(
            'label'      => __( 'Footer Background Colour', 'whtn' ),
            'section'    => 'whtn_colours_section',
            'settings'   => 'whtn_footer_background_setting',
        ) )
    );

    $wp_customize->add_setting('whtn_button_colour_setting', array(
        'default'   => '#3EA86F',
        'priority'  => 10,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'whtn_button_colour_section',
        array(
            'label'      => __( 'Button Colour', 'whtn' ),
            'section'    => 'whtn_colours_section',
            'settings'   => 'whtn_button_colour_setting',
        ) )
    );

}

add_action( 'customize_register', 'whtn_colours_customize_register' );


function whtn_customizer_style_output(){
    ?>
        <style>
            .navbar-brand,
            .navbar-brand:hover,
            .navContainer .menu li a{
                color: <?php echo get_theme_mod('whtn_header_text_setting', '#ffffff'); ?>;
            }

            .home p{
                color: <?php echo get_theme_mod('whtn_front_text_section', '#ffffff'); ?>;
            }

            .header,
            .header .sub-menu{
                background-color: <?php echo get_theme_mod('whtn_header_background_setting', '#3EA86F'); ?>;
            }

            .footer{
                background-color: <?php echo get_theme_mod('whtn_footer_background_setting', '#3EA86F'); ?>;
            }

            .btn-whtn,
            .page-link.current,
            .fc-prev-button,
            .fc-next-button{
                background-color: <?php echo get_theme_mod('whtn_button_colour_setting', '#3EA86F'); ?>;
                border-color: <?php echo get_theme_mod('whtn_button_colour_setting', '#3EA86F'); ?>;
            }

            .fc-event,
            .fc-event-dot{
                background-color: <?php echo get_theme_mod('whtn_button_colour_setting', '#3EA86F'); ?>;
            }

            .eventCard .row:hover{
                border-color: <?php echo get_theme_mod('whtn_button_colour_setting', '#3EA86F'); ?>;
            }
            .btn-primary.disabled,
            .btn-primary:disabled{
                background-color: <?php echo get_theme_mod('whtn_button_colour_setting', '#3EA86F'); ?>;
            }


        </style>
    <?php
}
add_action('wp_head', 'whtn_customizer_style_output');
