<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

function sikumys_register_cpts() {
  register_post_type( 'service', array(
    'labels' => array(
      'name' => __( '事業', 'sikumys' ),
      'singular_name' => __( '事業', 'sikumys' ),
    ),
    'public'      => true,
    'show_ui'     => true,
    'show_in_rest'=> true,
    'has_archive' => false,
    'rewrite'     => array( 'slug' => 'service' ),
    'supports'    => array( 'title', 'page-attributes' ),
    'menu_icon'   => 'dashicons-portfolio',
  ) );

  register_post_type( 'investment', array(
    'labels' => array(
      'name' => __( '投資先', 'sikumys' ),
      'singular_name' => __( '投資先', 'sikumys' ),
    ),
    'public'      => true,
    'show_ui'     => true,
    'show_in_rest'=> true,
    'has_archive' => false,
    'rewrite'     => array( 'slug' => 'investment' ),
    'supports'    => array( 'title', 'page-attributes' ),
    'menu_icon'   => 'dashicons-chart-line',
  ) );

  register_post_type( 'facility', array(
    'labels' => array(
      'name' => __( '事業所', 'sikumys' ),
      'singular_name' => __( '事業所', 'sikumys' ),
    ),
    'public'      => true,
    'show_ui'     => true,
    'show_in_rest'=> true,
    'has_archive' => false,
    'rewrite'     => array( 'slug' => 'facility' ),
    'supports'    => array( 'title', 'page-attributes' ),
    'menu_icon'   => 'dashicons-building',
  ) );

  register_post_type( 'creed', array(
    'labels' => array(
      'name' => __( '10の言葉', 'sikumys' ),
      'singular_name' => __( '言葉', 'sikumys' ),
    ),
    'public'      => true,
    'show_ui'     => true,
    'show_in_rest'=> true,
    'has_archive' => false,
    'rewrite'     => array( 'slug' => 'creed' ),
    'supports'    => array( 'title', 'page-attributes' ),
    'menu_icon'   => 'dashicons-format-quote',
  ) );
}
add_action( 'init', 'sikumys_register_cpts' );
