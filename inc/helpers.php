<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

function sikumys_get_setting( $key, $default = '' ) {
  $settings = get_option( SIKUMYS_SETTINGS_OPTION, array() );
  return isset( $settings[ $key ] ) ? $settings[ $key ] : $default;
}

function sikumys_get_setting_html( $key, $default = '' ) {
  return wp_kses_post( sikumys_get_setting( $key, $default ) );
}

function sikumys_has_setting( $key ) {
  $setting = sikumys_get_setting( $key );
  return '' !== trim( (string) $setting );
}

function sikumys_get_setting_array( $key ) {
  $settings = get_option( SIKUMYS_SETTINGS_OPTION, array() );
  return isset( $settings[ $key ] ) && is_array( $settings[ $key ] ) ? $settings[ $key ] : array();
}

function sk_opt( $key, $default = '' ) {
  return sikumys_get_setting( $key, $default );
}

function sk_has( $key ) {
  return sikumys_has_setting( $key );
}

function sk_opt_group( $key ) {
  return sikumys_get_setting_array( $key );
}

function sk_img( $key, $size = 'full', $attrs = array() ) {
  $value = sikumys_get_setting( $key );
  if ( ! $value ) {
    return '';
  }

  if ( is_array( $value ) ) {
    $value = reset( $value );
  }

  if ( is_numeric( $value ) ) {
    return wp_get_attachment_image( intval( $value ), $size, false, $attrs );
  }

  if ( is_string( $value ) && filter_var( $value, FILTER_VALIDATE_URL ) ) {
    $attributes = '';
    if ( ! empty( $attrs ) ) {
      foreach ( $attrs as $name => $attr_value ) {
        $attributes .= sprintf( ' %s="%s"', esc_attr( $name ), esc_attr( $attr_value ) );
      }
    }
    return sprintf( '<img src="%s"%s>', esc_url( $value ), $attributes );
  }

  return '';
}

function sk_opt_image( $key, $size = 'full', $attrs = array() ) {
  return sk_img( $key, $size, $attrs );
}

function sk_post_image( $size = 'full', $attrs = array() ) {
  if ( ! has_post_thumbnail() ) {
    return '';
  }

  return get_the_post_thumbnail( null, $size, $attrs );
}

function sk_echo( $value ) {
  echo esc_html( $value );
}

function sk_query( $args = array() ) {
  return new WP_Query( $args );
}
