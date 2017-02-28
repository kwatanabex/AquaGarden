<?php
SyL_Loader::userLib('EuryL.Manager');
/**
 * Index ���饹
 *
 * @access    public
 * @package   test
 * @author    {author}
 * @copyright {copyright}
 * @version   $Id:$
 */
class Menu extends AppAction
{
    /**
     * �ǥե���ȥ�����������
     *
     * @access public
     * @param object �ǡ����������֥�������
     * @param object ����ƥ����ȴ������֥�������
     * @return void
     */
    function execute(&$data, &$context)
    {
        $conn =& $context->getDB();

        $authority_manager =& EuryLManager::getManager('authority');

        $menu_manager =& EuryLManager::getManager('menu');

        $menu_manager->applyMenu($context);

        $menu =& $menu_manager->getCurrentMenu();
        $pankuzus =& $menu_manager->getPankuzuList();
        $lists =& $menu_manager->getMenuList();

        if (count($menu) == 0) {
            // 404 Not Found
            echo "404 Not Found";
            exit;
        }


        echo "\n\n";
        echo "�����ȥ�˥塼:\n";
        print_r($menu);
        echo "\n\n";

        echo "�Ѥ󤯤�:\n";
        echo "TOP";
        for ($i=0; $i<count($pankuzus); $i++) {
            echo " / " . $pankuzus[$i]->name;
        }
        echo "\n\n";


        echo "\n\n";
        echo "��˥塼�ꥹ��:\n";
        for ($i=0; $i<count($lists); $i++) {
            echo ($i+1) . " ����:\n";
            for ($j=0; $j<count($lists[$i]); $j++) {
                echo $lists[$i][$j]->name . "\n";
            }
        }
        echo "\n\n";
print_r($lists);
    }

}

?>
