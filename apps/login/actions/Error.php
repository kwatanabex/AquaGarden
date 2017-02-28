<?php
/**
 * AQUA GARDEN エラークラス
 *
 * @access    public
 * @package   AquaGarden.Login
 * @author    Koki Watanabe <k.watanabe@syl.jp>
 * @copyright 2009 Koki Watanabe 
 * @copyright 2009 AQUA GARDEN Project. All rights reserved.
 * @version   $Id:$
 */
class Error extends AppAction
{
    /**
     * デフォルトアクション処理
     *
     * @access public
     * @param object データ管理オブジェクト
     * @param object コンテキスト管理オブジェクト
     * @return void
     */
    function execute(&$data, &$context)
    {
        $error = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';

        $error_message = '';
        $historyback   = false;
        switch ($error) {
        // サイト取得エラー
        case 'site_not_found':
            $error_message = 'サイト情報が登録されていません';
            $historyback = true;
            break;
        // 権限エラー
        case 'access_forbidden':
            $error_message = 'アクセスしたURLに対する権限がありません。';
            $historyback = true;
            break;
        // セッションエラー
        case 'session_timeout':
            $error_message = 'ログインしていないか、またはセッションがタイムアウトしました。<br />再度ログイン画面からアクセスしてください';
            $historyback = false;
            break;
        // セッションエラー
        case '404_not_found':
            $error_message = '指定したURLに対するファイルが存在しません。<br />再度URLを確認してください。';
            $historyback = true;
            break;
            
        default:
            $error_title   = '内部エラー';
            $error_message = '内部エラーが発生しました。<br />しばらく時間を置いてから再度アクセスするか、緊急の場合は管理者に連絡してください';
            $historyback = true;
        }

        $data->set('historyback',   $historyback);
        $data->set('error_message', $error_message);
    }
}

?>
