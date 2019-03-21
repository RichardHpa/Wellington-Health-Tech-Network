<?php
/* Template Name: Events Page template */

get_header();
 ?>
 <?php if(have_posts()): ?>
     <?php while(have_posts()): the_post();?>
         <div class="container">
             <div class="row">
                 <div class="col">
                     <h1><?php the_title(); ?></h1>
                 </div>
             </div>
             <div class="row">
                 <div class="col">
                     <div class="">
                        <?php the_content(); ?>
                     </div>
                 </div>
             </div>
         </div>
     <?php endwhile; ?>
 <?php endif; ?>

<?php

    $period = date("Y-m-d");
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => 10,
        'order'=> 'ASC',
        'orderby'=> 'meta_value',
        'meta_key'=>'eventStartTime',
    );
    $allEvents = new WP_Query($args);
    $currentMonth;
    $i = 1;
?>

    <?php if( $allEvents->have_posts() ): ?>
        <?php $today = date("Y/m/d") ?>
        <ul class="eventList">
            <?php while($allEvents->have_posts()): $allEvents->the_post();?>
                <?php $startDateTime = date("Y/m/d",strtotime(get_post_meta($id, 'eventStartTime', true))); ?>

                <?php if($today < $startDateTime): ?>
                    <?php $month = date("F",strtotime(get_post_meta($id, 'eventStartTime', true))); ?>
                    <?php if((!isset($currentMonth) || $currentMonth != $month) && $i !== 1): ?>
                        </ul>
                    <?php endif; ?>
                    <?php if(!isset($currentMonth) || $currentMonth != $month): ?>
                        <?php $currentMonth = $month;   ?>
                        <li class="dateMonth"><?php echo $month; ?></li>
                        <ul class="eventMonth">
                    <?php endif; ?>
                    <li class="eventListItem">
                        <a href="<?= esc_url(get_permalink()); ?>">
                            <div class="row">
                                <div class="col-1 dateNumber">
                                    <?= date("jS",strtotime(get_post_meta($id, 'eventStartTime', true)));  ?>
                                </div>
                                <div class="col eventContent">
                                    <h5><?php the_title(); ?></h5>
                                    <p><?= date("g:i a",strtotime(get_post_meta($id, 'eventStartTime', true)));  ?></p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php $i++; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>


<?php get_footer(); ?>
