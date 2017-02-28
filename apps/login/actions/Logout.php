<?php
/*
 * AQUA GARDEN ログアウトクラス
 *
 * @access    public
 * @package   AquaGarden.Login
 * @author    Koki Watanabe <k.watanabe@syl.jp>
 * @copyright 2009 Koki Watanabe 
 * @copyright 2009 AQUA GARDEN Project. All rights reserved.
 * @version   $Id:$
 */
class Logout extends AppAction
{
    /**
     * デフォルトアクション処理
     *
     * @access public
     * @param object データ管理オブジェクト
     * @param object コンテキスト管理オブジェクト
     */
    function execute(&$data, &$context)
    {
        $authority_manager =& EuryLManager::getManager('authority');
        $user_data =& $authority_manager->getUser();
        $login_id = $user_data->login_id;
        $authority_manager->logout($context);

        SyL_Loggers::info('Logout: ' . $login_id);
    }
}

?>
