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
  wp_enqueue_style( 'sikumys-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
  wp_enqueue_script( 'sikumys-scripts', get_template_directory_uri() . '/assets/main.js', array(), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'sikumys_assets' );

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
