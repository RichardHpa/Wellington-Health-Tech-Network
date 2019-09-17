$ = jQuery;
$(document).ready(function(){
    if($('.backgroundSlider')){
        if($('.backgroundSlider').find('.slide').length > 1){
            setInterval(function(){
                 let $active = $('.backgroundSlider .active');
                 let $next = ($active.next().length > 0) ? $active.next() : $('.backgroundSlider .slide:first');
                 $next.css('z-index',2);//move the next image up the pile
                 $active.fadeOut(1500,function(){//fade out the top image
                 $active.css('z-index',1).show().removeClass('active');//reset the z-index and unhide the image
                     $next.css('z-index',3).addClass('active');//make the next image the top one
                 });
            }, local_values.duration * 1000);
        }
    }

});
