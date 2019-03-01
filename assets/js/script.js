$ = jQuery;

var currentTabs = $("li.active");
currentTabs.each(function(){
    if($(this).parents('.dropdown-menu').length){
        $(this).parents('.dropdown-menu').addClass('show');
    }
});



if($('#map').length){
    $("#startDate").text(moment($("#startDate").data('time')).format("MMMM Do YYYY, h:mm a"));
    $("#endDate").text(moment($("#endDate").data('time')).format("MMMM Do YYYY, h:mm a"));

    // var map = new google.maps.Map(document.getElementById('map'), {
    //     center: {lat: Number($('#map').data('lat')), lng: Number($('#map').data('lng'))},
    //     zoom: 15,
    //     disableDoubleClickZoom: true,
    //     disableDefaultUI: true,
    //     fullscreenControl: false,
    //     scrollwheel: false,
    //     navigationControl: false,
    //     mapTypeControl: false,
    //     scaleControl: false,
    //     draggable: false,
    // });
    // var marker = new google.maps.Marker({position: {
    //     lat: Number($('#map').data('lat')),
    //     lng: Number($('#map').data('lng'))
    // }, map: map});
}
