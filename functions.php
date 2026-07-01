<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

define( 'SIKUMYS_SETTINGS_OPTION', 'sikumys_site_settings' );

require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/cpt.php';
require_once get_template_directory() . '/inc/meta-box.php';

function sikumys_setup() {
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
  add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 220, 'flex-height' => true, 'flex-width' => true ) );
  add_theme_support( 'editor-styles' );
  register_nav_menus( array(
    'primary' => __( 'Primary Navigation', 'sikumys' ),
  ) );
}
add_action( 'after_setup_theme', 'sikumys_setup' );

function sikumys_assets() {
  wp_enqueue_style(
    'sikumys-fonts',
    'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&family=Noto+Sans+JP:wght@300;400;500;700&display=swap',
    array(),
    null
  );
  wp_enqueue_style( 'sikumys-style', get_stylesheet_uri(), array( 'sikumys-fonts' ), wp_get_theme()->get( 'Version' ) );

  $ver = wp_get_theme()->get( 'Version' );
  $dir = get_template_directory_uri();

  // UI 挙動（ヘッダー縮小・ドロワー・ヒーローパララックス）は全ページ。
  wp_enqueue_script( 'sikumys-scripts', $dir . '/assets/main.js', array(), $ver, true );

  $is_front    = is_front_page();
  $is_philo    = ( 'philosophy' === get_query_var( 'sk_page' ) );

  // トップのみ: Three.js 本体 → hero.js（NETWORK）。
  if ( $is_front ) {
    wp_enqueue_script( 'three', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), 'r128', true );
    wp_enqueue_script( 'sikumys-hero', $dir . '/assets/hero.js', array( 'three' ), $ver, true );
  }

  // インフォグラフィックは図が出るページ（トップ=VISION / Philosophy）。
  if ( $is_front || $is_philo ) {
    wp_enqueue_script( 'sikumys-infographic', $dir . '/assets/infographic.js', array(), $ver, true );
  }
}
add_action( 'wp_enqueue_scripts', 'sikumys_assets' );

/**
 * 静的ページはテンプレート直結にする（固定ページ運用をやめる）。
 * スラッグ → テンプレートのマッピング。
 */
define( 'SIKUMYS_REWRITE_VERSION', '1' );

function sikumys_static_routes() {
  return array(
    'overview'   => 'page-overview.php',
    'message'    => 'page-message.php',
    'philosophy' => 'page-philosophy.php',
    'service'    => 'page-service.php',
  );
}

/** カスタムクエリ変数を登録。 */
function sikumys_query_vars( $vars ) {
  $vars[] = 'sk_page';
  return $vars;
}
add_filter( 'query_vars', 'sikumys_query_vars' );

/** 各スラッグを index.php?sk_page=... に直結（'top' で CPT 等より優先）。 */
function sikumys_rewrite_rules() {
  foreach ( array_keys( sikumys_static_routes() ) as $slug ) {
    add_rewrite_rule( '^' . $slug . '/?$', 'index.php?sk_page=' . $slug, 'top' );
  }
}
add_action( 'init', 'sikumys_rewrite_rules' );

/** ルール変更時のみ自動で flush（本番でも初回アクセスで反映）。 */
function sikumys_maybe_flush_rewrite() {
  if ( get_option( 'sikumys_rewrite_version' ) !== SIKUMYS_REWRITE_VERSION ) {
    flush_rewrite_rules( false );
    update_option( 'sikumys_rewrite_version', SIKUMYS_REWRITE_VERSION );
  }
}
add_action( 'init', 'sikumys_maybe_flush_rewrite', 20 );

/** sk_page が立っていたら対応テンプレートを読み、200 で返す（404にしない）。 */
function sikumys_template_include( $template ) {
  $slug = get_query_var( 'sk_page' );
  if ( ! $slug ) {
    return $template;
  }
  $routes = sikumys_static_routes();
  if ( isset( $routes[ $slug ] ) ) {
    $located = locate_template( $routes[ $slug ] );
    if ( $located ) {
      return $located;
    }
  }
  return $template;
}
add_filter( 'template_include', 'sikumys_template_include' );

/** sk_page ルートは 404 扱いにせず 200 を返す。 */
function sikumys_fix_static_route_status( $wp_query ) {
  if ( $wp_query->is_main_query() && $wp_query->get( 'sk_page' ) ) {
    $wp_query->is_404  = false;
    $wp_query->is_home = false;
    status_header( 200 );
  }
}
add_action( 'parse_query', 'sikumys_fix_static_route_status' );

function sikumys_excerpt( $limit = 24 ) {
  $excerpt = get_the_excerpt();
  if ( $excerpt ) {
    $excerpt = wp_strip_all_tags( $excerpt );
    return wp_trim_words( $excerpt, $limit, '…' );
  }

  $content = get_the_content();
  $content = wp_strip_all_tags( $content );
  return wp_trim_words( $content, $limit, '…' );
}
