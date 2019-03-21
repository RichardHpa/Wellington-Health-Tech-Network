<?php get_header(); ?>

<?php if(have_posts()): ?>
    <?php while(have_posts()): the_post();?>
        <div class="container">
            <div class="row pb-4">
                <?php if(has_post_thumbnail()): ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <?php the_post_thumbnail('medium_large', ['class' => 'img-fluid', 'title' => get_the_title()]); ?>
                    </div>
                <?php endif; ?>
                <div class="col">
                    <h1><?php the_title(); ?></h1>
                    <h6 class="text-muted"><?= get_the_date('F j, Y'); ?></h6>
                    <div class="">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

            <?php if(get_post_meta( $post->ID , 'video_upload', true)): ?>
                <?php
                    $videoID =  get_post_meta( $post->ID, 'video_upload', true );
                    if($videoID){
                        $videoSrc = wp_get_attachment_url( $videoID );
                    }
                 ?>
                 <div class="row pb-4">
                     <div class="col-12">
                         <div class="videoWrapper">
                              <video class="thumbnailVideo" controls>
                                  <source src="<?= $videoSrc; ?>">
                                  Your browser does not support HTML5 video.
                              </video>
                          </div>
                      </div>
                 </div>
            <?php elseif(get_post_meta( $post->ID , 'video_link', true)): ?>
                <?php
                    $videoURL=  get_post_meta( $post->ID, 'video_link', true );
                    $embed_code = wp_oembed_get($videoURL);
                ?>
                <div class="row pb-4">
                    <div class="col-12">
                        <div class="videoWrapper">
                            <?php echo $embed_code?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(get_post_meta( $post->ID , 'audio_upload', true)): ?>
                <?php
                    $audioID =  get_post_meta( $post->ID, 'audio_upload', true );
                    if($audioID){
                        $audioSrc = wp_get_attachment_url( $audioID );
                    }
                ?>
                <div class="row pb-4">
                    <div class="col">
                        <div class="audioWrapper">
                            <audio controls>
                                <source src="<?= $audioSrc ?>">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
