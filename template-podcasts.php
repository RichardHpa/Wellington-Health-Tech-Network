<?php
/* Template Name: Podcasts Page template */

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
    $args = array(
        'post_type' => 'podcast',
        'posts_per_page' => 10,
    );
    $allPodcasts = new WP_Query($args);
?>

    <?php if( $allPodcasts->have_posts() ): ?>
        <div class="container">
            <?php while($allPodcasts->have_posts()): $allPodcasts->the_post();?>
                <div class="singlePost pb-2 pt-2 border-bottom">
                    <div class="row">
                        <?php if(has_post_thumbnail()): ?>
                            <div class="col-12 col-md-6 col-lg-4">
                                <?php the_post_thumbnail('medium_large', ['class' => 'img-fluid', 'title' => get_the_title()]); ?>
                            </div>
                        <?php elseif(get_post_meta( $post->ID , 'video_upload', true)): ?>
                            <?php
                                $videoID =  get_post_meta( $post->ID, 'video_upload', true );
                                if($videoID){
                                    $videoSrc = wp_get_attachment_url( $videoID );
                                }
                             ?>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="videoWrapper">
                                     <video class="thumbnailVideo" controls>
                                         <source src="<?= $videoSrc; ?>">
                                         Your browser does not support HTML5 video.
                                     </video>
                                 </div>
                             </div>
                         <?php elseif(get_post_meta( $post->ID , 'video_link', true)): ?>
                             <?php
                                 $videoURL=  get_post_meta( $post->ID, 'video_link', true );
                                 $embed_code = wp_oembed_get($videoURL);
                             ?>
                             <div class="col-12 col-md-6 col-lg-4">
                                 <div class="videoWrapper">
                                     <?php echo $embed_code?>
                                 </div>
                             </div>
                        <?php endif; ?>
                        <div class="col p-2">
                            <div class="card-block px-2">
                                <h6 class="text-muted"><?= get_the_date('F j, Y'); ?></h6>
                                <h4 class="card-title"><?php the_title(); ?></h4>
                                <?php the_excerpt(); ?>
                                <a href="<?= get_post_permalink() ?>" class="btn btn-whtn">View Podcast</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>


<?php get_footer(); ?>
