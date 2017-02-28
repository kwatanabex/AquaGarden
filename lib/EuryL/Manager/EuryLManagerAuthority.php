<?php
/**
 * AQUARIMユーザードメインマネージャクラス
 *
 * @package   SyL
 * @author    Koki Watanabe <k.watanabe@syl.jp>
 * @copyright 2006-2007 k.watanabe
 * @license   http://www.opensource.org/licenses/lgpl-license.php
 * @version   CVS: $Id:$
 * @link      http://www.syl.jp/
 */
class EuryLManagerAuthority extends EuryLManager
{
    /**
     * ユーザーデータ
     *
     * @access private
     * @var EuryLDataUser
     */
     var $user_data = null;
    /**
     * 権限データ
     *
     * @access private
     * @var EuryLDataAuthority
     */
     var $authority_data = null;
    /**
     * 管理者権限ID
     *
     * @access private
     * @var int
     */
     var $admin_authority_id = 1;
    /**
     * セッションキー
     *
     * @access private
     * @var string
     */
     var $session_key = 'EuryLManagerAuthorityProperties';

    /**
     * ユーザー管理オブジェクトを取得する
     *
     * @access public
     * @return object ユーザー管理オブジェクト
     */
    function &getUser()
    {
        return $this->user_data;
    }

    /**
     * ログイン認証
     *
     * @access public
     * @param object コンテキストオブジェクト
     * @param object ユーザーデータオブジェクト
     * @return bool true: OK、false: NG
     */
    function login(&$context, &$user_data)
    {
        if (!$user_data->login_id || !$user_data->login_passwd) {
            return false;
        }
        $user_manager =& EuryLManager::getManager('user');
        $this->user_data = $user_manager->getUser($user_data);
        if (($this->user_data != null) && $this->createAuthority($this->user_data->id)) {
            $user_manager->addUserHistory($user_data, 'Login Success');
            $request =& $context->getRequest();
            $request->setSession($this->session_key, array($this->user_data, $this->authority_data));
            return true;
        } else {
            $user_manager->addUserHistory($user_data, 'Login Failer');
            return false;
        }
    }

    /**
     * ログイン認証
     *
     * @access public
     * @param object コンテキストオブジェクト
     * @param object ユーザーデータオブジェクト
     * @return bool true: OK、false: NG
     */
    function logout(&$context)
    {
        $user_manager =& EuryLManager::getManager('user');
        $user_manager->addUserHistory($this->user_data, 'Logout Success');

        $request =& $context->getRequest();
        $session =& $request->getSessionObject();
        $session->deletes();
    }

    /**
     * ログイン状態判定
     *
     * @access public
     * @return bool true: OK、false: NG
     */
    function isLogin()
    {
        return ($this->user_data != null);
    }

    /**
     * 認証データをリストアする
     *
     * @access public
     * @param object コンテキストオブジェクト
     */
    function restoreSession(&$context)
    {
        $request =& $context->getRequest();
        $properties = $request->getSession($this->session_key);
        if (is_array($properties) && (count($properties) == 2)) {
            list($this->user_data, $this->authority_data) = $properties;
        }
    }

    /**
     * 各権限データを取得し、プロパティにセットする
     *
     * @access public
     * @param string ユーザーID
     */
    function createAuthority($user_id)
    {
        $authorities = array();

        $user_authority_table = EuryLManager::createTable('el_user_authority');
        $condition = $this->dao->createCondition();
        $condition->addEqual('USER_ID', $user_id);
        $user_authority_table->setConditions($condition);
        foreach ($this->dao->select($user_authority_table) as $authority) {
            $authorities[] = $authority['AUTHORITY_ID'];
        }

        if (count($authorities) == 0) {
            return false;
        }

        $this->authority_data = EuryLManager::createData('authority');
        if (array_search($this->admin_authority_id, $authorities) !== false) {
            $this->authority_data->is_admin = true;
        } else {
            $this->authority_data->is_admin = false;
            $site_id = array();
            $site_authority_table = EuryLManager::createTable('el_site_authority');
            $condition = $this->dao->createCondition();
            $condition->addIn('AUTHORITY_ID', $authorities);
            $site_authority_table->setConditions($condition);
            foreach ($this->dao->select($site_authority_table) as $authority) {
                $site_id[$authority['SITE_ID']] = false;
            }
            $this->authority_data->site_id = $site_id;

            $menu_id = array();
            $menu_authority_table = EuryLManager::createTable('el_menu_authority');
            $condition = $this->dao->createCondition();
            $condition->addIn('AUTHORITY_ID', $authorities);
            $menu_authority_table->setConditions($condition);
            foreach ($this->dao->select($menu_authority_table) as $authority) {
                if (isset($menu_id[$authority['MENU_ID']])) {
                    if (!$menu_id[$authority['MENU_ID']]) {
                        $menu_id[$authority['MENU_ID']] = ($authority['LOWER_ACCESS_FLAG'] == '1');
                    }
                } else {
                    $menu_id[$authority['MENU_ID']] = ($authority['LOWER_ACCESS_FLAG'] == '1');
                }
            }
            $this->authority_data->menu_id = $menu_id;
        }

        return true;
    }

    /**
     * サイトの権限判定
     *
     * @access public
     * @param int サイトID
     * @return bool true: OK、false: NG
     */
    function isSite($site_id)
    {
        if ($this->authority_data->is_admin) {
            return true;
        } else {
            return isset($this->authority_data->site_id[$site_id]);
        }
    }

    /**
     * 表示権限のないメニューを削除
     *
     * @access public
     * @param object メニューオブジェクト
     * @return bool true: カレントメニュー表示権限あり、false: カレントメニュー表示権限なし
     */
    function applyAuthority(&$menus)
    {
        if ($this->authority_data->is_admin) {
            return true;
        } else {
            $lower_access = false;
            $menu_depth = count($menus);
            for ($i=0; $i<$menu_depth; $i++) {
                $nots = array();
                for ($j=0; $j<count($menus[$i]); $j++) {
                    $menu_id          = $menus[$i][$j]->id;
                    $is_current_depth = $menus[$i][$j]->is_current_depth;
                    if (isset($this->authority_data->menu_id[$menu_id])) {
                        if ($is_current_depth && $this->authority_data->menu_id[$menu_id]) {
                            $lower_access = true;
                        }
                    } else {
                        if (!$is_current_depth && ($i == $menu_depth - 1)) {
                            $menus = array();
                            return false;
                        }
                        // 権限なし メニュー削除（非表示）
                        $nots[] = $j;
                    }
                }
                foreach (array_reverse($nots) as $not) {
                    array_splice($menus[$i], $not, 1);
                }
                if ($lower_access) {
                    break;
                }
            }
            return true;
        }
    }
}

?>
