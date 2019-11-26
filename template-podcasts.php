<?php
/* Template Name: Podcasts Page template */
get_header();
?>
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
            <div class="row">
                <div class="col">
                    <h2 class="display-4"><?= single_post_title(); ?></h2>
                </div>
            </div>
            <?php
                $args = array(
                    'post_type' => 'podcast',
                );
                $allPodcasts = new WP_Query($args);
            ?>

            <?php if( $allPodcasts->have_posts() ): ?>
                    <?php while($allPodcasts->have_posts()): $allPodcasts->the_post();?>
                        <?php
                            $podcastType =  get_post_meta( $post->ID, 'podcastType', true );
                            if($podcastType === 'Audio'){
                                $mediaID =  get_post_meta( $post->ID, 'audioUploader', true );
                                $mediaSrc = wp_get_attachment_url( $mediaID );
                                $mediaURL = get_post_meta( $post->ID, 'audioLink', true);
                            } else if($podcastType === 'Video'){
                                $mediaID =  get_post_meta( $post->ID, 'videoUploader', true );
                                $mediaSrc = wp_get_attachment_url( $mediaID );
                                $mediaURL = get_post_meta( $post->ID, 'videoLink', true);
                            }
                         ?>
                        <div class="card shadow-sm rounded-0 mb-4">
                            <div class="row">
                                <?php if(has_post_thumbnail()): ?>
                                    <div class="col-12 col-md-3 d-flex justify-content-center align-items-center">
                                        <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-fluid' ) ); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="col">
                                    <div class="card-body">
                                      <h5 class="card-title"><?php the_title(); ?></h5>
                                      <p class="card-text"><?php the_excerpt(); ?></p>
                                      <?php if($podcastType === 'Video'): ?>
                                          <?php if($mediaSrc): ?>
                                              <video class="mediaController" controls>
                                                  <source src="<?php echo $mediaSrc; ?>">
                                                  Your browser does not support HTML5 Videos.
                                              </video>
                                          <?php endif; ?>
                                          <a href="<?php the_permalink(); ?>" class="btn btn-whtn">Watch the Podcast Here</a>
                                      <?php elseif($podcastType === 'Audio'): ?>
                                          <?php if($mediaSrc): ?>
                                              <audio class="mediaController" controls>
                                                  <source src="<?php echo $mediaSrc; ?>">
                                                  Your browser does not support HTML5 Audio.
                                              </audio>
                                          <?php endif; ?>
                                          <a href="<?php the_permalink(); ?>" class="btn btn-whtn">Listen to the Podcast Here</a>
                                      <?php else: ?>
                                          <a href="<?php the_permalink(); ?>" class="btn btn-whtn">View More</a>
                                      <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile ?>
            <?php else: ?>
                <div class="row">
                    <div class="col">
                        <p>We currently don't have any podcasts at this time. Please check back agian later</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
