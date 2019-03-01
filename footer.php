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

    <?php wp_footer(); ?>
    </body>
</html>
