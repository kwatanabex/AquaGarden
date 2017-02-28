<?php
SyL_Loader::userLib('EuryL.Manager');
/**
 * Index クラス
 *
 * @access    public
 * @package   test
 * @author    {author}
 * @copyright {copyright}
 * @version   $Id:$
 */
class Index extends AppAction
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
        $authority_manager =& EuryLManager::getManager('authority');

        // -----------------------------
        // ログインエラー
        // -----------------------------
        $user_data = EuryLManager::createData('user');
        $user_data->login_id = "user";
        $user_data->login_passwd = "badpass";

        if ($authority_manager->login($user_data)) {
            // セッション登録 $authority_manager
            echo "Login OK\n";
        } else {
            echo "Login NG\n";
        }

        // -----------------------------
        // ログイン成功
        // -----------------------------
        $user_data = EuryLManager::createData('user');
        $user_data->login_id = "administrator";
        $user_data->login_passwd = "euryl";

        if ($authority_manager->login($user_data)) {
            // セッション登録 $authority_manager
            echo "Login OK\n";
        } else {
            echo "Login NG\n";
        }

        // -----------------------------
        // 権限マネージャ
        // -----------------------------
        //print_r($authority_manager);

        echo "site auth: " . $authority_manager->isSite("1") . "\n";
        //echo "menu auth: " . $authority_manager->isMenu("1") . "\n";

        // -----------------------------
        // ユーザーデータ取得
        // -----------------------------
        $user_data = $authority_manager->getUser();
        print_r($user_data);


        // -----------------------------
        // ユーザーデータ登録
        // -----------------------------
        $user_manager =& EuryLManager::getManager('user');
        $user_data = EuryLManager::createData('user');
        $user_data->login_id = "user";
        $user_data->login_passwd = "userpass";
        $user_data->name = "general user";
        $user_data->email = "k-wata@syl.jp";
        $i = 1;
        while ($user_manager->existsUser($user_data)) {
            $user_data->login_id = "user" . $i;
            $i++;
        }
        $user_manager->addUser($user_data);

        // -----------------------------
        // ユーザーデータ更新
        // -----------------------------
        $user_manager =& EuryLManager::getManager('user');
        $user_data = null;
        $user_data = $user_manager->getUser($user_data);
        $user_data->login_id = "user";
        $user_data->login_passwd = "userpass";
        $user_data->name = "general user";
        $user_data->email = "k-wata@syl.jp";
        $i = 1;
        while ($user_manager->existsUser($user_data)) {
            $user_data->login_id = "user" . $i;
            $i++;
        }
        $user_manager->addUser($user_data);
    }

}

?>
