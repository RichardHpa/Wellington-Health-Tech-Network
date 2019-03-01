<?php

function customCustomizer($wp_customize){
    require_once( dirname( __FILE__ ) . '/alpha-color-picker/alpha-color-picker.php' );

    /*
    Theme Styles
    */
    $wp_customize->add_section('theme_style_section', array(
        'title' => __('Site Styles', 'whtn'),
        'priority' => 20,
    ));

    //Footer Background Colour
    $wp_customize->add_setting(
        'footer_color_setting',
        array(
            'default'     => '#228496',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            'transport'   => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new Customize_Alpha_Color_Control(
            $wp_customize,
            'footer_colour_control',
            array(
                'label'         => __( 'Footer Background Colour', 'whtn' ),
                'section'       => 'theme_style_section',
                'settings'      => 'footer_color_setting',
                'show_opacity'  => true
            )
        )
    );

    //Footer Text Colour
    $wp_customize->add_setting(
        'footer_text_setting',
        array(
            'default'     => '#ffffff',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            'transport'   => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new Customize_Alpha_Color_Control(
            $wp_customize,
            'footer_text_control',
            array(
                'label'         => __( 'Footer Text Colour', 'whtn' ),
                'section'       => 'theme_style_section',
                'settings'      => 'footer_text_setting',
                'show_opacity'  => true
            )
        )
    );

    //Footer Background Colour
    $wp_customize->add_setting(
        'footer_color_setting',
        array(
            'default'     => '#228496',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            'transport'   => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new Customize_Alpha_Color_Control(
            $wp_customize,
            'footer_colour_control',
            array(
                'label'         => __( 'Footer Background Colour', 'whtn' ),
                'section'       => 'theme_style_section',
                'settings'      => 'footer_color_setting',
                'show_opacity'  => true
            )
        )
    );

    //Header Text Colour
    $wp_customize->add_setting(
        'header_text_setting',
        array(
            'default'     => '#000000',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            'transport'   => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new Customize_Alpha_Color_Control(
            $wp_customize,
            'header_text_control',
            array(
                'label'         => __( 'Header Text Colour', 'whtn' ),
                'section'       => 'theme_style_section',
                'settings'      => 'header_text_setting',
                'show_opacity'  => true
            )
        )
    );

    //Header Background Colour
    $wp_customize->add_setting(
        'header_color_setting',
        array(
            'default'     => '#228496',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            'transport'   => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new Customize_Alpha_Color_Control(
            $wp_customize,
            'header_colour_control',
            array(
                'label'         => __( 'Header Background Colour', 'whtn' ),
                'section'       => 'theme_style_section',
                'settings'      => 'header_color_setting',
                'show_opacity'  => true
            )
        )
    );

    //header background Image
    $wp_customize->add_setting('header_background_image_setting', array(
        'default' => '0',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'header_background_image_control', array(
		'label' => __('Default Background Image', 'whtn'),
		'section' => 'theme_style_section',
		'settings' => 'header_background_image_setting',
        'width' => 1280,
        'height' => 300,
        'flex_height' => true,
        'flex_width' => true
	)));


    $wp_customize->add_section('home_style_section', array(
        'title' => __('Home Page Content', 'whtn'),
        'priority' => 20,
    ));


    register_default_headers( array(
        'defaultImage' => array(
            'url'           => get_template_directory_uri() . '/assets/images/defaultBanner.jpg',
            'thumbnail_url' => get_template_directory_uri() . '/assets/images/defaultBanner.jpg',
            'description'   => __( 'defaultImage', 'whtn' )
        )
    ) );
    //header background Image
    $wp_customize->add_setting('home_background_image_setting', array(
        'default-image' => get_template_directory_uri() . '/assets/images/defaultBanner.jpeg',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'home_background_image_control', array(
        'label' => __('Home Background Image', 'whtn'),
        'section' => 'home_style_section',
        'settings' => 'home_background_image_setting',
        'width' => 1920,
        'height' => 1080,
        'flex_height' => true,
        'flex_width' => true
    )));

    //header background Image
    $wp_customize->add_setting('home_text_setting', array(
        'default' => 'Testing',
        'type'        => 'theme_mod',
        'capability'  => 'edit_theme_options',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'home_text_control',array(
            'label' => __('Home Page Text', 'whtn'),
            'section' => 'home_style_section',
            'settings' => 'home_text_setting',
            'type' => 'textarea'
        )
    ));

    //Front Text  Colour
    $wp_customize->add_setting(
        'front_text_color_setting',
        array(
            'default'     => '#ffffff',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            'transport'   => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new Customize_Alpha_Color_Control(
            $wp_customize,
            'front_text_color_control',
            array(
                'label'         => __( 'Front Page Text Colour', 'whtn' ),
                'section'       => 'home_style_section',
                'settings'      => 'front_text_color_setting',
                'show_opacity'  => true
            )
        )
    );
}

add_action('customize_register', 'customCustomizer');

function mytheme_customizer_live_preview(){
	wp_enqueue_script(
		  'mytheme-themecustomizer',
		  get_template_directory_uri().'/assets/js/theme-customizer.js',
		  array( 'jquery','customize-preview' ),
		  '',
		  true
	);
}

add_action( 'customize_preview_init', 'mytheme_customizer_live_preview' );

function customizer_style_output(){

    function get_background_image_url($modname) {
        if( get_theme_mod($modname) > 0) {
            return wp_get_attachment_url( get_theme_mod( $modname ) );
        }
    };

?>
    <style>
        .footer{
            background-color: <?php echo get_theme_mod('footer_color_setting', '#228496'); ?>;
            color: <?php echo get_theme_mod('footer_text_setting', '#ffffff'); ?>;
        }

        .navbar-brand,
        #headerNav li a{
            color: <?php echo get_theme_mod('header_text_setting', '#000000'); ?>;
        }

        header#header{
            background-color: <?php echo get_theme_mod('header_color_setting', '#228496'); ?>;
            <?php if(get_theme_mod('header_background_image_setting')): ?>
                background-image: url(<?php echo esc_url(get_background_image_url(header_background_image_setting)); ?>);
                height: 300px;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            <?php endif; ?>
        }

        .home .full{
            background-image: url(<?php if (get_theme_mod( 'home_background_image_setting' )) : echo esc_url( get_background_image_url(home_background_image_setting) ); else: echo get_template_directory_uri().'/assets/images/defaultBanner.jpg'; endif; ?>);
        }

        #homeBanner,
        #frontNav li a,
        .textContent hr{
            color: <?php echo get_theme_mod('front_text_color_setting', '#ffffff'); ?>;
        }



    </style>
<?php
}

add_action('wp_head', 'customizer_style_output');
