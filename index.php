<?php get_header(); ?>

    <?php if(have_posts()): ?>
        <?php while(have_posts()): the_post();?>
            <div class="container">
                <?php get_template_part('content', get_post_format()); ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    
<?php get_footer(); ?>
