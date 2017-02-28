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
        //$authority_manager =& EuryLManager::getManager('authority');

        $menus =& $data->getRef('ag_menu_list');


/*
        echo "\n\n";
        echo "カレントメニュー:\n";
        print_r($menu);
        echo "\n\n";

        echo "ぱんくず:\n";
        echo "TOP";
        for ($i=0; $i<count($pankuzus); $i++) {
            echo " / " . $pankuzus[$i]->name;
        }
        echo "\n\n";


        echo "\n\n";
        echo "メニューリスト:\n";
        for ($i=0; $i<count($lists); $i++) {
            echo ($i+1) . " 階層:\n";
            for ($j=0; $j<count($lists[$i]); $j++) {
                echo $lists[$i][$j]->name . "\n";
            }
        }
        echo "\n\n";
*/

    }

}

?>
