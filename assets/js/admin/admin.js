$ = jQuery;
// console.log(variables);
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
                                // console.log(tinymce["editors"].eventDescriptionEditor).setContent(moreDetails);
                                tinymce["editors"].eventDescriptionEditor.setContent(moreDetails.description);
                                // $('.eventDescriptionEditor').empty().append(moreDetails);

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
