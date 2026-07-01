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

  <?php
  $message_portrait = sk_img( 'message_portrait', 'large' );
  $message_history  = sk_opt_group( 'message_history' );
  $message_name     = sk_opt( 'message_name' );
  ?>
  <?php if ( $message_portrait || $message_name || $message_history ) : ?>
    <section>
      <div class="container message-grid">
        <?php if ( $message_portrait ) : ?>
          <div class="message-photo"><?php echo $message_portrait; ?></div>
        <?php endif; ?>
        <div>
          <div class="section-heading">
            <span class="eyebrow">Profile</span>
            <h2>代表プロフィール</h2>
          </div>
          <?php if ( $message_name ) : ?>
            <p class="message-name"><?php echo esc_html( $message_name ); ?></p>
          <?php endif; ?>
          <?php if ( $message_history ) : ?>
            <ul class="profile-list">
              <?php foreach ( $message_history as $entry ) : ?>
                <?php if ( ! empty( $entry['item'] ) ) : ?>
                  <li><?php echo esc_html( $entry['item'] ); ?></li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ( sk_has( 'message_lead' ) || sk_has( 'message_body' ) || sk_has( 'message_image' ) ) : ?>
    <section>
      <div class="container message-body">
        <?php if ( sk_img( 'message_image', 'large' ) ) : ?>
          <div class="message-body-image"><?php echo sk_img( 'message_image', 'large' ); ?></div>
        <?php endif; ?>
        <?php if ( sk_has( 'message_lead' ) ) : ?>
          <p class="message-lead"><?php echo nl2br( esc_html( sk_opt( 'message_lead' ) ) ); ?></p>
        <?php endif; ?>
        <?php if ( sk_has( 'message_body' ) ) : ?>
          <div class="message-text"><?php echo wp_kses_post( wpautop( sk_opt( 'message_body' ) ) ); ?></div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
