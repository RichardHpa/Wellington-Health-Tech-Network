<!DOCTYPE html>
<html lang="en" dir="ltr" <?php if(is_admin_bar_showing()): ?> class="adminLoggedIn" <?php endif; ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= get_bloginfo('name'); ?> - <?= $wp_query->post->post_title; ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="pageContainer">
        <header class="header">
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
                    'container_class'      => 'navContainer',
                    'walker' => new nav_has_children_Walker()
                ) )
                ?>
            </nav>
        </header>

        <main>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="jumbotron text-center">
                            <h1 class="display-4">404, Page not Found</h1>
                            <p class="lead">Sorry but we can't find the page you are looking for.</p>
                            <hr class="my-4">
                            <a class="btn btn-whtn btn-lg" href="<?php echo esc_url( home_url( '/' ) ); ?>" role="button">Head Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer p-5 mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p>Copyright © <?= date("Y"); ?> <?= get_bloginfo( 'name' ); ?></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
