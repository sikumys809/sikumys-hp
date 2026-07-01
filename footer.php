<footer class="site-footer">
  <div class="container">
    <?php if ( sk_has( 'logo_footer' ) ) : ?>
      <p class="brand"><?php echo sk_img( 'logo_footer', 'full', array( 'alt' => get_bloginfo( 'name' ) ) ); ?></p>
    <?php else : ?>
      <p class="brand">SIKUMYS<span> INC.</span></p>
    <?php endif; ?>
    <?php if ( sk_has( 'footer_catch' ) ) : ?>
      <p><?php echo esc_html( sk_opt( 'footer_catch' ) ); ?></p>
    <?php endif; ?>
    <p>© <?php echo esc_html( date_i18n( 'Y' ) ); ?> SIKUMYS, INC.</p>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
