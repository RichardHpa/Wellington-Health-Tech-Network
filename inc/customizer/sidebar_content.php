<?php

function whtn_sidebar_customize_register( $wp_customize ) {

    $wp_customize->add_section('whtn_sidebar_section', array(
        'title'      => 'Sidebar Content',
        'description' => 'Content for the sidebar',
        'priority'   => 100,
    ));

    $wp_customize->add_setting('whtn_sidebar_image_setting', array(
        'priority'   => 10,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'whtn_sidebar_image_control',
        array(
            'label'      => 'Sidebar Logo',
            'section'    => 'whtn_sidebar_section',
            'settings'   => 'whtn_sidebar_image_setting'
        )
    ));

    $wp_customize->add_setting('whtn_sidebar_text_setting', array(
        'priority'   => 10,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'whtn_sidebar_text_control',
        array(
            'label'      => 'Sidebar Text',
            'section'    => 'whtn_sidebar_section',
            'type'       => 'textarea',
            'settings'   => 'whtn_sidebar_text_setting',
        )
    ));

}

add_action( 'customize_register', 'whtn_sidebar_customize_register' );
