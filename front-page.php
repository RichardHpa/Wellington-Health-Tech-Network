<!DOCTYPE html>
<html lang="en" dir="ltr" <?php if(is_admin_bar_showing()): ?> class="adminLoggedIn" <?php endif; ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= get_bloginfo('name'); ?></title>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="fullScreen">

            <?php $rhSlideCount = get_theme_mod('whtn_slide_count_setting', 5); ?>

            <div class="backgroundSlider">
                <?php for($i=1;$i<=$rhSlideCount;$i++): ?>
                    <?php
                    $imageURL = get_theme_mod('whtn_slide_' . $i . '_setting');
                        $classes = 'slide';
                        if($i == 1){
                            $classes .= ' active';
                        }
                     ?>
                     <div class="<?= $classes; ?>" style="background-image: url(<?= $imageURL; ?>);"></div>
                <?php endfor; ?>
            </div>

        </div>
        <?php wp_footer(); ?>
    </body>
</html>
