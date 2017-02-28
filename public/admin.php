<?php
error_reporting(E_ALL);

/**
 * 初期化定数とコントローラクラスの読み込み
 */
require_once '/usr/local/apache2/data/SyL/SyL.php';

/**
 * 起動パラメータの設定
 *
 *  project_dir - プロジェクトディレクトリ
 *  app_name    - アプリケーション名
 *  action_key  - アクションパラメータのキー名
 *  cache       - キャッシュ使用方法（※未入力でキャッシュを使用しない）
 */
$config = array(
  'project_dir'  => '/usr/local/apache2/data/projects/AquaGarden',
  'app_name'     => 'admin',
  'action_key'   => 'action',
  'cache'        => 'file'
);

/**
 * フレームワーク起動
 */
SyL_Controller::streaming($config);

?>
