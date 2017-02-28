<?php
SyL_Loader::fw('Filter');
SyL_Loader::userLib('EuryL.Manager');

/**
 * ��˥塼�ϥ�ɥ�󥰥ե��륿���饹
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
     * ��˥塼�˴ؤ�����������Ԥ�
     *
     * @access public
     * @param object �ǡ����������֥�������
     * @param object ����ƥ����ȥ��֥�������
     */
    function preAction(&$data, &$context)
    {
        $authority_manager =& EuryLManager::getManager('authority');
        $authority_manager->restoreSession($context);

        $script_name = $context->getScriptName();
        /*
        if ($context->getPathInfo() != '') {
            if (!$authority_manager->isLogin()) {
                // ǧ�ڥ��顼
                SyL_Response::redirect(dirname($script_name) . '/login.php');
            }
        }
        */
        $data->setRef('ag_script_name', $script_name);
        $data->setRef('ag_script_dir', dirname($script_name));
    }
}

?>
