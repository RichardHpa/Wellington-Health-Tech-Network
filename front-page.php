<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
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
                                <nav class="header-nav navbar navbar-expand-md container">
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
                                <nav class="header-nav navbar navbar-expand-md justify-content-center">
                                    <?php
                                    wp_nav_menu( array(
                                        'theme_location'    => 'header_navigation',
                                        'depth'             => 2,
                                        'container'         => 'div',
                                        'container_class'   => 'collapse navbar-collapse',
                                        'container_id'      => 'header-nav-collapse',
                                        'menu_class'        => 'nav navbar-nav ml-auto w-100 justify-content-start',
                                        'menu_id'           => 'frontNav',
                                        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                        'walker'            => new WP_Bootstrap_Navwalker(),
                                    ) );
                                     ?>
                                </nav>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>
