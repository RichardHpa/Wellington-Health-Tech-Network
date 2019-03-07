<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <?php wp_head(); ?>
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
            </div>






            <div id="cycler">
                <div class="slide red active" style="background-image: url(https://picsum.photos/500/?random);"></div>
                <div class="slide blue" style="background-image: url(https://picsum.photos/g/500/?random);"></div>
                <div class="slide green" style="background-image: url(https://picsum.photos/500/?random);"></div>
                <div class="slide yellow" style="background-image: url(https://picsum.photos/g/500/?random);"></div>
            </div>
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


<!-- <div class="red active"><img src="https://picsum.photos/500/?random" alt="My image" /></div>
<div class="blue"><img src="https://picsum.photos/g/500/?random" alt="My image" /></div>
<div class="green"><img src="https://picsum.photos/500/?random" alt="My image" /></div>
<div class="yello"><img src="https://picsum.photos/g/500/?random" alt="My image" /></div> -->
