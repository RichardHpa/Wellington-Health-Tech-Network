$ = jQuery;

if(variables['eventBriteKey']){
    if($('#eventSelect').length){
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
                $('.loader').remove();
                $('#eventSelect').fadeIn();
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
                        console.log(event.venue['address'].latitude);
                        $("#title").val(event.name['text']).blur();
                        $('#title-prompt-text').addClass('screen-reader-text');
                        $("#eventDescription").find('textarea').val(event.description['text']);
                        $("#eventStartTime").val(event.start['local']);
                        $("#eventEndTime").val(event.end['local']);
                        $('#eventStartTimeSelect').dateTimePicker({
                            selectData: $("#eventStartTime").val()
                        });
                        $('#eventEndTimeSelect').dateTimePicker({
                            selectData: $("#eventEndTime").val()
                        });
                        $("#eventLocation").val(event.venue['address'].localized_address_display);
                        $("#eventLat").val(event.venue['address'].latitude);
                        $("#eventLng").val(event.venue['address'].longitude);
                        $("#eventLink").val(event.url);
                        createMap(Number(event.venue['address'].latitude), Number(event.venue['address'].longitude));
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
        console.log(this.getPosition().lat());
        console.log(this.getPosition().lng());
        $("#eventLat").val(this.getPosition().lat());
        $("#eventLng").val(this.getPosition().lng());
    } );
}
