<?php get_header(); ?>

    <?php if(have_posts()): ?>
        <?php while(have_posts()): the_post();?>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php the_title(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>


<?php get_footer(); ?>
