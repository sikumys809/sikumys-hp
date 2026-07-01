<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * 出力・非表示ヘルパー（指示書§6）。
 * テンプレートは必ずこのヘルパー経由で出力し、未入力＝自動非表示を徹底する。
 * 設定ページの値取得には Meta Box の rwmb_meta() をラップする。
 */

// 設定ページの option_name（rwmb_meta の取得キー）。
if ( ! defined( 'SK_SETTINGS' ) ) {
  define( 'SK_SETTINGS', SIKUMYS_SETTINGS_OPTION );
}

/** 空判定（値ベース）。 */
function sk_has( $v ) {
  return ! ( $v === '' || $v === null || $v === false || $v === array() );
}

/** 設定ページの値（空なら false）。 */
function sk_opt( $id ) {
  if ( ! function_exists( 'rwmb_meta' ) ) {
    return false;
  }
  $v = rwmb_meta( $id, array( 'object_type' => 'setting' ), SK_SETTINGS );
  return sk_has( $v ) ? $v : false;
}

/** 設定ページの画像URL（single_image / file_advanced。無ければ false）。 */
function sk_opt_image( $id, $size = 'full' ) {
  if ( ! function_exists( 'rwmb_meta' ) ) {
    return false;
  }
  $img = rwmb_meta( $id, array( 'object_type' => 'setting', 'size' => $size ), SK_SETTINGS );
  if ( empty( $img ) ) {
    return false;
  }
  if ( ! empty( $img['url'] ) ) {
    return $img['url'];
  }
  // file_advanced は複数ファイル配列を返すので先頭の url を使う。
  if ( is_array( $img ) ) {
    $first = reset( $img );
    if ( ! empty( $first['url'] ) ) {
      return $first['url'];
    }
  }
  return false;
}

/** 設定ページの Group（clone）を配列で取得。 */
function sk_opt_group( $id ) {
  if ( ! function_exists( 'rwmb_meta' ) ) {
    return array();
  }
  $rows = rwmb_meta( $id, array( 'object_type' => 'setting' ), SK_SETTINGS );
  return is_array( $rows ) ? $rows : array();
}

/** 投稿の single_image をURLで取得（ループ内 or $post_id 指定）。無ければ false。 */
function sk_post_image( $id, $post_id = null, $size = 'full' ) {
  if ( ! function_exists( 'rwmb_meta' ) ) {
    return false;
  }
  $img = rwmb_meta( $id, array( 'size' => $size ), $post_id );
  if ( empty( $img ) ) {
    return false;
  }
  if ( ! empty( $img['url'] ) ) {
    return $img['url'];
  }
  if ( is_array( $img ) ) {
    $first = reset( $img );
    if ( ! empty( $first['url'] ) ) {
      return $first['url'];
    }
  }
  return false;
}

/** 値があるときだけ HTML を出力。無ければ何も出さない。$value は事前にエスケープ済みで渡す。 */
function sk_echo( $value, $before = '', $after = '' ) {
  if ( $value === '' || $value === null || $value === false ) {
    return;
  }
  echo $before . $value . $after;
}

/** 画像URLがあれば<img>、無ければ何も出さない（プレースホルダーも出さない）。 */
function sk_img( $url, $alt = '', $class = '' ) {
  if ( ! $url ) {
    return;
  }
  printf(
    '<img src="%s" alt="%s" class="%s" loading="lazy">',
    esc_url( $url ),
    esc_attr( $alt ),
    esc_attr( $class )
  );
}

/** CPT を menu_order 昇順で取得（publish のみ＝下書きは自動非表示）。 */
function sk_query( $post_type, $limit = -1 ) {
  return new WP_Query( array(
    'post_type'      => $post_type,
    'posts_per_page' => $limit,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
    'no_found_rows'  => true,
  ) );
}

/**
 * 指定のページテンプレートを使う公開ページの URL を返す（ナビ用）。
 * 見つからなければトップページ。
 */
