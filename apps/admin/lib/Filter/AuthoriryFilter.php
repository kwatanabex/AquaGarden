<?php
SyL_Loader::fw('Filter');
SyL_Loader::userLib('EuryL.Manager');

/**
 * メニューハンドリングフィルタクラス
 *
 * @package   SyL
 * @author    Koki Watanabe <k.watanabe@syl.jp>
 * @copyright 2006-2007 k.watanabe
 * @license   http://www.opensource.org/licenses/lgpl-license.php
 * @version   CVS: $Id:$
 * @link      http://www.syl.jp/
 */
class AuthoriryFilter extends SyL_Filter
{
    /**
     * メニューに関する前処理を行う
     *
     * @access public
     * @param object データ管理オブジェクト
     * @param object コンテキストオブジェクト
     */
    function preAction(&$data, &$context)
    {
        $script_name = $context->getScriptName();

        $conn =& $context->getDB();

        $site_manager =& EuryLManager::getManager('site');
        $application_data = $site_manager->getApplication($context);
        if ($application_data == null) {
            // サイト情報登録エラー
            SyL_Response::redirect(dirname($script_name) . '/login.php/error.html?site_not_found');
        }

        $authority_manager =& EuryLManager::getManager('authority');
        $authority_manager->restoreSession($context);

        if (!$authority_manager->isLogin()) {
            // セッションエラー
            SyL_Response::redirect(dirname($script_name) . '/login.php/error.html?session_timeout');
        }

        $menu_manager =& EuryLManager::getManager('menu');
        $menu_manager->createMenuList($context, $application_data->application_id);
        $menus =& $menu_manager->getMenuList();
        if (!$authority_manager->applyAuthority($menus)) {
            // メニュー権限エラー
            SyL_Response::redirect(dirname($script_name) . '/login.php/error.html?access_forbidden');
        }

        //$current_menu =& $menu_manager->getCurrentMenu();

        $data->setRef('ag_menu_list', $menus);
        $data->setRef('ag_pankuzu_list', $menu_manager->getPankuzuMenuList());
        $data->setRef('ag_script_name', $script_name);
        $data->setRef('ag_script_dir', dirname($script_name));
/*
        // タイトル名
        $data->set('aq_title', $current_menu->getName());
        // ユーザー名
        $data->set('aq_login_user_name', $user->getName());

        // パンクズ配列
        $data->set('aq_menu_pankuzu', $menu_manager->getPankuzuList($menu, $urls));
        // JS DTree用データ配列
        $data->set('aq_menu_dtree', $menu_manager->convertToArray($menu, $urls));
        // カレントメニューID
        $data->set('aq_menu_current_id', $current_menu->getId());
*/
    }

    /**
     * メニューに関する後処理を行う
     *
     * @access public
     * @param object データ管理オブジェクト
     * @param object コンテキストオブジェクト
     */
    function postAction(&$data, &$context)
    {
/*
        if (!preg_match('/^js\./i', $context->getViewType())) {
            $template_dir  = $context->getTemplateDir();
            $template_file = $context->getTemplateFile(false);

            // テンプレートファイルが無い場合、
            // 子メニューがあればメニューインデックスを表示する
            if (!is_file($template_dir . $template_file)) {
                $menu_index = array();
                $menu_current_id = $data->get('aq_menu_current_id');
                foreach ($data->get('aq_menu_dtree') as $menu) {
                    if ($menu_current_id == $menu[1]) {
                        $menu_index[] = $menu;
                    }
                }
                // 子メニュー数判定
                if (count($menu_index) > 0) {
                    // 子メニュー配列
                    $data->set('aq_menu_index', $menu_index);
                    // メニューインデックス用テンプレートセット
                    $context->setTemplateFile('/Common/menu_index.html');
                }
            }
        }
*/
    }
}

?>
