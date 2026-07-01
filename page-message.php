<?php
/**
 * Template Name: Message Page
 */

get_header();
?>
<main>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <section class="section-heading">
      <div class="container">
        <span class="eyebrow">Message</span>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>
    </section>
  <?php endwhile; endif; ?>

  <?php $profile_entries = sk_opt_group( 'profile_entries' ); ?>
  <?php $representative_photo = sk_opt( 'representative_photo' ); ?>
  <?php $representative_photo_id = is_array( $representative_photo ) ? intval( reset( $representative_photo ) ) : intval( $representative_photo ); ?>
  <?php if ( $profile_entries || $representative_photo_id ) : ?>
    <section>
      <div class="container message-grid">
        <?php if ( $representative_photo_id ) : ?>
          <div class="message-photo">
            <?php echo wp_get_attachment_image( $representative_photo_id, 'large' ); ?>
          </div>
        <?php endif; ?>
        <div>
          <div class="section-heading">
            <span class="eyebrow">Profile</span>
            <h2>代表プロフィール</h2>
          </div>
          <div class="profile-list">
            <?php foreach ( $profile_entries as $entry ) : ?>
              <?php if ( ! empty( $entry['profile_label'] ) && ! empty( $entry['profile_value'] ) ) : ?>
                <div class="profile-item">
                  <strong><?php echo esc_html( $entry['profile_label'] ); ?>:</strong>
                  <span><?php echo esc_html( $entry['profile_value'] ); ?></span>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
