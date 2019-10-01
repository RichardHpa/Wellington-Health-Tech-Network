$ = jQuery;
$(document).ready(() => {
    setTimeout(() => {
        $('.toast').toast('show');
    }, 0);


    if($('.backgroundSlider')){
        if($('.backgroundSlider').find('.slide').length > 1){
            setInterval(() => {
                let $active = $('.backgroundSlider .active');
                let $next = ($active.next().length > 0) ? $active.next() : $('.backgroundSlider .slide:first');
                $next.css('z-index',2);//move the next image up the pile
                $active.fadeOut(1500,() => {//fade out the top image
                    $active.css('z-index',1).show().removeClass('active');//reset the z-index and unhide the image
                    $next.css('z-index',3).addClass('active');//make the next image the top one
                });
            }, local_values.duration * 1000);
        }
    }

    let navOpen = false;


    $('.menuIcon').click(() => {
        $('.hiddenNav').addClass('navOpen');
        setTimeout(() => {
            navOpen = true;
        }, 500);
    });

    $('.closebtn').click(() => {
        $('.hiddenNav').removeClass('navOpen');
        setTimeout(() => {
            navOpen = false;
        }, 500);
    });

    $(document).click((event) => {
        if ((!$(event.target).closest('.hiddenNavContent').length) && (navOpen === true)) {
            $('#hiddenNav').removeClass('navOpen');
            navOpen = false;
        }
    });

    $('.menu-item-has-children > :first-child').click(function(e){
        e.preventDefault();
        var parent = $(this).parent();
        parent.find('.sub-menu').slideToggle();
        parent.find('i.fas').toggleClass('fa-caret-down fa-caret-up');
    });

    if($('#map').length){
        $('#startDate').text(moment($('#startDate').data('time')).format('MMMM Do YYYY, h:mm a'));
        $('#endDate').text(moment($('#endDate').data('time')).format('MMMM Do YYYY, h:mm a'));

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

    $('.cal-dropdown a').click(function(e){
        e.preventDefault();
        var button = $(this);
        var event = {
            title: $('#eventTitle').text(),
            startDate: moment($('#startDate').data('time')).format('M/D/YYYY h:mm a'),
            endDate: moment($('#endDate').data('time')).format('M/D/YYYY h:mm a'),
            location: $('#eventLocation').text(),
            bio: $('#eventBio').text()
        };
        console.log(event);
        switch(button.data('type')){
            case 'apple':
            cal = ics();
            cal_single = ics();
            cal_single.addEvent(
                event['title'],
                event['bio'],
                event['location'],
                event['startDate'],
                event['endDate']
            );
            cal_single.download(event['title']);
            break;
            case 'google':
            var formatTime = function(date) {

                return date.toISOString().replace(/-|:|\.\d+/g, '');
            };
            var date = $('#startDate').data('time');
            var endDate2 = $('#endDate').data('time');
            var a = new Date(date);
            var b = new Date(endDate2);
            var href = encodeURI([
                'https://www.google.com/calendar/render',
                '?action=TEMPLATE',
                '&text=' + event['title'],
                '&dates=' + formatTime(a),
                '/' + formatTime(b),
                '&location=' + event['location'],
                '&sprop=&sprop=name:'
            ].join(''));
            window.open(href, '_blank');
            break;
        }
    });

});

var el = document.getElementById('calendar');
if(el){
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'dayGrid', 'bootstrap' ],
            themeSystem: 'bootstrap',
            events: local_values.events,
            height: 'auto',
            header: {
                left:   'title prev,next',
                center: '',
                right:  ''
            },
            footer: {
                left:   '',
                center: '',
                right:  ''
            },
            validRange: {
                start: moment().startOf('month').format('YYYY-MM-DD')
            },
            columnHeaderText: function(date) {
                return moment(date).format('dd');
            },
            eventLimit: false,
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                // console.log(info.event.start);
                console.log(moment(info.event.start).format('MMMM'));
            }
        });

        calendar.render();

    });

}
