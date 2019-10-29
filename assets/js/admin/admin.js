$ = jQuery;

if(variables['eventBriteKey']){
    if($('#eventSelect').length){
        console.log('https://www.eventbriteapi.com/v3/users/me/events/?token='+variables['eventBriteKey']);
        $.ajax({
            url: 'https://www.eventbriteapi.com/v3/users/me/events/?token='+variables['eventBriteKey'],
            dataType: 'json',
            success:function(success){
                const events = success['events'];
                var selected = '';
                for (var i = 0; i < events.length; i++) {
                    if(events[i].id == variables['currentEventID']){
                        selected = 'selected';
                    } else {
                        selected = '';
                    }
                    $('#eventSelect').append('<option '+selected+' value="'+events[i].id+'">'+events[i].name['text']+'</option>');
                }
                $('#eventSelect').fadeIn();
                if(variables['pageType'] === 'edit'){
                    var editLat = $("#eventLat").val();
                    var editLng = $("#eventLng").val();
                    $('#eventStartTimeSelect').dateTimePicker({
                        selectData: $("#eventStartTime").val()
                    });
                    $('#eventEndTimeSelect').dateTimePicker({
                        selectData: $("#eventEndTime").val()
                    });
                    createMap(Number(editLat), Number(editLng));
                    $("#map").fadeIn();
                    $(".form-group").fadeIn();
                }
                $('.loader').remove();

            },
            error:function(error){
                console.log(error);
            }
        });

        $('#eventSelect').change(function(){
            const value = $(this).val();
            $(".form-group").hide();
            if(value.length > 0){
                $( '<div class="loader"></div>').insertAfter($(this));
                $.ajax({
                    url: 'https://www.eventbriteapi.com/v3/events/'+value+'/?token='+variables['eventBriteKey']+'&expand=venue',
                    dataType: 'json',
                    success:function(event){
                        const eventDetails = event;
                        console.log(eventDetails);
                        $.ajax({
                            url: 'https://www.eventbriteapi.com/v3/events/'+eventDetails.id+'/description/?token='+variables['eventBriteKey'],
                            dataType: 'json',
                            success:function(moreDetails){
                                console.log(moreDetails);
                                tinymce["editors"].eventDescriptionEditor.setContent(moreDetails.description);
                            },
                            error:function(err){
                                console.log(err);
                                console.log('error in getting more info about the event');
                            }
                        });

                        $("#title").val(eventDetails.name['text']).blur();
                        $('#title-prompt-text').addClass('screen-reader-text');
                        $("#eventBio").find('textarea').val(eventDetails.description['text']);
                        $("#eventStartTime").val(eventDetails.start['local']);
                        $("#eventEndTime").val(eventDetails.end['local']);
                        $('#eventStartTimeSelect').dateTimePicker({
                            selectData: $("#eventStartTime").val()
                        });
                        $('#eventEndTimeSelect').dateTimePicker({
                            selectData: $("#eventEndTime").val()
                        });
                        $("#eventLocation").val(eventDetails.venue['address'].localized_address_display);
                        $("#eventLat").val(eventDetails.venue['address'].latitude);
                        $("#eventLng").val(eventDetails.venue['address'].longitude);
                        $("#eventLink").val(eventDetails.url);
                        createMap(Number(eventDetails.venue['address'].latitude), Number(eventDetails.venue['address'].longitude));
                        $('.loader').remove();
                        $("#map").fadeIn();
                        $(".form-group").fadeIn();
                    },
                    error:function(error){
                        console.log(error);
                    }
                });
            }
        });
    }
} else {
    $('.loader').remove();
    $('#normal-sortables .inside').append('<p>You need to include a Eventbrite API Key to add an event.</p>');
}


function createMap(lat, lng){
    const map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: lat, lng: lng},
        zoom: 15,
        disableDoubleClickZoom: true,
        disableDefaultUI: true,
        fullscreenControl: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
    });
    let marker = new google.maps.Marker({
        position: {
            lat: lat,
            lng: lng
        },
        map: map,
        draggable:true,
    });
    google.maps.event.addListener( marker, 'dragend', function ( event ) {
        console.log(this);
        $("#eventLat").val(this.getPosition().lat());
        $("#eventLng").val(this.getPosition().lng());
        geocodePosition(marker.getPosition());
    } );

    function geocodePosition(pos) {
        let geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
                $("#eventLocation").val(responses[0].formatted_address);
            } else {
                console.log('Cannot determine address at this location.');
            }
        });
    }
}

$(document).on('change', '#podcastType', function(e){
    const val = $(this).val().toLowerCase();
    $('.podcastType').hide();
    $('.'+val).fadeIn().removeClass('hidden');
});

$(document).on('click', 'button[data-type="upload"]', function(e){
    e.preventDefault();
    const button = $(this);
    const formGroup = $(this).parent('.form-group');
    const types = formGroup.data('type').split(',');
    formGroup.find('.errors').remove();
    var items_frame;
    if ( items_frame ) {
        items_frame.open();
        return;
    }
    items_frame = wp.media.frames.items = wp.media({
        title: 'Add Media to Gallery',
        button: {
            text: 'Select or Upload a Media Item'
        },
        library: {
            type: types
        },
    });
    items_frame.open();

    items_frame.on( 'select', function() {
        const attachment = items_frame.state().get('selection').first().toJSON();
        if(!types.includes(attachment.type)){
            formGroup.prepend(`
                <div class="errors">
                    <p>Error: Must be a valid media type for this input. Please upload one of theset types: ${types} </p>
                </div>
            `);
        } else {
            formGroup.find('.hiddenCustomInput').val(attachment.id);
            switch(attachment.type){
                case 'audio':
                    formGroup.find('source').attr('src', attachment.url);
                    let audioPlayer = formGroup.find('audio');
                    audioPlayer.get(0).pause();
                    audioPlayer.get(0).load();
                break;
                case 'video':
                    formGroup.find('source').attr('src', attachment.url);
                    let videoPlayer = formGroup.find('video');
                    videoPlayer.get(0).pause();
                    videoPlayer.get(0).load();
                break;
                case 'image':
                    formGroup.find('img').attr('src', attachment.url);
                break;
            }
            formGroup.find('button[data-type="remove"]').removeClass('hidden');
        }
    });
});

$(document).on('click', 'button[data-type="remove"]', function(e){
    e.preventDefault();
    const formGroup = $(this).parent('.form-group');
    const types = formGroup.data('type').split(',');
    formGroup.find('.hiddenCustomInput').val('');
    switch(types[0]){
        case 'audio':
            formGroup.find('source').attr('src', '');
            let audioPlayer = formGroup.find('audio');
            audioPlayer.get(0).pause();
            audioPlayer.get(0).load();
        break;
        case 'video':
            formGroup.find('source').attr('src', '');
            let videoPlayer = formGroup.find('video');
            videoPlayer.get(0).pause();
            videoPlayer.get(0).load();
        break;
        case 'image':
            formGroup.find('img').attr('src', '');
        break;
    }

});
