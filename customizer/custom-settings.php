<?php


// function my_plugin_menu() {
// 	add_theme_page('My API Keys', 'API Keys', 'edit_theme_options', 'my-api-keys', 'my_api_function');
//
//     function my_api_function(){
//         echo '<h1 class="wp-heading-inline">Site API Information</h1>';
//     }
// }
// add_action('admin_menu', 'my_plugin_menu');
//
//
// function test_custom_settings () {
//     add_settings_section(
//     	'eg_setting_sectionq',
//     	'Example settings section in reading',
//     	'add_new_setting',
//     	'my-api-keys'
//     );
//
//     function add_new_setting(){
//         echo '<p>this is the new section</p>';
//     }
// }
// //admin hook defined in functions.php. This calls the above function at
// // initialization time.
// add_action('admin_init', 'test_custom_settings' );







function apikey_settings_init() {
    register_setting( 'apikey', 'apikey_options' );

    add_settings_section(
        'apikey_section_developers',
        __( 'Include your API keys here.', 'apikey' ),
        'apikey_section_developers_cb',
        'apikey'
    );

    add_settings_field(
        'apikey_field_google', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __( 'Google Maps API Key', 'apikey' ),
        'api_field_cb',
        'apikey',
        'apikey_section_developers',
        [
        'label_for' => 'apikey_field_google',
        'class' => 'apikey_row',
        'apikey_custom_data' => 'custom',
        ]
    );

    add_settings_field(
        'apikey_field_eventbrite', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __( 'Event Brite API Token', 'apikey' ),
        'api_field_cb',
        'apikey',
        'apikey_section_developers',
        [
        'label_for' => 'apikey_field_eventBrite',
        'class' => 'apikey_row',
        'apikey_custom_data' => 'custom',
        ]
    );


}
add_action( 'admin_init', 'apikey_settings_init' );

function apikey_section_developers_cb( $args ) {
 ?>
 <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'You need to make sure you include both of these keys if you want the website to work.', 'apikey' ); ?></p>
 <?php
}

function api_field_cb($args){
    $options = get_option( 'apikey_options' );
    // var_dump( $options );
    // output the field
    ?>
        <input
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
            type="text"
            name="apikey_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
            value="<?php echo $options[ $args['label_for'] ]; ?>"
            class="regular-text"
            data-custom="<?php echo esc_attr( $args['apikey_custom_data'] ); ?>"
        >
    <?php
}

function apikey_options_page() {
    // add top level menu page
    add_menu_page(
        'Your API Keys',
        'API Keys',
        'manage_options',
        'api-keys',
        'apikey_options_page_html',
        'dashicons-tickets-alt',
        76
    );
}
add_action( 'admin_menu', 'apikey_options_page' );



function apikey_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // add error/update messages

    // check if the user have submitted the settings
    // wordpress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
    // add settings saved message with the class of "updated"
        add_settings_error( 'apikey_messages', 'apikey_message', __( 'Settings Saved', 'apikey' ), 'updated' );
    }

    // show error/update messages
    settings_errors( 'apikey_messages' );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "wporg"
            settings_fields( 'apikey' );
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections( 'apikey' );
            // output save settings button
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>

    <?php
}
