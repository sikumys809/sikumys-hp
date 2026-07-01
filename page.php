<?php get_header(); ?>
<main>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <section class="section-heading">
      <div class="container">
        <span class="eyebrow"><?php echo esc_html__( 'Page', 'sikumys' ); ?></span>
        <h1><?php the_title(); ?></h1>
      </div>
    </section>

    <section>
      <div class="container content-block">
        <?php the_content(); ?>
      </div>
    </section>
  <?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>
