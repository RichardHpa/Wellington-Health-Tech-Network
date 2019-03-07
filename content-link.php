<?php
    $link =   get_post_meta( $post->ID, 'ex_link', true );
    $heading = get_post_meta( $post->ID, 'externalLinkHeading', true );
    $imageURL = get_post_meta( $post->ID, 'externalLinkImageURL', true );


?>

<?php if( is_singular() ): ?>

<?php else: ?>
    <div class="singlePost pb-2 pt-2 border-bottom">
        <div class="row">
            <div class="col-4">
                <img src="<?= esc_url($imageURL); ?>" class="img-fluid" alt="">
            </div>
            <div class="col p-2">
                <div class="card-block px-2">
                    <h6 class="text-muted"><?= get_the_date('F j, Y'); ?></h6>
                    <h4 class="card-title"><?= $heading ?></h4>
                    <a href="<?= esc_url($link); ?>" target="blank" class="btn btn-whtn">View Article</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
