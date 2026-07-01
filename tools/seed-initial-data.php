<?php
/**
 * ステップ7 初期データ投入（冪等・再現用）。
 *
 * 実行方法（LocalのSite shell）:
 *   wp eval-file wp-content/themes/sikumys/tools/seed-initial-data.php
 *
 * サイト設定（Meta Box）・CPT（service/investment/facility/creed）・メディア（ロゴ/代表写真）を投入する。
 * 再実行時は種データ（_sikumys_seed）を入れ替えるため重複しない。内容は Notion「shikumyの自社HP改修」より。
 */

if ( ! defined( 'ABSPATH' ) ) {
  fwrite( STDERR, "WordPress 環境で実行してください（例: wp eval-file ...）。\n" );
  exit( 1 );
}

require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$THEME = get_template_directory();

/** ローカル画像をメディアに登録（seedキーで冪等）。添付IDを返す。 */
function sikumys_seed_attachment( $src, $key, $title ) {
  $found = get_posts( array(
    'post_type' => 'attachment', 'posts_per_page' => 1, 'post_status' => 'inherit',
    'meta_key' => '_sikumys_seed', 'meta_value' => $key, 'fields' => 'ids', 'no_found_rows' => true,
  ) );
  if ( $found ) {
    return $found[0];
  }
  if ( ! file_exists( $src ) ) {
    echo "  [WARN] missing image: $src\n";
    return 0;
  }
  $up   = wp_upload_dir();
  $base = wp_unique_filename( $up['path'], basename( $src ) );
  $dest = $up['path'] . '/' . $base;
  copy( $src, $dest );
  $ft  = wp_check_filetype( $base, null );
  $id  = wp_insert_attachment( array(
    'post_mime_type' => $ft['type'], 'post_title' => $title, 'post_content' => '', 'post_status' => 'inherit',
  ), $dest );
  wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $dest ) );
  update_post_meta( $id, '_sikumys_seed', $key );
  return $id;
}

/** CPT を1件投入（_sikumys_seed=1 でマーキング）。 */
function sikumys_seed_cpt( $type, $title, $order, $meta ) {
  $id = wp_insert_post( array(
    'post_type' => $type, 'post_status' => 'publish', 'post_title' => $title, 'menu_order' => $order,
  ), true );
  if ( is_wp_error( $id ) ) {
    echo "  [ERR] $title: " . $id->get_error_message() . "\n";
    return 0;
  }
  update_post_meta( $id, '_sikumys_seed', '1' );
  foreach ( $meta as $k => $v ) {
    if ( '' !== $v && null !== $v ) {
      update_post_meta( $id, $k, $v );
    }
  }
  return $id;
}

/* ---- 画像（ロゴZIPを一時展開して登録） ---- */
echo "=== images ===\n";
$logo_wide = 0; $logo_mark = 0;
$tmp = trailingslashit( get_temp_dir() ) . 'sikumys-rogo-' . wp_generate_password( 6, false );
if ( class_exists( 'ZipArchive' ) && file_exists( $THEME . '/sikumys-rogo-03.zip' ) ) {
  wp_mkdir_p( $tmp );
  $zip = new ZipArchive();
  if ( true === $zip->open( $THEME . '/sikumys-rogo-03.zip' ) ) {
    $zip->extractTo( $tmp );
    $zip->close();
  }
  $logo_wide = sikumys_seed_attachment( $tmp . '/sikumys-rogo-03.png', 'logo_wide', 'SIKUMYS ロゴ' );
  $logo_mark = sikumys_seed_attachment( $tmp . '/sikumys-rogo-02.png', 'logo_mark', 'SIKUMYS マーク' );
}
$portrait = sikumys_seed_attachment( $THEME . '/水野永吉.png', 'portrait', '水野永吉' );
echo "  logo_wide=$logo_wide logo_mark=$logo_mark portrait=$portrait\n";

/* ---- 1. サイト設定 ---- */
echo "=== settings ===\n";
$opt = get_option( SIKUMYS_SETTINGS_OPTION );
if ( ! is_array( $opt ) ) {
  $opt = array();
}
$opt['logo_header']      = $logo_wide ?: '';
$opt['logo_footer']      = $logo_wide ?: '';
$opt['overview_logo']    = $logo_mark ?: '';
$opt['message_portrait'] = $portrait ?: '';

$opt['hero_title']      = "CREATING EVERY\n\"HAPPINESS\"\nIN THIS WORLD.";
$opt['hero_sub']        = "世の中を、もっと豊かで、便利で、楽しく。";
$opt['footer_catch']    = "Necessity is the mother of invention.";
$opt['company_address'] = "〒160-0023 東京都新宿区西新宿5-24-17 SIL 6階";
$opt['company_email']   = "info@sikumys.co.jp";

