<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

function sikumys_register_cpts() {
  register_post_type( 'service', array(
    'labels' => array(
      'name' => __( 'Services', 'sikumys' ),
      'singular_name' => __( 'Service', 'sikumys' ),
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array( 'slug' => 'service' ),
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    'show_in_rest' => true,
  ) );

  register_post_type( 'investment', array(
    'labels' => array(
      'name' => __( 'Investments', 'sikumys' ),
      'singular_name' => __( 'Investment', 'sikumys' ),
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array( 'slug' => 'investment' ),
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    'show_in_rest' => true,
  ) );
}
add_action( 'init', 'sikumys_register_cpts' );
