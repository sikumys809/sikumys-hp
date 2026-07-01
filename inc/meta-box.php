<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * CPT メタボックス（指示書§5-3）と サイト設定ページ（§5-2）のフィールド定義。
 * すべて Meta Box プラグインの rwmb_meta_boxes フィルターで登録する。
 */
function sikumys_register_meta_boxes( $meta_boxes ) {

  /* ------------------------------------------------------------------ *
   * CPT メタボックス（§5-3）
   * ------------------------------------------------------------------ */

  // service（事業）
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
        'name' => __( 'タグ（例: 節税対策 × 画家支援）', 'sikumys' ),
        'type' => 'text',
      ),
      array(
        'id'   => 'service_lead',
        'name' => __( 'カード用の短い説明', 'sikumys' ),
        'type' => 'textarea',
      ),
      array(
        'id'   => 'service_body',
        'name' => __( '詳細ページ本文（テキストのみ）', 'sikumys' ),
        'desc' => __( '本文には画像を貼らないでください。ビジュアルは下の「画像」欄に登録します。', 'sikumys' ),
        'type' => 'wysiwyg',
      ),
      array(
        'id'   => 'service_image',
        'name' => __( '画像（TOPカード上・詳細ページ横に表示）', 'sikumys' ),
        'type' => 'single_image',
      ),
      array(
        'id'   => 'service_url',
        'name' => __( '外部サイトURL', 'sikumys' ),
        'type' => 'url',
      ),
    ),
  );

  // investment（投資先）
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
        'name' => __( 'ロゴ', 'sikumys' ),
        'type' => 'single_image',
      ),
      array(
        'id'   => 'investment_url',
        'name' => __( 'URL', 'sikumys' ),
        'type' => 'url',
      ),
    ),
  );

  // facility（事業所）
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
        'name' => __( '画像', 'sikumys' ),
        'type' => 'single_image',
      ),
      array(
        'id'   => 'facility_address',
        'name' => __( '住所', 'sikumys' ),
        'type' => 'text',
      ),
    ),
  );

  /* ------------------------------------------------------------------ *
   * サイト設定ページ（§5-2）— タブごとに1メタボックス
   * ------------------------------------------------------------------ */

  // 共通タブ: ロゴ / フッター / 会社情報 / SNS
  $meta_boxes[] = array(
    'title'          => __( '共通', 'sikumys' ),
    'id'             => 'settings-common',
    'settings_pages' => array( 'site-settings' ),
    'tab'            => 'common',
    'fields'         => array(
      array(
        'id'   => 'logo_header',
        'name' => __( 'ヘッダーロゴ', 'sikumys' ),
        'type' => 'single_image',
      ),
      array(
        'id'   => 'logo_footer',
        'name' => __( 'フッターロゴ', 'sikumys' ),
        'type' => 'single_image',
      ),
      array(
        'id'   => 'footer_catch',
        'name' => __( 'フッターキャッチコピー', 'sikumys' ),
        'type' => 'text',
      ),
      array(
        'id'   => 'company_address',
        'name' => __( '会社住所', 'sikumys' ),
        'type' => 'textarea',
      ),
      array(
        'id'   => 'company_email',
        'name' => __( 'E-mail', 'sikumys' ),
        'type' => 'text',
      ),
      array(
        'id'   => 'sns_facebook',
        'name' => __( 'Facebook URL', 'sikumys' ),
        'type' => 'url',
      ),
      array(
        'id'   => 'sns_youtube',
        'name' => __( 'YouTube URL', 'sikumys' ),
        'type' => 'url',
      ),
      array(
        'id'   => 'sns_instagram',
        'name' => __( 'Instagram URL', 'sikumys' ),
        'type' => 'url',
      ),
      array(
        'id'   => 'sns_x',
        'name' => __( 'X (Twitter) URL', 'sikumys' ),
        'type' => 'url',
      ),
    ),
  );

  // TOPタブ: ヒーロー / VISION / MISSION
  $meta_boxes[] = array(
    'title'          => __( 'TOP', 'sikumys' ),
    'id'             => 'settings-top',
    'settings_pages' => array( 'site-settings' ),
    'tab'            => 'top',
    'fields'         => array(
      array(
        'id'               => 'hero_media',
        'name'             => __( 'ヒーローメディア', 'sikumys' ),
        'type'             => 'file_advanced',
        'max_file_uploads' => 1,
      ),
      array(
        'id'   => 'hero_title',
        'name' => __( 'ヒーロータイトル', 'sikumys' ),
        'type' => 'textarea',
      ),
      array(
        'id'   => 'hero_sub',
        'name' => __( 'ヒーローサブテキスト', 'sikumys' ),
        'type' => 'text',
      ),
      array(
        'id'   => 'vision_heading',
        'name' => __( 'VISION 見出し', 'sikumys' ),
        'type' => 'text',
      ),
      array(
        'id'   => 'vision_body',
        'name' => __( 'VISION 本文', 'sikumys' ),
        'type' => 'textarea',
      ),
      array(
        'id'   => 'vision_infographic_on',
        'name' => __( 'VISION インフォグラフィック表示', 'sikumys' ),
        'type' => 'switch',
        'std'  => 1,
        'on_label'  => __( 'ON', 'sikumys' ),
        'off_label' => __( 'OFF', 'sikumys' ),
      ),
      array(
        'id'   => 'mission_heading',
        'name' => __( 'MISSION 見出し', 'sikumys' ),
        'type' => 'text',
      ),
      array(
        'id'   => 'mission_body',
        'name' => __( 'MISSION 本文', 'sikumys' ),
        'type' => 'textarea',
      ),
    ),
  );

  // Overviewタブ: ロゴ / 会社概要テーブル
  $meta_boxes[] = array(
    'title'          => __( 'Overview', 'sikumys' ),
    'id'             => 'settings-overview',
    'settings_pages' => array( 'site-settings' ),
    'tab'            => 'overview',
    'fields'         => array(
      array(
        'id'   => 'overview_logo',
        'name' => __( 'Overview ロゴ', 'sikumys' ),
        'type' => 'single_image',
      ),
      array(
        'id'         => 'company_info',
        'name'       => __( '会社概要テーブル', 'sikumys' ),
        'type'       => 'group',
        'clone'      => true,
        'sort_clone' => true,
        'add_button' => __( '行を追加', 'sikumys' ),
        'fields'     => array(
          array(
            'id'   => 'label',
            'name' => __( '項目', 'sikumys' ),
            'type' => 'text',
          ),
          array(
            'id'   => 'value',
            'name' => __( '内容', 'sikumys' ),
            'type' => 'textarea',
          ),
        ),
      ),
    ),
  );

  // Messageタブ: 代表メッセージ
  $meta_boxes[] = array(
    'title'          => __( 'Message', 'sikumys' ),
    'id'             => 'settings-message',
    'settings_pages' => array( 'site-settings' ),
    'tab'            => 'message',
    'fields'         => array(
      array(
        'id'   => 'message_portrait',
        'name' => __( '代表者写真', 'sikumys' ),
        'type' => 'single_image',
      ),
      array(
        'id'   => 'message_name',
        'name' => __( '代表者名', 'sikumys' ),
        'type' => 'text',
      ),
      array(
        'id'         => 'message_history',
        'name'       => __( '代表略歴', 'sikumys' ),
        'type'       => 'group',
        'clone'      => true,
        'sort_clone' => true,
        'add_button' => __( '行を追加', 'sikumys' ),
        'fields'     => array(
          array(
            'id'   => 'item',
            'name' => __( '略歴', 'sikumys' ),
            'type' => 'text',
          ),
        ),
      ),
      array(
        'id'   => 'message_lead',
        'name' => __( 'メッセージ リード', 'sikumys' ),
        'type' => 'textarea',
      ),
      array(
        'id'   => 'message_body',
        'name' => __( 'メッセージ 本文', 'sikumys' ),
        'type' => 'wysiwyg',
      ),
      array(
        'id'   => 'message_image',
        'name' => __( 'メッセージ 画像', 'sikumys' ),
        'type' => 'single_image',
      ),
    ),
  );

  // Philosophyタブ: 企業理念 / MIND
  $meta_boxes[] = array(
    'title'          => __( 'Philosophy', 'sikumys' ),
    'id'             => 'settings-philosophy',
    'settings_pages' => array( 'site-settings' ),
    'tab'            => 'philosophy',
    'fields'         => array(
      array(
        'id'   => 'philosophy_heading',
        'name' => __( 'Philosophy 見出し', 'sikumys' ),
        'type' => 'text',
      ),
      array(
        'id'   => 'philosophy_body',
        'name' => __( 'Philosophy 本文', 'sikumys' ),
        'type' => 'textarea',
      ),
      array(
        'id'   => 'philosophy_infographic_on',
        'name' => __( 'Philosophy インフォグラフィック表示', 'sikumys' ),
        'type' => 'switch',
        'std'  => 1,
        'on_label'  => __( 'ON', 'sikumys' ),
        'off_label' => __( 'OFF', 'sikumys' ),
      ),
      array(
        'id'   => 'mind_en',
        'name' => __( 'MIND 英語', 'sikumys' ),
        'type' => 'text',
      ),
      array(
        'id'   => 'mind_jp',
        'name' => __( 'MIND 日本語', 'sikumys' ),
        'type' => 'text',
      ),
      array(
        'id'   => 'mind_body',
        'name' => __( 'MIND 本文', 'sikumys' ),
        'type' => 'textarea',
      ),
    ),
  );

  return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'sikumys_register_meta_boxes' );

/**
 * サイト設定ページ（MB Settings Page）をタブ付きで登録。
 */
function sikumys_register_settings_page( $settings_pages ) {
  $settings_pages[] = array(
    'id'          => 'site-settings',
    'option_name' => SIKUMYS_SETTINGS_OPTION,
    'menu_title'  => __( 'サイト設定', 'sikumys' ),
    'page_title'  => __( 'サイト設定', 'sikumys' ),
    'capability'  => 'manage_options',
    'menu_slug'   => 'sikumys-site-settings',
    'icon_url'    => 'dashicons-admin-customizer',
    'position'    => 59,
    'style'       => 'no-boxes',
    'columns'     => 1,
    'tab_style'   => 'left',
    'tabs'        => array(
      'common'     => __( '共通', 'sikumys' ),
      'top'        => __( 'TOP', 'sikumys' ),
      'overview'   => __( 'Overview', 'sikumys' ),
      'message'    => __( 'Message', 'sikumys' ),
      'philosophy' => __( 'Philosophy', 'sikumys' ),
    ),
  );

  return $settings_pages;
}
add_filter( 'mb_settings_pages', 'sikumys_register_settings_page' );
