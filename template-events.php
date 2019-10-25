<?php
/* Template Name: Events Page template */
get_header();
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3">
            <div id="calendar"></div>
            <button id="showAllEvents" class="btn btn-whtn btn-block btn-sm">Show All</button>
        </div>
        <div class="col-12 col-md">
            <div class="row">
                <div class="col">
                    <h2 class="display-4"><?= single_post_title(); ?></h2>
                </div>
            </div>
            <?php
            $today = date("Y/m/d");
            $args = array(
                'post_type' => 'event',
                'posts_per_page' => 10,
                'order'=> 'ASC',
                'orderby'=> 'meta_value',
                'meta_key'=> 'eventStartTime',
                'meta_query' => array(
                    'key' => 'eventStartTime',
                    'value' => $today,
                    'compare' => '>=',
                    'type' => 'date'
                )
            );
            $allEvents = new WP_Query($args);
            $currentMonth;
            $i = 1;
            ?>
            <?php if( $allEvents->have_posts() ): ?>
                <div class="row">
                    <div id="eventsList" class="col-12">
                        <?php $today = date("Y/m/d") ?>
                        <?php while($allEvents->have_posts()): $allEvents->the_post();?>
                            <div class="card mb-3 rounded-0 eventCard">
                                <a href="<?= esc_url(get_permalink()); ?>">
                                    <div class="row no-gutters">
                                        <div class="col-md">
                                            <div class="card-body">
                                                <h5 class="card-title mb-0"><?php the_title(); ?></h5>
                                                <p class="card-text mb-0"><small class="text-muted"><?= date("g:i A",strtotime(get_post_meta(get_the_ID(), 'eventStartTime', true)));?></small></p>
                                                <p class="card-text"><?= get_post_meta(get_the_ID(), 'eventBio', true); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
