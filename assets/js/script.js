$ = jQuery;

function cycleImages(){
  var $active = $('#cycler .active');
  var $next = ($active.next().length > 0) ? $active.next() : $('#cycler .slide:first');
  $next.css('z-index',2);//move the next image up the pile
  $active.fadeOut(1500,function(){//fade out the top image
  $active.css('z-index',1).show().removeClass('active');//reset the z-index and unhide the image
      $next.css('z-index',3).addClass('active');//make the next image the top one
  });
}

$(document).ready(function(){
    // run every 7s
    if($('#cycler')){
        setInterval('cycleImages()', 7000);
    }

    // $('a[data-type="google"]').attr('href', href);
})

$(".cal-dropdown a").click(function(e){
    e.preventDefault();
    var button = $(this);
    var event = {
        title: $("#eventTitle").text(),
        startDate: moment($("#startDate").data('time')).format("M/D/YYYY h:mm a"),
        endDate: moment($("#endDate").data('time')).format("M/D/YYYY h:mm a"),
        location: $("#eventLocation").text(),
        description: $("#eventDesc").text().trim()
    }

    switch(button.data('type')){
        case 'apple':
        cal = ics();

        cal_single = ics();
        cal_single.addEvent(
            event['title'],
            event['description'],
            event['location'],
            event['startDate'],
            event['endDate']);
            cal_single.download(event['title']);
        break;
        case 'google':
        var formatTime = function(date) {
           console.log(date);
         return date.toISOString().replace(/-|:|\.\d+/g, '');
       };
        var date = $("#startDate").data('time');
        var endDate2 = $("#endDate").data('time');
        var a = new Date(date);
        var b = new Date(endDate2);
        var href = encodeURI([
              'https://www.google.com/calendar/render',
              '?action=TEMPLATE',
              '&text=' + event['title'],
              '&dates=' + formatTime(a),
              '/' + formatTime(b),
              '&details=' + event['description'],
              '&location=' + event['location'],
              '&sprop=&sprop=name:'
            ].join(''));
            window.open(href, '_blank');
        break;
    }


})

var currentTabs = $("li.active");
currentTabs.each(function(){
    if($(this).parents('.dropdown-menu').length){
        $(this).parents('.dropdown-menu').addClass('show');
    }
});

// console.log($(".menu-item-has-children a:first-child"));
$(".menu-item-has-children > :first-child").click(function(e){
    e.preventDefault();
    var parent = $(this).parent();
    parent.find('.sub-menu').slideToggle();
    parent.find('i.fas').toggleClass('fa-caret-down fa-caret-up')
})


$(".menuIcon").click(function(){
    $(this).toggleClass('change');
    $("#myNav").addClass('navOpen');
})
function closeNav() {
  $(".menuIcon").toggleClass('change');
  $("#myNav").removeClass('navOpen');
}

if($('#map').length){
    $("#startDate").text(moment($("#startDate").data('time')).format("MMMM Do YYYY, h:mm a"));
    $("#endDate").text(moment($("#endDate").data('time')).format("MMMM Do YYYY, h:mm a"));

    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: Number($('#map').data('lat')), lng: Number($('#map').data('lng'))},
        zoom: 15,
        disableDoubleClickZoom: true,
        disableDefaultUI: true,
        fullscreenControl: false,
        scrollwheel: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
        draggable: false,
    });
    var marker = new google.maps.Marker({position: {
        lat: Number($('#map').data('lat')),
        lng: Number($('#map').data('lng'))
    }, map: map});
}
