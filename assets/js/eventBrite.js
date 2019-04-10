$ = jQuery;

if(variables['eventBriteKey']){
    if($('#eventSelect').length){

        // var input = document.getElementById('eventLocation');
        // var autocomplete = new google.maps.places.Autocomplete(input);

        // autocomplete.addListener('place_changed', function() {
        //     var place = autocomplete.getPlace();
        //     $("#eventLat").val(place.geometry['location'].lat());
        //     $("#eventLng").val(place.geometry['location'].lng());
        //     createMap(place.geometry['location'].lat(), place.geometry['location'].lng())
        // });

        $.ajax({
            url: 'https://www.eventbriteapi.com/v3/users/me/events/?token='+variables['eventBriteKey'],
            dataType: 'json',
            success:function(success){
                var events = success['events'];
                var selected = '';
                for (var i = 0; i < events.length; i++) {
                    if(events[i].id == variables['currentEventID']){
                        selected = 'selected';
                    } else {
                        selected = ''
                    }
                    $('#eventSelect').append('<option '+selected+' value="'+events[i].id+'">'+events[i].name['text']+'</option>')
                }
                $('.loader').remove();

                if(variables['type'] === 'edit'){
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
                $('#eventSelect').fadeIn();
            },
            error:function(error){
                console.log(error);
            }
        })

        $('#eventSelect').change(function(){
            $('#eventDescription').hide();
            var value = $(this).val();
            if(value.length > 0){
                $( '<div class="loader"></div>').insertAfter($(this));
                $.ajax({
                    url: 'https://www.eventbriteapi.com/v3/events/'+value+'/?token='+variables['eventBriteKey']+'&expand=venue',
                    dataType: 'json',
                    success:function(event){
                        $("#title").focus().val(event.name['text']).blur();
                        $("#eventDescription").find('textarea').val(event.description['text']);
                        $("#eventStartTime").val(event.start['local']);
                        $("#eventEndTime").val(event.end['local']);
                        $('#eventStartTimeSelect').dateTimePicker({
                            selectData: $("#eventStartTime").val()
                        });
                        $('#eventEndTimeSelect').dateTimePicker({
                            selectData: $("#eventEndTime").val()
                        });
                        $("#eventLocation").val(event.venue['address'].localized_address_display)
                        $("#eventLat").val(event.venue['address'].latitude);
                        $("#eventLng").val(event.venue['address'].longitude);
                        $("#eventLink").val(event.url);
                        createMap(Number(event.venue['address'].latitude), Number(event.venue['address'].longitude));
                        $("#map").fadeIn();
                        $(".form-group").fadeIn();
                        $('.loader').remove();
                    },
                    error:function(error){
                        console.log(error)
                    }
                })
            } else {
                $(".form-group").fadeOut();
                $("#map").fadeOut();
            }
        })

        $("#eventLocation").change(function(){
            // var autocomplete = new google.maps.places.Autocomplete(input);

        });
    }

} else {
    $('.loader').remove();
    $('#normal-sortables .inside').append('<p>You need to include a Eventbrite API Key to add an event.</p>')
}


function createMap(lat, lng){
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: lat, lng: lng},
        zoom: 15,
        disableDoubleClickZoom: true,
        disableDefaultUI: true,
        fullscreenControl: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
    });
    var marker = new google.maps.Marker({
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