function sk_page_url( $template ) {
  $q = new WP_Query( array(
    'post_type'      => 'page',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'meta_key'       => '_wp_page_template',
    'meta_value'     => $template,
    'fields'         => 'ids',
    'no_found_rows'  => true,
  ) );
  $url = ( ! empty( $q->posts ) ) ? get_permalink( $q->posts[0] ) : home_url( '/' );
  return $url;
}

/** 現在のナビ位置（top / overview / message / philosophy / service）。 */
function sk_nav_current() {
  $sk = get_query_var( 'sk_page' );
  if ( $sk ) {
    return $sk;
  }
  return is_front_page() ? 'top' : '';
}

/** 現在ナビと一致すれば ' active' を返す（class属性用）。 */
function sk_nav_active( $slug ) {
  return sk_nav_current() === $slug ? 'active' : '';
}

/** SNS アイコン SVG（モック準拠）。未知スラッグは空文字。 */
function sk_svg_icon( $slug ) {
  $icons = array(
    'facebook'  => '<svg viewBox="0 0 24 24"><path d="M22 12a10 10 0 10-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.2c-1.2 0-1.6.8-1.6 1.6V12h2.7l-.4 2.9h-2.3v7A10 10 0 0022 12z"/></svg>',
    'youtube'   => '<svg viewBox="0 0 24 24"><path d="M23 7.5a3 3 0 00-2.1-2.1C19 4.9 12 4.9 12 4.9s-7 0-8.9.5A3 3 0 001 7.5 31 31 0 00.5 12 31 31 0 001 16.5a3 3 0 002.1 2.1c1.9.5 8.9.5 8.9.5s7 0 8.9-.5a3 3 0 002.1-2.1A31 31 0 0023.5 12 31 31 0 0023 7.5zM9.8 15.3V8.7l5.7 3.3z"/></svg>',
    'instagram' => '<svg viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.8.9 1.4.1.4.3 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.8.7-1.4.9-.4.1-1 .3-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.8-.9-1.4-.1-.4-.3-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.8-.7 1.4-.9.4-.1 1-.3 2.2-.4C8.4 2.2 8.8 2.2 12 2.2zm0 1.8c-3.1 0-3.5 0-4.7.1-1.1.1-1.7.2-2.1.4-.5.2-.9.4-1.3.8-.4.4-.6.8-.8 1.3-.2.4-.3 1-.4 2.1-.1 1.2-.1 1.6-.1 4.7s0 3.5.1 4.7c.1 1.1.2 1.7.4 2.1.2.5.4.9.8 1.3.4.4.8.6 1.3.8.4.2 1 .3 2.1.4 1.2.1 1.6.1 4.7.1s3.5 0 4.7-.1c1.1-.1 1.7-.2 2.1-.4.5-.2.9-.4 1.3-.8.4-.4.6-.8.8-1.3.2-.4.3-1 .4-2.1.1-1.2.1-1.6.1-4.7s0-3.5-.1-4.7c-.1-1.1-.2-1.7-.4-2.1-.2-.5-.4-.9-.8-1.3-.4-.4-.8-.6-1.3-.8-.4-.2-1-.3-2.1-.4-1.2-.1-1.6-.1-4.7-.1zm0 3.1a4.9 4.9 0 110 9.8 4.9 4.9 0 010-9.8zm0 8a3.1 3.1 0 100-6.2 3.1 3.1 0 000 6.2zm6.3-8.2a1.1 1.1 0 11-2.3 0 1.1 1.1 0 012.3 0z"/></svg>',
    'x'         => '<svg viewBox="0 0 24 24"><path d="M18.2 2.2h3.3l-7.2 8.2 8.5 11.4h-6.7l-5.2-6.8-6 6.8H1.6l7.7-8.8L1.1 2.2h6.8l4.7 6.3zM17 19.8h1.8L7.1 4.1H5.1z"/></svg>',
  );
  return isset( $icons[ $slug ] ) ? $icons[ $slug ] : '';
}
