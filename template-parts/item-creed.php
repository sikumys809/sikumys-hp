<?php
/**
 * 10の言葉の1行（番号＝menu_order ＋ タイトル）。ループ内で使用。
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
$num = (int) get_post()->menu_order;
?>
<div>
  <span class="num"><?php echo esc_html( sprintf( '%02d', $num ) ); ?></span>
  <span class="txt"><?php the_title(); ?></span>
</div>
