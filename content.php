<?php if( is_singular() ): ?>
    <div class="row">
        <div class="col">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="content">
                <div class="wp_content"><?php the_content(); ?></div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="card mb-3">
        <div class="row">
            <div class="col-3">
                <img src="//placehold.it/300x150" class="img-fluid" alt="">
            </div>
            <div class="col p-2">
                <div class="card-block px-2">
                    <h4 class="card-title"><?php the_title(); ?></h4>
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
