<?php get_header(); ?>

<div class="subpage">
  <div style="height:120px"></div>

  <?php while ( have_posts() ) : the_post(); ?>
    <section class="block wrap center">
      <h2 class="disp"><?php the_title(); ?></h2>
    </section>
    <?php if ( trim( get_the_content() ) !== '' ) : ?>
      <section class="block wrap">
        <div class="wrap" style="max-width:820px;text-align:left"><?php the_content(); ?></div>
      </section>
    <?php endif; ?>
  <?php endwhile; ?>

  <div style="height:40px"></div>
</div>

<?php get_footer(); ?>
