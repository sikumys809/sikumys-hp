<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

function sikumys_register_meta_boxes( $meta_boxes ) {
  $meta_boxes[] = array(
    'title'      => __( 'Service Detail', 'sikumys' ),
    'id'         => 'service-detail',
    'post_types' => array( 'service' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'autosave'   => true,
    'fields'     => array(
      array(
        'id'   => 'service_tag',
        'name' => __( 'Tag', 'sikumys' ),
        'type' => 'text',
      ),
      array(
        'id'   => 'service_lead',
        'name' => __( 'Lead', 'sikumys' ),
        'type' => 'textarea',
      ),
      array(
        'id'   => 'service_body',
        'name' => __( 'Body', 'sikumys' ),
        'type' => 'wysiwyg',
      ),
      array(
        'id'   => 'service_image',
        'name' => __( 'Image', 'sikumys' ),
        'type' => 'single_image',
      ),
      array(
        'id'   => 'service_url',
        'name' => __( 'Service URL', 'sikumys' ),
        'type' => 'url',
      ),
    ),
  );

  $meta_boxes[] = array(
    'title'      => __( 'Investment Detail', 'sikumys' ),
    'id'         => 'investment-detail',
    'post_types' => array( 'investment' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'autosave'   => true,
    'fields'     => array(
      array(
        'id'   => 'investment_logo',
        'name' => __( 'Logo', 'sikumys' ),
        'type' => 'image_advanced',
        'max_file_uploads' => 1,
      ),
      array(
        'id'   => 'investment_url',
        'name' => __( 'Investment URL', 'sikumys' ),
        'type' => 'url',
      ),
    ),
  );

  $meta_boxes[] = array(
    'title'      => __( 'Facility Detail', 'sikumys' ),
    'id'         => 'facility-detail',
    'post_types' => array( 'facility' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'autosave'   => true,
    'fields'     => array(
      array(
        'id'   => 'facility_image',
        'name' => __( 'Image', 'sikumys' ),
        'type' => 'image_advanced',
        'max_file_uploads' => 1,
      ),
      array(
        'id'   => 'facility_address',
        'name' => __( 'Address', 'sikumys' ),
        'type' => 'text',
      ),
      array(
        'id'   => 'facility_hours',
        'name' => __( 'Open Hours', 'sikumys' ),
        'type' => 'text',
      ),
    ),
  );

  $meta_boxes[] = array(
    'title'          => __( 'Site Settings', 'sikumys' ),
    'id'             => 'site-settings-fields',
    'settings_pages' => array( 'site-settings' ),
    'fields'         => array(
      array(
        'id'   => 'hero_headline',
        'name' => __( 'Hero Headline', 'sikumys' ),
        'type' => 'text',
      ),
      array(
        'id'   => 'hero_subtitle',
        'name' => __( 'Hero Subtitle', 'sikumys' ),
        'type' => 'textarea',
      ),
      array(
        'id'   => 'hero_image',
        'name' => __( 'Hero Image', 'sikumys' ),
        'type' => 'image_advanced',
        'max_file_uploads' => 1,
      ),
      array(
        'id'   => 'vision_text',
        'name' => __( 'VISION Text', 'sikumys' ),
        'type' => 'textarea',
      ),
      array(
        'id'   => 'mission_text',
        'name' => __( 'MISSION Text', 'sikumys' ),
        'type' => 'textarea',
      ),
      array(
        'id'   => 'overview_text',
        'name' => __( 'Overview Text', 'sikumys' ),
        'type' => 'textarea',
      ),
      array(
        'id'   => 'message_text',
        'name' => __( 'Message Text', 'sikumys' ),
        'type' => 'textarea',
      ),
      array(
        'id'   => 'philosophy_text',
        'name' => __( 'Philosophy Text', 'sikumys' ),
        'type' => 'textarea',
      ),
      array(
        'id'   => 'footer_text',
        'name' => __( 'Footer Text', 'sikumys' ),
        'type' => 'textarea',
      ),
      array(
        'id'   => 'social_twitter',
        'name' => __( 'Twitter URL', 'sikumys' ),
        'type' => 'url',
      ),
      array(
        'id'   => 'social_instagram',
        'name' => __( 'Instagram URL', 'sikumys' ),
        'type' => 'url',
      ),
      array(
        'id'   => 'social_linkedin', 'name' => __( 'LinkedIn URL', 'sikumys' ),
        'type' => 'url',
      ),
      array(
        'id'   => 'company_table',
        'name' => __( 'Company Table', 'sikumys' ),
        'type' => 'group',
        'clone' => true,
        'sort_clone' => true,
        'fields' => array(
          array(
            'id'   => 'company_field_name',
            'name' => __( 'Field', 'sikumys' ),
            'type' => 'text',
          ),
          array(
            'id'   => 'company_field_value',
            'name' => __( 'Value', 'sikumys' ),
            'type' => 'text',
          ),
        ),
      ),
      array(
        'id'   => 'profile_entries',
        'name' => __( 'Representative Profile', 'sikumys' ),
        'type' => 'group',
        'clone' => true,
        'sort_clone' => true,
        'fields' => array(
          array(
            'id'   => 'profile_label',
            'name' => __( 'Label', 'sikumys' ),
            'type' => 'text',
          ),
          array(
            'id'   => 'profile_value',
            'name' => __( 'Value', 'sikumys' ),
            'type' => 'text',
          ),
        ),
      ),
      array(
        'id'   => 'representative_photo',
        'name' => __( 'Representative Photo', 'sikumys' ),
        'type' => 'image_advanced',
        'max_file_uploads' => 1,
      ),
    ),
  );

  return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'sikumys_register_meta_boxes' );

function sikumys_register_settings_page() {
  $settings_pages = array();

  $settings_pages[] = array(
    'id'          => 'site-settings',
    'option_name' => SIKUMYS_SETTINGS_OPTION,
    'menu_title'  => __( 'サイト設定', 'sikumys' ),
    'page_title'  => __( 'サイト設定', 'sikumys' ),
    'capability'  => 'manage_options',
    'menu_slug'   => 'sikumys-site-settings',
  );

  return $settings_pages;
}
add_filter( 'mb_settings_pages', 'sikumys_register_settings_page' );