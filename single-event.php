<?php get_header(); ?>

<?php if(have_posts()): ?>
    <?php while(have_posts()): the_post();?>
        <div class="container">
            <div class="row pb-4">
                <div class="col-12 col-md-8">
                    <h1 id="eventTitle"><?php the_title(); ?></h1>
                    <h5><span id="startDate" data-time="<?= get_post_meta($id, 'eventStartTime', true)  ?>"></span> until <span id="endDate" data-time="<?= get_post_meta($id, 'eventEndTime', true)  ?>"></span></h5>

                    <h5 id="eventLocation"><?= get_post_meta($id, 'eventLocation', true)  ?></h5>
                </div>
                <div class="col-12 col-md-4 text-left text-md-right">
                    <a class="btn btn-whtn" href="<?= get_post_meta($id, 'eventLink', true)  ?>" target="blank">Register Here</a>
                    <div class="dropdown cal-dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-calendar-alt"></i> Add to Calendar
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a data-type="apple" class="dropdown-item" href="#"><i class="fab fa-apple"></i> Apple Calendar</a>

                        <a data-type="google" class="dropdown-item" target="_blank" href=""><i class="fab fa-google"></i> Google Calendar</a>
                      </div>
                    </div>

                    <!-- <div title="Add to Calendar" class="addeventatc">
                        Add to Calendar
                        <span class="start">03/05/2019 08:00 AM</span>
                        <span class="end">03/05/2019 10:00 AM</span>
                        <span class="timezone">America/Los_Angeles</span>
                        <span class="title">Summary of the event</span>
                        <span class="description">Description of the event</span>
                        <span class="location">Location of the event</span>
                    </div> -->
                </div>
            </div>
            <div class="row pb-4">
                <div class="col">
                    <div id="eventDesc" class="content">
                        <?= get_post_meta($id, 'eventDescription', true)  ?>
                    </div>
                </div>
            </div>
            <div class="row pb-4">
                <div class="col">
                    <div id="map" class="" data-lat="<?= get_post_meta($id, 'eventLat', true)  ?>" data-lng="<?= get_post_meta($id, 'eventLng', true)  ?>">

                    </div>
                </div>
            </div>
            <div class="row pb-4">
                <div class="col text-center">
                    <a class="btn btn-whtn" href="<?= get_post_meta($id, 'eventLink', true)  ?>" target="blank">Register Here</a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
