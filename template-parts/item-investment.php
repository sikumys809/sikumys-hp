<?php
/**
 * 投資先タイル。ロゴがあればロゴ、無ければ社名テキスト。URLがあればリンク、無ければ span。
 * ループ内で使用。
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
$logo = sk_post_image( 'investment_logo', null, 'medium' );
$url  = rwmb_meta( 'investment_url' );
$el   = $url ? 'a' : 'span';
$attr = $url ? sprintf( 'href="%s" target="_blank" rel="noopener"', esc_url( $url ) ) : '';
?>
<<?php echo $el; ?> class="inv" <?php echo $attr; ?>>
  <?php
  if ( $logo ) {
    sk_img( $logo, get_the_title(), 'inv-logo' );
  } else {
    printf( '<span>%s</span>', esc_html( get_the_title() ) );
  }
  ?>
</<?php echo $el; ?>>
