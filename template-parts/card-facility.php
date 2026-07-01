<?php
/**
 * 事業所カード（ギャラリー）。画像・住所は各々未入力なら非表示。
 * ループ内で使用。
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
$img  = sk_post_image( 'facility_image', null, 'large' );
$addr = rwmb_meta( 'facility_address' );
?>
<figure class="gcard">
  <?php if ( $img ) : ?>
    <div class="gmedia"><?php sk_img( $img, get_the_title() ); ?></div>
  <?php endif; ?>
  <figcaption>
    <?php the_title(); ?>
    <?php sk_echo( esc_html( $addr ), '<span>', '</span>' ); ?>
  </figcaption>
</figure>
