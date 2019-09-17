<?php

    function custom_customize_enqueue() {
    	wp_enqueue_script( 'rh_slideshow_customizer_script', get_template_directory_uri() . '/assets/js/front/customizer.min.js', array( 'jquery', 'customize-controls' ), false, true );
    	wp_localize_script('rh_slideshow_customizer_script', 'post_counts', array(
    		'count'=> get_theme_mod('whtn_slide_count_setting', 5)
    	));
    }
    add_action( 'customize_controls_enqueue_scripts', 'custom_customize_enqueue' );

    function whtn_slideshow_customize_register( $wp_customize ) {

        $wp_customize->add_section('whtn_slideshow_section', array(
    		'title'      => 'Slideshow',
    		'description' => 'Settings for the home screen slideshow.',
    		'priority'   => 100,
    	));

        $wp_customize->add_setting('whtn_slide_speed_setting', array(
            'default'   => '3',
            'priority'   => 10,
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Control(
            $wp_customize,
            'whtn_slide_speed_control',
            array(
                'label'      => 'Slideshow Duration (Seconds)',
                'section'    => 'whtn_slideshow_section',
                'type'           => 'number',
                'settings'   => 'whtn_slide_speed_setting',
                'description' => 'How many seconds do you want between each slide transition.'
            )
        ));

        $wp_customize->add_setting('whtn_slide_count_setting', array(
            'default'   => '5',
            'transport' => 'active_callback',
        ));

        $whtnSlideCount = 10;
        $whtnSlideCountArray = array();
        for ($i=1; $i <= $whtnSlideCount; $i++) {
            $whtnSlideCountArray[$i] = $i;
        };

        $wp_customize->add_control(new WP_Customize_Control(
    		$wp_customize,
    		'whtn_slide_count_control',
    		array(
    			'label'      => 'Show many slides would you like?',
    			'section'    => 'whtn_slideshow_section',
    			'type'       => 'select',
    			'default'   => '5',
    			'choices' => $whtnSlideCountArray,
    			'settings'   => 'whtn_slide_count_setting',
    		)
    	));


        for ($i=1; $i <= $whtnSlideCount; $i++) {
            $wp_customize->add_setting('whtn_slide_' . $i . '_setting', array(
    			'priority'  => 20,
                'default' => get_template_directory_uri() . '/assets/images/placeholderSlide.jpg',
    			'transport' => 'refresh',
    		));

            $wp_customize->add_control(new WP_Customize_Image_Control(
                $wp_customize,
                'whtn_slide_' . $i . '_control',
                array(
                    'label'      => 'Slideshow Image ' . $i,
                    'section'    => 'whtn_slideshow_section',
                    'settings'   => 'whtn_slide_' . $i . '_setting'
                )
            ));
        }

    }
    add_action( 'customize_register', 'whtn_slideshow_customize_register' );
 ?>
