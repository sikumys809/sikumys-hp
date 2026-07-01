<?php
/**
 * Template Name: Message Page
 */
get_header(); ?>

<div class="subpage">
  <div style="height:120px"></div>

  <section class="block wrap center">
    <span class="eyebrow">Message</span>
    <h2 class="disp"><?php echo esc_html( get_the_title() ? get_the_title() : '代表メッセージ' ); ?></h2>
  </section>

  <?php
  $portrait = sk_opt_image( 'message_portrait' );
  $name     = sk_opt( 'message_name' );
  $lead     = sk_opt( 'message_lead' );
  $hist     = sk_opt_group( 'message_history' );
  $body     = sk_opt( 'message_body' );
  $mimg     = sk_opt_image( 'message_image' );

  $has_hist = false;
  foreach ( $hist as $h ) {
    if ( ! empty( $h['item'] ) ) {
      $has_hist = true;
      break;
    }
  }
  ?>

  <?php if ( $portrait || $name || $lead || $has_hist || $body ) : ?>
    <section class="block wrap" style="padding-top:0">
      <?php if ( $portrait || $name || $lead || $has_hist ) : ?>
        <div class="msg-top">
          <?php if ( $portrait ) : ?>
            <div class="portrait"><?php sk_img( $portrait, $name ? $name : get_bloginfo( 'name' ) ); ?></div>
          <?php endif; ?>
          <div>
            <?php if ( $name ) : ?><div class="msg-name"><?php echo esc_html( $name ); ?></div><?php endif; ?>
            <?php if ( $lead ) : ?><div class="msg-jp"><?php echo nl2br( esc_html( $lead ) ); ?></div><?php endif; ?>
            <?php if ( $has_hist ) : ?>
              <ul>
                <?php foreach ( $hist as $h ) : if ( empty( $h['item'] ) ) { continue; } ?>
                  <li><?php echo esc_html( $h['item'] ); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>

      <?php if ( $body ) : ?>
        <div class="msg-body"><?php echo wp_kses_post( wpautop( $body ) ); ?></div>
      <?php endif; ?>
    </section>
  <?php endif; ?>

  <?php if ( $mimg ) : ?>
    <div class="wrap"><div class="msg-media"><?php sk_img( $mimg, get_bloginfo( 'name' ) ); ?></div></div>
  <?php endif; ?>

  <div style="height:80px"></div>
</div>

<?php get_footer(); ?>
