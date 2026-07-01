# 実装ログ

- 2026-07-01 00:00:00
  - 実施内容: テーマ基盤の作成、フロントページテンプレート、CPT（service/investment）の登録、初期ヘッダー/フッター/スタイルの追加
  - 変更/追加したファイル: assets/main.js, footer.php, front-page.php, functions.php, header.php, inc/cpt.php, inc/meta-box.php, index.php, page.php, style.css
  - コミットハッシュ: adb45ec
  - 次にやること: Meta Box の詳細フィールドとテンプレート分解の深化、固定ページ/投稿の表示調整
  - 詰まった点/判断した点: PHP実行環境がローカルに見当たらなかったため、構文確認は実行不能。テーマの読み込み構造と WordPress 標準に合わせて実装を進めた。

- 2026-07-01 12:00:00
  - 実施内容: `sk_*` ヘルパー関数群を追加し、テーマテンプレートを `sk_opt`, `sk_has`, `sk_opt_group`, `sk_query` などで動的化。`facility_address` フィールド参照を修正。
  - 変更/追加したファイル: inc/helpers.php, footer.php, front-page.php, header.php, page-overview.php, page-message.php, page-philosophy.php
  - コミットハッシュ: pending
  - 次にやること: Meta Box サイト設定内容とテンプレートの実データ反映確認、必要ならテンプレートパーツ分割
