<?php
/**
 * AQUA GARDEN ログインクラス
 *
 * @access    public
 * @package   AquaGarden.Login
 * @author    Koki Watanabe <k.watanabe@syl.jp>
 * @copyright 2009 Koki Watanabe 
 * @copyright 2009 AQUA GARDEN Project. All rights reserved.
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
     */
    function execute(&$data, &$context)
    {
        $form =& $this->getActionForm($data, !$context->isPost(), 'EuryL.Form.Login');
        if ($context->isPost()) {
            if ($form->validate()) {
                $user_data = EuryLManager::createData('user');
                $user_data->login_id = $form->getValue('login_id');
                $user_data->login_passwd = $form->getValue('login_passwd');

                $authority_manager =& EuryLManager::getManager('authority');
                if ($authority_manager->login($context, $user_data)) {
                    SyL_Loggers::info('Login Success: ' . $user_data->login_id);
                    SyL_Response::redirect(dirname($context->getScriptName()) . '/admin.php');
                } else {
                    SyL_Loggers::warn('Login Error: ' . $user_data->login_id);
                    $form->setErrorMessage('login_id', 'ログインID、またはパスワードが一致しません');
                }
            }
        }
        $data->set('form', $form->getResultArray());
    }
}

?>
