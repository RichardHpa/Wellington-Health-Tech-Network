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
          <?php
              $args = array(
                  'post_type' => 'sponsor',
                  'posts_per_page' => -1,
              );
              $sponsor = new WP_Query($args);
           ?>
          <?php if( $sponsor->have_posts() ):?>
              <div id="sponsorsListFooter">
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
          <hr>
          <p>&copy; Copyright <?php echo date("Y"); ?></p>
    </footer>
    <?php wp_footer(); ?>
    </body>
</html>
