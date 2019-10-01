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


    $(".menuIcon").click(() => {
        $(".hiddenNav").addClass('navOpen');
        setTimeout(() => {
            navOpen = true;
        }, 500);
    });

    $('.closebtn').click(() => {
        $(".hiddenNav").removeClass('navOpen');
        setTimeout(() => {
            navOpen = false;
        }, 500);
    });

    $(document).click((event) => {
        if ((!$(event.target).closest(".hiddenNavContent").length) && (navOpen === true)) {
            $("#hiddenNav").removeClass('navOpen');
            navOpen = false;
        }
    });

    $(".menu-item-has-children > :first-child").click(function(e){
        e.preventDefault();
        var parent = $(this).parent();
        parent.find('.sub-menu').slideToggle();
        parent.find('i.fas').toggleClass('fa-caret-down fa-caret-up');
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
