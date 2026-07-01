</main>

<footer>
  <div class="flogo">
    <?php if ( $flogo = sk_opt_image( 'logo_footer' ) ) : ?>
      <?php sk_img( $flogo, get_bloginfo( 'name' ) ); ?>
    <?php else : ?>
      SIKUMYS<b>.</b>
    <?php endif; ?>
  </div>

  <?php if ( $catch = sk_opt( 'footer_catch' ) ) : ?>
    <div class="fcatch"><?php echo esc_html( $catch ); ?></div>
  <?php endif; ?>

  <nav class="fnav">
    <a href="<?php echo esc_url( home_url( '/overview' ) ); ?>">Overview</a>
    <a href="<?php echo esc_url( home_url( '/message' ) ); ?>">Message</a>
    <a href="<?php echo esc_url( home_url( '/philosophy' ) ); ?>">Philosophy</a>
    <a href="<?php echo esc_url( home_url( '/service' ) ); ?>">Service &amp; Investment</a>
  </nav>

  <?php
  $sns = array( 'sns_facebook' => 'facebook', 'sns_youtube' => 'youtube', 'sns_instagram' => 'instagram', 'sns_x' => 'x' );
  $sns_links = array();
  foreach ( $sns as $field => $slug ) {
    if ( $url = sk_opt( $field ) ) {
      $sns_links[ $slug ] = $url;
    }
  }
  ?>
  <?php if ( $sns_links ) : ?>
    <div class="sns">
      <?php foreach ( $sns_links as $slug => $url ) : ?>
        <a href="<?php echo esc_url( $url ); ?>" aria-label="<?php echo esc_attr( ucfirst( $slug ) ); ?>" target="_blank" rel="noopener"><?php echo sk_svg_icon( $slug ); ?></a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php
  $meta_parts = array_filter( array( get_bloginfo( 'name' ), sk_opt( 'company_address' ), sk_opt( 'company_email' ) ) );
  ?>
  <?php if ( $meta_parts ) : ?>
    <div class="meta"><?php echo esc_html( implode( ' ｜ ', $meta_parts ) ); ?></div>
  <?php endif; ?>

  <div class="copy">© <?php echo esc_html( date_i18n( 'Y' ) ); ?> SIKUMYS, INC. All Rights Reserved.</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
