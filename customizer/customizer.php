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
    /*
        Primary Colours
    */
    $wp_customize->add_setting(
        'primary_color_setting',
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
            'primary_color_control',
            array(
                'label'         => __( 'Primary Site Colour', 'whtn' ),
                'section'       => 'theme_style_section',
                'settings'      => 'primary_color_setting',
                'show_opacity'  => true
            )
        )
    );

    /*
        Header Sections
    */
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
    /*
        Footer Sections
    */
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
    /*
        Home Sections
    */
    $wp_customize->add_section('home_style_section', array(
        'title' => __('Home Page Content', 'whtn'),
        'priority' => 20,
    ));
    /*
        Home Image
    */
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
    /*
        Alert
    */
    $wp_customize->add_section('alert_section', array(
        'title' => __('Alert Settings', 'whtn'),
        'priority' => 20,
    ));

    $wp_customize->add_setting( 'alert_checkbox_setting', array(
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themeslug_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'alert_checkbox_control', array(
      'type' => 'checkbox',
      'section' => 'alert_section', // Add a default or your own section
      'label' => __( 'View Alert' ),
      'settings'      => 'alert_checkbox_setting',
      'description' => __( 'Do you want to see the alert on the front page.' ),
    ) );

    function themeslug_sanitize_checkbox( $checked ) {
      // Boolean check.
      return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }
    $wp_customize->add_setting('alert_heading_setting', array(
        'default' => 'Alert heading',
        'type'        => 'theme_mod',
        'capability'  => 'edit_theme_options',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'alert_heading_control',array(
            'label' => __('Alert Heading', 'whtn'),
            'section' => 'alert_section',
            'settings' => 'alert_heading_setting',
            'type' => 'text'
        )
    ));
    $wp_customize->add_setting('alert_text_setting', array(
        'default' => 'Alert Text',
        'type'        => 'theme_mod',
        'capability'  => 'edit_theme_options',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'alert_text_control',array(
            'label' => __('Alert Text', 'whtn'),
            'section' => 'alert_section',
            'settings' => 'alert_text_setting',
            'type' => 'textarea'
        )
    ));

    $args = array(
        'numberposts' => -1,
        'post_type'   => array('post', 'event')
    );
    $allPosts = get_posts($args);
    $options = array();
    $options[''] ='';
    foreach ($allPosts as $singlePost) {
        $options[$singlePost->ID] = $singlePost->post_title;
    }

    $wp_customize->add_setting('alert_post_url_setting', array(
        'default' => '',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'alert_post_url_control',
            array(
                'label' => __('Select Alert Link Post', 'whtn'),
                'section' => 'alert_section',
                'settings' => 'alert_post_url_setting',
                'type' => 'select',
                'choices' => $options
            )
        )
    );

    $wp_customize->add_setting('alert_url_setting', array(
        'default' => '',
        'type'        => 'theme_mod',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'alert_url_setting',array(
            'label' => __('Or Alert URL', 'whtn'),
            'section' => 'alert_section',
            'settings' => 'alert_url_setting',
            'type' => 'url'
        )
    ));




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
        .navbar-brand:hover,
        #headerNav li a,
        .navbar-light .navbar-brand{
            color: <?php echo get_theme_mod('header_text_setting', '#000000'); ?>;
        }

        header#header{
            background-color: <?php echo get_theme_mod('header_color_setting', '#228496'); ?>;
            <?php if(get_theme_mod('header_background_image_setting')): ?>
                /* background-image: url(<?php echo esc_url(get_background_image_url('header_background_image_setting')); ?>); */
                height: 300px;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            <?php endif; ?>
        }

        #homeBanner,
        #frontNav li a,
        .textContent hr{
            color: <?php echo get_theme_mod('front_text_color_setting', '#ffffff'); ?>;
        }

        .menuIcon .bar,
        #sponsorsList h3{
            color: <?php echo get_theme_mod('front_text_color_setting', '#ffffff'); ?>;
        }

        .btn-whtn{
            background-color: <?php echo get_theme_mod('primary_color_setting', '#228496'); ?>;
            border-color: <?php echo get_theme_mod('primary_color_setting', '#228496'); ?>;
            color: white;
        }

        .btn-whtn:hover{
            color: white;
            opacity: 0.8;
            text-decoration: underline;
        }

        .dateNumber{
            background-color: <?php echo get_theme_mod('primary_color_setting', '#228496'); ?> ;
        }

        .eventListItem h5,
        .eventListItem p,
        .eventListItem:hover h5,
        .eventListItem:hover p{
            color: <?php echo get_theme_mod('primary_color_setting', '#228496'); ?> ;
        }

        .alert_section{
            border-left-color: <?php echo get_theme_mod('primary_color_setting', '#228496'); ?> ;
        }

    </style>
<?php
}

add_action('wp_head', 'customizer_style_output');
