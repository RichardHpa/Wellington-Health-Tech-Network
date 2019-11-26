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
                    <div class="frontHeader">
                        <nav>
                            <div class="row">
                                <div class="col">
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
                                </div>
                                <?php $notification = get_theme_mod('whtn_notification_display_setting', 'yes'); ?>
                                <?php if($notification === 'yes'): ?>
                                    <div class="col-12 col-md-6 d-none d-md-block">
                                        <div class="notifications float-right">
                                            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
                                              <div class="toast-header">
                                                <strong class="mr-auto"><?php echo get_theme_mod('whtn_notification_title_setting', 'Notification Title'); ?></strong>
                                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="toast-body">
                                                <?php echo get_theme_mod('whtn_notification_description_setting', 'Notification Description'); ?>
                                                <?php if(get_theme_mod('whtn_notification_link_setting')): ?>
                                                    <br><a href="<?php echo get_theme_mod('whtn_notification_link_setting'); ?>" target="_blank">Check it out</a>
                                                <?php endif; ?>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </nav>
                    </div>

                    <div class="frontFooter">
                        <?php if(have_posts()): ?>
                            <div class="content">
                                <?php while(have_posts()): the_post();?>
                                    <?php the_content(); ?>
                                <?php endwhile ?>
                            </div>
                        <?php endif; ?>
                        <hr>
                        <div class="menuIcon">
                           <div class="bar bar-1"></div>
                           <div class="bar bar-2"></div>
                           <div class="bar bar-3"></div>
                       </div>
                   </div>
                </div>
            </div>

            <!-- Background Slideshow -->
            <div class="backgroundSlider">
                <?php $rhSlideCount = get_theme_mod('whtn_slide_count_setting', 5); ?>
                <?php for($i=1;$i<=$rhSlideCount;$i++): ?>
                    <?php
                        if(get_theme_mod('whtn_slide_' . $i . '_setting')){
                            $imageURL = get_theme_mod('whtn_slide_' . $i . '_setting');
                        } else {
                            $imageURL = get_template_directory_uri() . '/assets/images/placeholderSlide.jpg';
                        }
                        $classes = 'slide';
                        if($i == 1){
                            $classes .= ' active';
                        }
                     ?>
                     <div class="<?= $classes; ?>" style="background-image: url(<?= $imageURL; ?>);"></div>
                <?php endfor; ?>
            </div>

        </div>

        <!-- Off Screen Navigation -->
        <div class="hiddenNav overlay">
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
