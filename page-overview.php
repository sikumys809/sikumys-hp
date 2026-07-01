<?php
/**
 * Template Name: Overview Page
 */

get_header();
?>
<main>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <section class="section-heading">
      <div class="container">
        <span class="eyebrow">Overview</span>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>
    </section>
  <?php endwhile; endif; ?>

  <?php $company_table = sk_opt_group( 'company_table' ); ?>
  <?php if ( $company_table ) : ?>
    <section>
      <div class="container">
        <div class="section-heading">
          <span class="eyebrow">Company</span>
          <h2>会社概要</h2>
        </div>
        <dl class="company-table">
          <?php foreach ( $company_table as $row ) : ?>
            <?php if ( ! empty( $row['company_field_name'] ) && ! empty( $row['company_field_value'] ) ) : ?>
              <div class="company-row">
                <dt><?php echo esc_html( $row['company_field_name'] ); ?></dt>
                <dd><?php echo esc_html( $row['company_field_value'] ); ?></dd>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </dl>
      </div>
    </section>
  <?php endif; ?>

  <?php
  $facilities = sk_query( array(
    'post_type' => 'facility',
    'posts_per_page' => 6,
    'orderby' => 'menu_order',
    'order'   => 'ASC',
  ) );
  if ( $facilities->have_posts() ) :
  ?>
    <section>
      <div class="container">
        <div class="section-heading">
          <span class="eyebrow">Facility</span>
          <h2>事業所ギャラリー</h2>
        </div>
        <div class="card-grid">
          <?php while ( $facilities->have_posts() ) : $facilities->the_post(); ?>
            <article class="card">
              <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
              <?php endif; ?>
              <div class="card-body">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php if ( function_exists( 'rwmb_meta' ) ) : ?>
                  <?php $address = rwmb_meta( 'facility_address' ); ?>
                  <?php $hours = rwmb_meta( 'facility_hours' ); ?>
                  <?php if ( $address ) : ?><p><?php echo esc_html( $address ); ?></p><?php endif; ?>
                  <?php if ( $hours ) : ?><p><?php echo esc_html( $hours ); ?></p><?php endif; ?>
                <?php endif; ?>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
      </div>
    </section>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
