<?php if( is_singular() ): ?>
    <div class="row mb-3">
        <div class="col">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
    <?php if(get_post_meta( $post->ID , 'image_link', true)): ?>
        <div class="row mb-3">
            <div class="col">
                <?php
                    $imageID =  get_post_meta( $post->ID, 'image_link', true );
                    if($imageID){
                        $imagSrc = wp_get_attachment_image_src( $imageID, 'large')[0];
                    }
                ?>
                <img src="<?= $imagSrc; ?>" class="img-fluid" alt="<?= get_the_title(); ?>">
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
            <?php elseif(get_post_meta( $post->ID , 'image_link', true)): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <?php
                        $imageID =  get_post_meta( $post->ID, 'image_link', true );
                        if($imageID){
                            $imagSrc = wp_get_attachment_image_src( $imageID, 'medium-large')[0];
                        }
                    ?>
                    <img src="<?= $imagSrc; ?>" class="img-fluid" alt="<?= get_the_title(); ?>">
                </div>
            <?php endif; ?>
            <div class="col p-2">
                <div class="card-block px-2">
                    <h6 class="text-muted"><?= get_the_date('F j, Y'); ?></h6>
                    <h4 class="card-title"><?php the_title(); ?></h4>
                    <?php the_excerpt(); ?>
                    <a href="<?= get_post_permalink() ?>" class="btn btn-whtn">View Post</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
