$ = jQuery;
$(document).ready(() => {
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
        $("#hiddenNav").addClass('navOpen');
        setTimeout(() => {
            navOpen = true;
        }, 500);
    });

    $('.closebtn').click(() => {
        $("#hiddenNav").removeClass('navOpen');
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

    $(".menu-item-has-children > :first-child").click((e) => {
        e.preventDefault();
        $(this).find('.sub-menu').slideToggle();
        $(this).find('i.fas').toggleClass('fa-caret-down fa-caret-up');
    });

});
