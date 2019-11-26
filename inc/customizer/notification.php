<?php

function whtn_notification_customize_register( $wp_customize ) {

    $wp_customize->add_section('whtn_notification_section', array(
        'title'      => 'Notification',
        'description' => 'Notification will appear on the sites home page.',
        'priority'   => 100,
    ));

    $wp_customize->add_setting('whtn_notification_display_setting', array(
        'default'   => 'yes',
        'priority'   => 10,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'whtn_notification_display_control',
        array(
            'label'      => 'Do you want a notification?',
            'section'    => 'whtn_notification_section',
            'type'           => 'radio',
            'settings'   => 'whtn_notification_display_setting',
            'choices'        => array(
                'yes'   => __( 'Yes' ),
                'no'  => __( 'No' )
            )
        )
    ));

    $wp_customize->add_setting('whtn_notification_title_setting', array(
        'default'   => 'Notification Title',
        'priority'   => 10,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'whtn_notification_title_control',
        array(
            'label'      => 'Notification Title',
            'section'    => 'whtn_notification_section',
            'type'       => 'text',
            'settings'   => 'whtn_notification_title_setting'
        )
    ));

    $wp_customize->add_setting('whtn_notification_description_setting', array(
        'default'   => 'Notification Description',
        'priority'   => 10,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'whtn_notification_description_control',
        array(
            'label'      => 'Notification Description',
            'section'    => 'whtn_notification_section',
            'type'       => 'textarea',
            'settings'   => 'whtn_notification_description_setting'
        )
    ));

    $wp_customize->add_setting('whtn_notification_link_setting', array(
        'default'   => '',
        'priority'   => 10,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'whtn_notification_link_control',
        array(
            'label'      => 'Notification Link',
            'section'    => 'whtn_notification_section',
            'type'       => 'url',
            'settings'   => 'whtn_notification_link_setting'
        )
    ));

}

add_action( 'customize_register', 'whtn_notification_customize_register' );

?>
