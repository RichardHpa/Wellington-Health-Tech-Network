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
    ),
    'audio_clip' => array(
        'title' => __('Audio Information', 'whtn'),
        'applicableto' => 'post',
        'location' => 'normal',
        'display_condition' => 'post-format-audio',
        'priority' => 'low',
        'fields' => array(
            'audio_link' => array(
                'title' => __('Link: ', 'whtn'),
                'type' => 'upload_audio',
                'description' => 'Insert the src url for the audio, will be found in the embed section',
                'size' => 100
            )
        )
    ),
    'upload_images' => array(
        'title' => __('Image', 'whtn'),
        'applicableto' => 'post',
        'location' => 'normal',
        'display_condition' => 'post-format-image',
        'priority' => 'low',
        'fields' => array(
            'image_link' => array(
                'title' => __('Image Upload: ', 'whtn'),
                'type' => 'upload_image',
                'description' => 'Upload your own custom image',
                'size' => 100
            )
        )
    ),
    'video_link' => array(
        'title' => __('Video Information', 'whtn'),
        'applicableto' => 'post',
        'location' => 'normal',
        'display_condition' => 'post-format-video',
        'priority' => 'low',
        'fields' => array(
            'video_upload' => array(
                'title' => __('Upload Video: ', 'whtn'),
                'type' => 'upload_video',
                'description' => 'Upload your own video',
                'size' => 100
            ),
            'video_link' => array(
                'title' => __('Embed URL Link: ', 'whtn'),
                'type' => 'link',
                'description' => 'Or Insert the embed src url for the video, will be found in the embed section',
                'size' => 100
            )
        )
    ),
    'external_link' => array(
        'title' => __('External Link', 'whtn'),
        'applicableto' => 'post',
        'location' => 'normal',
        'display_condition' => 'post-format-link',
        'priority' => 'low',
        'fields' => array(
            'ex_link' => array(
                'title' => __('Link to external Post', 'whtn'),
                'type' => 'external_link',
                'description' => 'Insert a external link to a web page',
                'size' => 100
            )
        )
    ),
    'slide_image' => array(
        'title' => __('Slide Image', 'whtn'),
        'applicableto' => 'slide',
        'location' => 'normal',
        'priority' => 'low',
        'fields' => array(
            'slide_image' => array(
                'title' => __('Image Slide', 'whtn'),
                'type' => 'upload_image',
                'description' => 'Upload an image for the front page Slideshow',
                'size' => 100
            )
        )
    ),
    'podcast_info' => array(
        'title' => __('Podcast Media', 'whtn'),
        'applicableto' => 'podcast',
        'location' => 'normal',
        'priority' => 'low',
        'fields' => array(
            'video_upload' => array(
                'title' => __('Upload Video Podcast: ', 'whtn'),
                'type' => 'upload_video',
                'description' => 'Upload your own video',
                'size' => 100
            ),
            'video_link' => array(
                'title' => __('Link to Video Podcast: ', 'whtn'),
                'type' => 'link',
                'description' => 'Or Insert the embed src url for the video, will be found in the embed section',
                'size' => 100
            ),
            'audio_upload' => array(
                'title' => __('Upload Audio Podcast: ', 'whtn'),
                'type' => 'upload_audio',
                'description' => 'Upload your own audio podcast',
                'size' => 100
            ),
            // 'audio_link' => array(
            //     'title' => __('Link to Audio Podcast: ', 'whtn'),
            //     'type' => 'upload_audio',
            //     'description' => 'Insert the src url for the audio, will be found in the embed section',
            //     'size' => 100
            // )
        )
    ),
    'slide_image' => array(
        'title' => __('Slide Image', 'whtn'),
        'applicableto' => 'sponsor',
        'location' => 'normal',
        'priority' => 'low',
        'fields' => array(
            'sponsor_url' => array(
                'title' => __('Sponsor Website url', 'whtn'),
                'type' => 'text',
                'description' => 'Include the url to the sponsors website',
                'size' => 100
            ),
            'sponsor_image' => array(
                'title' => __('Sponsor Image', 'whtn'),
                'type' => 'upload_image',
                'description' => 'Upload the sponsor image.',
                'size' => 100
            )
        )
    ),
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
                case 'text':
                    $output .= '<label for="'.$id.'" class="customLabel">'.$field['title'].'</label>';
                    $output .= '<p>'.$field['description'].'</p>';
                    $output .= '<input type="text" name="'.$id.'" class="customInput" value="'.$customValues[$id][0].'">';
                break;
                case 'eventSelect':
                    $output .= '<div class="loader"></div>';
                    $output .= '<select id="eventSelect" name="'.$id.'" class="customField">';
                        $output .= '<option value="">--Choose an Event--</option>';
                    $output .= '</select>';
                break;
                case 'eventTextarea':
                    if (is_edit_page('new')){
                        $output .= '<div class="form-group hide" id="eventDescription">';
                    } else {
                       $output .= '<div class="form-group show" id="eventDescription">';
                    }
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
                case 'upload_audio':
                    $audioID =  get_post_meta( $post->ID, $id, true );
                    if($audioID){
                        $audioSrc = wp_get_attachment_url( $audioID );
                        $audioClasses = "form-group validAudio";
                    } else{
                        $audioClasses = "form-group noAudio";
                    }
                    $output .= '<div class="'.$audioClasses.'">';
                        $output .= '<label for="'.$id.'" class="customLabel">'.$field['title'].'</label><br>';
                        $output .= '<p>'.$field['description'].'</p>';
                        $output .= '<audio controls class="dynamicInput">';
                            if($audioID){
                                $output .= '<source src="'.$audioSrc.'">';
                            } else {
                                $output .= '<source src="">';
                            }
                            $output .= 'Your browser does not support HTML5 Audio.';
                        $output .= '</audio>';
                        $output .= '<input type="hidden" value="'. $audioID .'" class="customInput regular-text hiddenCustomInput" name="'.$id.'" readonly>';
                        $output .= '<button data-type="audio" class="customUpload button customButton">Add Audio Clip</button>';
                        $output .= '<button data-type="audio" class="removeButton button customButton">Remove Audio Clip</button>';
                    $output .= '</div>';
                break;
                case 'upload_image':
                    $imageID =  get_post_meta( $post->ID, $id, true );
                    if($imageID){
                        $imagesrc = wp_get_attachment_image_url($imageID, 'header_image', false);
                        $imageClasses = "form-group validImage";
                    } else {
                        $imageClasses = "form-group noImage";
                    }
                    $output .= '<div class="'.$imageClasses.'">';
                        $output .= '<label for="'.$id.'" class="customLabel">'.$field['title'].'</label>';
                        $output .= '<p>'.$field['description'].'</p>';
                        $output .= '<img class="custom_image" src="'.$imagesrc.'">';
                        $output .= '<input type="hidden" value="' . $imageID . '" class="customInput regular-text hiddenCustomInput" name="'.$id.'" readonly>';
                        $output .= '<button data-type="image" class="customUpload button customButton">Add new Image</button>';
                        $output .= '<button data-type="image" class="removeButton button customButton">Remove Image</button>';
                    $output .= '</div>';
                break;
                case 'upload_video':
                    $videoID =  get_post_meta( $post->ID, $id, true );
                    if($videoID){
                        $videoSrc = wp_get_attachment_url( $videoID );
                        $videoClasses = "form-group validVideo";
                    } else {
                        $videoClasses = "form-group noVideo";
                    }
                    $output .= '<div class="'.$videoClasses.'">';
                        $output .= '<label for="'.$id.'" class="customLabel">'.$field['title'].'</label>';
                        $output .= '<p>'.$field['description'].'</p>';
                        $output .= '<video controls>';
                            if($videoID){
                                $output .= '<source src="'.$videoSrc.'">';
                            } else {
                                $output .= '<source src="">';
                            }
                            $output .= 'Your browser does not support HTML5 video.';
                        $output .= '</video>';
                        $output .= '<input type="hidden" value="' . $videoID . '" class="customInput regular-text hiddenCustomInput" name="'.$id.'" readonly>';
                        $output .= '<button data-type="video" class="customUpload button customButton">Add new Video</button>';
                        $output .= '<button data-type="video" class="removeButton button customButton">Remove Video</button>';
                    $output .= '</div>';
                break;
                case 'external_link':
                    $valid = $customValues[$id][0];
                    if($valid){
                        $html = file_get_contents($valid);
                        preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i',$html, $matches );
                        $imgURL = json_encode($matches[1][0]);
                        preg_match_all('/<title.*?>(.*)<\/title>/msi',$html, $subresult);
                        $urlHeading = $subresult[1][0];
                    }
                    $output .= '<div class="form-group">';
                        $output .= '<label for="'.$id.'" class="customLabel">'.$field['title'].'</label>';
                        $output .= '<p>'.$field['description'].'</p>';
                        $output .= '<input id="'.$id.'" type="link" name="'.$id.'" class="customInput customLinkInput" value="'.$customValues[$id][0].'">';
                        $output .= '<input type="hidden" name="externalLinkImageURL" value="'.esc_url($imgURL).'">';
                        $output .= '<input type="hidden" name="externalLinkHeading" value="'.$urlHeading.'">';
                        if($valid){
                            $output .= '<div class="scrapperCard">';
                                $output .= '<img class="custom_image" src="'.esc_url($imgURL).'">';
                                $output .= '<h3>'.$urlHeading.'</h3>';
                            $output .= '</div>';
                        }
                    $output .= '</div>';
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