$opt['vision_heading']        = "仕組みが、幸せの連鎖をつくる。";
$opt['vision_body']           = "私たちは、人々の暮らしや社会に新たな価値を生み出す“仕組み”を創造し続けます。\nひとつの仕組みが、誰かの笑顔を生み、新しい幸せの連鎖をつくっていく。\nそんな未来を目指しています。";
$opt['mission_heading']       = "私たちは、仕組みを創造する企業です。";
$opt['mission_body']          = "世の中を豊かで便利で楽しくするために、必要とされる“仕組み”を考え、形にし、育て続けます。\n好奇心を原動力に、課題を可能性へ変え、新しい価値を社会へ届けます。";
$opt['vision_infographic_on'] = 1;

$opt['philosophy_heading']        = "世界一幸せな仕組みを持つ会社を創る。";
$opt['philosophy_body']           = "私たちは、仕組みそのものだけでなく、その先にいる人まで幸せにする会社を目指します。\n一人ひとりの豊かな人生が、豊かな企業を育て、やがて世界を少しずつ豊かにすると信じています。";
$opt['philosophy_infographic_on'] = 1;
$opt['mind_en']   = "Necessity is the mother of invention.";
$opt['mind_jp']   = "必要は発明の母なり。";
$opt['mind_body'] = "私たちは、好奇心を持ち、本質を見極め、慎重かつ大胆に挑戦します。失敗を恐れず、逆境を楽しみ、行動し続けること。一人ひとりが豊かな人生を歩み、その豊かな価値観が、新しい仕組みを生み出す力になると信じています。";

$opt['message_name'] = "Eikichi Mizuno / 代表取締役";
$opt['message_lead'] = "世界一幸せな仕組みを\n持つ会社を創る。";
$opt['message_history'] = array(
  array( 'item' => '広島県に生まれる' ),
  array( 'item' => '2011年 慶應義塾大学卒業' ),
  array( 'item' => '2011年 株式会社ハッピーズ創業（専務取締役）' ),
  array( 'item' => '2017年 株式会社シクミーズ創業（代表取締役）' ),
);
$opt['message_body'] =
  "<p>当社では、「Creating every &quot;happiness&quot; in this world.」というビジョンのもと、世の中がハッピーになるような【仕組み】を創りつづけます。会社名である「シクミーズ」には、仕組みを創り続ける創造性豊かな集合体という思いが込められています。</p>\n" .
  "<p>私は、昔から「なぜ？どうして？」と、物事に疑問を持ち深く追求するような子供でした。小学低学年の頃、カメの甲羅は何で出来ているのだろう？　そう気になると、いてもたってもいられずに図鑑を買いあさって調べた記憶があります。今のようにインターネットが主流の時代ではなかったので、疑問に対する答えを導き出すにも苦労した覚えがあります。</p>\n" .
  "<p>様々なことに興味・関心を寄せることで、今まで知らなかった世界を知り、気にも止めなかったような事に気付きが生まれます。これまでに先人達が生み出してきた様々な発明、サービスも、始まりは「小さな」興味関心から生まれています。</p>\n" .
  "<p>株式会社シクミーズでは、常に「世の中がハッピーになるような仕組み」を創り続けます。世界がアッと驚くような仕組みから、とても自然で必要不可欠な仕組みまで、好奇心と想像力を持って「Creating」します。</p>";

$opt['company_info'] = array(
  array( 'label' => '社名', 'value' => '株式会社シクミーズ「sikumys, inc.」' ),
  array( 'label' => '企業サイト', 'value' => 'https://sikumys.co.jp/' ),
  array( 'label' => '本社', 'value' => '東京都新宿区西新宿5-24-17 SIL 6階' ),
  array( 'label' => 'Gallery / Gym', 'value' => '東京都新宿区西新宿4-3-13 西新宿三関ビル ／ 東京都渋谷区本町3-49-16 西新宿アイコービル' ),
  array( 'label' => 'E-mail', 'value' => 'info@sikumys.co.jp' ),
  array( 'label' => '創業', 'value' => '2017年6月' ),
  array( 'label' => '資本金', 'value' => '3,000万円' ),
  array( 'label' => '代表', 'value' => '水野永吉' ),
  array( 'label' => '代表略歴', 'value' => '慶應義塾大学商学部卒。2011年、株式会社ハッピーズを創業し、創業2年で年商1億円を達成。WEBサービス【交通事故病院】の開発に従事。2017年、株式会社シクミーズを創業。' ),
  array( 'label' => '取引銀行', 'value' => '城南信用金庫' ),
  array( 'label' => '事業許可証', 'value' => '有料職業紹介事業許可証（13-ユ-313811）／労働者派遣事業許可証（派13-315776）／古物商許可証（304362220830）' ),
  array( 'label' => '主要取引先', 'value' => 'SAPジャパン／ツバキスタイル／大阪ソーダ労働組合／オリエントコーポレーション労働組合／フォルクスワーゲンジャパン販売／大日本印刷労働組合／ガイカーペンター／現代文化研究所労働組合／博報堂ダイレクト／ポーラ／ビックケミー・ジャパン／三菱UFJ信託銀行従業員組合／日立システムズフィールドサービス／日広建設／大戸屋ホールディングス／丹青社／バイオベラティブ・ジャパン／ラムセス　他' ),
);

