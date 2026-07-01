<?php get_header(); ?>

<div class="subpage">
  <div style="height:120px"></div>
  <section class="block wrap center">
    <h2 class="disp"><?php bloginfo( 'name' ); ?></h2>
    <?php if ( get_bloginfo( 'description' ) ) : ?>
      <p class="lead"><?php bloginfo( 'description' ); ?></p>
    <?php endif; ?>
  </section>
  <div style="height:40px"></div>
</div>

<?php get_footer(); ?>
