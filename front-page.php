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

            <div class="contentContainer">
                <div class="contentInner">
                    <header>
                        <nav>
                            <?php
                                $url = home_url();
                                $custom_logo_id = get_theme_mod( 'custom_logo' );
                                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                                if ( has_custom_logo() ) {
                                        echo '<a class="navbar-brand" href="'.esc_url( $url ).'"><img src="'. esc_url( $logo[0] ) .'"height="50" class="d-inline-block align-top"></a>';
                                } else {
                                        echo '<a class="navbar-brand" href="'.esc_url( $url ).'">'. get_bloginfo( 'name' ) .'</a>';
                                }
                             ?>
                        </nav>
                    </header>

                    <footer>
                        <hr>
                        <div class="menuIcon">
                           <div class="bar bar-1"></div>
                           <div class="bar bar-2"></div>
                           <div class="bar bar-3"></div>
                       </div>
                    </footer>
                </div>
            </div>




            <!-- Background Slideshow -->
            <div class="backgroundSlider">
                <?php $rhSlideCount = get_theme_mod('whtn_slide_count_setting', 5); ?>
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

        <div id="hiddenNav" class="overlay">
            <a class="closebtn"><i class="fas fa-times fa-2x"></i></a>
            <?php wp_nav_menu( array(
                'theme_location'    => 'header_navigation',
                'container'         => 'div',
                'container_class'   => 'hiddenNavContent',
                'walker' => new nav_has_children_Walker()
            )); ?>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>
