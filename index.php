<?php get_header(); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="card p-4">
                    <?php $sidebarImg = get_theme_mod('whtn_sidebar_image_setting');?>
                    <img src="<?=$sidebarImg ?>" class="img-fluid">
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
