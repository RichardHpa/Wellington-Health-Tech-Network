<!DOCTYPE html>
<html lang="en" dir="ltr" <?php if(is_admin_bar_showing()): ?> class="adminLoggedIn" <?php endif; ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= get_bloginfo('name'); ?> - <?= $wp_query->post->post_title; ?></title>
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
        <header id="header" class="<?php if(get_theme_mod('header_background_image_setting')): ?> image-background <?php endif; ?>">

            <?php if(get_theme_mod('header_background_image_setting')): ?>
                <?php
                    $imageURL = wp_get_attachment_url(get_theme_mod('header_background_image_setting'));
                 ?>
                 <img src="<?= $imageURL; ?>" alt="Wellington Health Tech Network" data-position="50% 50%" onload="backgroundLoaded(this)" />
            <?php endif; ?>

            <nav class="header-nav navbar navbar-expand-md justify-content-between container">
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
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'header_navigation',
                        'menu_id'           => 'headerNav',
                        'container'         => 'div',
                        'container_id'      => 'navContainer',
                        'walker' => new nav_has_children_Walker()
                  ) )
                ?>
                <div class="menuIcon">
                    <div class="bar bar-1"></div>
                    <div class="bar bar-2"></div>
                    <div class="bar bar-3"></div>
                </div>
            </nav>
            <div id="myNav" class="overlay">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <?php wp_nav_menu( array(
                        'theme_location'    => 'header_navigation',
                        'container'         => 'div',
                        'container_class'   => 'overlay-content',
                        'walker' => new nav_has_children_Walker()
                    )); ?>
            </div>
        </header>
        <main role="main" class="container">
