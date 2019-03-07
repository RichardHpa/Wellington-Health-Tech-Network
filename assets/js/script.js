$ = jQuery;

function cycleImages(){
      var $active = $('#cycler .active');
      console.log($active);
      // console.log($active);
      var $next = ($active.next().length > 0) ? $active.next() : $('#cycler .slide:first');
      $next.css('z-index',2);//move the next image up the pile
      $active.fadeOut(1500,function(){//fade out the top image
	  $active.css('z-index',1).show().removeClass('active');//reset the z-index and unhide the image
          $next.css('z-index',3).addClass('active');//make the next image the top one
      });
}

$(document).ready(function(){
// run every 7s
    setInterval('cycleImages()', 7000);
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
    console.log("here");
    var parent = $(this).parent();
    parent.find('.sub-menu').slideToggle();
    parent.find('i.fas').toggleClass('fa-caret-down fa-caret-up')
})


$(".menuIcon").click(function(){
    $(this).toggleClass('change');
    document.getElementById("myNav").style.width = "100%";
})
function closeNav() {
  document.getElementById("myNav").style.width = "0%";
  $(".menuIcon").toggleClass('change');
}

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
