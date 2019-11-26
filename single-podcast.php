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
                                    <div class="card-body">
                                        <h1 class="card-title display-4"><?php the_title(); ?></h1>
                                        <p class="blockquote-footer"><?php the_date('F j, Y'); ?></p>
                                        <div class="wpContent">
                                            <?php the_content(); ?>
                                        </div>
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
                                         <?php if($podcastType === 'Video'): ?>
                                             <?php if($mediaSrc): ?>
                                                 <video class="mediaController" controls>
                                                     <source src="<?php echo $mediaSrc; ?>">
                                                     Your browser does not support HTML5 Videos.
                                                 </video>
                                             <?php endif; ?>
                                             <?php if($mediaURL): ?>
                                                 <div class="embedContainer">
                                                     <?php echo wp_oembed_get($mediaURL, array( 'width' => '100%' ) ); ?>
                                                 </div>
                                             <?php endif; ?>
                                         <?php elseif($podcastType === 'Audio'): ?>
                                             <?php if($mediaSrc): ?>
                                                 <audio class="mediaController" controls>
                                                     <source src="<?php echo $mediaSrc; ?>">
                                                     Your browser does not support HTML5 Audio.
                                                 </audio>
                                             <?php endif; ?>
                                             <?php if($mediaURL): ?>
                                                 <p class="my-0">This podcast is held on another website,</p>
                                                 <a href="<?php echo $mediaURL; ?>" class="btn btn-whtn" target="_blank">Click here to go to the Podcast</a>
                                             <?php endif; ?>
                                         <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
