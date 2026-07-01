<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

function sikumys_register_meta_boxes() {
  if ( ! function_exists( 'rwmb_meta' ) ) {
    return;
  }

  $meta_boxes[] = array(
    'title' => __( 'Service Detail', 'sikumys' ),
    'id' => 'service-detail',
    'post_types' => array( 'service' ),
    'fields' => array(
      array(
        'id' => 'service_subtitle',
        'name' => __( 'Subtitle', 'sikumys' ),
        'type' => 'text',
      ),
      array(
        'id' => 'service_benefit',
        'name' => __( 'Benefit', 'sikumys' ),
        'type' => 'textarea',
      ),
    ),
  );

  $meta_boxes[] = array(
    'title' => __( 'Investment Detail', 'sikumys' ),
    'id' => 'investment-detail',
    'post_types' => array( 'investment' ),
    'fields' => array(
      array(
        'id' => 'investment_category',
        'name' => __( 'Category', 'sikumys' ),
        'type' => 'text',
      ),
    ),
  );

  foreach ( $meta_boxes as $meta_box ) {
    register_meta_box( $meta_box );
  }
}
add_action( 'init', 'sikumys_register_meta_boxes' );
