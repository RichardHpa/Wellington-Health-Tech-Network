    </main>

    <footer class="footer">
      <div class="container">
          <?php
            wp_nav_menu( array(
                'menu_id' => 'footerMenu',
                'menu_class' => 'menu',
                'theme_location'    => 'footer_navigation',
                'container_class'   => 'footer-menu-container'
            ) );
            ?>
          <hr>
          <p>&copy; Copyright <?php echo date("Y"); ?></p>
    </footer>

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
