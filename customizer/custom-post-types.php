<?php

function events_init() {
    $labels = array(
        'name'               => _x( 'Events', 'whtn' ),
        'singular_name'      => _x( 'Event', 'whtn' ),
        'menu_name'          => _x( 'Events', 'whtn' ),
        'name_admin_bar'     => _x( 'Event', 'whtn' ),
        'add_new'            => _x( 'Add a new Event', 'whtn' ),
        'add_new_item'       => __( 'Add a new Event', 'whtn' ),
        'new_item'           => __( 'New Event', 'whtn' ),
        'edit_item'          => __( 'Edit Event', 'whtn' ),
        'view_item'          => __( 'View Event', 'whtn' ),
        'all_items'          => __( 'All Events', 'whtn' ),
        'search_items'       => __( 'Search Events', 'whtn' ),
        'parent_item_colon'  => __( 'Parent Event:', 'whtn' ),
        'not_found'          => __( 'No Events found.', 'whtn' ),
        'not_found_in_trash' => __( 'No Events found in Trash.', 'whtn' )
    );
    $args = array(
      'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-tickets-alt',
        'supports' => array(
            'title')
        );
    register_post_type( 'event', $args );
}
add_action( 'init', 'events_init' );

function my_admin_enqueue_scripts() {
    if ( 'event' == get_post_type() )
        wp_dequeue_script( 'autosave' );
}
add_action( 'admin_enqueue_scripts', 'my_admin_enqueue_scripts' );

function slider_init(){
    $labels = array(
        'name'               => _x( 'Slides', 'whtn' ),
        'singular_name'      => _x( 'Slide', 'whtn' ),
        'menu_name'          => _x( 'Slides', 'whtn' ),
        'name_admin_bar'     => _x( 'Slide', 'whtn' ),
        'add_new'            => _x( 'Add a new Slide', 'whtn' ),
        'add_new_item'       => __( 'Add a new Slide', 'whtn' ),
        'new_item'           => __( 'New Slide', 'whtn' ),
        'edit_item'          => __( 'Edit Slide', 'whtn' ),
        'view_item'          => __( 'View Slide', 'whtn' ),
        'all_items'          => __( 'All Slides', 'whtn' ),
        'search_items'       => __( 'Search Slides', 'whtn' ),
        'parent_item_colon'  => __( 'Parent Slide:', 'whtn' ),
        'not_found'          => __( 'No Slides found.', 'whtn' ),
        'not_found_in_trash' => __( 'No Slides found in Trash.', 'whtn' )
    );
    $args = array(
      'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'query_var' => false,
        'menu_icon' => 'dashicons-slides',
        'supports' => array(
            'title')
        );
    register_post_type( 'slide', $args );
}
add_action( 'init', 'slider_init' );

function podcast_init(){
    $labels = array(
        'name'               => _x( 'Podcasts', 'whtn' ),
        'singular_name'      => _x( 'Podcast', 'whtn' ),
        'menu_name'          => _x( 'Podcasts', 'whtn' ),
        'name_admin_bar'     => _x( 'Podcast', 'whtn' ),
        'add_new'            => _x( 'Add a new Podcast', 'whtn' ),
        'add_new_item'       => __( 'Add a new Podcast', 'whtn' ),
        'new_item'           => __( 'New Podcast', 'whtn' ),
        'edit_item'          => __( 'Edit Podcast', 'whtn' ),
        'view_item'          => __( 'View Podcast', 'whtn' ),
        'all_items'          => __( 'All Podcasts', 'whtn' ),
        'search_items'       => __( 'Search Podcasts', 'whtn' ),
        'parent_item_colon'  => __( 'Parent Podcast:', 'whtn' ),
        'not_found'          => __( 'No Podcasts found.', 'whtn' ),
        'not_found_in_trash' => __( 'No Podcasts found in Trash.', 'whtn' )
    );
    $args = array(
      'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'query_var' => false,
        'menu_icon' => 'dashicons-microphone',
        'supports' => array(
            'title',
            'editor',
            'thumbnail')
        );
    register_post_type( 'podcast', $args );
}
add_action( 'init', 'podcast_init' );

function meta_box_scripts() {
    global $post;
    wp_enqueue_media( array(
        'post' => $post->ID,
    ) );
}
add_action( 'admin_enqueue_scripts', 'meta_box_scripts' );





function sponsors_init() {
    $labels = array(
        'name'               => _x( 'Sponsors', 'whtn' ),
        'singular_name'      => _x( 'Sponsor', 'whtn' ),
        'menu_name'          => _x( 'Sponsors', 'whtn' ),
        'name_admin_bar'     => _x( 'Sponsor', 'whtn' ),
        'add_new'            => _x( 'Add a new Sponsor', 'whtn' ),
        'add_new_item'       => __( 'Add a new Sponsor', 'whtn' ),
        'new_item'           => __( 'New Sponsor', 'whtn' ),
        'edit_item'          => __( 'Edit Sponsor', 'whtn' ),
        'view_item'          => __( 'View Sponsor', 'whtn' ),
        'all_items'          => __( 'All Sponsors', 'whtn' ),
        'search_items'       => __( 'Search Sponsors', 'whtn' ),
        'parent_item_colon'  => __( 'Parent Sponsor:', 'whtn' ),
        'not_found'          => __( 'No Sponsors found.', 'whtn' ),
        'not_found_in_trash' => __( 'No Sponsors found in Trash.', 'whtn' )
    );
    $args = array(
          'labels' => $labels,
          'public' => false,
          'show_ui' => true,
          'capability_type' => 'post',
          'hierarchical' => false,
          'query_var' => false,
        'menu_icon' => 'dashicons-groups',
        'supports' => array(
            'title')
        );
    register_post_type( 'sponsor', $args );
}
add_action( 'init', 'sponsors_init' );
