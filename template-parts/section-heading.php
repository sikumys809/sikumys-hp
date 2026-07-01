<?php
/**
 * 見出し共通パーツ（eyebrow + h2.disp）。
 * 呼び出し: get_template_part( 'template-parts/section-heading', null, array( 'eyebrow' => 'Service', 'title' => '事業紹介' ) );
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
$eyebrow = isset( $args['eyebrow'] ) ? $args['eyebrow'] : '';
$title   = isset( $args['title'] ) ? $args['title'] : '';
?>
<?php if ( $eyebrow ) : ?><span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span><?php endif; ?>
<?php if ( $title ) : ?><h2 class="disp"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
