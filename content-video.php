<?php if( is_singular() ): ?>
    <div class="row mb-3">
        <div class="col">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
    <?php if(get_post_meta( $post->ID , 'video_upload', true)): ?>
        <?php
            $videoID =  get_post_meta( $post->ID, 'video_upload', true );
            if($videoID){
                $videoSrc = wp_get_attachment_url( $videoID );
            }
        ?>
        <div class="row mb-3">
            <div class="col">
                <div class="videoWrapper">
                    <video class="thumbnailVideo" controls>
                        <source src="<?= $videoSrc; ?>">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    <?php elseif(get_post_meta( $post->ID , 'video_link', true)): ?>
        <?php
            $videoURL=  get_post_meta( $post->ID, 'video_link', true );
            $embed_code = wp_oembed_get($videoURL);
        ?>
        <div class="row mb-3">
            <div class="col">
                <div class="videoWrapper">
                    <?php echo $embed_code?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row mb-3">
        <div class="col">
            <div class="content">
                <div class="wp_content"><?php the_content(); ?></div>
            </div>
        </div>
    </div>
<?php else: ?>
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
                    <a href="<?= get_post_permalink() ?>" class="btn btn-whtn">Watch the Video</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
