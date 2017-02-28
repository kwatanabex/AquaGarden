<?php
SyL_Loader::userLib('EuryL.Data.Menu');

/**
 * EuryL メニュードメインマネージャクラス
 *
 * @package   SyL
 * @author    Koki Watanabe <k.watanabe@syl.jp>
 * @copyright 2006-2007 k.watanabe
 * @license   http://www.opensource.org/licenses/lgpl-license.php
 * @version   CVS: $Id:$
 * @link      http://www.syl.jp/
 */
class EuryLManagerMenu extends EuryLManager
{
    /**
     * メニューリストオブジェクトの配列
     *
     * @access protected
     * @var array
     */
    var $menus = array();
    /**
     * キャッシュの接頭辞
     *
     * @access protected
     * @var string
     */
    var $cache_prefix = 'menu.';

    /**
     * カレントメニューオブジェクトを取得する
     *
     * @access public
     * @return object カレントメニューオブジェクト
     */
    function &getCurrentMenu()
    {
        $menu = null;
        $index = count($this->menus) - 1;
        if ($index >= 0) {
            for ($i=0; $i<count($this->menus[$index]); $i++) {
                if ($this->menus[$index][$i]->is_current_depth) {
                    $menu =& $this->menus[$index][$i];
                    break;
                }
            }
        }
        return $menu;
    }

    /**
     * メニューリストオブジェクトの配列を取得する
     *
     * @access public
     * @return array メニューリストオブジェクトの配列
     */
    function &getMenuList()
    {
        return $this->menus;
    }

    /**
     * パンクズメニューリストオブジェクトの配列を取得する
     *
     * @access public
     * @return array パンクズメニューリストオブジェクトの配列
     */
    function &getPankuzuMenuList()
    {
        $menus = array();
        $index = count($this->menus);
        if ($index > 0) {
            for ($i=0; $i<$index; $i++) {
                $lines = count($this->menus[$i]);
                for ($j=0; $j<$lines; $j++) {
                    if ($this->menus[$i][$j]->is_current_depth) {
                        $menus[$i] =& $this->menus[$i][$j];
                        break;
                    }
                }
            }
        }
        return $menus;
    }

    /**
     * メニューデータを構築する
     *
     * @access public
     * @param object コンテキストオブジェクト
     * @param int アプリケーションID
     */
    function createMenuList(&$context, $application_id)
    {
        $router =& $context->getRouter();
        $url_names = $router->getUrlNames();

        $cache_key = md5(implode('_', $url_names));
        $cache = $context->getCache($cache_key, $this->cache_prefix);
        if ($cache) {
            $this->menus = $cache;
        } else {
            $this->applyMenuRecursive($this->menus, $url_names, $application_id);
            if (count($this->menus) > 0) {
                $context->setCache($cache_key, $this->menus, $this->cache_prefix);
            }
        }
    }

    /**
     * メニューデータを再帰的に構築する
     *
     * @access private
     * @param object カレントメニューオブジェクト
     * @param array メニューオブジェクトの配列
     * @param int アプリケーションID
     * @param array パンクズメニューオブジェクトの配列
     * @param array 検索するURL名の配列
     * @param int 検索階層
     */
    function applyMenuRecursive(&$menus, $url_names, $application_id, $parent_menu_id=null, $depth=0)
    {
        $parent_link = '/';
        for ($i=0; $i<count($menus); $i++) {
            foreach ($menus[$i] as $menu) {
                if ($menu->is_current_depth) {
                    $parent_link .= $menu->url_name . '/';
                    break;
                }
            }
        }

        $menu_table = EuryLManager::createTable('el_menu');
        $condition = $this->dao->createCondition();
        $condition->addEqual('APPLICATION_ID', $application_id);
        if ($parent_menu_id) {
            $condition->addEqual('PARENT_MENU_ID', $parent_menu_id);
        } else {
            $condition->addNull('PARENT_MENU_ID');
        }
        $condition->addEqual('ENABLE_FLAG', '1');
        $menu_table->setConditions($condition);
        $menu_table->addSort('MENU_ORDER');
        $menu_table->addSort('MENU_ID');

        $current_menu_id = null;
        foreach ($this->dao->select($menu_table) as $menu_table) {
            $menu_data =& $this->createMenuData($menu_table, $parent_link);
            if (isset($url_names[$depth]) && ($menu_data->url_name == $url_names[$depth])) {
                $menu_data->is_current_depth = true;
                $current_menu_id = $menu_data->id;
            }
            $menus[$depth][] =& $menu_data;
        }

        if (isset($url_names[$depth])) {
            if ($current_menu_id !== null) {
                $this->applyMenuRecursive($this->menus, $url_names, $application_id, $current_menu_id, ++$depth);
            } else {
                // 404 not found
                $menus = array();
            }
        }

    }

    /**
     * メニューデータオブジェクトを作成する
     *
     * @access private
     * @param object メニューテーブルオブジェクト
     * @return object メニューデータオブジェクト
     */
    function &createMenuData(&$menu_table, $parent_link)
    {
        $menu_data = EuryLManager::createData('menu');
        $menu_data->id   = $menu_table['MENU_ID'];
        $menu_data->name = $menu_table['MENU_NAME'];
        $menu_data->parent_id = $menu_table['PARENT_MENU_ID'];
        $menu_data->url_name = ucfirst($menu_table['MENU_URL_NAME']);
        $menu_data->display_flag = $menu_table['DISPLAY_FLAG'];
        $menu_data->link = $parent_link . $menu_table['MENU_URL_NAME'] . '/';
        return $menu_data;
    }

}

?>
