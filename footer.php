<footer class="site-footer">
  <div class="container">
    <p class="brand">SIKUMYS<span> INC.</span></p>
    <?php if ( sk_has( 'footer_text' ) ) : ?>
      <p><?php echo esc_html( sk_opt( 'footer_text' ) ); ?></p>
    <?php endif; ?>
    <p>© <?php echo esc_html( date_i18n( 'Y' ) ); ?> SIKUMYS, INC.</p>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
