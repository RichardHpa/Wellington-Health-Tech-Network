<?php
$metaboxes = array(
    'staff' => array(
        'title' => 'Event Information',
        'applicableto' => 'event',
        'location' => 'normal',
        'priority' => 'high',
        'fields' => array(
            'selectEvent' => array(
                'title' => 'Select an event',
                'type' => 'eventSelect',
                'description' => 'You need to add an event to eventbrite first, then come here and select the event you are wanting to add.'
            ),
            'eventDescription' => array(
                'title' => 'Event Description',
                'type' => 'eventTextarea'
            ),
            'eventStartTime' => array(
                'title' => 'Event Start Time (NZST)',
                'type' => 'eventTime'
            ),
            'eventEndTime' => array(
                'title' => 'Event End Time (NZST)',
                'type' => 'eventTime'
            ),
            'eventLocation' => array(
                'title' => 'Event Location',
                'type' => 'eventLocation'
            ),
            'eventLat' => array(
                'title' => 'Event Latitude',
                'type' => 'eventLatLng'
            ),
            'eventLng' => array(
                'title' => 'Event Longitude',
                'type' => 'eventLatLng'
            ),
            'eventGoogleMap' => array(
                'title' => 'Event Location',
                'type' => 'eventMap'
            ),
            'eventLink' => array(
                'title' => 'Event Link',
                'type' => 'hidden'
            )
        )
    )
);

function add_post_format_metabox() {
    global $metaboxes;
    if ( ! empty( $metaboxes ) ) {
        foreach ( $metaboxes as $id => $metabox ) {
            add_meta_box( $id, $metabox['title'], 'show_metaboxes', $metabox['applicableto'], $metabox['location'], $metabox['priority'], $id );
        }
    }
}
add_action( 'admin_init', 'add_post_format_metabox' );
function show_metaboxes($post, $args){
    global $metaboxes;
    $fields = $metaboxes[$args['id']]['fields'];
    $customValues = get_post_custom($post->ID);
    $output = '<input type="hidden" name="post_format_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'">';
    if(! empty($fields)){
        foreach ($fields as $id => $field) {
            switch($field['type']){
                case 'eventSelect':
                    $output .= '<div class="loader"></div>';
                    $output .= '<select id="eventSelect" name="'.$id.'" class="customField">';
                        $output .= '<option value="">--Choose an Event--</option>';
                    $output .= '</select>';
                break;
                case 'eventTextarea':
                    $output .= '<div class="form-group hide" id="eventDescription">';
                        $output .= '<label for="'.$id.'" class="customLabel">'.$field['title'].'</label>';
                        $output .= '<textarea name="'.$id.'" class="EventDecs" rows="10">'.$customValues[$id][0].'</textarea>';
                    $output .= '</div>';
                break;
                case 'eventTime':
                    $output .= '<div class="form-group hide">';
                        $output .= '<label for="'.$id.'" class="customLabel">'.$field['title'].'</label>';
                        $output .= '<div id="'.$id.'Select" class="customInput"> </div>';
                        $output .= '<input id="'.$id.'" name="'.$id.'" type="hidden" value="'.$customValues[$id][0].'">';
                    $output .= '</div>';
                break;
                case 'eventLocation':
                    $output .= '<div class="form-group hide">';
                        $output .= '<label for="'.$id.'" class="customLabel">'.$field['title'].'</label>';
                        $output .= '<input id="'.$id.'" type="text" name="'.$id.'" class="customInput" value="'.$customValues[$id][0].'">';
                    $output .= '</div>';
                break;
                case 'eventLatLng':
                    $output .= '<div class="form-group alwaysHidden">';
                        $output .= '<label for="'.$id.'" class="customLabel">'.$field['title'].'</label>';
                        $output .= '<input id="'.$id.'" type="text" name="'.$id.'" class="customInput" value="'.$customValues[$id][0].'">';
                    $output .= '</div>';
                break;
                case 'eventMap':
                    $output .= '<div id="map" class="hide">';
                    $output .= '</div>';
                break;
                case 'hidden':
                    $output .= '<input id="'.$id.'" type="hidden" name="'.$id.'" class="customInput" value="'.$customValues[$id][0].'">';
                 break;
                default:
                    $output .= '<div class="form-group">';
                        $output .= '<label for="'.$id.'" class="customLabel">'.$field['title'].'</label>';
                        $output .= '<p>'.$field['description'].'</p>';
                        $output .= '<input id="'.$id.'" type="text" name="'.$id.'" class="customInput" value="'.$customValues[$id][0].'">';
                    $output .= '</div>';
                break;
            }
        }
    }
    echo $output;
}
function save_metaboxes($postID){
    global $metaboxes;
    if(! wp_verify_nonce( $_POST['post_format_meta_box_nonce'], basename(__FILE__) )){
        return $postID;
    }
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return $postID;
    }
    if($_POST['post_type'] == 'page'){
        if(! current_user_can('edit_page', $postID) ){
            return $postID;
        }
    } elseif(! current_user_can('edit_page', $postID) ){
        return $postID;
    }
    $post_type = get_post_type();
    foreach($metaboxes as $id => $metabox){
        if( $metabox['applicableto'] == $post_type ){
            $fields = $metaboxes[$id]['fields'];
            foreach ($fields as $id => $field) {
                $oldValue = get_post_meta($postID, $id, true);
                $newValue = $_POST[$id];
                if($newValue && $newValue != $oldValue){
                    update_post_meta($postID, $id, $newValue);
                } elseif($newValue == '' && $oldValue || !isset($_POST[$id])){
                    delete_post_meta($postID, $id, $oldValue);
                }
            }
        }
    }
    if($_POST['externalLinkImageURL']){
        update_post_meta( $postID, 'externalLinkImageURL', $_POST['externalLinkImageURL'] );
    } else {
        delete_post_meta( $postID, 'externalLinkImageURL');
    }
    if($_POST['externalLinkHeading']){
        update_post_meta( $postID, 'externalLinkHeading', $_POST['externalLinkHeading'] );
    } else {
        delete_post_meta( $postID, 'externalLinkHeading');
    }
}
add_action('save_post', 'save_metaboxes');
