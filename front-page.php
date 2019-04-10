<!DOCTYPE html>
<html lang="en" dir="ltr" <?php if(is_admin_bar_showing()): ?> class="adminLoggedIn" <?php endif; ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= get_bloginfo('name'); ?></title>
        <?php wp_head(); ?>
        <script>
            function backgroundLoaded(element) {
                var url = "url('" + element.src + "')";
                var parent = element.parentNode;
                var bgPosition = element.dataset.position;
                if (bgPosition) {
                    parent.style.backgroundPosition = bgPosition;
                }
                parent.style.backgroundImage = url;
                parent.style.opacity = "1";
            }
        </script>
    </head>
    <body <?php body_class(); ?>>
        <div class="full">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-12 mx-auto">
                        <div class="content">
                            <header>
                                <nav class="header-nav navbar navbar-expand-md">
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

                            <?php if(get_theme_mod('alert_checkbox_setting')): ?>
                                <?php if(get_theme_mod('alert_post_url_setting')): ?>
                                    <a href="<?php echo esc_url( get_permalink(get_theme_mod('alert_post_url_setting')) ); ?>">
                                <?php elseif(get_theme_mod('alert_url_setting')): ?>
                                    <a target="blank" href="<?php echo esc_url( get_theme_mod('alert_url_setting') ); ?>">
                                <?php endif; ?>
                                <div class="alert_section">
                                    <h5><?= get_theme_mod('alert_heading_setting'); ?></h5>
                                    <p><?= get_theme_mod('alert_text_setting'); ?></p>
                                </div>
                                <?php if( (get_theme_mod('alert_post_url_setting')) ||  (get_theme_mod('alert_url_setting')) ): ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php
                                $args = array(
                                    'post_type' => 'sponsor',
                                    'posts_per_page' => -1,
                                );
                                $sponsor = new WP_Query($args);
                             ?>
                            <?php if( $sponsor->have_posts() ):?>
                                <div id="sponsorsList">
                                    <h3>Our Sponsors</h3>
                                    <?php while($sponsor->have_posts()): $sponsor->the_post();?>
                                        <?php
                                            $postID = get_the_ID();
                                            $imageID =  get_post_meta( $postID, 'sponsor_image', true );
                                        ?>
                                        <div class="sponsorLogo">
                                            <?php if(get_post_meta($postID, 'sponsor_url', true)): ?><a href="<?= get_post_meta($postID, 'sponsor_url', true); ?>" target="blank"><?php endif; ?>
                                                <img src="<?= wp_get_attachment_image_src( $imageID, 'Thumbnail')[0]  ?>" alt="Our Sponsor - <?= the_title(); ?>" />
                                            <?php if(get_post_meta($postID, 'sponsor_url', true)): ?></a><?php endif; ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>

                            <div class="textContent">
                                <h4 id="homeBanner"><?php echo get_theme_mod('home_text_setting'); ?></h4>
                                <hr>
                                <div class="menuIcon">
                                    <div class="bar bar-1"></div>
                                    <div class="bar bar-2"></div>
                                    <div class="bar bar-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php
                $args = array(
                    'post_type' => 'slide',
                    'posts_per_page' => -1
                );
                $allSlides = new WP_Query($args);
             ?>
             <?php $total = $allSlides->found_posts; ?>

             <?php if($total == 0): ?>
                 <?php if (get_theme_mod( 'home_background_image_setting' )) : ?>
                     <?php $imageURL = esc_url( get_background_image_url('home_background_image_setting') ); ?>
                 <?php else: ?>
                     <?php $imageURL = get_template_directory_uri().'/assets/images/defaultBanner.jpg'; ?>
                 <?php endif; ?>
                 <div class="image-background singleSlide">
                    <img src="<?= $imageURL ?>" alt="Wellington Health Tech Network" data-position="50% 50%" onload="backgroundLoaded(this)" />
                </div>
             <?php elseif($total == 1): ?>
                 <?php while($allSlides->have_posts()): $allSlides->the_post();?>
                     <?php
                         $postID = get_the_ID();
                         $imageID =  get_post_meta( $postID, 'slide_image', true );
                     ?>
                     <div class="image-background singleSlide">
                        <img src="<?= wp_get_attachment_image_src( $imageID, 'large')[0]  ?>" alt="Wellington Health Tech Network" data-position="50% 50%" onload="backgroundLoaded(this)" />
                    </div>
                 <?php endwhile; ?>
             <?php else: ?>
                 <?php $i = 1; ?>
                 <div id="cycler">
                    <?php while($allSlides->have_posts()): $allSlides->the_post();?>
                        <?php
                            $postID = get_the_ID();
                            $imageID =  get_post_meta( $postID, 'slide_image', true );
                            $classes = 'slide';
                            if($i == 1){
                                $classes .= ' active';
                            }
                        ?>
                        <div class="<?= $classes; ?>" style="background-image: url(<?= wp_get_attachment_image_src( $imageID, 'large')[0]  ?>);"></div>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                 </div>
             <?php endif; ?>
        </div>

        <div id="myNav" class="overlay">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <?php wp_nav_menu( array(
                    'theme_location'    => 'header_navigation',
                    'container'         => 'div',
                    'container_class'   => 'overlay-content',
                    'walker' => new nav_has_children_Walker()
                )); ?>
        </div>

        <?php wp_footer(); ?>
    </body>
</html>