update_option( SIKUMYS_SETTINGS_OPTION, $opt );
echo "  settings saved (" . count( $opt ) . " keys)\n";

/* ---- 2. CPT（既存の種投稿を入れ替え） ---- */
foreach ( array( 'service', 'investment', 'facility', 'creed' ) as $pt ) {
  $olds = get_posts( array(
    'post_type' => $pt, 'posts_per_page' => -1, 'post_status' => 'any',
    'meta_key' => '_sikumys_seed', 'meta_value' => '1', 'fields' => 'ids', 'no_found_rows' => true,
  ) );
  foreach ( $olds as $oid ) {
    wp_delete_post( $oid, true );
  }
}

echo "=== service ===\n";
$services = array(
  array( 'Bank of Art', '節税対策 × 画家支援', 'アート作品を「資産」として活用する、法人・事業者向けサービス。',
    "画家の未来を支える仕組みを。アートは、人の心を豊かにするもの。その価値を未来へつなぐために、企業と画家を結び、新たな循環を生み出します。\n「企業の資産」と「画家の創作活動」をつなぐことで、アートが社会に巡り続ける仕組みを創造しています。",
    'https://bankof-art.com/' ),
  array( 'お料理ファシリテーション', 'チームビルディング', 'キッチンスタジオで、通常業務では見られない新たな一面を互いに知る機会を提供。',
    "人と人がつながる仕組みを。食卓は、ただ料理を囲む場所ではありません。会話が生まれ、笑顔が広がり、互いを知るきっかけとなる、大切なコミュニケーションの場です。\nお料理を通して人と人との距離を縮め、新しい出会いや信頼が育まれる仕組みを創造しています。",
    'https://eikichi-building.com/?page_id=5517' ),
  array( 'コッソリFIRE予備校', '経済的自立 × 早期リタイア', '国や会社に依存しない生き方を目指す、資産形成と人生設計の学び舎。',
    "自分らしい人生を築く仕組みを。経済的な自由は、ゴールではなく新しい人生のスタートです。正しい知識と考え方を身につけ、未来を自ら選択できる力を育む。\n一人ひとりが自分らしい人生を描けるよう、資産形成と人生設計を支える仕組みを創造しています。",
    'https://www.kosori-fire.com/' ),
  array( 'コッソリFIREジム', 'パーソナルジム', '前田健太が認めた“消えた天才”が監修する、ダイエット専門のパーソナルジム。',
    "前田健太が認めた“消えた天才”が監修するパーソナルジム。ダイエットを科学し、結果にコミットする学びの場を提供します。",
    'https://www.gym.kosori-fire.com/' ),
);
$i = 0;
foreach ( $services as $s ) {
  $i++;
  $id = sikumys_seed_cpt( 'service', $s[0], $i, array( 'service_tag' => $s[1], 'service_lead' => $s[2], 'service_body' => $s[3], 'service_url' => $s[4] ) );
  echo "  #$i $s[0] => $id\n";
}

echo "=== investment ===\n";
$invs = array(
  array( 'Konohikara', 'https://www.konohikara.co.jp/' ),
  array( 'diffuse', 'https://diffuse.jp/' ),
  array( 'MOOOVE', 'https://mooove.jp/' ),
  array( 'CONOC', 'https://conoc-dx.co.jp/' ),
  array( 'Robokaru', 'https://robokaru.jp/' ),
  array( 'CLEA. LLC', 'https://clea.llc/' ),
);
$i = 0;
foreach ( $invs as $v ) {
  $i++;
  $id = sikumys_seed_cpt( 'investment', $v[0], $i, array( 'investment_url' => $v[1] ) );
  echo "  #$i $v[0] => $id\n";
}

echo "=== facility ===\n";
$facs = array(
  array( '本社 / Head Office', '東京都新宿区西新宿5-24-17 SIL 6階' ),
  array( 'Gallery', '東京都新宿区西新宿4-3-13 西新宿三関ビル' ),
  array( 'Gym', '東京都渋谷区本町3-49-16 西新宿アイコービル' ),
);
$i = 0;
foreach ( $facs as $f ) {
  $i++;
  $id = sikumys_seed_cpt( 'facility', $f[0], $i, array( 'facility_address' => $f[1] ) );
  echo "  #$i $f[0] => $id\n";
}

echo "=== creed ===\n";
$creeds = array( '慎重かつ大胆に', 'バランスを意識', '偶然さえも必然に', '出過ぎた杭になれ', '豊かな人生を歩もう',
  '怒りは愚か者、焦りは未熟者', '信用しても信頼はするな', '逆境に強くなろう', '実行者には賛辞を送ろう', '弱音を吐くな、夢を叶えろ' );
$i = 0;
foreach ( $creeds as $c ) {
  $i++;
  $id = sikumys_seed_cpt( 'creed', $c, $i, array() );
  echo "  #" . sprintf( '%02d', $i ) . " $c => $id\n";
}

echo "\nDONE\n";
