<?php get_header(); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card p-4">
                <?php $sidebarImg = get_theme_mod('whtn_sidebar_image_setting');?>
                <img src="<?=$sidebarImg ?>" class="img-fluid align-self-center">
                <p class="mt-3"><?= get_theme_mod('whtn_sidebar_text_setting'); ?></p>
            </div>
        </div>
        <div class="col-12 col-md-9">
            <?php if(have_posts()): ?>
                <?php while(have_posts()): the_post();?>
                    <div class="card shadow-sm rounded-0 mb-4">
                        <div class="row">
                            <div class="col">
                                <?php if(has_post_thumbnail()): ?>
                                    <div class="card-img-header" style="background-image: url('<?= get_the_post_thumbnail_url(); ?>');"></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <h1 id="eventTitle" class="card-title display-4"><?php the_title(); ?></h1>
                                            <a class="btn btn-whtn" href="<?= get_post_meta($id, 'eventLink', true)  ?>" target="blank">Register Here</a>
                                            <div class="dropdown d-inline cal-dropdown">
                                                <button class="btn btn-whtn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-calendar-alt"></i> Add to Calendar
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a data-type="apple" class="dropdown-item" href="#"><i class="fab fa-apple"></i> Apple Calendar</a>

                                                    <a data-type="google" class="dropdown-item" target="_blank" href=""><i class="fab fa-google"></i> Google Calendar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <h6 id="eventLocation"><?= get_post_meta($id, 'eventLocation', true)  ?></h6>
                                            <p class="blockquote-footer"><span id="startDate" data-time="<?= get_post_meta(get_the_ID(), 'eventStartTime', true)  ?>"></span> until <span id="endDate" data-time="<?= get_post_meta(get_the_ID(), 'eventEndTime', true)  ?>"></span></p>
                                            <p id="eventBio"><?= get_post_meta(get_the_ID(), 'eventBio', true); ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="wpContent">
                                        <?= get_post_meta(get_the_ID(), 'eventDescriptionEditor', true); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="map" data-lat="<?= get_post_meta($id, 'eventLat', true); ?>" data-lng="<?= get_post_meta($id, 'eventLng', true); ?>"></div>
                    </div>
                <?php endwhile ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
