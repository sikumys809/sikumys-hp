<?php
/**
 * Template Name: Philosophy Page
 */

get_header();
?>
<main>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <section class="section-heading">
      <div class="container">
        <span class="eyebrow">Philosophy</span>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>
    </section>
  <?php endwhile; endif; ?>

  <?php if ( sk_has( 'philosophy_text' ) ) : ?>
    <section>
      <div class="container">
        <div class="section-heading">
          <span class="eyebrow">Mind</span>
          <p><?php echo esc_html( sk_opt( 'philosophy_text' ) ); ?></p>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php
  $creeds = sk_query( array(
    'post_type' => 'creed',
    'posts_per_page' => 10,
    'orderby' => 'menu_order',
    'order'   => 'ASC',
  ) );
  if ( $creeds->have_posts() ) :
  ?>
    <section>
      <div class="container">
        <div class="three-grid">
          <?php while ( $creeds->have_posts() ) : $creeds->the_post(); ?>
            <article class="mind-card">
              <h3><?php the_title(); ?></h3>
              <?php the_content(); ?>
            </article>
          <?php endwhile; ?>
        </div>
      </div>
    </section>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
