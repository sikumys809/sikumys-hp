<?php
/**
 * 事業カード（TOP一覧＝variant 'card' / Service&Investment詳細＝variant 'detail'）。
 * ループ内で使用。未入力の要素は各々非表示。
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
$variant = isset( $args['variant'] ) ? $args['variant'] : 'card';
$tag     = rwmb_meta( 'service_tag' );
$lead    = rwmb_meta( 'service_lead' );
$body    = rwmb_meta( 'service_body' );
$image   = sk_post_image( 'service_image', null, 'large' );
$url     = rwmb_meta( 'service_url' );

if ( 'detail' === $variant ) : ?>
  <div class="svc-detail<?php echo $image ? '' : ' no-media'; ?>">
    <div class="txtcol">
      <?php sk_echo( esc_html( $tag ), '<div class="tag">', '</div>' ); ?>
      <h3><?php the_title(); ?></h3>
      <?php echo $body ? wp_kses_post( wpautop( $body ) ) : ''; ?>
      <?php if ( $url ) : ?>
        <a class="link" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener">Visit Site</a>
      <?php endif; ?>
    </div>
    <?php if ( $image ) : ?>
      <div class="svc-media"><?php sk_img( $image, get_the_title() ); ?></div>
    <?php endif; ?>
  </div>
<?php else : ?>
  <article class="svc">
    <?php if ( $image ) : ?>
      <div class="svc-media"><?php sk_img( $image, get_the_title() ); ?></div>
    <?php endif; ?>
    <div class="body">
      <?php sk_echo( esc_html( $tag ), '<div class="tag">', '</div>' ); ?>
      <h3><?php the_title(); ?></h3>
      <?php sk_echo( esc_html( $lead ), '<p>', '</p>' ); ?>
      <?php if ( $url ) : ?>
        <a class="more" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener">View More</a>
      <?php endif; ?>
    </div>
  </article>
<?php endif; ?>
