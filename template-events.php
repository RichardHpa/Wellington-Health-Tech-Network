<?php
/* Template Name: Events Page template */
get_header();
 ?>
 <div class="container mt-5">
     <div class="row">
         <div class="col-12 col-md-4">
             <div class="card p-4">
                 <p>Calendar</p>
             </div>
         </div>
         <div class="col-12 col-md-7">
             <div class="row">
                 <div class="col">
                     <h2 class="display-4"><?= single_post_title(); ?></h2>
                 </div>
             </div>
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
         </div>
     </div>
 </div>

<?php get_footer(); ?>
