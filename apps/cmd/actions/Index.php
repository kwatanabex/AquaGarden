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
class Index extends AppAction
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
        $authority_manager =& EuryLManager::getManager('authority');

        // -----------------------------
        // �����󥨥顼
        // -----------------------------
        $user_data = EuryLManager::createData('user');
        $user_data->login_id = "user";
        $user_data->login_passwd = "badpass";

        if ($authority_manager->login($user_data)) {
            // ���å������Ͽ $authority_manager
            echo "Login OK\n";
        } else {
            echo "Login NG\n";
        }

        // -----------------------------
        // ����������
        // -----------------------------
        $user_data = EuryLManager::createData('user');
        $user_data->login_id = "administrator";
        $user_data->login_passwd = "euryl";

        if ($authority_manager->login($user_data)) {
            // ���å������Ͽ $authority_manager
            echo "Login OK\n";
        } else {
            echo "Login NG\n";
        }

        // -----------------------------
        // ���¥ޥ͡�����
        // -----------------------------
        //print_r($authority_manager);

        echo "site auth: " . $authority_manager->isSite("1") . "\n";
        //echo "menu auth: " . $authority_manager->isMenu("1") . "\n";

        // -----------------------------
        // �桼�����ǡ�������
        // -----------------------------
        $user_data = $authority_manager->getUser();
        print_r($user_data);


        // -----------------------------
        // �桼�����ǡ�����Ͽ
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
        // �桼�����ǡ�������
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
